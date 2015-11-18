<?php

namespace Code4\Platform\Controllers;

use App\Http\Controllers\Controller;

use Code4\Platform\Components\Users\CreateUserForm;
use Code4\Platform\Components\Users\EditUserForm;
use Code4\Platform\Components\Users\UsersDataTable;
use Code4\Platform\Contracts\Auth;
use Code4\Platform\Models\User;
use Code4\View\Facades\ViewHelper;
use Illuminate\Contracts\Logging\Log;
use Illuminate\Http\Request;

use App\Http\Requests;

class UsersController extends Controller
{
    /**
     * Lista użytkowników
     * @return \Illuminate\View\View
     */
    public function index() {
        $dt = \DataTable::make(UsersDataTable::class);
        return view('platform::users.index', compact('dt'));
    }

    /**
     * Renders data for index Data Grid
     * @param Request $request
     * @return array
     */
    public function indexDataTable(Request $request) {
        return \DataTable::make(UsersDataTable::class)->renderData($request);
    }

    /**
     * Tworzenie nowego usera
     * @return \Illuminate\View\View
     */
    public function create(Auth $auth) {
        //Sprawdzamy uprawnienia do zasobu
        if (!$auth->hasAccess('users.create')) {
            \Alert::error('Brak uprawnień do tworzenia tego zasobu');
            return redirect()->back();
        }

        //Dodawania userów nie ma w menu więc musimy aktywować ręcznie
        \Menu::get('main')->setActiveByPath('settings.users');

        $permissions = \Config::get('permissions');

        $roleRepo = $auth->getRolesModel();
        $roles = $roleRepo->all();

        $form = new CreateUserForm();
        $form->get('role')->options($roles);

        return view('platform::users.create', compact('permissions','roles', 'form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Requests\UserStoreRequest  $request
     * @return Response
     */
    public function store(Request $request, Auth $auth)
    {
        $form = new CreateUserForm();
        if (!$form->validate($request)) {
            return $form->response();
        }

        //Ustalamy czy user ma być od razu aktywowany
        $activate = $request->has('activate') && $request->get('activate') ? true : false;

        //Generacja qr-hash i sprawdzenie czy jest unikatowy
        $loginHash = generateUniqueHash('uid');

        while (!User::isUnique('login_hash', $loginHash)) {
            $loginHash = generateUniqueHash('uid');
        }

        /*while(!User::isThisIdUnique($loginHash)) {
            $loginHash = generateUniqueHash('uid');
        }*/

        //Listowanie danych do zapisania
        $credentials = [
            'email' => $request->get('email'),
            'password' => $request->get('password'),
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'job_title' => $request->get('job_title'),
            'login_hash' => $loginHash
        ];

        //Rejestracja użytkownika
        //$user = \Sentinel::register($credentials, $activate);
        $userId = $auth->addUser($credentials, $activate);

        //Dodawanie użytkownika do ról
        foreach($request->get('role') as $roleId) {
            $auth->addUserToRole($userId, $roleId);

            //$r = \Sentinel::findRoleById($roleId);
            //$r->users()->attach($user);
        }

        //Listowanie przesłanych uprawnień
        $permissions = [];
        if ($request->has('permission')) {
            foreach($request->get('permission') as $key => $perm) {
                foreach($perm as $k => $v) {
                    switch($v) {
                        case "true":
                            $permissions[$k] = true;
                            break;
                        case "false":
                            $permissions[$k] = false;
                            break;
                    }
                }
            }
        }

        //Zapisujemy uprawnienia
        $auth->addUserPermissions($userId, $permissions);
//        $user->permissions = $permissions;
//        $user->save();

        \Alert::success('Użytkownik utworzony');

        if ($activate) {
            \Alert::info('Użytkownik '.$request->get('email').' aktywowany');
        }

        return ViewHelper::jsRedirect(action('\Code4\Platform\Controllers\UsersController@index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $form = new EditUserForm();

        $permissions = \Config::get('permissions');

        $user = \Sentinel::findById($id);

        if (!$user) {
            \Alert::warning('Nie znaleziono użytkownika o ID: '.$id.'!');
            return redirect(action('UsersController@index'));
        }

        $roleRepo = \Sentinel::getRoleRepository()->createModel();
        $roles = $roleRepo->all();

        //Menu::get('menu')->item('settings')->activate();

        return view('platform::users.edit', compact('permissions','user','roles', 'form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Requests\UserUpdateRequest  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $userId, Auth $auth)
    {
        $form = new EditUserForm();
        if (!$form->validate($request)) {
            return $form->response();
        }

        if (!($user = User::find($userId))) {
            return response('User not found!', 404);
        }

        //Listowanie danych do zapisania
        $credentials = [
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'job_title' => $request->get('job_title'),
        ];
        if ($request->has('password') && $request->get('password') != '') {
            $credentials['password'] = $request->get('password');
        }

        if ($request->has('email') && $request->get('email') != '') {
            $credentials['email'] = $request->get('email');
        }

        $auth->editUser($userId, $credentials);

        //Aktualizowanie ról użytkownika
        $roleIds = [];
        foreach($request->get('role') as $rId) {
            $roleIds[] = $rId;
        }
        $auth->syncUserRoles($userId, $roleIds);

        //Ustalamy czy user ma być aktywowany czy nie
        $activate = $request->has('activate') && $request->get('activate') ? true : false;

        //Listowanie przesłanych uprawnień
        $permissions = [];
        if ($request->has('permission')) {
            foreach($request->get('permission') as $key => $perm) {
                foreach($perm as $k => $v) {
                    switch($v) {
                        case "true":
                            $permissions[$k] = true;
                            break;
                        case "false":
                            $permissions[$k] = false;
                            break;
                    }
                }
            }
        }

        //Zapisujemy uprawnienia
        $user->permissions = $permissions;
        $user->save();

        \Alert::success('Użytkownik zaktualizowany');

        return ViewHelper::jsRedirect(action('\Code4\Platform\Controllers\UsersController@index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $user = \Sentinel::findById($id);
        if (!$user) { \Alert::error('Nie znaleziono użytkownika o ID'); }
        if ($user->delete()) {
            \Alert::success('Użytkownik usunięty!');
        }
        return redirect(action("UsersController@index"));
    }
}

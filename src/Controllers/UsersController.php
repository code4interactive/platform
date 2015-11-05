<?php

namespace Code4\Platform\Controllers;

use App\Http\Controllers\Controller;

use App\Components\C4Form\C4Form;

use Code4\Platform\Components\Users\DT\UsersDataTable;
use Code4\Platform\Models\User;
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
    public function create() {
        //Sprawdzamy uprawnienia do zasobu
        //\Sentinel::check('user.create');
        if (\Platform::permission('user.create')) {
            return redirect()->back();
        }

        //Dodawania userów nie ma w menu więc musimy aktywować ręcznie
        \Menu::get('main')->setActiveByPath('settings.users');

        $permissions = \Config::get('permissions');

        $roleRepo = \Sentinel::getRoleRepository()->createModel();
        $roles = $roleRepo->all();

        return view('platform::users.create', compact('permissions','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Requests\UserStoreRequest  $request
     * @return Response
     */
    public function store(Requests\UserStoreRequest $request)
    {
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
        $user = \Sentinel::register($credentials, $activate);

        //Dodawanie użytkownika do ról
        foreach($request->get('role') as $rId) {
            $r = \Sentinel::findRoleById($rId);
            $r->users()->attach($user);
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
        $user->permissions = $permissions;
        $user->save();

        \Alert::success('Użytkownik utworzony');

        if ($activate) {
            \Alert::info('Użytkownik '.$request->get('email').' aktywowany');
        }

        return C4Form::jsRedirect(action('UsersController@index'));
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
        $form = new C4Form('Modules/Users/Forms/editUser');

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
    public function update(Requests\UserUpdateRequest $request, $id)
    {
        $user = User::find($id);

        $user->roles()->detach();
        //Aktualizowanie ról użytkownika
        foreach($request->get('role') as $rId) {
            $r = \Sentinel::findRoleById($rId);
            $r->users()->attach($user);
        }

        //Listowanie danych do zapisania
        $credentials = [
            'first_name' => $request->get('first_name'),
            'last_name' => $request->get('last_name'),
            'job_title' => $request->get('job_title'),
        ];
        \Sentinel::update($user, $credentials);

        if ($request->has('password') && $request->get('password') != '') {
            \Sentinel::update($user, array('password' => $request->get('password')));
        }

        if ($request->has('email') && $request->get('email') != '') {
            \Sentinel::update($user, array('email' => $request->get('email')));
        }

        //Ustalamy czy user aktywowany czy nie
        $activate = $request->has('activate') && $request->get('activate') ? true : false;

        if ($activate)
        {
            if (!\Activation::completed($user)) {

                if (\Activation::exists($user)) {
                    $activation = \Activation::exists($user);
                } else {
                    $activation = \Activation::create($user);
                }

                $code = $activation->code;
                \Activation::complete($user, $code);
            }

        } else {
            \Activation::remove($user);
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
        $user->permissions = $permissions;
        $user->save();

        \Alert::success('Użytkownik zaktualizowany');
        return C4Form::jsRedirect(action('UsersController@index'));

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
        if (!$user) { Alert::error('Nie znaleziono użytkownika o ID'); }
        if ($user->delete()) {
            Alert::success('Użytkownik usunięty!');
        }
        return redirect(action("UsersController@index"));
    }
}

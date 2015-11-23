<?php

namespace Code4\Platform\Controllers;

//use App\Components\C4Form\C4Form;
use Code4\Platform\Components\Roles\DataTables\RolesDataTable;
use Code4\Platform\Components\Roles\Forms\CreateRoleForm;
use Code4\Platform\Models\Role;
use Cartalyst\Alerts\Laravel\Facades\Alert;
use Code4\View\Facades\ViewHelper;
use Illuminate\Http\Request;
use Code4\Platform\Contracts\Auth;


use App\Http\Requests;

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $dt = \DataTable::make(RolesDataTable::class);
        return view('platform::roles.index', compact('dt'));
    }

    /**
     * Renders data for index Data Grid
     * @param Request $request
     * @return array
     */
    public function indexDataTable(Request $request) {
        return \DataTable::make(RolesDataTable::class)->renderData($request);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        \Menu::get('main')->setActiveByPath('settings.roles');
        $form = new CreateRoleForm();
        $permissions = \Config::get('permissions');
        return view('platform::roles.create', compact('permissions','form'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles|max:255',
            'slug' => 'required|unique:roles|max:255',
        ]);

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

        \Sentinel::getRoleRepository()->setModel('Code4\Platform\Models\Role');

        $role = \Sentinel::getRoleRepository()->createModel()->create([
            'name' => $request->get('name'),
            'slug' => $request->get('slug')
        ]);

        $role->permissions = $permissions;
        $role->save();

        Alert::success('Rola zapisana');

        return ViewHelper::jsRedirect(action('\Code4\Platform\Controllers\RolesController@index'));
        //return C4Form::jsRedirect(action('RolesController@index'));
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
    public function edit($id, Auth $auth)
    {
        //check permissions

        if (!$auth->hasAccess('roles.edit')) {
            redirect(action('\Code4\Platform\Controllers\RolesController@index'));
        }

        \Menu::get('main')->setActiveByPath('settings.roles');

        $permissions = \Config::get('permissions');
        $role = Role::find($id);

        $form = new CreateRoleForm();
        $form->values($role);

        return view('platform::roles.edit', compact('role', 'permissions', 'form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'id'   => 'required',
            'name' => 'required|max:255'
        ]);

        \Sentinel::getRoleRepository()->setModel('Code4\Platform\Models\Role');

        $role = \Sentinel::findRoleById($request->id);
        $role->name = $request->get('name');

        if ($request->has('permission')) {
            foreach($request->get('permission') as $key => $perm) {
                foreach($perm as $k => $v) {
                    switch($v) {
                        case "true":
                            $role->updatePermission($k, true, true)->save();
                            break;
                        case "false":
                            $role->updatePermission($k, false, true)->save();
                            break;
                        case "notset":
                            $role->removePermission($k)->save();
                            break;
                    }
                }
            }
        }

        $role->save();

        Alert::success('Rola zapisana');

        return ViewHelper::jsRedirect(action('\Code4\Platform\Controllers\RolesController@index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $role = \Sentinel::findRoleById($id);
        if (!$role) { Alert::error('Nie znaleziono roli o ID'); }
        if ($role->delete()) {
            Alert::success('Rola usunięta!');
        }
        return redirect(action("RolesController@index"));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UtilisateurController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all();

        return view('configuration.users.liste', ['titre' => "Liste des Utilisateurs", 'users' => $users]);
    }

    public function edit($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('configuration.users.edit', ['titre' => "Modifier Utilisateur ".$user->nom, 'user' => $user, 'roles' => $roles]);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $user->name = $request->input('name');

        try{
            $user->save();

            $hisRole = $user->roles;

            if(isset($hisRole) AND !empty($hisRole) AND isset($hisRole[0])){
                $oldRole = $hisRole[0];
                $user->removeRole($oldRole->name);
            }

            $newRole = Role::findById($_POST['role_id']);

            $user->assignRole($newRole->name);

        }catch (\Exception $e){
            echo'e';
        }
        return redirect()->route('user.index');
    }

    public function permissions($id){
        $temp = Role::find($id);
        $role = Role::findById($temp->id);

        $permissions = $role->load('permissions');

        //echo('<pre>'); die(print_r($permisions->permissions));
        return view('configuration.role.listePermission', ['titre' => "Liste des Permissions du Profil ".$role->guard_name, 'permissions' => $permissions->permissions, 'role' => $role]);
    }

    public function addPermission($id){
        $temp = Role::find($id);
        $role = Role::findById($temp->id, $temp->guard_name);

        $x = $role->load('permissions');

        $permissions = Permission::all();

        foreach ($permissions as $key => $permission) {
            //echo('<pre>'); die(print_r($permission));
            if($role->hasPermissionTo($permission->name)){
                $permissions[$key]->Checked = 'checked';
            }else{
                $permissions[$key]->Checked = '';
            }
            //$role->hasPermissionTo('edit articles');
        }

        //echo('<pre>'); die(print_r($permissions));
        return view('configuration.role.ajouterPermission', ['titre' => "Ajouter Permissions du Profil ".$role->guard_name, 'role' => $role, 'permissions' => $permissions]);
    }

    public function grantPermission(Request $request, $id){
        $temp = Role::find($id);
        $role = Role::findByName($temp->name);

        $permissions = Permission::all();

        //echo('<pre>'); die(print_r($role));

        foreach ($permissions as $permission) {
            $role->revokePermissionTo($permission->name);
            if(isset($_POST['role_'.$permission->id]) AND $_POST['role_'.$permission->id] == 'on'){
                $role->givePermissionTo($permission->name);
            }
        }
        return redirect('profil/permission/'.$id);
        //echo('<pre>'); die(print_r($_POST));
    }

    public function revoquer($idRole, $idPermission){
        $role = Role::findById($idRole);

        $permission = Permission::findById($idPermission);

        if($role->hasPermissionTo($permission->name)){
            $role->revokePermissionTo($permission->name);
        }

        return redirect()->back()->withInput();
    }
}

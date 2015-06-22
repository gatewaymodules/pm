<?php

namespace App\Http\Controllers;

//namespace App\Http\Controllers;

use Input;
use Redirect;
use App\User;
use App\Role;
use App\Permission;
use Illuminate\Http\Request;

class RoleController extends Controller
{

    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $user = User::where('email', '=', 'eugenevdm@gmail.com')->first();
        if ($user->hasRole('admin')) {
            die ("User has role admin");
        } else {
            die ("User does not have admin role");
        }
        //return view('role.index', compact($user));
        //$this->deletePerm();
        //$admin = $this->createRoles();
        //$adminUsers = $this->attachPerms($admin);
        //$admin->attachPermission($adminUsers);
        // equivalent to $admin->perms()->sync(array($createPost->id));
    }

    function createRoles()
    {
        // Steps to create a role
        $admin = new Role();
        $admin->name = 'admin';
        $admin->display_name = 'User Administrator'; // optional
        $admin->description = 'User is allowed to manage and edit other users'; // optional
        $admin->save();
        $user = User::where('email', '=', 'eugene@snowball.co.za')->first();
        // role attach alias
        $user->attachRole($admin); // parameter can be an Role object, array, or id
        // or eloquent's original technique
        //$user->roles()->attach($admin->id); // id only
        return $admin;
    }

    function attachPerms($admin)
    {
        $adminUsers = new Permission();
        $adminUsers->name = 'admin-users';
        $adminUsers->display_name = 'Administrate Users'; // optional
        // Allow a user to...
        $adminUsers->description = 'create, change, delete users'; // optional
        $adminUsers->save();

        //$editUser = new Permission();
        //$editUser->name         = 'edit-user';
        //$editUser->display_name = 'Edit Users'; // optional
        // Allow a user to...
        //$editUser->description  = 'edit existing users'; // optional
        //$editUser->save();

        //$owner->attachPermissions(array($createPost, $editUser));
        // equivalent to $owner->perms()->sync(array($createPost->id, $editUser->id));

        return $adminUsers;
    }

    function deletePerm()
    {
        //$role = Role::findOrFail(1);

        // Regular Delete
        //$role->delete(); // This will work no matter what
    }

}



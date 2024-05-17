<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserRole;
use App\Models\User;

class UserRoleController extends Controller
{
    public function index()
    {
        $roles = UserRole::all();
        return view('backend.roles.index', compact('roles'));
    }

    public function create()
    {
        $users=User::get();
        return view('backend.roles.create')
            ->with('users',$users);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|unique:user_roles',
            'role' => 'required',
            'status' => 'required',
            // Add validation for other fields if necessary
        ]);

        UserRole::create($request->all());

        return redirect()->route('roles.index')
            ->with('success', 'User Role created successfully.');
    }

    public function show(UserRole $role)
    {
        return view('backend.roles.show', compact('role'));
    }

    public function edit($id)
    {
        $role=UserRole::findOrFail($id);
        $users=User::get();
        return view('backend.roles.edit')
            ->with('role',$role)
            ->with('users',$users);
    }

    public function update(Request $request, UserRole $role)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'name' => 'required|unique:user_roles',
            'role' => 'required',
            'status' => 'required',
            // Add validation for other fields if necessary
        ]);

        $role->update($request->all());

        return redirect()->route('roles.index')
            ->with('success', 'User Role updated successfully');
    }

    public function destroy(UserRole $role)
    {
        $role->delete();

        return redirect()->route('roles.index')
            ->with('success', 'User Role deleted successfully');
    }
}

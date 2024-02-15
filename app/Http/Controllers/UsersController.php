<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Requests\RegisterRequest;

class UsersController extends Controller
{
    /**
     * Display all users
     * 
     * @return \Illuminate\Http\Response
     */
    public function showBackOfficeIndex()
    {
        $users = User::latest()->paginate(10);

        return view('backoffice.users.index', compact('users'));
    }

    /**
     * Show form for creating user
     * 
     * @return \Illuminate\Http\Response
     */
    public function showBackOfficeCreate()
    {
        return view('backoffice.users.create');
    }

    /**
     * Store a newly created user
     * 
     * @param User $user
     * @param StoreUserRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function backOfficeStore(RegisterRequest $request)
    {
        User::create($request->validated());

        return redirect()->route('users.showBackOfficeIndex')
            ->withSuccess(__('Usuario creado correctamente.'));
    }

    /**
     * Show user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function showBackOfficeOne(User $user)
    {
        return view('backoffice.users.show', [
            'user' => $user
        ]);
    }

    /**
     * Edit user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function showBackOfficeEdit(User $user)
    {
        return view('backoffice.users.edit', [
            'user' => $user,
            'userRole' => $user->roles->pluck('name')->toArray(),
            'roles' => Role::latest()->get()
        ]);
    }

    /**
     * Update user data
     * 
     * @param User $user
     * @param UpdateUserRequest $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function backOfficeUpdate(User $user, RegisterRequest $request)
    {
        $user->update($request->validated());

        $user->syncRoles($request->get('role'));

        return redirect()->route('users.showBackOfficeIndex')
            ->withSuccess(__('Usuario actulizado correctamente.'));
    }

    /**
     * Delete user data
     * 
     * @param User $user
     * 
     * @return \Illuminate\Http\Response
     */
    public function backOfficeDestroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.showBackOfficeIndex')
            ->withSuccess(__('Usuario eliminado correctamente.'));
    }
}

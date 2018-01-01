<?php

namespace App\Http\Controllers;

use App\User;
use App\Branch;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $branches = Branch::all();
        return view('users.create', compact('branches'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'username' => 'required|unique:users,username',
            'password' => 'required|min:6',
            'confirm_password' => 'required|same:password',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'branch_id' => $request->branch_id,
        ]);

        return redirect()->route('users.index');
    }

    public function edit(User $user)
    {
        $branches = Branch::all();
        return view('users.edit', compact('branches', 'user'));
    }

    public function update(Request $request, User $user)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $user->id,
            'username' => 'required|unique:users,username,' . $user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
            'branch_id' => $request->branch_id,
        ]);

        return redirect()->route('users.index');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users.index');
    }
}

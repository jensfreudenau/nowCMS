<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;

class UserController extends Controller
{
    public function index()
    {
        return view('admin/user.index', [
            'users' => User::all()
        ]);
    }
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'email' => ['required'],
        ]);
        User::create($request->all());
        return redirect('/users/index')->with('success', 'user created!');
    }

    public function create()
    {
        return view('/admin/user.createOrUpdate');
    }

    public function edit($id): View|Factory|Application
    {
        $user = User::find($id);
        return view('/admin/user.createOrUpdate', compact('user'));
    }

    public function update(Request $request, $id): Application|Redirector|RedirectResponse
    {
        $validatedData = $request->validate([
            'email' => ['required'],
        ]);

        $user = User::find($id);
        $user->update($request->all());
        return redirect('/users/index')->with('success', 'user created!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $user
     * @return RedirectResponse
     */
    public function destroy(User $user): RedirectResponse
    {
        $user->delete();

        return redirect('/users/index')->with('success', 'user deleted successfully');
    }
}

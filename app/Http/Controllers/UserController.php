<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use App\Jobs\EnviarBienvenidaJob;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       return view('admin.users.index', [
        'users' => User::with('role')->get()
       ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.users.create', [
           'roles' => Role::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role_id' => 'required',
        ]);

         $validated['password'] = Hash::make($validated['password']);

         $user = User::create($validated);
         \Log::info('Dispatching job...');
         EnviarBienvenidaJob::dispatch($user)->onQueue('emails');

         return redirect()->route('admin.users.index')->with('success', 'Usuario creado correctamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', [
        'user' => $user,
        'roles' => Role::all()
    ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
        'name' => 'required',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role_id' => 'required',
    ]);

    if ($request->filled('password')) {
        $validated['password'] = Hash::make($request->password);
    }

    $user->update($validated);

    return redirect()->route('admin.users.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
     //   $user = User::findOrFail($id);  
        $user->delete();
        return redirect()->route('admin.users.index');
    }
}

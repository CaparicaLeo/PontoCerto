<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Clock;

class AdminController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $adminUser = Auth::user();
        $users = User::all()->except($adminUser->id);

        return view('admin.dashboard', compact('users'));
    }
    public function show($id)
    {
        $user = User::findOrFail($id);
        return view('admin.show', compact('user'));
    }
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'Usuário deletado com sucesso.');
    }
    public function destroyClock($id)
    {
        $clock = Clock::findOrFail($id);
        $userId = $clock->user_id;
        $clock->delete();
        
        return redirect()
            ->route('admin.users.show', $userId)
            ->with('success', 'Registro de ponto deletado com sucesso.');
    }
}

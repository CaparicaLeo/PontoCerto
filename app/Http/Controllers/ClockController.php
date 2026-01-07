<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Clock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClockController extends Controller
{
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $clocks = $user
            ->clocks()
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('clocks.index', compact('clocks', 'user'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'nullable|string|max:255',
            'clock_in'    => 'required',
            'clock_out'   => 'required|after:clock_in',
            'date'        => 'required|date',
        ]);
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $clock = $user->clocks()->create($validated);

        if ($request->expectsJson()) {
            return response()->json(['success' => true, 'clock' => $clock]);
        }

        return redirect()->route('clocks.index');
    }

    public function destroy($id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $user->clocks()->where('id', $id)->delete();

        return redirect()->route('clocks.index');
    }
    public function edit($id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $clock = \App\Models\Clock::where('user_id', $user->id)
            ->findOrFail($id);

        return view('clocks.edit', compact('clock'));
    }
    public function update(Request $request, $id)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $clock = \App\Models\Clock::where('user_id', $user->id)
            ->findOrFail($id);

        $validated = $request->validate([
            'description' => 'nullable|string|max:255',
            'clock_in'    => 'required|date',
            'clock_out'   => 'nullable|date|after_or_equal:clock_in',
        ]);

        $clock->update($validated);

        return redirect()
            ->route('clocks.index')
            ->with('success', 'Clock atualizado com sucesso');
    }
}

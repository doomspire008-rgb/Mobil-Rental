<?php

namespace App\Http\Controllers\Web\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    public function index(Request $request): View
    {
        $users = User::query()
            ->withCount('bookings')
            ->when($request->filled('search'), function ($q) use ($request) {
                $q->where(function ($sub) use ($request) {
                    $sub->where('name', 'like', "%{$request->search}%")
                        ->orWhere('email', 'like', "%{$request->search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    public function updateRole(Request $request, User $user): RedirectResponse
    {
        $data = $request->validate([
            'role' => 'required|in:admin,customer',
        ]);

        if ($user->id === auth()->id() && $data['role'] !== 'admin') {
            return redirect()->route('admin.users.index')
                ->with('error', 'Anda tidak dapat mengubah role akun Anda sendiri.');
        }

        $user->update(['role' => $data['role']]);

        return redirect()->route('admin.users.index')
            ->with('success', 'Role ' . $user->name . ' berhasil diperbarui.');
    }
}

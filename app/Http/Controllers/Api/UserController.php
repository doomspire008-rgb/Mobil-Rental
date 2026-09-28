<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::withCount(['bookings', 'cars'])
            ->when($request->filled('role'), fn ($q) => $q->where('role', $request->role))
            ->when($request->filled('search'), function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                    ->orWhere('email', 'like', "%{$request->search}%");
            })
            ->latest()
            ->paginate($request->get('per_page', 20))
            ->withQueryString();

        return response()->json([
            'success' => true,
            'data' => $users,
        ]);
    }

    public function show(int $id)
    {
        $user = User::with(['bookings.car.category', 'cars.category'])->findOrFail($id);
        
        return response()->json([
            'success' => true,
            'data' => $user,
        ]);
    }

    public function updateRole(Request $request, int $id)
    {
        $request->validate([
            'role' => 'required|in:admin,customer',
        ]);

        $user = User::findOrFail($id);
        
        if ($user->id === $request->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak dapat mengubah role sendiri',
            ], 422);
        }

        $user->update(['role' => $request->role]);
        
        return response()->json([
            'success' => true,
            'message' => 'Role pengguna diperbarui',
            'data' => $user,
        ]);
    }

    public function destroy(int $id)
    {
        $user = User::findOrFail($id);
        
        if ($user->id === request()->user()->id) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak dapat menghapus akun sendiri',
            ], 422);
        }

        $user->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Pengguna berhasil dihapus',
        ]);
    }
}
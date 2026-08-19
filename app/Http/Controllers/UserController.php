<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Menampilkan daftar seluruh user.
     */
    public function index()
    {
        $users = User::latest()->get();

        return view('users.index', compact('users'));
    }

    /**
     * Form tambah user.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Menyimpan user baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|in:admin,user',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        return redirect()
            ->route('users.index')
            ->with('success', 'User berhasil ditambahkan.');
    }

    /**
     * Form edit user.
     */
    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

    /**
     * Memperbarui data user.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'role' => 'required|in:admin,user',
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Proteksi Admin
        |--------------------------------------------------------------------------
        */

        // Admin tidak boleh mengubah role dirinya sendiri menjadi User.
        if ($user->id === auth()->id() && $request->role !== 'admin') {
            return back()
                ->withInput()
                ->with('error', 'Anda tidak dapat mengubah role akun sendiri menjadi User.');
        }

        // Jangan sampai admin terakhir diturunkan menjadi User.
        if (
            $user->role === 'admin' &&
            $request->role === 'user' &&
            User::where('role', 'admin')->count() <= 1
        ) {
            return back()
                ->withInput()
                ->with('error', 'Tidak dapat mengubah role. Sistem harus memiliki minimal satu Admin.');
        }

        /*
        |--------------------------------------------------------------------------
        | Update Data
        |--------------------------------------------------------------------------
        */

        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;

        // Password hanya diubah jika admin mengisi password baru.
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()
            ->route('users.index')
            ->with('success', 'User berhasil diperbarui.');
    }

    /**
     * Menghapus user.
     */
    public function destroy(User $user)
    {
        /*
        |--------------------------------------------------------------------------
        | Proteksi Admin
        |--------------------------------------------------------------------------
        */

        // Admin tidak boleh menghapus dirinya sendiri.
        if ($user->id === auth()->id()) {
            return back()
                ->with('error', 'Anda tidak dapat menghapus akun sendiri.');
        }

        // Jangan sampai admin terakhir terhapus.
        if (
            $user->role === 'admin' &&
            User::where('role', 'admin')->count() <= 1
        ) {
            return back()
                ->with('error', 'Admin terakhir tidak dapat dihapus. Sistem harus memiliki minimal satu Admin.');
        }

        $user->delete();

        return redirect()
            ->route('users.index')
            ->with('success', 'User berhasil dihapus.');
    }
}
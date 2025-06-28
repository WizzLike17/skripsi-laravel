<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();// Lebih baik gunakan paginate
        return view('admin.users.kelola', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:admin,validator,mahasiswa',  // Validasi role
            'photo' => 'nullable|image|max:2048',
        ]);
    
        // Simpan data
        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('photos', 'public');
        }
    
        User::create([
            'nama' => $validated['nama'],
            'nim' => $validated['nim'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
            'photo' => $photoPath,
        ]);
    
        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan.');
    }
    

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

public function update(Request $request, User $user)
{
    $validated = $request->validate([
        'nama' => 'required|string|max:255',
        'nim' => 'required|string|unique:users,nim,' . $user->user_id . ',user_id',
        'role' => 'required|in:admin,validator,mahasiswa',
        'photo' => 'nullable|image|max:2048',
    ]);

    if ($request->hasFile('photo')) {
        $oldPhoto = $user->getRawOriginal('photo');

        if ($oldPhoto && Storage::disk('public')->exists($oldPhoto)) {
            Storage::disk('public')->delete($oldPhoto);
        }

        $validated['photo'] = $request->file('photo')->store('photos', 'public');
    }

    $user->update($validated);

    return redirect()->route('users.index')->with('success', 'User berhasil diperbarui.');
}


    public function destroy(User $user)
    {
        if ($user->photo) {
            Storage::disk('public')->delete($user->photo);
        }

        $user->delete();
        return redirect()->route('admin.users.kelola')->with('success', 'User berhasil dihapus.');
    }
}

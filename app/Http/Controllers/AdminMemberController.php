<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminMemberController extends Controller
{
    public function index()
    {
        // Fetch members with pagination (excluding admins)
        $members = User::where('level', '!=', 'admin')->paginate(10);
        return view('admin.members.index', compact('members'));
    }

    public function create()
    {
        return view('admin.members.create');
    }

    public function store(Request $request)
    {
        // Validate incoming request data
        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create new member
        User::create([
            'nama_lengkap' => $validated['nama_lengkap'],
            'username' => $validated['username'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'level' => 'member',
        ]);

        return redirect()->route('admin.members.index')->with('success', 'Member berhasil ditambahkan.');
    }

    public function edit(User $member)
    {
        // Only allow editing non-admin members
        if ($member->isAdmin()) {
            return redirect()->route('admin.members.index')->with('error', 'Tidak dapat mengedit admin.');
        }
        return view('admin.members.edit', compact('member'));
    }

    public function update(Request $request, User $member)
    {
        if ($member->isAdmin()) {
            return redirect()->route('admin.members.index')->with('error', 'Tidak dapat mengupdate admin.');
        }

        $validated = $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($member->id)],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($member->id)],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        // Update member details
        $member->nama_lengkap = $validated['nama_lengkap'];
        $member->username = $validated['username'];
        $member->email = $validated['email'];

        if (!empty($validated['password'])) {
            $member->password = Hash::make($validated['password']);
        }

        $member->save();

        return redirect()->route('admin.members.index')->with('success', 'Member berhasil diperbarui.');
    }

    public function destroy(User $member)
    {
        if ($member->isAdmin()) {
            return redirect()->route('admin.members.index')->with('error', 'Tidak dapat menghapus admin.');
        }

        $member->delete();

        return redirect()->route('admin.members.index')->with('success', 'Member berhasil dihapus.');
    }
}

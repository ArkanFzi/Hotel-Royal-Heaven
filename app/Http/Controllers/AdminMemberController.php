<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminMemberController extends Controller
{
    /**
     * Display a listing of members.
     */
    public function index()
    {
        $members = User::where('level', 'member')->paginate(15);
        return view('admin.members.index', compact('members'));
    }

    /**
     * Show the form for creating a new member.
     */
    public function create()
    {
        return view('admin.members.create');
    }

    /**
     * Store a newly created member in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => 'member',
        ]);

        return redirect()->route('admin.members.index')->with('success', 'Member berhasil ditambahkan.');
    }

    /**
     * Show the form for editing the specified member.
     */
    public function edit(User $member)
    {
        return view('admin.members.edit', compact('member'));
    }

    /**
     * Update the specified member in storage.
     */
    public function update(Request $request, User $member)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($member->id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($member->id)],
            'password' => 'nullable|string|min:8|confirmed',
        ]);

        $member->nama_lengkap = $request->nama_lengkap;
        $member->username = $request->username;
        $member->email = $request->email;

        if ($request->filled('password')) {
            $member->password = Hash::make($request->password);
        }

        $member->save();

        return redirect()->route('admin.members.index')->with('success', 'Member berhasil diperbarui.');
    }

    /**
     * Remove the specified member from storage.
     */
    public function destroy(User $member)
    {
        $member->delete();
        return redirect()->route('admin.members.index')->with('success', 'Member berhasil dihapus.');
    }
}

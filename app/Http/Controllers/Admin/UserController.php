<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use App\Models\Dusun;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * LIST USER (ADMIN)
     */
    public function index(Request $request)
    {
        $query = User::with(['role', 'dusun']);

        // SEARCH
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('nama_lengkap', 'like', "%{$request->search}%")
                ->orWhere('nik', 'like', "%{$request->search}%")
                ->orWhere('email', 'like', "%{$request->search}%");
            });
        }

        // FILTER ROLE
        if ($request->role) {
            $query->where('role_id', $request->role);
        }

        // FILTER DUSUN
        if ($request->dusun) {
            $query->where('dusun_id', $request->dusun);
        }

        // SORT ONLY BY NAME (AMAN & FIXED)
        $sortOrder = $request->sort_order ?? 'asc';

        $query->orderBy('nama_lengkap', $sortOrder);

        $users = $query->paginate(10)->withQueryString();

        $roles = Role::all();
        $dusun = Dusun::all();

        return view('admin.users.index', compact('users', 'roles', 'dusun'));
    }

    /**
     * FORM CREATE
     */
    public function create()
    {
        $roles = Role::all();
        $dusun = Dusun::all();

        return view('admin.users.create', compact('roles', 'dusun'));
    }

    /**
     * STORE USER
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'role_id' => 'required|exists:roles,role_id',
            'dusun_id' => 'required|exists:dusun,dusun_id',
            'nik' => 'required|digits:16|unique:users,nik',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'pekerjaan' => 'nullable|string|max:255',
            'pendidikan_terakhir' => 'required|string',
            'status_perkawinan' => 'required|string',
            'agama' => 'required|string',
            'nomor_telepon' => 'required|digits_between:10,15',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&]).+$/'
            ],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil ditambahkan');
    }

    /**
     * DETAIL USER
     */
    public function show($id)
    {
        $user = User::with(['role', 'dusun'])
            ->findOrFail($id);

        return view('admin.users.show', compact('user'));
    }

    /**
     * FORM EDIT
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();
        $dusun = Dusun::all();

        return view('admin.users.edit', compact('user', 'roles', 'dusun'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // VALIDASI UTAMA (tanpa password dulu)
        $validated = $request->validate([
            'role_id' => 'required|exists:roles,role_id',
            'dusun_id' => 'required|exists:dusun,dusun_id',
            'nik' => 'required|digits:16|unique:users,nik,' . $id . ',user_id',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'pekerjaan' => 'nullable|string|max:255',
            'pendidikan_terakhir' => 'required|string',
            'status_perkawinan' => 'required|string',
            'agama' => 'required|string',
            'nomor_telepon' => 'nullable|string|max:20',
            'email' => 'required|email|unique:users,email,' . $id . ',user_id',
        ]);

        // 🔥 PASSWORD OPTIONAL (FIXED LOGIC)
        if ($request->filled('password')) {

            // hanya validasi kalau password diisi
            $request->validate([
                'password' => 'min:8|confirmed',
            ]);

            $validated['password'] = Hash::make($request->password);
        }

        $user->update($validated);

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil diperbarui');
    }

    /**
     * DELETE (SOFT DELETE)
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'User berhasil dihapus');
    }

    /**
     * TRASHED USER
     */
    public function trashed()
    {
        $users = User::onlyTrashed()
            ->with(['role', 'dusun'])
            ->latest('deleted_at')
            ->get();

        return view('admin.users.trashed', compact('users'));
    }

    /**
     * RESTORE USER
     */
    public function restore($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->restore();

        return back()->with('success', 'User berhasil direstore');
    }

    /**
     * FORCE DELETE
     */
    public function forceDelete($id)
    {
        $user = User::onlyTrashed()->findOrFail($id);
        $user->forceDelete();

        return back()->with('success', 'User dihapus permanen');
    }
}
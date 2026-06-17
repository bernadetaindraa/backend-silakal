<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Menampilkan semua user
     */
    public function index()
    {
        $users = User::with(['role', 'dusun'])
            ->latest('created_at')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data user berhasil diambil',
            'data' => $users
        ]);
    }

    /**
     * Menambahkan user baru
     */
    public function store(Request $request)
    {
        $validated = $request->validate([

            'role_id' => 'required|exists:roles,role_id',
            'dusun_id' => 'required|exists:dusun,dusun_id',
            'nik' => 'required|digits:13|unique:users,nik',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'pekerjaan' => 'nullable|string|max:255',
            'pendidikan_terakhir' => 'required|in:Tidak Sekolah,SD,SMP,SMA/K,D3,S1,S2,S3',
            'status_perkawinan' => 'required|in:Belum Kawin,Kawin,Cerai Hidup,Cerai Mati',
            'agama' => 'required|in:Islam,Kristen,Katolik,Hindu,Buddha,Konghucu',
            'nomor_telepon' => 'required|digits_between:10,15',
            'email' => 'required|email|unique:users,email',
            'password' => ['required','string','min:8','confirmed','regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&]).+$/'],
            'url_foto_profil' => 'nullable|string',
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nik.digits' => 'NIK harus 13 digit.',
            'nik.unique' => 'NIK sudah digunakan.',
            'nama_lengkap.required' => 'Nama lengkap wajib diisi.',
            'dusun_id.required' => 'Dusun wajib dipilih.',
            'tanggal_lahir.required' => 'Tanggal lahir wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin tidak valid.',
            'agama.required' => 'Agama wajib dipilih.',
            'status_perkawinan.required' => 'Status perkawinan wajib dipilih.',
            'pendidikan_terakhir.required' => 'Pendidikan terakhir wajib dipilih.',
            'nomor_telepon.required' => 'Nomor telepon wajib diisi.',
            'nomor_telepon.digits_between' => 'Nomor telepon harus 10-15 digit.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'password.regex' => 'Password harus mengandung huruf, angka, dan simbol.',
        ]);

        $validated['password'] = Hash::make($validated['password']);

        $user = User::create($validated);

        return redirect()
            ->route('login')
            ->with('success', 'Registrasi berhasil! Silakan login.');
    }

    /**
     * Menampilkan detail user
     */
    public function show($id)
    {
        $user = User::with(['role', 'dusun'])
            ->findOrFail($id);

        return response()->json([
            'success' => true,
            'message' => 'Detail user berhasil diambil',
            'data' => $user
        ]);
    }

    /**
     * Mengupdate user
     */
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $validated = $request->validate([
            'role_id' => 'required|exists:roles,role_id',
            'dusun_id' => 'required|exists:dusun,dusun_id',
            'nik' => 'required|string|unique:users,nik,' . $id . ',user_id',
            'nama_lengkap' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'pekerjaan' => 'nullable|string|max:255',
            'pendidikan_terakhir' => 'nullable|string|max:255',
            'status_perkawinan' => 'required|string|max:255',
            'agama' => 'required|string|max:255',
            'nomor_telepon' => 'nullable|string|max:20',
            'email' => 'required|email|unique:users,email,' . $id . ',user_id',
            'password' => 'nullable|min:6',
            'url_foto_profil' => 'nullable|string',
        ]);

        // password hanya diupdate jika diisi
        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'User berhasil diupdate',
            'data' => $user->load(['role', 'dusun'])
        ]);
    }

    /**
     * Soft delete user
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->delete();

        return response()->json([
            'success' => true,
            'message' => 'User berhasil dihapus'
        ]);
    }

    /**
     * Menampilkan user yang sudah dihapus
     */
    public function trashed()
    {
        $users = User::with(['role', 'dusun'])
            ->onlyTrashed()
            ->latest('deleted_at')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data user terhapus berhasil diambil',
            'data' => $users
        ]);
    }

    /**
     * Restore user
     */
    public function restore($id)
    {
        $user = User::onlyTrashed()
            ->findOrFail($id);

        $user->restore();

        return response()->json([
            'success' => true,
            'message' => 'User berhasil direstore'
        ]);
    }

    /**
     * Hapus permanen user
     */
    public function forceDelete($id)
    {
        $user = User::onlyTrashed()
            ->findOrFail($id);

        $user->forceDelete();

        return response()->json([
            'success' => true,
            'message' => 'User berhasil dihapus permanen'
        ]);
    }
}
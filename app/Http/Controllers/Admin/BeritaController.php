<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Berita;
use App\Models\BeritaFoto;
use App\Models\KategoriBerita;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BeritaController extends Controller
{

    public function index(Request $request)
    {
        $query = Berita::with([
            'user',
            'foto',
            'kategori'
        ]);

        if ($request->search) {

            $query->where(function ($q) use ($request) {

                $q->where('judul_berita', 'like', '%' . $request->search . '%')
                  ->orWhere('isi_berita', 'like', '%' . $request->search . '%');
            });
        }

        $berita = $query
            ->latest('tanggal_berita')
            ->paginate(10);

        return view('admin.berita.index', compact('berita'));
    }

    public function create()
    {
        $kategori = KategoriBerita::all();

        return view('admin.berita.create', compact('kategori'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_berita' => 'required|string|max:255',
            'isi_berita' => 'required|string',
            'tanggal_berita' => 'required|date',
            'status_berita' => 'required|string|max:100',
            'kategori_berita_id' => 'nullable|array',
            'kategori_berita_id.*' => 'exists:kategori_beritas,kategori_berita_id',
            'foto_berita' => 'nullable|array',
            'foto_berita.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'judul_berita.required' => 'Judul berita wajib diisi.',
            'isi_berita.required' => 'Isi berita wajib diisi.',
            'tanggal_berita.required' => 'Tanggal berita wajib diisi.',
            'status_berita.required' => 'Status berita wajib dipilih.',
            'kategori_berita_id.*.exists' => 'Kategori yang dipilih tidak valid.',
            'foto_berita.*.image' => 'File harus berupa gambar.',
            'foto_berita.*.mimes' => 'Format gambar harus JPG, JPEG, atau PNG.',
            'foto_berita.*.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $berita = Berita::create([
            'user_id' => Auth::user()->user_id,
            'judul_berita' => $validated['judul_berita'],
            'isi_berita' => $validated['isi_berita'],
            'tanggal_berita' => $validated['tanggal_berita'],
            'status_berita' => $validated['status_berita'],
        ]);

        // SIMPAN KATEGORI
        if ($request->kategori_berita_id) {
            $berita->kategori()->sync($request->kategori_berita_id);
        }

        // SIMPAN FOTO
        if ($request->hasFile('foto_berita')) {
            foreach ($request->file('foto_berita') as $foto) {
                $path = $foto->store('berita', 'public');
                BeritaFoto::create([
                    'berita_id' => $berita->berita_id,
                    'url_file_berita' => $path,
                ]);
            }
        }

        return redirect('/admin/berita')->with('success', 'Berita berhasil ditambahkan');
    }

    public function edit($id)
    {
        $berita = Berita::with([
            'foto',
            'kategori'
        ])->findOrFail($id);

        $kategori = KategoriBerita::all();

        return view('admin.berita.edit', compact(
            'berita',
            'kategori'
        ));
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::with('foto')->findOrFail($id);

        $validated = $request->validate([
            'judul_berita' => 'required|string|max:255',
            'isi_berita' => 'required|string',
            'tanggal_berita' => 'required|date',
            'status_berita' => 'required|string|max:100',
            'kategori_berita_id' => 'nullable|array',
            'kategori_berita_id.*' => 'exists:kategori_beritas,kategori_berita_id',
            'foto_berita' => 'nullable|array',
            'foto_berita.*' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'judul_berita.required' => 'Judul berita wajib diisi.',
            'isi_berita.required' => 'Isi berita wajib diisi.',
            'tanggal_berita.required' => 'Tanggal berita wajib diisi.',
            'status_berita.required' => 'Status berita wajib dipilih.',
            'kategori_berita_id.*.exists' => 'Kategori yang dipilih tidak valid.',
            'foto_berita.*.image' => 'File harus berupa gambar.',
            'foto_berita.*.mimes' => 'Format gambar harus JPG, JPEG, atau PNG.',
            'foto_berita.*.max' => 'Ukuran gambar maksimal 2MB.',
        ]);

        $berita->update([
            'judul_berita' => $validated['judul_berita'],
            'isi_berita' => $validated['isi_berita'],
            'tanggal_berita' => $validated['tanggal_berita'],
            'status_berita' => $validated['status_berita'],
        ]);

        // UPDATE KATEGORI
        $berita->kategori()->sync($request->kategori_berita_id ?? []);

        // UPDATE FOTO
        if ($request->hasFile('foto_berita')) {
            foreach ($berita->foto as $fotoLama) {
                Storage::disk('public')->delete($fotoLama->url_file_berita);
                $fotoLama->delete();
            }

            foreach ($request->file('foto_berita') as $foto) {
                $path = $foto->store('berita', 'public');
                BeritaFoto::create([
                    'berita_id' => $berita->berita_id,
                    'url_file_berita' => $path,
                ]);
            }
        }

        return redirect('/admin/berita')->with('success', 'Berita berhasil diperbarui');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        $berita->delete();

        return redirect()->back()
            ->with('success', 'Berita berhasil dihapus');
    }

    public function trashed()
    {
        $berita = Berita::with([
            'user',
            'foto',
            'kategori'
        ])
        ->onlyTrashed()
        ->latest('deleted_at')
        ->get();

        return view('admin.berita.trashed', compact('berita'));
    }

    public function restore($id)
    {
        $berita = Berita::onlyTrashed()
            ->findOrFail($id);

        $berita->restore();

        return redirect()->back()
            ->with('success', 'Berita berhasil direstore');
    }

    public function forceDelete($id)
    {
        $berita = Berita::onlyTrashed()
            ->with('foto')
            ->findOrFail($id);

        foreach ($berita->foto as $foto) {

            Storage::disk('public')
                ->delete($foto->url_file_berita);

            $foto->forceDelete();
        }

        $berita->forceDelete();

        return redirect()->back()
            ->with('success', 'Berita berhasil dihapus permanen');
    }

    public function toggleStatus($id)
    {
        $berita = Berita::findOrFail($id);

        $berita->status_berita =
            strtolower($berita->status_berita) == 'published'
            ? 'Draft'
            : 'Published';

        $berita->save();

        return back()->with(
            'success',
            'Status berita berhasil diperbarui'
        );
    }

}

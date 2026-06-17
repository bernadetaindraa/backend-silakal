<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Agenda;
use App\Models\AgendaItem;
use App\Models\PiketDukuh;
use App\Models\User;
use App\Models\IzinCuti;

class AgendaController extends Controller
{
    // PUBLIC - List Agenda
    public function index(Request $request)
    {
        $query = Agenda::with([
            'agendaItems.user',
            'piketDukuh.user',
            'izinCuti.user'
        ]);

        if ($request->search) {

            $query->where('judul_agenda', 'like', '%' . $request->search . '%');
        }

        $agenda = $query
                    ->latest('tanggal_agenda')
                    ->paginate(10);

        return view('admin.agenda.index', compact('agenda'));
    }
    
    // ADMIN - Form Create
    public function create()
    {
        $users = User::whereIn('role_id', [3,5])
                    ->orderBy('nama_lengkap')
                    ->get();

        return view('admin.agenda.create', compact('users'));
    }

    // ADMIN - Store
    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul_agenda' => 'required|string|max:255',
            'tanggal_agenda' => 'required|date',

            'agenda_items' => 'required|array|min:1',
            'piket_dukuh' => 'required|array|min:1',
            'izin_cuti' => 'nullable|array',

            'agenda_items.*.user_id' => 'required|exists:users,user_id',
            'agenda_items.*.kategori_agenda' => 'required|string|max:100',
            'agenda_items.*.waktu_agenda' => 'required',
            'agenda_items.*.nama_agenda' => 'required|string|max:255',
            'agenda_items.*.tempat_agenda' => 'nullable|string|max:255',
            'agenda_items.*.penyelenggara_agenda' => 'nullable|string|max:255',

            'piket_dukuh.*.user_id' => 'required|exists:users,user_id',
            'piket_dukuh.*.waktu_piket' => 'required',
            'piket_dukuh.*.keterangan_piket' => 'nullable|string',

            'izin_cuti.*.user_id' => 'required|exists:users,user_id',
            'izin_cuti.*.tanggal_mulai_izin_cuti' => 'required|date',
            'izin_cuti.*.tanggal_selesai_izin_cuti' => 'required|date',
            'izin_cuti.*.alasan_izin_cuti' => 'nullable|string',
        ]);

        DB::beginTransaction();

        try {

            $agenda = Agenda::create([
                'judul_agenda' => $validated['judul_agenda'],
                'tanggal_agenda' => $validated['tanggal_agenda'],
            ]);

            foreach ($validated['agenda_items'] as $item) {

                AgendaItem::create([
                    'agenda_id' => $agenda->agenda_id,
                    'user_id' => $item['user_id'],
                    'kategori_agenda' => $item['kategori_agenda'],
                    'waktu_agenda' => $item['waktu_agenda'],
                    'nama_agenda' => $item['nama_agenda'],
                    'tempat_agenda' => $item['tempat_agenda'] ?? null,
                    'penyelenggara_agenda' => $item['penyelenggara_agenda'] ?? null,
                ]);
            }

            foreach ($validated['piket_dukuh'] as $piket) {

                PiketDukuh::create([
                    'agenda_id' => $agenda->agenda_id,
                    'user_id' => $piket['user_id'],
                    'waktu_piket' => $piket['waktu_piket'],
                    'keterangan_piket' => $piket['keterangan_piket'] ?? null,
                ]);
            }

            if (!empty($validated['izin_cuti'])) {

                foreach ($validated['izin_cuti'] as $izin) {

                    IzinCuti::create([
                        'agenda_id' => $agenda->agenda_id,
                        'user_id' => $izin['user_id'],
                        'tanggal_mulai_izin_cuti' => $izin['tanggal_mulai_izin_cuti'],
                        'tanggal_selesai_izin_cuti' => $izin['tanggal_selesai_izin_cuti'],
                        'alasan_izin_cuti' => $izin['alasan_izin_cuti'] ?? null,
                    ]);
                }
            }

            DB::commit();

            return redirect()
                    ->route('admin.agenda.index')
                    ->with('success', 'Agenda berhasil ditambahkan');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                    ->withInput()
                    ->with('error', $e->getMessage());
        }
    }

    // ADMIN - Edit
    public function edit($id)
    {
        $agenda = Agenda::with([
            'agendaItems',
            'piketDukuh',
            'izinCuti'
        ])->findOrFail($id);

        $users = User::whereIn('role_id', [3,5])
                    ->orderBy('nama_lengkap')
                    ->get();

        return view('admin.agenda.edit', compact('agenda', 'users'));
    }

    // ADMIN - Update
    public function update(Request $request, $id)
    {
        $agenda = Agenda::findOrFail($id);

        $validated = $request->validate([
            'judul_agenda' => 'required|string|max:255',
            'tanggal_agenda' => 'required|date',

            'agenda_items' => 'required|array|min:1',
            'piket_dukuh' => 'required|array|min:1',
            'izin_cuti' => 'nullable|array',
        ]);

        DB::beginTransaction();

        try {

            // 1. UPDATE HEADER
            $agenda->update([
                'judul_agenda' => $validated['judul_agenda'],
                'tanggal_agenda' => $validated['tanggal_agenda'],
            ]);

            // 2. HAPUS DATA LAMA
            AgendaItem::where('agenda_id', $agenda->agenda_id)->delete();
            PiketDukuh::where('agenda_id', $agenda->agenda_id)->delete();
            IzinCuti::where('agenda_id', $agenda->agenda_id)->delete();

            // 3. INSERT ULANG AGENDA ITEMS
            foreach ($validated['agenda_items'] as $item) {
                AgendaItem::create([
                    'agenda_id' => $agenda->agenda_id,
                    'user_id' => $item['user_id'],
                    'kategori_agenda' => $item['kategori_agenda'],
                    'waktu_agenda' => $item['waktu_agenda'],
                    'nama_agenda' => $item['nama_agenda'],
                    'tempat_agenda' => $item['tempat_agenda'] ?? null,
                    'penyelenggara_agenda' => $item['penyelenggara_agenda'] ?? null,
                ]);
            }

            // 4. INSERT PIKET
            foreach ($validated['piket_dukuh'] as $piket) {
                PiketDukuh::create([
                    'agenda_id' => $agenda->agenda_id,
                    'user_id' => $piket['user_id'],
                    'waktu_piket' => $piket['waktu_piket'],
                    'keterangan_piket' => $piket['keterangan_piket'] ?? null,
                ]);
            }

            // 5. INSERT IZIN
            if (!empty($validated['izin_cuti'])) {
                foreach ($validated['izin_cuti'] as $izin) {
                    IzinCuti::create([
                        'agenda_id' => $agenda->agenda_id,
                        'user_id' => $izin['user_id'],
                        'tanggal_mulai_izin_cuti' => $izin['tanggal_mulai_izin_cuti'],
                        'tanggal_selesai_izin_cuti' => $izin['tanggal_selesai_izin_cuti'],
                        'alasan_izin_cuti' => $izin['alasan_izin_cuti'] ?? null,
                    ]);
                }
            }

            DB::commit();

            return redirect()
                ->route('admin.agenda.index')
                ->with('success', 'Agenda berhasil diperbarui');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    // ADMIN - Delete
    public function destroy($id)
    {
        $agenda = Agenda::findOrFail($id);

        $agenda->delete();

        return redirect()
                ->back()
                ->with('success', 'Agenda berhasil dihapus');
    }

    // ADMIN - Trash
    public function trashed()
    {
        $agenda = Agenda::onlyTrashed()->latest()->get();

        return view('admin.agenda.trashed', compact('agenda'));
    }

    // ADMIN - Restore
    public function restore($id)
    {
        Agenda::onlyTrashed()
                ->findOrFail($id)
                ->restore();

        return redirect()
                ->back()
                ->with('success', 'Agenda berhasil direstore');
    }

    // ADMIN - Force Delete
    public function forceDelete($id)
    {
        Agenda::onlyTrashed()
                ->findOrFail($id)
                ->forceDelete();

        return redirect()
                ->back()
                ->with('success', 'Agenda berhasil dihapus permanen');
    }
}

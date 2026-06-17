<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\AgendaItem;
use App\Models\PiketDukuh;
use App\Models\IzinCuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AgendaController extends Controller
{
    // PUBLIC - List Agenda
    public function index()
    {
        $agenda = Agenda::with([
                        'agendaItems.user',
                        'piketDukuh.user',
                        'izinCuti.user'
                    ])
                    ->latest()
                    ->paginate(10);

        return view('public.agenda.index', compact('agenda'));
    }

    // PUBLIC - Detail Agenda
    public function show($id)
    {
        $agenda = Agenda::with([
                        'agendaItems.user',
                        'piketDukuh.user',
                        'izinCuti.user'
                    ])
                    ->findOrFail($id);

        return view('public.agenda.detail', compact('agenda'));
    }
}
<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\DatabaseMessage;

class LayananNotification extends Notification
{
    use Queueable;

    protected $judul;
    protected $pesan;

    public function __construct($judul, $pesan)
    {
        $this->judul = $judul;
        $this->pesan = $pesan;
    }

    public function via(object $notifiable)
    {
        return ['database'];
    }

    public function toDatabase(object $notifiable)
    {
        return [
            'judul' => $this->judul,
            'pesan' => $this->pesan,
            'type'  => 'layanan',
        ];
    }
}
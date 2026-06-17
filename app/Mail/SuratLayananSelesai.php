<?php

namespace App\Mail;

use App\Models\Layanan;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SuratLayananSelesai extends Mailable
{
    use SerializesModels;

    public $layanan;

    public function __construct(Layanan $layanan)
    {
        $this->layanan = $layanan;
    }

    public function build()
    {
        $mail = $this->subject('Surat Layanan Telah Selesai Diproses')
            ->view('emails.surat-layanan-selesai');

        if ($this->layanan->file_surat) {
            $mail->attach(
                storage_path('app/public/' . $this->layanan->file_surat)
            );
        }

        return $mail;
    }
}
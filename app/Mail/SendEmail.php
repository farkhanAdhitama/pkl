<?php

namespace App\Mail;

use App\Models\Buku;
use App\Models\Anggota;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\TransaksiSiswa;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Guru;


class SendEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $data_email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data_email)
    {
         $this->data_email = $data_email;
    }

    /**
     * Get the message envelope.
     *
    * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            from: new Address('farkhanduolingo@gmail.com', 'Perpustakaan SMA Negeri 1 Kajen'),
            subject: 'Perpustakaan SMA N 1 Kajen : Masa Peminjaman Telah Habis',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        $peminjaman = TransaksiSiswa::all();
        $bukus = Buku::all();
        $anggotas = Anggota::all();
        $gurus = Guru::all();

        return new Content(
            view: 'mail.sendemail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}

<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Medidores;
use App\User;


class LecturasEnergia extends Mailable
{
    use Queueable, SerializesModels;

    public $medidores;
    public $user;


    public function __construct(Medidores $medidores, string $user)
    {
        $this->medidores=$medidores;
        $this->user=$user;
    }


    public function build()
    {
        return $this->markdown('emails.medidores')
            ->from('tarjetas.cic@gmail.com', 'Tarjetas CIC')
            ->subject('Lecturas de Energia');;
    }
}

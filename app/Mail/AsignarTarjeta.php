<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\TarjetasModel;

class AsignarTarjeta extends Mailable
{
    use Queueable, SerializesModels;

public $tarjeta;

    public function __construct(TarjetasModel $tarjeta)
    {
          $this->tarjeta=$tarjeta;
    }


    public function build()
    {
        return $this->markdown('emails.asignar-tarjeta')
        ->from('tarjetas.cic@gmail.com', 'Tarjetas CIC')
        ->subject('Asignacion de tarjeta amarilla');;
    }
}

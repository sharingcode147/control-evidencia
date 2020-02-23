<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SistemaEvidenciasInfo extends Mailable
{
    use Queueable, SerializesModels;

    public $id;
    public $estado;
    public $responsable;
    public $nivel;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($id,$estado,$responsable,$nivel)
    {
        $this->id = $id;
        $this->estado = $estado;
        $this->responsable = $responsable;
        $this->nivel = $nivel;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.estadoEvidencia');
    }
}

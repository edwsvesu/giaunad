<?php

namespace App\Dominio\Email;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UsuarioRegistrado extends Mailable
{
    use Queueable, SerializesModels;

    public $numero_documento;
    public $nombres;
    public $apellidos;
    public $correo_principal;
    public $correo_secundario;

    public function __construct(array $datos)
    {
        $this->numero_documento=$datos['numero_documento'];
        $this->nombres=$datos['nombres'];
        $this->apellidos=$datos['apellidos'];
        $this->correo_principal=$datos['correo_principal'];
        $this->correo_secundario=$datos['correo_secundario'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.UsuarioRegistrado');
    }
}

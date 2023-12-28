<?php
namespace App\System\Services;

use App\Mail\EnviarFacturaMailable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

trait EnviarEmail {

    use GuardarDTE;

    public function enviarEmailCliente($cliente, $request, $documentId)
    {
        if ($request['receptor']['correo']) {
            try {
                Mail::to($request['receptor']['correo'])
                ->send(new EnviarFacturaMailable($cliente, $request));
                $this->guardarEmailEnviado($documentId);
            } catch (\Throwable $th) {
                Log::alert("No se envio el Email");
            }
        }
    }



}
<?php
namespace App\System\Services;

use App\Mail\EnviarFacturaMailable;
use Illuminate\Support\Facades\Mail;

trait EnviarEmail {


    public function enviarEmailCliente($cliente, $request)
    {
        if ($request['receptor']['correo']) {
            Mail::to($request['receptor']['correo'])
            ->send(new EnviarFacturaMailable($cliente, $request));
        }
    }



}
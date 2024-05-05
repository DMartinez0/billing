<?php
namespace App\System\Services;

use App\Mail\SendInvoiceMailable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

trait SendEmail {

    use SaveDTE;

    public function sendEmailClient($cliente, $request, $documentId)
    {
        if (isset($request['receptor']) && isset($request['receptor']['correo'])) {
            try {
                Mail::to($request['receptor']['correo'])
                ->send(new SendInvoiceMailable($cliente, $request));
                $this->saveEmailSended($documentId);
                $this->deleteFiles($request);          
            } catch (\Throwable $th) {
                Log::alert("No se envio el Email: " . $th->getMessage());
            }
        }
    }



}
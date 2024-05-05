<?php
namespace App\System\Services;

use Illuminate\Support\Facades\Http;

trait Signer {


    public function signDocument($request)
    {
        $firma = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ])
        ->post(config("principal.signer"), [
            'nit' => $request->nit,
            'activo' => true,
            'passwordPri' => $request->passwordPri,
            'dteJson' => $request->dteJson
        ]);
        if ($firma["status"] == "OK") {
            return $firma['body'];
        }
        else{
            return null;
        }
    }



}
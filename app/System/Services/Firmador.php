<?php
namespace App\System\Services;

use Illuminate\Support\Facades\Http;

trait Firmador {


    public function firmarDocumento($request)
    {
        $firma = Http::withHeaders([
            'Accept' => 'application/json',
            'Content-Type' => 'application/json'
        ])
        ->post("https://seahorse-app-fem4j.ondigitalocean.app/firmardocumento/", [
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
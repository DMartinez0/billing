<?php
namespace App\System\Services;

use Illuminate\Support\Facades\Http;

trait EnviarDTE {

        /**
        *@ambiente "00",
        *@idEnvio // numero a discrecion, = codigoGeneracion
        *@version 1,
        *@tipoDte "01",
        *@codigoGeneracion "D45CD5DD-8831-46F7-9510-2BBF31259AEE",
        *@documento 
         */
    public function dte($request, $firma)
    {
       
       
       return Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOiIwMjA3MjEwMzg2MTAyOSIsImF1dGhvcml0aWVzIjpbIlVTRVIiLCJVU0VSX0FQSSIsIlVzdWFyaW8iXSwiaWF0IjoxNzAzNjIzNjExLCJleHAiOjE3MDM3MTAwMTF9.zicE7iggr51a5bHfuNeY9rNmyXLfP-pyMchDiIa5l1RE-Py06KXpWj9ceBb_uf_1h8c8BVsf-mkWOuXGHDDRvw'
            ])
            ->post($this->getUrl($request), [
                'ambiente' => $request->dteJson['identificacion']['ambiente'],
                'idEnvio' => $request->idEnvio,
                'version' => $request->dteJson['identificacion']['version'],
                'tipoDte' => $request->dteJson['identificacion']['tipoDte'],
                'codigoGeneracion' => $request->dteJson['identificacion']['codigoGeneracion'],
                'documento' => $firma
            ]);
    }

    private function getUrl($request)
    {
        if ($request->dteJson['identificacion']['ambiente'] == "01") {
           return "https://api.dtes.mh.gob.sv/fesv/recepciondte";
        } else {
            return "https://apitest.dtes.mh.gob.sv/fesv/recepciondte";
        }
    }


}
<?php
namespace App\System\Services;

use App\System\Mocks\DTE;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

trait EnviarDTE {

    use GenerarArchivos, EnviarEmail, GuardarDTE, DTE;

    public function procesarDTE($request, $documentId, $firma, $cliente)
    {
        $dte = $this->dte($request, $firma);
        // $dte = $this->respuestaProcesado();
        if ($dte) {
            if ($dte['estado'] == "RECHAZADO") {
                // Guardar los dados de rechazo
                $this->guardarRechazado($documentId, $dte);
            } else {
                // Guardar la respuesta del MH (selloRecibido)
                $firmado = Arr::add($request->dteJson, 'firmaElectronica', $firma);
                $sellado = Arr::add($firmado, 'responseMH', $dte);
                $this->guardarProcesado($sellado, $documentId, $dte); //
                $this->crearJson($sellado);
                $this->crearQR($sellado);
                $this->crearPdf($sellado);
                $this->enviarEmailCliente($cliente, $sellado, $documentId);  
            }
            // return $dte;
            return json_decode($dte, true);
        } 
        return errorResponse("Error al procesar DTE");
    }

    
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
                'Authorization' => 'Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOiIwMjA3MjEwMzg2MTAyOSIsImF1dGhvcml0aWVzIjpbIlVTRVIiLCJVU0VSX0FQSSIsIlVzdWFyaW8iXSwiaWF0IjoxNzA1MDkyMzk1LCJleHAiOjE3MDUxNzg3OTV9.TTFXzr7_CZjw7L8VlIDAHXGLRxmOfOxHaMfiX27OFaTF9SFc3nahjXN9TLbz5uY7ZH_B6Ns3-rb-abBenTer0g'
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
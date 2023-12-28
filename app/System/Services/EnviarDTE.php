<?php
namespace App\System\Services;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;

trait EnviarDTE {

    use GenerarArchivos, EnviarEmail, GuardarDTE;

    public function procesarDTE($request, $documentId, $firma, $cliente)
    {
        $dte = $this->dte($request, $firma);

        if ($dte) {
            if ($dte['estado'] == "RECHAZADO") {
                // Guardar los dados de rechazo
                $this->guardarRechazado($documentId, $dte);
            } else {
            // Guardar la respuesta del MH (selloRecibido)
            $firmado = Arr::add($request->dteJson, 'firmaElectronica', $firma);
            $sellado = Arr::add($firmado, 'selloRecibido', $dte['selloRecibido']);
            $this->guardarProcesado($sellado, $documentId, $dte); //
            // Enviar email al Cliente
            $this->crearJson($sellado);
            $this->crearQR($sellado);
            $this->crearPdf($sellado, $dte);
            $this->enviarEmailCliente($cliente, $sellado, $documentId);            
        }
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
                'Authorization' => 'Bearer eyJhbGciOiJIUzUxMiJ9.eyJzdWIiOiIwMjA3MjEwMzg2MTAyOSIsImF1dGhvcml0aWVzIjpbIlVTRVIiLCJVU0VSX0FQSSIsIlVzdWFyaW8iXSwiaWF0IjoxNzAzNzEwNjA5LCJleHAiOjE3MDM3OTcwMDl9.EgR2j--aZco1Iu0tgPc3SaadzXIcQiRiRPps2ikqbhupq1PW-UlhY5jQRHWs4rIYR7ScUHn7jZXdtOlqzTfauQ'
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
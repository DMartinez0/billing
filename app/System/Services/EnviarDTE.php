<?php
namespace App\System\Services;

use App\System\Mocks\DTE;
use Carbon\Carbon;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

trait EnviarDTE {

    use GenerarArchivos, EnviarEmail, GuardarDTE, DTE;

    public function procesarDTE($request, $documentId, $firma, $cliente)
    {
        $dte = $this->dte($request, $firma, $cliente);
        // $dte = $this->respuestaProcesado();
        if ($dte) {
            if ($dte['estado'] == "RECHAZADO") {
                // Guardar los dados de rechazo
                $this->guardarRechazado($documentId, $dte);
            } else {
                // Guardar la respuesta del MH (selloRecibido)
                $firmado = Arr::add($request->dteJson, 'firmaElectronica', $firma);
                $sellado = Arr::add($firmado, 'responseMH', json_decode($dte, true));
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
    public function dte($request, $firma, $cliente)
    {
       
       
       return Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => $this->getToken($request, $cliente)
            ])
            ->post($this->getUrl($request) . "fesv/recepciondte", [
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
           return "https://api.dtes.mh.gob.sv/";
        } else {
            return "https://apitest.dtes.mh.gob.sv/";
        }
    }


    
    public function getToken($request, $cliente)
    {
        if ($cliente->token_updated_at) {
            $fechaRegistro = Carbon::parse($cliente->token_updated_at);
            $fechaActual = Carbon::now();
            $diferenciaHoras = $fechaActual->diffInHours($fechaRegistro);
            if ($diferenciaHoras >= 24) { // 24 horas
                return $this->tokenMH($request, $cliente);
            } else {
                return $cliente->token;
            } 
        }
        return $this->tokenMH($request, $cliente);

    }


    public function tokenMH($request, $cliente)
    {

            $token = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/x-www-form-urlencoded',
            ])
            ->asForm()
            ->post($this->getUrl($request) . "seguridad/auth", [
                'user' => $request->nit,
                'pwd' => $cliente->pwd,
            ]);


        if ($token['status'] == "OK") {
            $this->guardarToken($cliente, $token['body']['token']);
            return $token['body']['token'];
        }
        return null;
    }




}
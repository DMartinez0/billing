<?php
namespace App\System\Services;

use App\Models\Client;
use App\Models\Document;
use Illuminate\Support\Arr;

trait SaveDTE {

    public function saveDocument($request, $cliente)
    {
       $document =  Document::create([
            'ambiente'=> $request->dteJson['identificacion']['ambiente'],
            'id_envio'=> $request->idEnvio,
            'numero_control'=> $request->dteJson['identificacion']['numeroControl'],
            'codigo_generacion'=> $request->dteJson['identificacion']['codigoGeneracion'],
            'version'=> $request->dteJson['identificacion']['version'],
            'tipo_dte'=> $request->dteJson['identificacion']['tipoDte'],
            'documento_json' => json_encode($request->dteJson),

            'client_id'=> $cliente->id,
            'email' => 0,
            'status' => 1
        ]);

        return $document->id;
    }


    public function saveSignature($documentId, $firma)
    {
        Document::where('id', $documentId)->update(['documento_firmado' => $firma, 'status' => 2]);
    }


    public function saveRejected($documentId, $dte)
    {
        Document::where('id', $documentId)->update([
            'fecha_procesamiento' => $dte['fhProcesamiento'], 
            'clasificacion_msg' => $dte['clasificaMsg'], 
            'codigo_msg' => $dte['codigoMsg'], 
            'descripcion_msg' => $dte['descripcionMsg'], 
            'observaciones' => $dte['observaciones'], 
            'status' => 3,
        ]);
    }


    public function saveProcessed($firmado, $documentId, $dte)
    {   
        Document::where('id', $documentId)->update([
            'documento_json' => json_encode($firmado), 
            'documento_firmado' => null,
            'sello_recibido' => $dte['selloRecibido'], 
            'fecha_procesamiento' => $dte['fhProcesamiento'], 
            'clasificacion_msg' => $dte['clasificaMsg'], 
            'codigo_msg' => $dte['codigoMsg'], 
            'descripcion_msg' => $dte['descripcionMsg'], 
            'observaciones' => $dte['observaciones'], 
            'status' => 4,
        ]);
    }

    
    public function saveEmailSended($documentId)
    {   
        Document::where('id', $documentId)->update(['email' => 1,]);
    }


    public function saveToken($cliente, $token)
    {
        Client::where('id', $cliente->id)->update(['token' => $token, 'token_updated_at' => now()]);
    }



}
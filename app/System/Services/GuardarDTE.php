<?php
namespace App\System\Services;

use App\Models\Document;
use Illuminate\Support\Arr;

trait GuardarDTE {

    public function guardarDocument($request, $cliente)
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
            'id_sistema'=> $request->id_sistema,
            'email' => 0,
            'status' => 1
        ]);

        return $document->id;
    }


    public function guardarFirma($documentId, $firma)
    {
        Document::where('id', $documentId)->update(['documento_firmado' => $firma, 'status' => 2]);
    }


    public function guardarRechazado($documentId, $dte)
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


    public function guardarProcesado($firmado, $documentId, $dte)
    {   
        Document::where('id', $documentId)->update([
            'documento_sellado' => json_encode($firmado), 
            'sello_recibido' => $dte['selloRecibido'], 
            'fecha_procesamiento' => $dte['fhProcesamiento'], 
            'clasificacion_msg' => $dte['clasificaMsg'], 
            'codigo_msg' => $dte['codigoMsg'], 
            'descripcion_msg' => $dte['descripcionMsg'], 
            'observaciones' => $dte['observaciones'], 
            'status' => 4,
        ]);
    }

    
    public function guardarEmailEnviado($documentId)
    {   
        Document::where('id', $documentId)->update(['email' => 1,]);
    }





}
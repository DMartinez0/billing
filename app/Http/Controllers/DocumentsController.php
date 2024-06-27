<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentsRequest;
use App\Models\Client;
use App\Models\Document;
use App\Models\User;
use App\System\Services\SendDTE;
use App\System\Services\Signer;
use App\System\Services\GenerateFiles;
use App\System\Services\SaveDTE;
use App\System\Services\ModifierJson;

class DocumentsController extends Controller
{

    use Signer, SaveDTE, SendDTE, ModifierJson, GenerateFiles;


    public function index($clientId){
        return Document::where('client_id', $clientId)->paginate(25);
    }


    /*
    * @ Guarda, Firma, Envia y valida el documento
    * @nit
    * @passwordPri
    * @dteJson
    * @id_sistema es igual a client_id o id de tabla cliente
    * @idEnvio // campo a discresion (uuid de factura)(NO SE USARA)
    */
    public function store(DocumentsRequest $request)
    {
        // Filtrar campos de validacion (Se realiza en DocumentsRequest)
        // Obtener datos del cliente
        $cliente = Client::find($request->id_sistema);
        if(!$cliente) return errorResponse("No se encuentra el cliente");
        // Agregar el emisor y clave desde la base de datos
        $request = $this->addInitialValues($request, $cliente);
        // Guardar documento sin firmar y obtener el id
        $documentId = $this->saveDocument($request, $cliente); ///
        // Firmar documento
        $firma = $this->signDocument($request);
        if ($firma) {
            $this->saveSignature($documentId, $firma);
            // return successResponse("Documento Firmado!");
            return $this->processDTE($request, $documentId, $firma, $cliente);
        } else {
            return errorResponse("Error al firmar el documento");
        }
    }

    

    public function show($codigo, $clientId)
    {
        $documento = Document::where('codigo_generacion', $codigo)
                             ->where('client_id', $clientId)
                             ->first();
        if(!$documento) return errorResponse("No se encuentra el documento");
        return response()->json([
                                'documento_json' => json_decode($documento->documento_json, true), 
                                'status' => $documento->status, 
                                'email' => $documento->email, 
                                'descripcion' => $documento->descripcion_msg, 
                                'observaciones' => $documento->observaciones, 
                                'type' => 'successful'
        ], 200);
    }


    public function download($codigo, $clientId)
    {
        $sellado = Document::where('codigo_generacion', $codigo)
                             ->where('client_id', $clientId)
                             ->first();

        if(!$sellado) return errorResponse("No se encuentra el documento");
        return $this->downloadPdf(json_decode($sellado->documento_json, true));
    }



}

<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentsRequest;
use App\Models\Client;
use App\Models\Document;
use App\System\Services\EnviarDTE;
use App\System\Services\Firmador;
use App\System\Services\GuardarDTE;
use App\System\Services\ModificarJson;

class DocumentsController extends Controller
{

    use Firmador, GuardarDTE, EnviarDTE, ModificarJson;


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
        $request = $this->agregarValoresIniciales($request, $cliente);
        // Guardar documento sin firmar y obtener el id
        $documentId = $this->guardarDocument($request, $cliente); ///
        // Firmar documento
        $firma = $this->firmarDocumento($request);
        if ($firma) {
            $this->guardarFirma($documentId, $firma);
            // return successResponse("Documento Firmado!");
            return $this->procesarDTE($request, $documentId, $firma, $cliente);
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
                                'documento_sellado' => json_decode($documento->documento_sellado, true), 
                                'status' => $documento->status, 
                                'email' => $documento->email, 
                                'descripcion' => $documento->descripcion_msg, 
                                'observaciones' => $documento->observaciones, 
                                'type' => 'successful'
        ], 200);
    }

}

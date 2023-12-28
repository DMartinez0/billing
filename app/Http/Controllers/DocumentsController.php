<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentsRequest;
use App\Models\Client;
use App\System\Services\EnviarDTE;
use App\System\Services\Firmador;
use App\System\Services\GuardarDTE;
use App\System\Services\ModificarJson;

class DocumentsController extends Controller
{

    use Firmador, GuardarDTE, EnviarDTE, ModificarJson;
    /*
    * @ Guarda, Firma, Envia y valida el documento
    * @nit
    * @passwordPri
    * @dteJson
    * @id_sistema
    * @idEnvio // campo a discresion (uuid de factura)(NO SE USARA)
    */
    public function store(DocumentsRequest $request)
    {
        // Filtrar campos de validacion (Se realiza en DocumentsRequest)
        // Obtener datos del cliente
        $cliente = Client::where('nit', $request->nit)->first();
        if(!$cliente) return errorResponse("No se encuentra el cliente");
        // Agregar el emsor desde la base de datos
        $request = $this->agregarEmisor($request, $cliente);
        // Guardar documento sin firmar y obtener el id
        $documentId = $this->guardarDocument($request, $cliente); ///
        // Firmar documento
        $firma = $this->firmarDocumento($request);
        if ($firma) {
            $this->guardarFirma($documentId, $firma);
            return $this->procesarDTE($request, $documentId, $firma, $cliente);
        } else {
            return errorResponse("Error al firmar el documento");
        }
    }
}

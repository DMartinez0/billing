<?php

namespace App\Http\Controllers;

use App\Http\Requests\DocumentsRequest;
use App\System\Validations\validations;
use Illuminate\Http\Request;
use phpseclib3\File\ASN1\Maps\Certificate;
use SimpleXMLElement;

class DocumentsController extends Controller
{

    use validations;
    /*
    * @ Guarda, Firma, Envia y valida el documento
    * @nit
    * @passwordPri
    * @dteJson
    * @id_sistema
    */
    public function store(DocumentsRequest $request)
    {
        $certificate = $this->CertificateToJson($request);
        if (!$certificate) return errorResponse("No se encuentra un certificado valido");
        if (!$this->IsValidated($request, $certificate)) return errorResponse("Sus datos no coinciden");
 
        // return successResponse();
        $firma = $this->generateJWT($request->dteJson, $certificate['privateKey']['encodied']);
        // return $request->all();
        // $cer = $this->IsValidated($request);
        // return successResponse();
        return response()->json([
            "certificado" => $firma,
        ], 200);
    }


}

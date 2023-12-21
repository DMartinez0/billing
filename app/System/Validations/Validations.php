<?php
namespace App\System\Validations;

use Firebase\JWT\JWT;
use SimpleXMLElement;


trait validations {


    public function IsValidated($request, $certificate){ 
        if ($certificate) {
            if ($this->ValidateNit($request, $certificate) and  $this->ValidatePasswordPri($request, $certificate)) {
                return true;
            } return false;
        } else {
            return false;
        }
    }


    public function ValidateNit($request, $certificate){
        if ($request->nit == $certificate['nit'] and $request->nit == $request->dteJson['emisor']['nit']) {
            return true;
        }
        return false;
    }

    
    public function ValidatePasswordPri($request, $certificate){
        if (hash('sha512', $request->passwordPri) == $certificate['privateKey']['clave']) {
            return true;
        }
        return false;
    }

    public function CertificateToJson($request){
        $rutaArchivo = storage_path("app/certificados/".$request->nit.".crt");

        if (file_exists($rutaArchivo)) {
            $contenidoXML = file_get_contents($rutaArchivo);
            $xml = new SimpleXMLElement($contenidoXML);
            $arrayResultante = json_decode(json_encode($xml), true);
            return $arrayResultante;
        } else {
            return false;
        }

    }





    public function generateJWT($jsonData, $secretKey) {

        $header = [
            'alg' => 'HS512'
        ];

        $jwt = JWT::encode($jsonData, $secretKey, 'HS512', null, $header);
        return $jwt;
    }



}
<?php
namespace App\System\Mocks;

trait DTE {

    public function respuestaProcesado()
    {
        $json = '{
                "version": 2,
                "ambiente": "00",
                "versionApp": 2,
                "estado": "PROCESADO",
                "codigoGeneracion": "D45CD5DD-8831-46F7-9210-2DA2BC24254E",
                "selloRecibido": "202305B6BF2ED55244D5B05D293CBE500A73666S",
                "fhProcesamiento": "28/12/2023 04:07:35",
                "clasificaMsg": "10",
                "codigoMsg": "001",
                "descripcionMsg": "RECIBIDO",
                "observaciones": []
                }';
        return json_decode($json, true);
    }

   
    public function respuestaRechazado()
    {
        $json = '{
                "version": 2,
                "ambiente": "00",
                "versionApp": 2,
                "estado": "RECHAZADO",
                "codigoGeneracion": "D45CD5DD-8831-46F7-9210-2DA2BC24254E",
                "selloRecibido": null,
                "fhProcesamiento": "28/12/2023 06:06:39",
                "clasificaMsg": "11",
                "codigoMsg": "004",
                "descripcionMsg": "[identificacion.codigoGeneracion] YA EXISTE UN REGISTRO CON ESE VALOR",
                "observaciones": []
            }';
        return json_decode($json, true);
    }

}
<?php
namespace App\System\Services;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

trait GenerarArchivos {


    public function crearJson($request)
    {
        Storage::disk('local')
        ->put('documentos/'.$request['identificacion']['codigoGeneracion'] .'.json', json_encode($request));
    }

    public function crearPdf($request, $dte)
    {
        $pdf = Pdf::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
        ->loadView('pdf.01', compact('request', 'dte'))
        ->save(storage_path('/app/documentos/'.$request['identificacion']['codigoGeneracion'] .'.pdf'))
        ->stream(storage_path('/app/documentos/'.$request['identificacion']['codigoGeneracion'] .'.pdf'));
    }

    public function crearQR($request)
    {
        $carpeta = storage_path('/app/public/qr/');
        if (!file_exists($carpeta)) {
            mkdir($carpeta, 0777, true);
        }
        QrCode::generate('https://admin.factura.gob.sv/consultaPublica?ambiente='.$request['identificacion']['ambiente'].'&codGen='.$request['identificacion']['codigoGeneracion'].'&fechaEmi='. $request['identificacion']['fecEmi'], 
        storage_path('/app/public/qr/'.$request['identificacion']['codigoGeneracion'] .'.svg'));
    }

}
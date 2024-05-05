<?php
namespace App\System\Services;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

trait GenerateFiles {


    public function createJson($request)
    {
        try {
            Storage::disk('local')
            ->put('documentos/'.$request['identificacion']['codigoGeneracion'] .'.json', json_encode($request));
        } catch (\Throwable $th) {
            Log::alert("Error al crear archivo JSON: " . $th->getMessage());
        }
    }

    public function createPdf($request)
    {
        try {
            $pdf = Pdf::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                        ->loadView(formatView('pdf', $request['emisor']['nit'], $request['identificacion']['tipoDte']), compact('request'))
                        ->save(storage_path('/app/documentos/'.$request['identificacion']['codigoGeneracion'] .'.pdf'))
                        ->stream(storage_path('/app/documentos/'.$request['identificacion']['codigoGeneracion'] .'.pdf'));
        } catch (\Throwable $th) {
            Log::alert("Error al crear archivo PDF: " . $th->getMessage());
        }
    }

    public function createQR($request)
    {
        try {
            $carpeta = storage_path('/app/public/qr/');
            if (!file_exists($carpeta)) {
                mkdir($carpeta, 0777, true);
            }
            QrCode::generate('https://admin.factura.gob.sv/consultaPublica?ambiente='.$request['identificacion']['ambiente'].'&codGen='.$request['identificacion']['codigoGeneracion'].'&fechaEmi='. $request['identificacion']['fecEmi'], 
            storage_path('/app/public/qr/'.$request['identificacion']['codigoGeneracion'] .'.svg'));
        } catch (\Throwable $th) {
            Log::alert("Error al crear codigo QR: " . $th->getMessage());
        }
    }


    public function deleteFiles($request)
    {
        try {
            $codigoGeneracion = $request['identificacion']['codigoGeneracion'];
            // Eliminar archivos usando el facade Storage
            Storage::disk('local')->delete([
                'documentos/' . $codigoGeneracion . '.json',
                'documentos/' . $codigoGeneracion . '.pdf',
                'public/qr/' . $codigoGeneracion . '.svg',
            ]);
        } catch (\Throwable $th) {
            Log::alert("Error al Eliminar Archivos: " . $th->getMessage());
        }
    }



    /*
    Descargar PDF, este no se guarda en el storage del server
    */
    public function downloadPdf($request)
    {
        try {
            $this->createQR($request);
            $pdf = Pdf::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])
                        ->loadView(formatView('pdf', $request['emisor']['nit'], $request['identificacion']['tipoDte']), compact('request'));
            $response =  $pdf->download($request['identificacion']['codigoGeneracion'] .'.pdf');
            $this->deleteFiles($request);
            return $response;
        } catch (\Throwable $th) {
            Log::alert("Error al crear archivo PDF: " . $th->getMessage());
        }
    }

}
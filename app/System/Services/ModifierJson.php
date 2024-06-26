<?php
namespace App\System\Services;

use Illuminate\Support\Arr;

trait ModifierJson {


    public function addInitialValues($request, $cliente)
    {
        $emisor = array();
        
        $emisor["nit"] = $cliente->nit;
        $emisor["nrc"] = $cliente->ncr;
        $emisor["nombre"] = $cliente->nombre;
        $emisor["codActividad"] = $cliente->cod_actividad;
        $emisor["descActividad"] = $cliente->desc_actividad;
        $emisor["direccion"]['departamento'] = $cliente->direccion_departamento;
        $emisor["direccion"]['municipio'] = $cliente->direccion_municipio;
        $emisor["direccion"]['complemento'] = $cliente->direccion_complemento;
        $emisor["telefono"] = $cliente->telefono;
        $emisor["correo"] = $cliente->correo;
        $emisor["codEstableMH"] = $cliente->cod_estable_mh;
        $emisor["codEstable"] = $cliente->cod_estable;
        $emisor["codPuntoVentaMH"] = $cliente->cod_punto_venta_mh;
        $emisor["codPuntoVenta"] = $cliente->cod_punto_venta;
        
        if ($request->dteJson['identificacion']['tipoDte'] != "14") {
            $emisor["tipoEstablecimiento"] = $cliente->tipo_establecimiento;
            $emisor["nombreComercial"] = $cliente->nombre_comercial;
        }
        
        $requestArray = $request->all();
        Arr::set($requestArray, 'nit', $cliente->nit);
        Arr::set($requestArray, 'activo', true);
        Arr::set($requestArray, 'passwordPri', $cliente->password_pri);
        Arr::set($requestArray, 'dteJson.identificacion.ambiente', $cliente->ambiente);
        Arr::set($requestArray, 'dteJson.emisor', $emisor);
        $request = (object) $requestArray;
        return $request;
    }



    public function addStamps($request, $firma, $dte)
    {
        //no se llama desde ningun lugar esta funcion
        $newFirma = array();
        $newFirma["firmaElectronica"] = $firma;
        $newSello["selloRecibido"] = $dte['selloRecibido'];

        $requestArray = json_decode($request);
        Arr::set($requestArray, 'dteJson.firmaElectronica', $newFirma);
        Arr::set($requestArray, 'dteJson.selloRecibido', $newSello);
        $request = (object) $requestArray;
        return $request;
    }


}
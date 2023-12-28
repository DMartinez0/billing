<?php
namespace App\System\Services;

use Illuminate\Support\Arr;

trait ModificarJson {


    public function agregarEmisor($request, $cliente)
    {
        $emisor = array();
        $emisor["nit"] = $cliente->nit;
        $emisor["nrc"] = $cliente->ncr;
        $emisor["nombre"] = $cliente->nombre;
        $emisor["codActividad"] = $cliente->cod_actividad;
        $emisor["descActividad"] = $cliente->desc_actividad;
        $emisor["nombreComercial"] = $cliente->nombre_comercial;
        $emisor["tipoEstablecimiento"] = $cliente->tipo_establecimiento;
        $emisor["direccion"]['departamento'] = $cliente->direccion_departamento;
        $emisor["direccion"]['municipio'] = $cliente->direccion_municipio;
        $emisor["direccion"]['complemento'] = $cliente->direccion_complemento;
        $emisor["telefono"] = $cliente->telefono;
        $emisor["correo"] = $cliente->correo;
        $emisor["codEstableMH"] = $cliente->cod_estable_mh;
        $emisor["codEstable"] = $cliente->cod_estable;
        $emisor["codPuntoVentaMH"] = $cliente->cod_punto_venta_mh;
        $emisor["codPuntoVenta"] = $cliente->cod_punto_venta;

        $requestArray = $request->all();
        Arr::set($requestArray, 'dteJson.emisor', $emisor);
        $request = (object) $requestArray;
        return $request;
    }


    public function agregarSellos($request, $firma, $dte)
    {
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
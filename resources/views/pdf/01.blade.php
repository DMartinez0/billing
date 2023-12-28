<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Documento Tributario Electrónico - Factura</title>
    <link rel="stylesheet" href="{{ asset('css/style_invoice.css') }}" media="all" />
  </head>
  <body>
    <header class="clearfix">
      <div id="logo">
        <img src="{{ asset('storage/qr/'.$request['identificacion']['codigoGeneracion'].'.svg') }}" width="150">
      </div>
      <div id="contenheader">
          <h1>Documento Tributario Electrónico - Factura</h1>

          <div id="content">
            <div id="project">
                <div>EMISOR</div>
                <div><span>Nombre</span> {{ $request['emisor']['nombre'] }}</div>
                <div><span>NIT</span> {{ $request['emisor']['nit'] }}</div>
                <div><span>NCR</span> {{ $request['emisor']['nrc'] }}</div>
                <div><span>Actividad Economica</span> {{ $request['emisor']['descActividad'] }}</div>
                <div><span>Dirección</span> {{ $request['emisor']['direccion']['complemento'] }}, {{ nombreMunicipio($request['emisor']['direccion']['departamento'], $request['emisor']['direccion']['municipio']) }}, {{ nombreDepartamento($request['emisor']['direccion']['departamento']) }}</div>
                <div><span>Numero de telefono</span> {{ $request['emisor']['telefono'] }}</div>
                <div><span>Email</span> {{ $request['emisor']['correo'] }}</div>
                <div><span>Establicimiento</span> {{ $request['emisor']['tipoEstablecimiento'] }}</div>
            </div>
            <div id="company" class="clearfix">
              @if ($request['receptor'])    
              <div>RECEPTOR</div>
                @if ($request['receptor']['nombre'])
                <div><span>Nombre</span> {{ $request['receptor']['nombre'] }}</div>
                @endif
                @if ($request['receptor']['numDocumento'])
                <div><span>Documento</span> {{ $request['receptor']['numDocumento'] }}</div>
                @endif
                @if ($request['receptor']['nrc'])
                <div><span>NCR</span> {{ $request['receptor']['nrc'] }}</div>
                @endif
                @if ($request['receptor']['descActividad'])
                <div><span>Actividad Economica</span> {{ $request['receptor']['descActividad'] }}</div>
                @endif
                @if ($request['receptor']['direccion'])
                <div><span>Dirección</span> {{ $request['receptor']['direccion']['complemento'] }}, {{ nombreMunicipio($request['receptor']['direccion']['departamento'], $request['receptor']['direccion']['municipio']) }}, {{ nombreDepartamento($request['receptor']['direccion']['departamento']) }}</div>
                @endif
                @if ($request['receptor']['telefono'])
                <div><span>Numero de telefono</span> {{ $request['receptor']['telefono'] }}</div>
                @endif
                @if ($request['receptor']['correo'])
                <div><span>Email</span> {{ $request['receptor']['correo'] }}</div>
                @endif
              @endif
            </div>
          </div>

      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service">CANT</th>
            <th class="desc">DESCRIPCION</th>
            <th>CODIGO</th>
            <th>PRECIO</th>
            <th>DESC. POR ITEM</th>
            <th>TOTAL</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($request['cuerpoDocumento'] as $producto)
          <tr>
            <td class="cant">{{ $producto['numItem'] }}</td>
            <td class="desc">{{ $producto['descripcion'] }}</td>
            <td class="cod">{{ $producto['codigo'] }}</td>
            <td class="price">{{ $producto['precioUni'] }}</td>
            <td class="descuento">{{ $producto['montoDescu'] }}</td>
            <td class="total">{{ $producto['ventaGravada'] }}</td>
          </tr>
          @endforeach
          <tr>
            <td colspan="5">Suma total de operaciones</td>
            <td class="total">${{$request['resumen']['subTotalVentas']}}</td>
          </tr>
          <tr>
            <td colspan="5">Monto total de descuentos</td>
            <td class="total">${{$request['resumen']['totalDescu']}}</td>
          </tr>
          <tr>
            <td colspan="5">Monto total de Operaciones</td>
            <td class="total">${{$request['resumen']['montoTotalOperacion']}}</td>
          </tr>
          <tr>
            <td colspan="5" class="grand total">TOTAL A PAGAR</td>
            <td class="grand total">${{$request['resumen']['pagos'][0]['montoPago']}}</td>
          </tr>
          <tr>
            <td colspan="6" class="letras">TOTAL EN LETRAS: {{$request['resumen']['totalLetras']}}</td>
          </tr>

        </tbody>
      </table>


          <div id="resumen" class="clearfix">
              <div><span>Codigo Generación:</span> {{ $request['identificacion']['codigoGeneracion'] }}</div>
              <div><span>Numero de Contról:</span> {{ $request['identificacion']['numeroControl'] }}</div>
              <div><span>Sello de Recepción:</span> {{ $request['selloRecibido'] }}</div>
              <div><span>Fecha/Hora Emisión:</span> {{ $dte['fhProcesamiento'] }}</div>
              <div><span>Moneda:</span> {{ $request['identificacion']['tipoMoneda'] }}</div>
          </div>



        <div id="notices">
            <div class="notice">Documento Tributário Electrónico emitido y distribuido por Hibrido El Salvador. Fecha de emisión: {{ $dte['fhProcesamiento'] }}. Cualquier duda, favor escribir a info@hibridosv.com
            </div>
        </div>

    </main>
    <footer>

    </footer>
  </body>
</html>
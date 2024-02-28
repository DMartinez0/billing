<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Documento Tributario Electrónico - Factura</title>
    {{-- <link rel="stylesheet" href="{{ asset('css/style_invoice.css')."?v=".rand(1,1000) }}" media="all"  /> --}}
    <style>
.clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #5D6975;
  text-decoration: underline;
}

body {
  position: relative;
  width: 21cm;  
  height: 29.7cm; 
  margin: 0 auto; 
  color: #001028;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 12px; 
  font-family: Arial;
}

header {
  padding: 10px 0;
  margin-bottom: 30px;
}

#logo {
  width: 90%;
  text-align: center;
  margin-bottom: 10px;
  margin-top: 5px;
}

#logo img {
  width: 125px;
  padding-left: 60px;
  padding-right: 60px;
}

h1 {
  border-top: 1px solid  #5D6975;
  border-bottom: 1px solid  #5D6975;
  color: #5D6975;
  font-size: 2.4em;
  line-height: 1.4em;
  font-weight: normal;
  text-align: center;
  margin: 0 0 20px 0;
  width: 90%;
  background: url(http://billing.test/images/invoice/dimension.png);
}

h2 {
  width: 90%;
  font-size: 2em;
  line-height: 1.4em;
  font-weight: normal;
  text-align: center;
  margin: 0 0 20px 0;
}

#content {
  width: 90%;
}

#project {
  float: left;
}

#project span {
  color: #5D6975;
  text-align: right;
  width: 52px;
  margin-right: 10px;
  display: inline-block;
  font-size: 0.8em;
}

#company {
  float: right;
}

#company span {
  color: #5D6975;
  text-align: right;
  width: 52px;
  margin-right: 10px;
  display: inline-block;
  font-size: 0.8em;
}

#project div,
#company div {
  white-space: nowrap;        
}

table {
  width: 90%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}

table tr:nth-child(2n-1) td {
  background: #F5F5F5;
}

table th,
table td {
  text-align: center;
}

table th {
  padding: 5px 20px;
  color: #5D6975;
  border-bottom: 1px solid #C1CED9;
  white-space: nowrap;        
  font-weight: normal;
}

table .service,
table .desc {
  text-align: left;
}

table td {
  padding: 10px;
  text-align: right;
}

table td.service,
table td.desc {
  vertical-align: top;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}

table td.grand {
  border-top: 1px solid #5D6975;
}

table td.letras {
  border-top: 1px solid #5D6975;
  text-align: center;
}

#notices .notice {
  color: #5D6975;
  width: 90%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #C1CED9;
  padding: 8px 0;
  text-align: center;
  margin-bottom: 27px;
  font-size: 0.8em;
}

    </style>
  </head>
  <body>
    <h1>Documento Tributario Electrónico - Factura</h1>
    <header class="clearfix">
      
      <div id="logo">
        <img src="https://api-connect.hibridosv.com/images/invoice/logo.png" width="150">

        <img src="{{ asset('storage/qr/'.$request['identificacion']['codigoGeneracion'].'.svg') }}" width="150">
        
      </div>

      <div id="contenheader">
          @if ($request['emisor']['nombreComercial'])
          <h2>{{ $request['emisor']['nombreComercial'] }}</h2>
          @endif
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
            <td class="service">{{ $producto['numItem'] }}</td>
            <td class="desc">{{ $producto['descripcion'] }}</td>
            <td>{{ $producto['codigo'] }}</td>
            <td>${{ toMoney($producto['precioUni']) }}</td>
            <td>${{ toMoney($producto['montoDescu']) }}</td>
            <td class="total">${{ toMoney($producto['ventaGravada']) }}</td>
          </tr>
          @endforeach
          <tr>
            <td colspan="5">Suma total de operaciones</td>
            <td class="total">${{ toMoney($request['resumen']['subTotalVentas']) }}</td>
          </tr>
          <tr>
            <td colspan="5">Monto total de descuentos</td>
            <td class="total">${{ toMoney($request['resumen']['totalDescu']) }}</td>
          </tr>
          <tr>
            <td colspan="5">Monto total de Operaciones</td>
            <td class="total">${{ toMoney($request['resumen']['montoTotalOperacion']) }}</td>
          </tr>
          <tr>
            <td colspan="5" class="grand total">TOTAL A PAGAR</td>
            <td class="grand total">${{ toMoney($request['resumen']['pagos'][0]['montoPago']) }}</td>
          </tr>
          <tr>
            <td colspan="6" class="letras">TOTAL EN LETRAS: {{$request['resumen']['totalLetras']}}</td>
          </tr>

        </tbody>
      </table>


          <div id="resumen" class="clearfix">
              <div><span>Codigo Generación:</span> {{ $request['identificacion']['codigoGeneracion'] }}</div>
              <div><span>Numero de Contról:</span> {{ $request['identificacion']['numeroControl'] }}</div>
              <div><span>Sello de Recepción:</span> {{ $request['responseMH']['selloRecibido'] }}</div>
              <div><span>Fecha/Hora Emisión:</span> {{ $request['responseMH']['fhProcesamiento'] }}</div>
              <div><span>Moneda:</span> {{ $request['identificacion']['tipoMoneda'] }}</div>
          </div>



        <div id="notices">
            <div class="notice">Documento Tributário Electrónico emitido y distribuido por Hibrido El Salvador. Fecha de emisión: {{ $request['responseMH']['fhProcesamiento'] }}. Cualquier duda, favor escribir al +503 7665 3304
            </div>
        </div>

    </main>
  </body>
</html>
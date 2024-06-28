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
  padding-top: 20px;
  margin-bottom: 5px;
}

#logo {
  width: 25%;
  text-align: left;
  margin-bottom: 10px;
  margin-top: 5px;
  display: inline;
}

#qr {
  width: 25%;
  margin-bottom: 10px;
  margin-top: 5px;
  float: right;
}

#qr img {
  width: 125px;
  margin-top: 25px;

}

#logo img {
  width: 125px;
  padding-left: 50px;
  padding-right: 50px;
}

h1 {
  color: #5D6975;
  font-size: 1.4em;
  line-height: 1.4em;
  font-weight: normal;
  text-align: center;
  margin: 0 0 0 0;
  width: 100%;
  background: url(https://api-connect.hibridosv.com/images/invoice/dimension.png);
}

h2 {
  width: 90%;
  font-size: 2em;
  line-height: 1.4em;
  font-weight: normal;
  text-align: left;
  margin: 0 0 0 0;
}

#content {
  width: 90%;
}

#project {
  float: left;
}


#company {
  float: right;
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

table tr:nth-child(2n) td {
  background: #F5F5F5;
}

table th,
table td {
  text-align: center;
}

table th {
  padding: 5px 20px;
  color: #171718;
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
  bottom: 30px;
  border-top: 1px solid #C1CED9;
  padding: 8px 0;
  text-align: center;
  margin-bottom: 27px;
  font-size: 0.8em;
}

.rectangulo {
    width: 60%;   
    height: 140px; 
    background-color: #ffffff;   
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); 
    border: 1px solid #000;  
    float: right;
    margin-right: 70px;
}

.rectanguloCliente {
    width: 90%; 
    height: 75px;   
    background-color: #ffffff;
    border-top: 1px solid #5D6975;  
}

.rectanguloDerecho {
    width: 35%;  
    height: 75px;   
    background-color: #ffffff;  
    float: right;
}

.rectanguloIzquierdo {
    width: 55%;  
    height: 75px; 
    background-color: #ffffff; 
    float: left;
    margin-left: 0px
}

#resumen {
  padding: 10px;
}

.negritas {
    font-weight: bold; 
}

.linea {
    margin: 0;
}

.encabezado{
  background-color: #F5F5F5;
  
}
    </style>
  </head>
  <body>    
      <div id="logo">
        <img src="https://api-connect.hibridosv.com/images/invoice/logo.jpg" width="150">      
      </div>

      <div class="rectangulo">
        <h1>Documento Tributario Electrónico</h1>
        <h1>Factura</h1>
        <hr class="linea">
        <div id="resumen" class="clearfix">
          <div><span class="negritas">Fecha/Hora Emisión:</span> {{ $request['responseMH']['fhProcesamiento'] }}</div>
          <div><span class="negritas">Codigo Generación:</span> {{ $request['identificacion']['codigoGeneracion'] }}</div>
          <div><span class="negritas">Numero de Contról:</span> {{ $request['identificacion']['numeroControl'] }}</div>
          <div><span class="negritas">Sello de Recepción:</span> {{ $request['responseMH']['selloRecibido'] }}</div>
          <div><span class="negritas">Moneda:</span> {{ $request['identificacion']['tipoMoneda'] }}</div>
      </div>
        </div>

        <header class="clearfix">
          <div id="contenheader">
            <div id="qr">
              <img src="{{ asset('storage/qr/'.$request['identificacion']['codigoGeneracion'].'.svg') }}" width="150">
            </div>
              <div id="content">
                <div id="project">
                    <div><br></div>
                    <h2>{{ $request['emisor']['nombre'] }}</h2>
                    <div><span class="negritas">NIT: </span> {{ $request['emisor']['nit'] }}</div>
                    <div><span class="negritas">NCR: </span> {{ $request['emisor']['nrc'] }}</div>
                    <div><span class="negritas">Actividad Economica: </span> {{ $request['emisor']['descActividad'] }}</div>
                    <div><span class="negritas">Dirección</span> {{ $request['emisor']['direccion']['complemento'] }}, {{ townName($request['emisor']['direccion']['departamento'], $request['emisor']['direccion']['municipio']) }}, {{ departamentName($request['emisor']['direccion']['departamento']) }}</div>
                    <div><span class="negritas">Numero de telefono: </span> {{ $request['emisor']['telefono'] }}</div>
                    <div><span class="negritas">Email: </span> {{ $request['emisor']['correo'] }}</div>
                    <div><span class="negritas">Establecimiento: </span> {{ $request['emisor']['tipoEstablecimiento'] }}</div>
                </div>
            </div>
          </div>
         
        </header>
        @if ($request['receptor'])
        <div class="rectanguloCliente">
          <div class="rectanguloIzquierdo">    
          <div class="negritas">INFORMACION DEL RECEPTOR</div>
            @if ($request['receptor']['nombre'])
            <div><span class="negritas">Nombre: </span> {{ $request['receptor']['nombre'] }}</div>
            @endif
            @if ($request['receptor']['descActividad'])
            <div><span class="negritas">Actividad Económica: </span> {{ $request['receptor']['descActividad'] }}</div>
            @endif
            @if ($request['receptor']['direccion'])
            <div><span class="negritas">Dirección: </span> {{ $request['receptor']['direccion']['complemento'] }}, {{ $request['receptor']['direccion']['departamento'], $request['receptor']['direccion']['municipio'] }}, {{ $request['receptor']['direccion']['departamento'] }}</div>
            @endif
            @if ($request['receptor']['correo'])
            <div><span class="negritas">Email: </span> {{ $request['receptor']['correo'] }}</div>
            @endif
          @endif
        </div>
        @if ($request['receptor']) 
        <div class="rectanguloDerecho">
          <div><br></div>
          @if ($request['receptor']['numDocumento'])
            <div><span class="negritas">Documento: </span> {{ $request['receptor']['numDocumento'] }}</div>
            @endif
            @if ($request['receptor']['nrc'])
            <div><span class="negritas">NCR: </span> {{ $request['receptor']['nrc'] }}</div>
            @endif
            @if ($request['receptor']['telefono'])
            <div><span class="negritas">Numero de telefono: </span> {{ $request['receptor']['telefono'] }}</div>
            @endif
          @endif
    
        </div>
      </div>



    <main>
      <table>
        <thead>
          <tr>
            <th class="service">CANT</th>
            <th>CODIGO</th>
            <th class="desc">DESCRIPCION</th>
            <th>PRECIO</th>
            <th>DESC. POR ITEM</th>
            <th>TOTAL</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($request['cuerpoDocumento'] as $producto)
          <tr>
            <td class="service">{{ $producto['cantidad'] }}</td>
            <td>{{ $producto['codigo'] }}</td>
            <td class="desc">{{ $producto['descripcion'] }}</td>
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

        <div id="notices">
            <div class="notice">Documento Tributário Electrónico emitido y distribuido por Hibrido El Salvador. Fecha de emisión: {{ $request['responseMH']['fhProcesamiento'] }}. Cualquier duda, favor escribir al +503 7665 3304
            </div>
        </div>

    </main>
  </body>
</html>
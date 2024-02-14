<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Factura electronica</title>
</head>
<body>
    <h3>Estimado(a) {{$request['receptor']['nombre']}}</h3>
    <p>{{$cliente->nombre_comercial}} agradece su apoyo sumándose a la reducción del consumo de papel y así cuidar juntos de nuestro medio ambiente.</p>
    <p>Por este medio le compartimos su Comprobante de crédito fiscal el cual puede descargar y consultar dando clic al archivo adjunto. <br>
    Le recordamos mantener sus datos actualizados según su identificación tributaria, para agilizar dicho trámite y a la vez agradecemos su preferencia.
    </p>
    <p>Cualquier consulta, contactarnos al Tel. +503 {{$cliente->telefono}}</p>
</body>
</html>
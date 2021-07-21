<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Correo</title>
</head>
<body>
    <h1>Un nuevo usuario se ha registrado</h1>
    <br>
    <ul>
        <li>numero de documento: {{$numero_documento}}</li>
        <li>nombres: {{$nombres}}</li>
        <li>apellidos: {{$apellidos}}</li>
        <li>correo electónico principal: {{$correo_principal}}</li>
        <li>correo electónico secundario: {{$correo_secundario}}</li>
    </ul>
</body>
</html>

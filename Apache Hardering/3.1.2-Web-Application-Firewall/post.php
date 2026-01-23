<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Prueba ModSecurity</title>
</head>
<body>

<h1>Izan Rubio Palau</h1>
<h2>Formulario de prueba WAF</h2>

<form method="POST" action="">
    <label>Introduce texto:</label><br><br>
    <input type="text" name="comentario">
    <br><br>
    <input type="submit" value="Enviar">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    echo "<h3>Resultado:</h3>";
    echo $_POST["comentario"];
}
?>

</body>
</html>

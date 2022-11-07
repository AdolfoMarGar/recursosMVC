<h1>Control de acceso</h1>

<?php
//FORMULARIO DE INICIO DE SESION
if (isset($data["error"])) {
    echo "<div style='color: red'>".$data["error"]."</div>";
}
if (isset($data["info"])) {
    echo "<div style='color: blue'>".$data["info"]."</div>";
}
?>

<form action="index.php" method="get">
    Usuario: <input type='text' name='username'><br/>
    Contraseña: <input type='password' name='password'><br/>
    <input type='hidden' name='action' value='procesarFormLogin'>
    <input type='hidden' name='controller' value='UserController'>
    <button type='submit'>Enviar</button>
</form>

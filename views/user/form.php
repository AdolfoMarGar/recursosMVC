<?php
include_once("views/plantilla/nav.php");

// VISTA PARA INSERCIÓN/EDICIÓN DE resourceS

extract($data);   // Extrae el contenido de $data y lo convierte en variables individuales  ej ($resource)

// Vamos a usar la misma vista para insertar y modificar. Para saber si hacemos una cosa u otra,
// usaremos la variable $resource: si existe, es porque estamos modificando un resource. Si no, estamos insertando uno nuevo.
if (isset($user)) {   
    echo "<h1>Modificación de usuarios</h1>";
} else {
    echo "<h1>Inserción de usuarios</h1>";
}

// Sacamos los datos del resource (si existe) a variables individuales para mostrarlo en los inputs del formulario.
// (Si no hay resource, dejamos los campos en blanco y el formulario servirá para inserción).
$id = $user->id ?? ""; 
$username = $user->username ?? "";
$password = $user->password ?? "";
$realname = $user->realname ?? "";
$type = $user->type ?? "user";

// Creamos el formulario con los campos del resource
echo "<form enctype='multipart/form-data' action = '/' method = 'post'>
        <input type='hidden' name='controller' value='UserController'>

        <input type='hidden' name='id' value='".$id."'>
        <table border ='1'>
        
        <tr>
        <td>Usuario:</td>
        <td><input type='text' name='username' value='".$username."'></td>
        </tr>
        <tr>
        <td>Contraseña:</td>
        <td><input type='texts' name='password' value='".$password."'></td>
        </tr>
        <tr>
        <tr>
        <td>Nombre:</td>
        <td><input type='text' name='realname' value='".$realname."'></td>
        </tr>
        <tr>
        <td>Tipo de usuario:</td>
        <td>
        <select name='type'>
        <option";
        if($type == 'user'){
            echo(" selected");
        }
        echo " value='user'>Usuario</option>

        <option";
        if($type == 'admin'){
            echo(" selected");
        }
        echo " value='admin'>Administrador</option>
        </select>
        </td>
        </tr>
       
        </table>
        <br>";



// Finalizamos el formulario
if (isset($user)) {
    echo "  <input type='hidden' name='action' value='modificarUser'>";
} else {
    echo "  <input type='hidden' name='action' value='insertarUser'>";
}
echo '<button name="action" value="mostrarListaUser"  >Volver</button>';

echo "	<input type='submit'></form>";


<?php
include_once("views/plantilla/nav.php");

// VISTA PARA LA LISTA DE USER

// Recuperamos la lista de user
$listaUser = $data["listaUser"];

// Si hay algún mensaje de feedback, lo mostramos
if (isset($data["info"])) {
  echo "<div style='color:blue'>".$data["info"]."</div>";
}

if (isset($data["error"])) {
  echo "<div style='color:red'>".$data["error"]."</div>";
}

// Ahora, la tabla con los datos de los user
if (count($listaUser) == 0) {
  echo "No hay datos";
} else {
  echo "<table border ='1'>";
  echo "<tr>";
  echo "<td>Usuario</td>";
  echo "<td>Contraseña</td>";
  echo "<td>Nombre</td>";
  echo "<td>Tipo</td>";
  echo "<td>Acciones</td>";
  echo "<tr>";
  foreach ($listaUser as $fila) {
    echo "<tr>";
    echo "<td>" . $fila->username . "</td>";
    echo "<td><p>" . $fila->password ."</p></td>";
    echo "<td>" . $fila->realname . "</td>";
    echo "<td>" . $fila->type . "</td>";
    
    echo '<td>';

    echo "<form action = '/' method = 'post'>";
    echo "<input type='hidden' name='controller' value='UserController'>";
    echo "<input type='hidden' name='idUser' value='".$fila->id."'>";
    echo '<button name="action" value="formularioModificarUser">Modificar</button>';
    echo "</form>";

    echo "<form action = '/' method = 'post'>";
    echo "<input type='hidden' name='controller' value='UserController'>";
    echo "<input type='hidden' name='idUser' value='".$fila->id."'>";
    echo '<button name="action" value="borrarUser">Borrar</button>';
    echo "</form>";

    echo'</td>';

    echo "</tr>";
  }
  echo "</table>";
}
echo "<form action = '/' method = 'post'>";
echo "<input type='hidden' name='controller' value='UserController'>";

echo '<button name="action" value="formularioInsertarUser">Nuevo</button>';

echo "</form>";

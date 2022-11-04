<?php
// VISTA PARA LA LISTA DE LIBROS

// Recuperamos la lista de libros
$listaResources = $data["listaResources"];

// Si hay algún mensaje de feedback, lo mostramos
if (isset($data["info"])) {
  echo "<div style='color:blue'>".$data["info"]."</div>";
}

if (isset($data["error"])) {
  echo "<div style='color:red'>".$data["error"]."</div>";
}

// Ahora, la tabla con los datos de los libros
if (count($listaResources) == 0) {
  echo "No hay datos";
} else {

  echo "<table border ='1'>";
  echo "<tr>";
  echo "<td>Nombre</td>";
  echo "<td>Descripcion</td>";
  echo "<td>Localización</td>";
  echo "<td>Imagen</td>";
  echo "<td>Acciones</td>";
  echo "<tr>";
  foreach ($listaResources as $fila) {
    echo "<tr>";
    echo "<td>" . $fila->name . "</td>";
    echo "<td><p>" . $fila->description ."</p></td>";
    echo "<td>" . $fila->location . "</td>";
    echo "<td><img src='" . $fila->image . "' width='100' height='100'></td>";

    echo '<td>';

    echo "<form action = '/' method = 'post'>";
    echo "<input type='hidden' name='controller' value='ResourcesController'>";
    echo "<input type='hidden' name='idResource' value='".$fila->id."'>";
    echo '<button name="action" value="formularioModificarResource">Modificar</button>';
    echo "</form>";

    echo "<form action = '/' method = 'post'>";
    echo "<input type='hidden' name='controller' value='ResourcesController'>";
    echo "<input type='hidden' name='idResource' value='".$fila->id."'>";
    echo '<button name="action" value="borrarResource">Borrar</button>';
    echo "</form>";


    echo'</td>';
    echo "</tr>";
  }
  echo "</table>";
}

echo "<form action = '/' method = 'post'>";
echo "<input type='hidden' name='controller' value='ResourcesController'>";
echo '<button name="action" value="formularioInsertarResources">Nuevo</button>';
echo "</form>";

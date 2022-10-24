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
    echo "<td><a href='index.php?action=formularioModificarLibro&idLibro=" . $fila->id . "'>Modificar</a>";
    echo "</br></br><a href='index.php?action=borrarLibro&idLibro=" . $fila->id . "'>Borrar</a></td>";
    echo "</tr>";
  }
  echo "</table>";
}
echo "<p><a href='index.php?action=formularioInsertarResources'>Nuevo</a></p>";

<?php
include_once("views/plantilla/nav.php");
// VISTA PARA LA LISTA DE LIBROS

// Recuperamos la lista de libros
$listaResources = $data["listaResources"];
$listaUser = $data["listaUser"];
$listaTimeSlot = $data["listaTimeSlot"];
$listaReservations = $data["listaReservations"];

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
  echo "<td>Recurso</td>";
  echo "<td>Tramo horario</td>";
  echo "<td>Usuario</td>";
  echo "<td>Comentario</td>";
  echo "<td>Accion</td>";
  
  echo "<tr>";
  for ($i=0; $i < count($data["listaResources"]); $i++){
    echo "<tr>";

    echo "<td>";
    echo $listaResources[$i][0]->name ."";
    echo "</br>";
    echo "</br>";
    echo "<img src='" .$listaResources[$i][0]->image . "' width='100' height='100'>";
    echo"</td>";

    echo "<td>";
    echo $listaTimeSlot[$i][0]->dayOfWeek.":" ;
    echo "</br>";
    echo "De ";
    echo $listaTimeSlot[$i][0]->startTime ;
    echo " a ";
    echo $listaTimeSlot[$i][0]->endTime ;
    echo"</td>";

    echo "<td>";
    echo "Nombre:</br>";
    echo $listaUser[$i][0]->realname ;
    echo"</td>";
   

    echo "<td>";
    echo $listaReservations[$i]->remark ;
    echo"</td>";

    echo "<td>";

    echo "<form action = '/' method = 'post'>";
    echo "<input type='hidden' name='controller' value='ReservationsController'>";
    echo "<input type='hidden' name='idReservation' value='".$listaReservations[$i]->id."'>";
    echo '<button name="action" value="borrarReservation">Borrar</button>';
    echo "</form>";
    echo"</td>";
    echo "</tr>";


  }
  echo "</table>";
}

echo "<form action = '/' method = 'post'>";
echo "<input type='hidden' name='controller' value='ReservationsController'>";
echo '<button name="action" value="selectResources">Nuevo</button>';
echo "</form>";

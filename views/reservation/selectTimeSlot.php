<?php
include_once("views/plantilla/nav.php");
// VISTA PARA SELECCIONAR UN TRAMO HORARIO Y UNA FECHA PARA LA RESERVA

// Recuperamos la lista de reservas
$listaTimeSlot = $data["listaTimeSlot"];

// Si hay algún mensaje de feedback, lo mostramos
if (isset($data["info"])) {
  echo "<div style='color:blue'>".$data["info"]."</div>";
}

if (isset($data["error"])) {
  echo "<div style='color:red'>".$data["error"]."</div>";
}

// Ahora, la tabla con los datos de los reservas
if (count($listaTimeSlot) == 0) {
  echo "No hay datos";
} else {

  echo "<table border ='1'>";
  echo "<tr>";
  echo "<td>Dia de la semana</td>";
  echo "<td>Hora inicio</td>";
  echo "<td>Hora fin</td>";
  echo "<td>Fecha</td>";
  echo "<td>Acciones</td>";
  echo "<tr>";
  foreach ($listaTimeSlot as $fila) {
    echo "<tr>";
    echo "<td>" . $fila->dayOfWeek . "</td>";
    echo "<td><p>" . $fila->startTime ."</p></td>";
    echo "<td>" . $fila->endTime . "</td>";

    

    echo "<form action = '/' method = 'post'>";
    echo "<input type='hidden' name='controller' value='ReservationsController'>";
    echo '<td>';
    echo '<input type="date"  name="date" value="'.date("Y/m/d").'">';
    echo'</td>';

    echo '<td>';

    $idResource = $_REQUEST["idResource"];
    echo "<input type='hidden' name='idResource' value='".$idResource."'>";
    echo "<input type='hidden' name='idTimeSlot' value='".$fila->id."'>";
    echo '<button name="action" value="resume">Seleccionar</button>';


    echo "</form>";

    echo'</td>';
    echo "</tr>";
  }
  echo "</table>";
  echo "Comentarios: </br>";

}

echo "<form action = '/' method = 'post'>";
echo "<input type='hidden' name='controller' value='ReservationsController'>";
echo '<button name="action" value="mostrarListaReservations">Inicio</button>';
echo '<button name="action" value="selectResources">Volver</button>';
echo "</form>";

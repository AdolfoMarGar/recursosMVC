<!DOCTYPE html>
<html>
<head>
  <title>Gestión de Recursos</title>
</head>
<body>
<?php
  echo "<table><tr>";

  echo "<form action = '/' method = 'post'>";
  echo "<input type='hidden' name='controller' value='MenuController'>";
  echo '<button name="action" value="mostrarStartMenu">Menu</button>';
  echo "</form>";

  echo "<form action = '/' method = 'post'>";
  echo "<input type='hidden' name='controller' value='ResourcesController'>";
  echo '<button name="action" value="mostrarListaResources">Recursos</button>';
  echo "</form>";

  echo "<form action = '/' method = 'post'>";
  echo "<input type='hidden' name='controller' value='TimeSlotController'>";
  echo '<button name="action" value="mostrarListaTimeSlot">Tramos horarios</button>';
  echo "</form>";

  echo "<form action = '/' method = 'post'>";
  echo "<input type='hidden' name='controller' value='UserController'>";
  echo '<button name="action" value="mostrarListaUser">Usuarios</button>';
  echo "</form>";

  echo "<form action = '/' method = 'post'>";
  echo "<input type='hidden' name='controller' value='MenuController'>";
  echo '<button name="action" value="mostrarStartMenu">Logout</button>';
  echo "</form>";




  echo "</tr></table>";

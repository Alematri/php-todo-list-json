<?php

// 1. Leggo il JSON e lo salvo in una variabile sotto forma di stringa
$json_string = file_get_contents('todo-list.json');

// 2. Trasformo la stringa in un array PHP
$list = json_decode($json_string, true);

// Verifico se mi arriva in post la variabile del nuovo item
if (isset($_POST['todoItem'])) {
  // Aggiungo l'elemento alla lista
  $newItem = $_POST['todoItem'];
  $list[] = array('text' => $newItem, 'completed' => false);

  // Salvo il dato nel file JSON esterno insieme a tutta la lista aggiornata
  file_put_contents('todo-list.json', json_encode($list));
}

// Verifico se c'è un indice di un item da eliminare
if (isset($_POST['indexToDelete'])) {
  $indexToDelete = $_POST['indexToDelete'];

  // Elimino l'elemento dall'array in base all'indice passato
  array_splice($list, $indexToDelete, 1);

  // Salvo la lista aggiornata nel JSON
  file_put_contents('todo-list.json', json_encode($list));
}

// Verifico se c'è un indice di un item da togglare
if (isset($_POST['indexToToggle'])) {
  $indexToToggle = $_POST['indexToToggle'];
  $list[$indexToToggle]['completed'] = !$list[$indexToToggle]['completed'];

  // Salvo la lista aggiornata nel JSON
  file_put_contents('todo-list.json', json_encode($list));
}

// 3. "Trasformo" il file PHP in file JSON
header('Content-Type: application/json');

// 4. Stampo la lista ricodificata, la lista PHP torna ad essere una stringa e viene stampata
echo json_encode($list);
<?php

//1 leggo il JSON e lo salvo in una variabile sotto forma di stringa
$json_string = file_get_contents('todo-list.json');
// il metodo file_get_contents prende un file esterno e lo restituisce sottoforma di stringa

//2 trasformo la stringa in un array PHP
$list = json_decode($json_string, true);
// il metodono json_decode trasforma la stringa in un array PHP appunto

// verifico se mi arriva in post la variabile del nuovo item
if(isset($_POST['todoItem'])){
  //aggiungo l'elemento alla lista
  $newItem = $_POST['todoItem'];

  $list[] = $newItem;
  // salvo il dato nel file JSON esterno insieme a tutta la lista aggiornata
  file_put_contents('todo-list.json', json_encode($list));
  // file_put_contents è un metodo nativo di PHP che va a scrivere del testo all'interno di una stringa. In questo caso dentro todo-list ci vado a scrivere $list trasformata in stringa da json_encode
}

// verifico se c'è un indice di un item da eliminare
if(isset($_POST['indexToDelete'])){

  $indexToDelete = $_POST['indexToDelete'];
  //elimino l'elemento dall'array in base all'indicer passato
  array_splice($list, $indexToDelete, 1);
  //array_splice è un metodo che toglie dall'array che gli passo (list), partendo da indice che gli passo (indextodelete), un certo quantitativo di elementi (1)
  // salvo la lista aggiornata nel JSON
  file_put_contents('todo-list.json', json_encode($list));
}

//3 "trasformo" il file PHP in file JSON
header('Content-Type: application/json');
// Content-type modifica l'header del file trasformandolo in json

//4 stampo la lista ricodificata, la lista PHP torna ad essere una stringa e viene stampata
echo json_encode($list);
// il metodo json_econde fa il processo inverso di json_decode
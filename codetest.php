<?php

$text = "my name is chimaraoke ohuoba";
$text = str_replace(' ', '_', $text);
//echo $text;

$name = 'Gerforce GTX 1080 TI for the gamers!';

echo parseInput($name);


function parseInput($data){
    $data = str_replace(' ', '-', $data);
    $data = preg_replace('/[^A-Za-z0-9\-]/', '', $data);
    $data = strtolower($data);
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

?>
<?php

try
{
  $data = new PDO('mysql:host=localhost;dbname=yasab;charset=utf8','root','');
  //N5p32rid1D
}
catch(Exception $e)
{
  die('Erreur : '.$e->getmessage());  
}
?>
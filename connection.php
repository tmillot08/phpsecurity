<?php
function connect(){
  $host = 'db757132810.db.1and1.com';
  $dbname = 'db757132810';
  $user = 'dbo757132810';
  $mdp = 'Simplon_08';
  return new PDO("mysql:host=$host;dbname=$dbname",$user,$mdp,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
}

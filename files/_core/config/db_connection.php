<?php 
//MySql Connection
DEFINE('host_mysql', 'localhost');
DEFINE('db_username_mysql', 'dbmasteruser');
DEFINE('db_password_mysql', '|aj*a]h)P82u]m~s*)yMB45GEgPmb~N');
DEFINE('db_name_mysql', 'tcmarket');

function connect_mysql()
{
  $con = new mysqli(host_mysql, db_username_mysql, db_password_mysql, db_name_mysql);
  if ($con->connect_error) {
    echo $response = array("status" => "DB_ERROR");
    die();
  }
  return $con;
}

function close_mysql($con)
{
  $con->close();
}


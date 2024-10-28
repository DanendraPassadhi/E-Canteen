<?php 
$serverName = "DESKTOP-2SVDLK3\SQLEXPRESS";
$connectionInfo = ["Database" => "ecanteen"];

$conn = sqlsrv_connect($serverName, $connectionInfo);

if ($conn === false) {
    die(print_r(sqlsrv_errors(), true)); 
}
?>
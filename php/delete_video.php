<?php
/**
 * Created by PhpStorm.
 * User: Fei Zhijun
 * Date: 2018/1/2
 * Time: 23:00
 */
require_once('../php/mysqli_connect.php');
$vid = $_GET['vid'];

$query = "DELETE FROM file where vid='$vid'";
$result = @mysqli_query($dbc, $query);
if($result){
    header('Location: '.'../teacher/material.php');
}

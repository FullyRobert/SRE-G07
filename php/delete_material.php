<?php
/**
 * Created by PhpStorm.
 * User: Fei Zhijun
 * Date: 2018/1/2
 * Time: 22:30
 */
require_once('../php/mysqli_connect.php');
$filename = $_GET['file'];
$cata = $_GET['cata'];
$cid=$_GET['cid'];
$path = "../material/$cata/$cid/$filename";

$query = "DELETE FROM file where path='$path'";
$result = @mysqli_query($dbc, $query);
if($result){
    header('Location: '.'../teacher/material.php');
}

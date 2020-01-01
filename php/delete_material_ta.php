<?php
/**
 * Created by PhpStorm.
 * User: Fei Zhijun
 * Date: 2018/1/2
 * Time: 22:30
 */
require_once('../php/mysqli_connect.php');
require_once('../ta/check-right.php');

$filename = $_GET['file'];
$cata = $_GET['cata'];
$cid = $_GET['cid'];
$path = "../material/$cata/$cid/$filename";

if (!check_right($cid, "delete_material", $dbc)) {
    echo "<script>alert('没有该权限！');location.href='../ta/material.php';</script>";
} else {
    $query = "DELETE FROM file where path='$path'";
    $result = @mysqli_query($dbc, $query);
    if ($result) {
        header('Location: ' . '../ta/material.php');
    }
}



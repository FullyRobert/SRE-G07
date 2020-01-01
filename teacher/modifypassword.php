<?php
require_once '../php/mysqli_connect.php';
header('Content-Type: text/html; charset=gb2312');
$id=$_COOKIE['user_id'];
// $json = file_get_contents('php://input');
$newpass = $_POST['$newpass'];
$oldpass=$_POST['$oldpass'];
$q = "select password  from user_signup where id= $id";
$q1 = "select usertype  from user_signup where id= $id";
$r = @mysqli_query($dbc, $q);
$r1 = @mysqli_query($dbc, $q1);
$r=mysqli_fetch_assoc($r);
$r1=mysqli_fetch_assoc($r1);
$r=$r['password'];
$r1=$r1['usertype'];
if($oldpass!=$r)
    echo 0;
else{
    if($r1=="1")
    {
        $q = "update user_signup set password ='{$newpass}' where id= {$id}";
    $q1 = "update teacher set password ='{$newpass}' where tid= {$id}";
    @mysqli_query($dbc, $q);
    @mysqli_query($dbc, $q1);
    mysqli_close($dbc) ;
    echo true;}
    else if($r1=="2")
    {
        $q = "update user_signup set password ='{$newpass}' where id= {$id}";
    $q1 = "update student set password ='{$newpass}' where sid= {$id}";
    @mysqli_query($dbc, $q);
    @mysqli_query($dbc, $q1);
    mysqli_close($dbc) ;
    echo true;}
    else if($r1=="3")
    {
        $q = "update user_signup set password ='{$newpass}' where id= {$id}";
    $q1 = "update ta set password ='{$newpass}' where aid= {$id}";
    @mysqli_query($dbc, $q);
    @mysqli_query($dbc, $q1);
    mysqli_close($dbc) ;
    echo true;}
}
?>
<?php
require_once '../php/mysqli_connect.php';

if(isset($_COOKIE['user_type'])){
    if($_COOKIE['user_type']=='0'){
        $home_url = '../php/logout.php';
        header('Location: '.$home_url);
    }
    else if ($_COOKIE['user_type']=='2'){
        $home_url = '../student/index.php';
        header('Location: '.$home_url);
    }
    else if($_COOKIE['user_type']=='1'){
        $home_url = '../teacher/index.php';
        header('Location: '.$home_url);
    }
}
else{
    $home_url = '../index.php';
    header('Location: '.$home_url);
}
error_reporting(0);
$reply_id = $_POST['reply_id'];
$post_id = $_POST['post_id'];

if (isset($_POST['cid']))
    $course_id = $_POST['cid'];
else
    $course_id = $_GET['cid'];
if (isset($_POST['cname']))
    $course_name = $_POST['cname'];
else
    $course_name = $_GET['cname'];

$query = "delete from replys where id = '$reply_id'";
$result = @mysqli_query($dbc, $query);
if($result){
}
else{
    echo 'failure';
}

$home_url = "./bbs-thread.php?id=$post_id&cid=$course_id&cname=$course_name";
header('Location: '.$home_url);
?>
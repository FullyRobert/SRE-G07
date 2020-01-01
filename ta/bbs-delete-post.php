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

$course_id = $_POST['course_id'];
$course_name = $_POST['course_name'];
$post_id = $_POST['post_id'];
$is_public = $_POST['is_public'];
$gid = $_POST['gid'];

$query = "delete from posts where id = '$post_id'";
$result = @mysqli_query($dbc, $query);
if($result){
}
else{
    echo 'failure';
}

if ($is_public == 1)
    $home_url = "./bbs-course.php?cid=$course_id&cname=$course_name";
else 
    $home_url = "./bbs-group.php?cid=$course_id&cname=$course_name&gid=$gid";
header('Location: '.$home_url);
?>
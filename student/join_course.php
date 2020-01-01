<?php
require_once '../php/mysqli_connect.php';
header('Content-Type: text/html; charset=gb2312');
$code=$_POST['$coursecode'];
$sid=$_COOKIE['user_id'];
$query='select course_id from course_basic where invitation="'.$code.'";';
$result = @mysqli_query($dbc, $query);
$row = mysqli_fetch_assoc($result);
$cid=$row['course_id'];
$cid=(int)$cid;
$sid=(int)$sid;
$query2='insert into course(course_id, sid) values('.$cid.','.$sid.');';
                $result2 = @mysqli_query($dbc, $query2);
                $row2 = mysqli_fetch_assoc($result2);

?>
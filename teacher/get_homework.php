<?php
$course_id=$_POST['$cid'];
$tid=$_COOKIE['user_id'];
// $hw_id=$_GET['hw_id'];
$hw_id =$_POST['$hw_id'];
require_once('../php/mysqli_connect.php');

$query1="select hw_name,deadline,summary from homework where hw_id=".$hw_id.";";
$queryresult1=@mysqli_query($dbc, $query1);
$array1 = array();
if ($queryresult1) {
    while($row = mysqli_fetch_array($queryresult1, MYSQLI_ASSOC))
        array_push($array1,$row);
} 
else {
    echo "no result";
}
$jarray1=json_encode($array1);

$query2="select count(sid) from course where course_id=".$course_id.";";
$queryresult2 = @mysqli_query($dbc, $query2);
if ($queryresult2)
    $row = mysqli_fetch_array($queryresult2, MYSQLI_ASSOC);
$studentNum=$row['count(sid)'];

$query3="select count(sid) from student_homework where hw_id=".$hw_id.";";
$queryresult3 = @mysqli_query($dbc, $query3);
if ($queryresult3)
    $row = mysqli_fetch_array($queryresult3, MYSQLI_ASSOC);
$handinNum=$row['count(sid)'];

$array=array();
$query4="select B.sid,B.sname,A.handintime,A.hw_Index,A.grade,A.comment from student_homework as A join student as B on A.sid=B.sid where A.hw_id=".$hw_id.";";
$queryresult4 = @mysqli_query($dbc, $query4);
if ($queryresult4)
    while($row = mysqli_fetch_array($queryresult4, MYSQLI_ASSOC))
    {
        array_push($array,$row);
    }
else {
    echo "no result";
}
if ($queryresult4)
    mysqli_free_result($queryresult4);
$jarray=json_encode($array);

$data123=[
    '$jarray'=>$jarray, 
    '$jarray1'=>$jarray1,
    '$studentNum'=>$studentNum,
    '$handinNum'=>$handinNum,
    '$hw_id'=>$hw_id
];
echo json_encode($data123);

?>
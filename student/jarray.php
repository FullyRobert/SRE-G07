<?php
/**
 * Created by PhpStorm.
 * User: Fei Zhijun
 * Date: 2017/12/20
 * Time: 18:01
 */

require_once('../php/mysqli_connect.php');

$course_id=$_POST['$course_id'];

$tid=$_COOKIE['user_id'];
$query = "select hw_id,hw_name,deadline,summary from homework where course_id=".$course_id." order by deadline;";
$array = array();
$queryresult = @mysqli_query($dbc, $query);
if ($queryresult) {
    while($row = mysqli_fetch_array($queryresult, MYSQLI_ASSOC))
    {
        array_push($array,$row);
    }
} 
else {
    echo "no result";
}

if ($queryresult)
    mysqli_free_result($queryresult);

$handinArray=array();
$queryHandin="select B.hw_id,count(sid) from student_homework as A join homework as B on A.hw_id=B.hw_id group by B.hw_id;";
$Handinresult=@mysqli_query($dbc,$queryHandin);
if($Handinresult)
    while($row = mysqli_fetch_array($Handinresult, MYSQLI_ASSOC))
    {
        array_push($handinArray,$row);
    }
    else {
    echo "no result";
}

for($i=0;$i<count($array);$i++){

    $array[$i]["count"]=0;
    for($j=0;$j<count($handinArray);$j++)
    {
        if($array[$i]['hw_id']==$handinArray[$j]['hw_id'])
            $array[$i]['count']=$handinArray[$j]['count(sid)'];
    }
}

$jarray=json_encode($array);

$queryCount="select count(sid) from course where course_id=".$course_id.";";
$Countresult = @mysqli_query($dbc, $queryCount);
if ($Countresult)
    $row = mysqli_fetch_array($Countresult, MYSQLI_ASSOC);
$studentNum=$row['count(sid)'];

$data123=[
    '$jarray'=>$jarray, 
    '$studentNum'=>$studentNum
];
echo json_encode($data123);
?>

<?php
/**
 * Created by PhpStorm.
 * User: Fei Zhijun
 * Date: 2018/1/1
 * Time: 20:26
 */
require_once('../php/mysqli_connect.php');
array('request'=>$_REQUEST);
if(empty($_FILES["video"])){
    $output=['error'=>'No files were processed.'];
    echo json_encode($output);
    return;
}
if ($_FILES["video"]["error"] > 0)
{
    $success=false;
    $output = ["error"=> $_FILES["video"]["error"]];
}
else
{
    $name = $_FILES["video"]["name"];
    $course = $_REQUEST["course"];
    $path="../material/video/".$course;

    if (!check_right($course, "upload_material", $dbc)) {
        echo "<script>alert('没有该权限！');location.href='../ta/material.php';</script>";
    }

    if(is_dir($path)==0)
    {
        mkdir("$path");
    }
    $path=$path.'/'.$name;
    $size = $_FILES["video"]["size"];
    $query="SELECT valid FROM video WHERE path='$path'";
    $result = @mysqli_query($dbc, $query);
    if ($result) {
        $row = @mysqli_fetch_array($result, MYSQLI_NUM);
        if(mysqli_num_rows($result)>0){
            $query="UPDATE video SET name='$name', size=$size, upload_time=NOW(), valid=true";
            $result = @mysqli_query($dbc, $query);
            if($result AND move_uploaded_file($_FILES["video"]["tmp_name"], $path)){
                $output = [];
                $success=true;
            }
            else {
                $success=false;
                echo mysqli_error($dbc);
                $output = ['error'=>'Database insert error!'];
            }
        }
        else{
            $query="INSERT INTO video(name,size,path,upload_time,valid,course_id) VALUES ('$name',$size,'$path',NOW(),false,$course)";
            $result = @mysqli_query($dbc, $query);
            if ($result) {
                if(move_uploaded_file($_FILES["video"]["tmp_name"], $path)){
                    $output = [];
                    $query="UPDATE video SET valid=true WHERE name='$name'";
                    $result = @mysqli_query($dbc, $query);
                    $success=true;
                }
                else{
                    $success=false;
                    $output = ['error'=>'No files were processed.'];
                }
            } else {
                $success=false;
//                echo mysqli_error($dbc);
                $output = ['error'=>'Database insert error!'];
            }
        }
    }
//    $query="INSERT INTO video(name,size,path,upload_time,valid) VALUES ('$name',$size,'$path',NOW(),false)";
//    $result = @mysqli_query($dbc, $query);
//    if ($result) {
//        if(move_uploaded_file($_FILES["video"]["tmp_name"], $path)){
//            $output = [];
//            $query="UPDATE video SET valid=true WHERE name='$name'";
//            $result = @mysqli_query($dbc, $query);
//            $success=true;
//        }
//        else{
//            $success=false;
//            $output = ['error'=>'File move error.'];
//        }
//    } else {
//        $success=false;
//        echo mysqli_error($dbc);
//        $output = ['error'=>'Database insert error!'];
//    }

}
echo json_encode($output);
?>
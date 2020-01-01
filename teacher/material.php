
<!-- jQuery -->
<script src="../js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="../js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="../js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="../js/jquery.waypoints.min.js"></script>
	<!-- Stellar Parallax -->
	<script src="../js/jquery.stellar.min.js"></script>
	<!-- Carousel -->
	<script src="../js/owl.carousel.min.js"></script>
	<!-- Flexslider -->
	<script src="../js/jquery.flexslider-min.js"></script>
	<!-- countTo -->
	<script src="../js/jquery.countTo.js"></script>
	<!-- Magnific Popup -->
	<script src="../js/jquery.magnific-popup.min.js"></script>
	<script src="../js/magnific-popup-options.js"></script>
	<!-- Count Down -->
	<script src="../js/simplyCountdown.js"></script>
	<!-- Main -->
	<script src="../js/main.js"></script>

<?php
/**
 * Created by PhpStorm.
 * User: Fei Zhijun
 * Date: 2017/12/20
 * Time: 18:01
 */
if(isset($_COOKIE['user_type'])){
    if($_COOKIE['user_type']=='0'){
        $home_url = '../php/logout.php';
        header('Location: '.$home_url);
    }
    else if ($_COOKIE['user_type']=='2'){
        $home_url = '../student/index.php';
        header('Location: '.$home_url);
    }
    else if($_COOKIE['user_type']=='3'){
        $home_url = './ta/index.php';
        header('Location: '.$home_url);
    }
}
else{
    $home_url = '../index.php';
    header('Location: '.$home_url);
}
require_once("../include/material_teacher_header.html");
?>
<style type="text/css">
    .container-gray {
        background: #F0F0F0;
        padding-top: 12px;
        padding-bottom: 12px;
        padding-left: 12px;
        padding-right: 12px;
        /*border:1px solid #ccc;*/
    }

    .container-white {
        padding-top: 12px;
        padding-bottom: 12px;
        border: 1px solid #ccc;
    }

    .tr_odd {
        background-color: #EBF2FE;
    }

    .tr_even {
        background: #B4CDE6;
    }

    .input_control {
        width: 360px;
        margin: 20px auto;
    }

    input[type="text"],
    #btn1,
    #btn2 {
        box-sizing: border-box;
        text-align: center;
        font-size: 1.4em;
        height: 2.7em;
        border-radius: 4px;
        border: 1px solid #c8cccf;
        color: #6a6f77;
        -web-kit-appearance: none;
        -moz-appearance: none;
        display: block;
        outline: 0;
        padding: 0 1em;
        text-decoration: none;
        width: 50%;
    }

    input[type="text"]:focus {
        border: 1px solid #ff7496;
    }

    input[type="date"],
    #btn1,
    #btn2 {
        box-sizing: border-box;
        text-align: center;
        font-size: 1.4em;
        height: 2.7em;
        border-radius: 4px;
        border: 1px solid #c8cccf;
        color: #6a6f77;
        -web-kit-appearance: none;
        -moz-appearance: none;
        display: block;
        outline: 0;
        padding: 0 1em;
        text-decoration: none;
        width: 20%;
    }

    input[type="date"]:focus {
        border: 1px solid #ff7496;
    }
</style>
<link type="text/css" rel="stylesheet" href="../css/fileinput.css" />
<div class="container">
        <br>
        <ol class="breadcrumb">
        <div class="dropdown">
<p>请选择一门课程</p>
<button  type="button" class="btn dropdown-toggle" id="dropdownMenu2" data-toggle="dropdown">
                所有课程<span class="caret"></span>
            </button>
            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu2">
            <?php
                require_once('../php/mysqli_connect.php');
                $tid = $_COOKIE['user_id']; // 当前教师的id
                $query4 = "select course_id, course_name from course_basic where tid = $tid;";  // 获取当前教师的所有课程
                $result4 = @mysqli_query($dbc, $query4);
                if($result4){
                    $a=1;
                    while ($row4 = mysqli_fetch_array($result4, MYSQLI_ASSOC)) {
                        if($a==1)
                        {
                            $tmp=$row4['course_id'];
                            $a+=1;
                        }

                        echo '<li>
                        <form action="material2.php" method="post">
                        <input type="hidden" name="cid" value="'.$row4['course_id'].'">
                        <input type="hidden" name="cname" value="'.$row4['course_name'].'">
                        <button type="submit" class="btn"> '.$row4['course_name'].' </button></form></li>';

                    }
                }
                ?>
            </ul>
        </div>
        </ol>
</div>

<div class="materialPane">
    <div class="timeline-post videoArea" style="height: 600px">
    <div class="timeline-post fileArea">
    <?php
    require_once('../php/mysqli_connect.php');
                            
                            $query="select  course_name from course_basic where course_id = $tmp;" ;
                            $result = @mysqli_query($dbc, $query);
//                            echo $query;
                            if($result){
                                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))//从结果集$r得到关联数组
                                {
                                    $name=$row['course_name'];
                                }
                                echo '<h2>'.$name.'课程资源</h2>';
                            }
                                ?>
        <div class="panel-group" id="fileList">
            <div class="panel panel-info" data-toggle="collapse" data-parent="#fileList"
                 href="#requirementVideo">
                <div class="panel-heading">
                    
                </div>
                <div id="requirementVideo" class="panel-collapse collapse in">
                    <div class="panel-body">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>名称</th>
                                <th>上传日期</th>
                                <th>大小</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            require_once('../php/mysqli_connect.php');
                            
                            $query="SELECT name,upload_time,size,path FROM file where course_id=$tmp and valid=true" ;
                            $result = @mysqli_query($dbc, $query);
//                            echo $query;
                            if($result){
                                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))//从结果集$r得到关联数组
                                {
                                    $name=$row['name'];
                                    $time=$row["upload_time"];
                                    $size=$row["size"];
                                    $path=$row["path"];
                                    echo '<tr>
                                            <td>'.$name.'</td>
                                            <td>'.$time.'</td>
                                            <td>'.$size.'byte</td>
                                            <td><a style="color: white" href="../php/download_material.php?cid='.$tmp.'&cata=file&file='.$name.'" class="btn btn-success unwork_a">下载</a>
                                               
                                            </td>
                                           </tr>';
                                }
                            }
                            $query="SELECT name,upload_time,size,path FROM video where course_id=$tmp and valid=true" ;
                            $result = @mysqli_query($dbc, $query);
//                            echo $query;
                            if($result){
                                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))//从结果集$r得到关联数组
                                {
                                    $name=$row['name'];
                                    $time=$row["upload_time"];
                                    $size=$row["size"];
                                    $path=$row["path"];
                                    echo '<tr>
                                            <td>'.$name.'</td>
                                            <td>'.$time.'</td>
                                            <td>'.$size.'byte</td>
                                            <td><a style="color: white" href="../php/download_material.php?cid='.$tmp.'&cata=video&file='.$name.'" class="btn btn-success unwork_a">下载</a>
                                               
                                            </td>
                                           </tr>';
                                }
                            }
                            
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <br />
    </div>
    </div>
</div>
<?php
require_once("../include/footer_teacher.html");
?>

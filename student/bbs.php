<?php
if(isset($_COOKIE['user_type'])){
    if($_COOKIE['user_type']=='0'){
        $home_url = '../php/logout.php';
        header('Location: '.$home_url);
    }
    elseif ($_COOKIE['user_type']=='1'){
        $home_url = '../teacher/index.php';
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

require_once('../include/bbs_student_header.html');
?>

<div id="body">
    <div class="container">
        <br>
        <ol class="breadcrumb">
            <li><a href="bbs.php"><span class="glyphicon glyphicon-home"> 教学论坛</span></a></li>
            <a href="bbs-profile.php" role="button" class="btn btn-primary" style="float: right;
            color: #fff;"><span class="glyphicon glyphicon-user"></span> <?php echo $_COOKIE['user_name'];?></a>
        </ol>

        <div class="container-gray">
            <h3>所有课程：</h3>
        </div>

        <?php
        require_once('../php/mysqli_connect.php');
        $sid = $_COOKIE['user_id']; // 当前学生的id
        $query4 = "select course_id from course where sid = $sid;";  // 获取当前学生的所有课程
        $result4 = @mysqli_query($dbc, $query4);
        if($result4){
            while ($row4 = mysqli_fetch_array($result4, MYSQLI_ASSOC)) {
                $course_id = $row4['course_id'];
                $query5 = "select course_name from course_basic where course_id = $course_id";
                $result5 = @mysqli_query($dbc, $query5);
                $row5 = mysqli_fetch_array($result5, MYSQLI_ASSOC);
                $course_name = $row5['course_name'];
                echo '<li>
                <form action="bbs-course.php" method="post">
                <input type="hidden" name="cid" value="'.$course_id.'">
                <input type="hidden" name="cname" value="'.$course_name.'">
                <button type="submit" class="btn"> '.$course_name.' </button></form></li><br>';
            }
        }
        ?>
        <br>
        <br>
    </div>
</div>

<?php
require_once("../include/footer_student.html");
?>
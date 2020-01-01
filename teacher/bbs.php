<?php
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

require_once('../include/bbs_teacher_header.html');
?>

<div id="body">
    <div class="container">
        <br>
        <ol class="breadcrumb">
            <li><a href="bbs.php"><span class="glyphicon glyphicon-home"> 教学论坛</span></a></li>
            <a href="bbs-profile.php" role="button" class="btn btn-primary" style="float: right;color: #fff;"><span class="glyphicon glyphicon-user"></span> <?php echo $_COOKIE['user_name'];?></a>
        </ol>

        <div class="dropdown">
            <button type="button" class="btn dropdown-toggle" id="dropdownMenu2" data-toggle="dropdown">
                全部课程<span class="caret"></span>
            </button>

            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu2">
                <?php
                require_once('../php/mysqli_connect.php');
                $tid = $_COOKIE['user_id']; // 当前教师的id
                $query4 = "select course_id, course_name from course_basic where tid = $tid;";  // 获取当前教师的所有课程
                $result4 = @mysqli_query($dbc, $query4);
                if($result4){
                    while ($row4 = mysqli_fetch_array($result4, MYSQLI_ASSOC)) {
                        echo '<li>
                        <form action="bbs-course.php" method="post">
                        <input type="hidden" name="cid" value="'.$row4['course_id'].'">
                        <input type="hidden" name="cname" value="'.$row4['course_name'].'">
                        <button type="submit" class="btn"> '.$row4['course_name'].' </button></form></li>';
                    }
                }
                ?>
            </ul>
        </div>
        <br>
    </div>
</div>
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

<?php
require_once("../include/footer_teacher.html");
?>
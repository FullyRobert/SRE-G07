<?php
/**
 * Created by PhpStorm.
 * User: momotani
 * Date: 2017/12/26
 * Time: 下午4:50
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

$course_id = 0;
$gid = 0;
if (isset($_POST['cid']))
    $course_id = $_POST['cid'];
else
    $course_id = $_GET['cid'];
if (isset($_POST['cname']))
    $course_name = $_POST['cname'];
else
    $course_name = $_GET['cname'];
if (isset($_POST['is_public']))
    $is_public = $_POST['is_public'];
else
    $is_public = $_GET['is_public'];
if (isset($_POST['gid']))
    $gid = $_POST['gid'];
if (isset($_GET['gid']))
    $gid = $_GET['gid'];

require_once ("../include/bbs_teacher_header.html")
?>

<div class="content-warp" id="barba-wrapper" aria-live="polite">
        <div class="container list-container" style="visibility: visible;">
            <div class="row">
                <!--start main content aera-->
                <!-- <div>
                    <button class="btn btn-info">新增文章</button>
                </div> -->
                <form  action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                    <div class="col-md-12 main-content-timeline">
                        <div class="timeline-post">
                            <h3>标题：</h3>
                            <!-- <div class="input-group"> -->
                            <input type="text" name="title" class="form-control">
                            <?php
                            echo '<input type="hidden" name="cid" value="'.$course_id.'">';
                            ?>
                            <?php
                            echo '<input type="hidden" name="cname" value="'.$course_name.'">';
                            ?>
                            <?php
                            echo '<input type="hidden" name="is_public" value="'.$is_public.'">';
                            ?>
                            <?php
                            echo '<input type="hidden" name="gid" value="'.$gid.'">';
                            ?>
                            <!-- </div> -->
                            <h3>正文：</h3>
                            <textarea id="TextArea1" name="content" cols="20" rows="200" class="ckeditor"></textarea>
                            <button class="btn btn-success" type="submit" name="submit" id="issueArticle">发布</button>
                        </div>
                    </div>
                </form>
                <?php
                require_once('../php/mysqli_connect.php');
                require_once ('../php/global.php');
                error_reporting(0);
                
                if(isset($_POST['submit']))
                {
                    date_default_timezone_set('PRC');
                    $time1 = date('Y-m-d H:i',time());
                    //获取用户的输入
                    $course_id = mysqli_real_escape_string($dbc, trim($_POST['cid']));
                    $title = mysqli_real_escape_string($dbc, trim($_POST['title']));
                    $content = mysqli_real_escape_string($dbc, trim($_POST['content']));
                    $owner = mysqli_real_escape_string($dbc, trim($_COOKIE['user_name']));
                    $is_public = mysqli_real_escape_string($dbc, trim($_POST['is_public']));
                    $gid = mysqli_real_escape_string($dbc, trim($_POST['gid']));
                    if ($is_public == 1)
                        $q = "insert into posts(course_id, owner, title, content, post_date, is_public) values ($course_id ,'$owner','$title','$content','$time1', '1')";
                    else 
                        $q = "insert into posts(course_id, owner, title, content, post_date, is_public) values ($course_id ,'$owner','$title','$content','$time1', '0')";
                    //执行sql语句，同样需要在前头加上 @ 符号
                    $r = @mysqli_query($dbc, $q);
                    if($r){
                        echo    '<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog"><div class="modal-content"><div class="modal-body btn-success">
                                            发帖成功！</div></div></div>
                                     </div>
                                     <script>$(function () { $(\'#myModal3\').modal({ keyboard: true})});</script>';
                        
                        if ($is_public == 1)    // 如果是在课程论坛内发言
                            echo '
                                <script>url="bbs-course.php?cid='.$course_id.'&cname='.$course_name.'";window.location.href=url;</script>'; // 返回课程论坛
                        else    // 如果是在组内论坛发言
                            echo '
                                <script>url="bbs-group.php?cid='.$course_id.'&cname='.$course_name.'&gid='.$gid.'";window.location.href=url;</script>'; // 返回组内论坛
                        // header("Location: bbs-course.php?cid=$course_id&cname=$course_name");
                    }
                    else{
                        echo    '<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog"><div class="modal-content"><div class="modal-body btn-danger">
                                            发帖失败！<br />'.mysqli_error($dbc).'</div></div></div>
                                     </div>
                                     <script>$(function () { $(\'#myModal3\').modal({ keyboard: true})});</script>';
                    }
                }
                ?>
            </div>
        </div>
    </div>



<?php
require_once ("../include/footer_teacher.html")
?>
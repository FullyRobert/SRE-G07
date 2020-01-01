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
    else if($_COOKIE['user_type']=='1'){
        $home_url = '../teacher/index.php';
        header('Location: '.$home_url);
    }
}
else{
    $home_url = '../index.php';
    header('Location: '.$home_url);
}

require_once("../include/manage_ta_header.html");
require_once('../php/mysqli_connect.php');
require_once('./check-right.php');

$tid = $_COOKIE['user_id'];
$tname = $_COOKIE['user_name'];
?>
<div class="content-warp" id="barba-wrapper" aria-live="polite">
    <div class="container list-container" style="visibility: visible;">
        <div class="row">
                <div class="col-md-12 main-content-timeline">
                    <div class="timeline-post">
                        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                            <h2>公告管理</h2>
                            <br>
                            <h4>选择课程：</h4>
                            <div class="form-group">
                                <select name="course_name" class="form-control">
                                    <?php
                                    require_once('../php/mysqli_connect.php');
                                    $course_query = "select distinct course_name from course_basic where taid = $tid;";    // 找该教师的所有课程
                                    $course_result = @mysqli_query($dbc, $course_query);
                                    $tmp_course_row = mysqli_fetch_array($course_result, MYSQLI_ASSOC);
                                    if ($tname == 'root') { // 如果是管理员
                                        echo '<option selected="selected">全体成员公告</option>';
                                    } else {
                                        if ($tmp_course_row) {
                                            echo '<option selected="selected">'.$tmp_course_row['course_name'].'</option>';
                                            while ($tmp_course_row = mysqli_fetch_array($course_result, MYSQLI_ASSOC)) {
                                                echo '<option>'.$tmp_course_row['course_name'].'</option>';
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <h4>公告内容：</h4>
                            <textarea type="text" name="content" class="form-control">
                                <?php
                                ?>
                            </textarea>
                            <?php
                            echo '<input type="hidden" name="tid" value="'.$_COOKIE['user_id'].'">'
                            ?>
                            <button class="btn btn-success" type="submit" name="notice_submit" id="issueArticle">添加公告</button>
                        </form>
                        <h2>历史公告：</h2>
                        <?php
                        if ($tname == 'root') { // 如果是管理员
                            $notice_query = "select content, time from notice where user_type = 0 order by id desc;";
                            $notice_result = @mysqli_query($dbc, $notice_query);
                            while ($notice_tmp_row = mysqli_fetch_array($notice_result, MYSQLI_ASSOC)) {
                                $content = $notice_tmp_row['content'];
                                $time = $notice_tmp_row['time'];
                                echo '
                                <div class="card">
                                    <div class="card-block" style="float:red">
                                        <hr style="height:1px;border:none;border-top:1px solid #555555;" />
                                        <p style="line-height: 1"></p>
                                        <h4>
                                            发布者: 管理员（全体公告）
                                        </h4>
                                        <p>内容：'.$content.'</p>
                                        <span class="username text-info">
                                            时间: '.$time.'
                                        </span>
                                        <p style="line-height: 1"><br><br></p>
                                    </div>
                                </div>
                                ';
                            }
                        } else {
                            $notice_query = "select course_id, user_type, content, time from notice where course_id in (select course_id from course_basic where taid = '$tid') order by id desc;";
                            $notice_result = @mysqli_query($dbc, $notice_query);
                            while ($notice_tmp_row = mysqli_fetch_array($notice_result, MYSQLI_ASSOC)) {
                                $course_id = $notice_tmp_row['course_id'];
                                $user_type = $notice_tmp_row['user_type'];
                                $content = $notice_tmp_row['content'];
                                $time = $notice_tmp_row['time'];
                                $tname_query = "select tname from course_basic natural join teacher where course_id = '$course_id';";
                                $tname_result = @mysqli_query($dbc, $tname_query);
                                $tname_tmp_row = mysqli_fetch_array($tname_result, MYSQLI_ASSOC);
                                $tname = $tname_tmp_row['tname'];
                                $cname_query = "select course_name from course_basic where course_id = $course_id;";
                                $cname_result = @mysqli_query($dbc, $cname_query);
                                $cname_tmp_row = mysqli_fetch_array($cname_result, MYSQLI_ASSOC);
                                $course_name = $cname_tmp_row['course_name'];
                                echo '
                                <div class="card">
                                    <div class="card-block" style="float:red">
                                        <hr style="height:1px;border:none;border-top:1px solid #555555;" />
                                        <p style="line-height: 1"></p>
                                        <h4>
                                            发布者:'.$tname.' （课程:'.$course_name.'）
                                        </h4>
                                        <p>内容：'.$content.'</p>
                                        <span class="username text-info">
                                            时间: '.$time.'
                                        </span>
                                        <p style="line-height: 1"><br><br></p>
                                    </div>
                                </div>
                                ';
                            }
                        }
                        ?>
                    </div>
                </div>

            <?php
            if(isset($_POST['notice_submit']))
            {
                //获取用户的输入
                $course_name = $_POST['course_name'];
                $content = $_POST['content'];
                $content = str_replace("\n","<br />", $content);
                $tid = $_POST['tid'];
                $tname_query = "select aname from TA where aid = $tid";
                $tname_result = @mysqli_query($dbc, $tname_query);
                $tname_tmp_row = mysqli_fetch_array($tname_result, MYSQLI_ASSOC);
                $tname = $tname_tmp_row['aname'];
                if ($tname == 'root') { // tname为'root'的teacher是administrator
                    $q = "insert into notice(course_id, user_type, content, time) values (-999, 0, '$content', NOW())"; // -999应该不会被取到
                    $r = @mysqli_query($dbc, $q);
                }
                else {
                    $cid_query = "select course_id from course_basic where taid = '$tid' and course_name = '$course_name'";
                    $cid_result = @mysqli_query($dbc, $cid_query);
                    while ($cid_tmp_row = mysqli_fetch_array($cid_result, MYSQLI_ASSOC)) {  // 将该教师下某门课程名称对应的所有课程都添加相同的公告
                        $course_id = $cid_tmp_row['course_id'];
                        if (!check_right($course_id, "post_notice", $dbc)) {
                            echo "<script>alert('没有该权限！');location.href='manage.php';</script>";
                        }
                        $q = "insert into notice(course_id, user_type, content, time) values ('$course_id', 1, '$content', NOW())";
                        $r = @mysqli_query($dbc, $q);
                    }
                }
                if($r){
                    echo    '<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog"><div class="modal-content"><div class="modal-body btn-success">
                                            更新公告成功！</div></div></div>
                                     </div>
                                     <script>$(function () { $(\'#myModal3\').modal({ keyboard: true})});</script>';
                    echo '
                        <script>url="manage.php";window.location.href=url;</script>';
                }
                else{
                    echo    '<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog"><div class="modal-content"><div class="modal-body btn-danger">
                                            更新公告失败！<br />'.mysqli_error($dbc).'</div></div></div>
                                     </div>
                                     <script>$(function () { $(\'#myModal3\').modal({ keyboard: true})});</script>';
                }

            }
            if(isset($_POST['alloc_submit']))
            {
                //获取用户的输入
                $sid = $_POST['stu_id'];
                $gid = $_POST['group_id'];
                $q = "select sname from student where sid='$sid'";
                $r = @mysqli_query($dbc, $q);
                if($r){
                    $row = mysqli_fetch_array($r, MYSQLI_ASSOC);
                    $name = $row['sname'];
                    $q = "INSERT INTO groupz(id, name, gid) VALUES ($sid,'$name',$gid)";
                    //执行sql语句，同样需要在前头加上 @ 符号
                    $r = @mysqli_query($dbc, $q);
                    if($r){
                        echo    '<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog"><div class="modal-content"><div class="modal-body btn-success">
                                            添加组号成功！</div></div></div>
                                     </div>
                                     <script>$(function () { $(\'#myModal3\').modal({ keyboard: true})});</script>';
                    }
                    else{
                        echo    '<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog"><div class="modal-content"><div class="modal-body btn-danger">
                                            添加组号失败！<br />'.mysqli_error($dbc).'</div></div></div>
                                     </div>
                                     <script>$(function () { $(\'#myModal3\').modal({ keyboard: true})});</script>';
                    }
                }


            }
            if(isset($_POST['modify_submit']))
            {
                //获取用户的输入
                $sid = explode(' ',$_POST['stu_id'])[0];
                $gid = $_POST['group_id'];
                $q = "UPDATE groupz SET gid=$gid where id=$sid";
                echo $q;
                //执行sql语句，同样需要在前头加上 @ 符号
                $r = @mysqli_query($dbc, $q);
                if($r){
                    echo    '<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog"><div class="modal-content"><div class="modal-body btn-success">
                                            更新组号成功！</div></div></div>
                                     </div>
                                     <script>$(function () { $(\'#myModal3\').modal({ keyboard: true})});</script>';
                }
                else{
                    echo    '<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog"><div class="modal-content"><div class="modal-body btn-danger">
                                            更新组号失败！<br />'.mysqli_error($dbc).'</div></div></div>
                                     </div>
                                     <script>$(function () { $(\'#myModal3\').modal({ keyboard: true})});</script>';
                }

            }
            ?>
        </div>
    </div>
</div>
<script>
    $("#alloc_stu").click(function () {
        $(".dropdown-toggle").dropdown('toggle');
    })
//    $(function() {
//        $(".dropdown-toggle").dropdown('toggle');
//    });
</script>
<div style="height: 50px;"></div>
<?php
require_once("../include/footer_teacher.html");
?>

<?php

require_once('../php/mysqli_connect.php');

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

if (isset($_POST['cid']))
    $course_id = $_POST['cid'];
else 
    $course_id = $_GET['cid'];
if (isset($_POST['cname']))
    $course_name = $_POST['cname'];
else
    $course_name = $_GET['cname'];
if (isset($_POST['gid']))
    $gid = $_POST['gid'];
else
    $gid = $_GET['gid'];

$query_gid = "select id from groupz where gid=$gid";
$result_gid = @mysqli_query($dbc, $query_gid);
if ($result_gid) {
} else {
    echo "no result";
}

// echo $_POST['cname'];
// echo $_POST['cid'];

require_once('../include/bbs_student_header.html');

?>

<div id="body">
    <div class="container">
        <br>
        <ol class="breadcrumb">
            <li><a href="bbs.php"><span class="glyphicon glyphicon-home"> 教学论坛</span></a></li>
            <a href="bbs-profile.php" role="button" class="btn btn-primary" style="float: right;"><span class="glyphicon glyphicon-user"></span> <?php echo $_COOKIE['user_name'];?></a>

            <?php
            echo '
            <a href="new-post.php?cid='.$course_id.'&cname='.$course_name.'&is_public=0&gid='.$gid.'" role="button" class="btn btn-primary" style="float: right; color: white;">发新帖</a>';
            ?>
        </ol>
        <br>
        <?php
        echo '
        <a href="bbs-course.php?cid='.$course_id.'&cname='.$course_name.'" role="button" class="btn btn-primary" style="color: white;">返回</a>';
        ?>
        <br>
        <br>

        <div class="card">
            <div class="card-header">
                <ul>
                    <li>
                        最新主题
                    </li>
                </ul>
                <ul>

                </ul>
            </div>

            <div class="card-block">
                <table class="table table-hover">
                    <tbody>

                    <?php
                    require_once('../php/mysqli_connect.php');

                    $query2 = "select id, owner, title, post_date from posts where owner in (select name from groupz where gid=$gid) and is_public = 0 order by id desc";
                    $result2 = @mysqli_query($dbc, $query2);
                    if($result2){
                        while($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)){
                            $post_id_temp = $row2['id'];
                            $query_temp = "select count(id) as num from replys where post_id=$post_id_temp";
                            $result_temp = @mysqli_query($dbc, $query_temp);
                            $num_reply = 0;
                            if($result_temp){
                                $row_temp = mysqli_fetch_array($result_temp, MYSQLI_ASSOC);
                                $num_reply = $row_temp['num'];
                            }

                            echo '<tr><td><a href="bbs-thread.php?id='.$row2['id'].'&cid='.$course_id.'&cname='.$course_name.'">'.$row2['title'].'</a></td>
                                        <td width="50" class="text-small text-nowrap hidden-md-down">
                                            <span class="text-info">'.$row2['owner'].'</span>
                                            <br><span class="date text-grey hidden-md-down">'.$row2['post_date'].'</span>
                                        </td>
                                        <td width="80"><span><i class="icon-eye"></i> '.$num_reply.'</span></td>
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
<script src="../js/jquery.min.js"></script>
<script src="../js/bootstrap.min.js"></script>

<?php
require_once("../include/footer_teacher.html");
?>
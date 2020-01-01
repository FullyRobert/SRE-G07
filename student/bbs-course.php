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

/*
$gid = $_POST['gid'];
$query_gid = "select id from groupz where gid=$gid";
$result_gid = @mysqli_query($dbc, $query_gid);
if ($result_gid) {
} else {
    echo "no result";
}
*/

if (isset($_POST['cid']))
    $course_id = $_POST['cid'];
else
    $course_id = $_GET['cid'];
if (isset($_POST['cname']))
    $course_name = $_POST['cname'];
else
    $course_name = $_GET['cname'];
$sid = $_COOKIE['user_id'];
$gid = 0;

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
            <a href="new-post.php?cid='.$course_id.'&cname='.$course_name.'&is_public=1" role="button" class="btn btn-primary" style="float: right; color: white;">发新帖</a>';
            ?>
        </ol>

        <br>
        <?php
        $query3 = "select gid from groupz where course_id = $course_id and id = $sid;";    // 把该学生在该课程下的group id选出来
        $result3 = @mysqli_query($dbc, $query3);
        $row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC);
        if ($row3) { // 如果已经加入小组
            echo '<li>
                <form action="bbs-group.php" method="post">
                <input type="hidden" name="cid" value="'.$course_id.'">
                <input type="hidden" name="cname" value="'.$course_name.'">
                <input type="hidden" name="gid" value="'.$row3['gid'].'">
                <button type="submit" class="btn"> 进入小组讨论区 </button></form></li>';
        } else {    // 如果还没有小组
            echo '<div class="container-gray">
                    <h4>当前未加入小组，请尽快加入！</h4>
                  </div>';
			echo '<a class="btn btn-primary" href="#" style="color: white; id="login" data-toggle="modal" data-target="#myModal1">创建小组</a>';
			echo '<a class="btn btn-primary" href="#" style="color: white; id="login" data-toggle="modal" data-target="#myModal0">加入小组</a>';
        }
        $row3 = mysqli_fetch_array($result3, MYSQLI_ASSOC);
        ?>
		<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabe2">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                        <div class="modal-header btn-info">
                            <span class="heading modal-title" id="myModalLabe2">创建小组</span>
                        </div>
                        <div class="modal-body">
									<?php
										require_once('../php/mysqli_connect.php');
										echo '<form method="post"><input type="hidden" name="cid" value="'.$course_id.'"></form>';
										if (isset($_POST['cid']))
											$course_id = $_POST['cid'];
										else
											$course_id = $_GET['cid'];
                                        if(isset($_POST['submit'])){//判断用户是否提交表单，如果是则执行如下代码
                                            $invitation = $_POST['invi'];
											$gid = $_POST['id'];
                                            $query = "SELECT * FROM groupz_code WHERE gid = '$gid'";
                                            $result = @mysqli_query($dbc, $query);
                                            if($result){
                                                if(mysqli_num_rows($result)>0){
                                                    echo "<script>alert('小组ID已存在，创建失败！');location.href='bbs.php';</script>";
                                                }
                                                else{
													$query = "SELECT * FROM groupz_code WHERE invitation = $invitation";
													$result = @mysqli_query($dbc, $query);
													if(mysqli_num_rows($result)>0){
														echo "<script>alert('邀请码已存在，创建失败！');location.href='bbs.php';</script>";
													}
													else{
														
														$query1 = "insert into groupz_code(gid, invitation) values ($gid, $invitation);";
														$query2 = "insert into groupz(course_id, id, gid) values ($course_id, $sid, $gid);";
														$result1 = @mysqli_query($dbc, $query1);
														$result2 = @mysqli_query($dbc, $query2);
														if($result1 && $result2){
															echo "<script>alert('创建并加入小组成功！');location.href='bbs.php';</script>";
														}
													}
												}
											}
										}											
                                    ?>
                            <div class="form-group">
                                <input class="form-control" name="id" id="inputid" placeholder="小组ID">
                                <i class="fa fa-user"></i>
							</div>
							<div class="form-group">
                                <input class="form-control" name="invi" id="inputinvi" placeholder="6位邀请码">
                                <i class="fa fa-user"></i>
								</div>
                            <div class="form-group">
                                <button id="userLogin" type="submit" name="submit" class="btn-form-temp btn-info">确认</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
		<div class="modal fade" id="myModal0" tabindex="-1" role="dialog" aria-labelledby="myModalLabe2">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                        <div class="modal-header btn-info">
                            <span class="heading modal-title" id="myModalLabe2">加入小组</span>
                        </div>
                        <div class="modal-body">
									<?php
										require_once('../php/mysqli_connect.php');
										echo '<form method="post"><input type="hidden" name="cid" value="'.$course_id.'"></form>';
										if (isset($_POST['cid']))
											$course_id = $_POST['cid'];
										else
											$course_id = $_GET['cid'];
                                        if(isset($_POST['submit2'])){//判断用户是否提交表单，如果是则执行如下代码
                                            $invitation = $_POST['invi2'];
                                            $query = "SELECT gid FROM groupz_code WHERE invitation = $invitation;";
                                            $result = @mysqli_query($dbc, $query);
                                            if($result){
                                                if(mysqli_num_rows($result)>0){
													$query2 = "insert into groupz(course_id, gid, id) values ($course_id, $invitation, $sid);";
													$query3 = "update groupz set groupz.gid = (select gid from groupz_code where $invitation = groupz_code.invitation)";
													$result2 = @mysqli_query($dbc, $query2);
													$result3 = @mysqli_query($dbc, $query3);
													if(result2 && result3){
														echo "<script>alert('加入小组成功！');location.href='bbs.php';</script>";
													}
                                                }
                                                else{
													echo "<script>alert('邀请码无效，加入小组失败！');location.href='bbs.php';</script>";
												}
											}
										}									
                                    ?>
							<div class="form-group">
                                <input class="form-control" name="invi2" id="inputinvi2" placeholder="6位邀请码">
                                <i class="fa fa-user"></i>
							</div>
                            <div class="form-group">
                                <button id="userLogin" type="submit2" name="submit2" class="btn-form-temp btn-info">确认</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
		</br>
		<br>
        <?php
        echo '<a href="bbs.php" role="button" class="btn btn-primary" style="color: white;">返回</a>';
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
                    // $query2 = "select id, owner, title, post_date from posts where owner in (select name from groupz where gid=1)  order by id desc";
                    // 这里显示的是当前课程下的所有帖子
                    $query2 = "select id, owner, title, post_date from posts where course_id  = $course_id and is_public = 1;";
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
                    } else {
                        echo "no";
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
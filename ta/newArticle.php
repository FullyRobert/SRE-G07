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
    else if($_COOKIE['user_type']=='1'){
        $home_url = '../teacher/index.php';
        header('Location: '.$home_url);
    }
}
else{
    $home_url = '../index.php';
    header('Location: '.$home_url);
}
require_once ("../include/article_teacher_header.html")
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
								<h3>文章标题：</h3>
								<!-- <div class="input-group"> -->
								<input type="text" name="title" class="form-control">
								<!-- </div> -->
								<h3>正文：</h3>
								<textarea id="TextArea1" name="content" cols="20" rows="200" class="ckeditor"></textarea>
								<button class="btn btn-success" type="submit" name="submit" id="issueArticle">发布文章</button>
							</div>
						</div>
					</form>
                    <?php
                        require_once('../php/mysqli_connect.php');
                        require_once ('../php/global.php');
                        if(isset($_POST['submit']))
                        {
                            //获取用户的输入
                            $title = mysqli_real_escape_string($dbc, trim($_POST['title']).'，发布者：'.$_COOKIE['user_name']);
                            $html = mysqli_real_escape_string($dbc, trim($_POST['content']));
                            $content = substr(trimall(strip_tags($html)),0,128);
                            $q = "insert into article(title,html,content,article_date) values('$title','$html','$content',now())";
                            //执行sql语句，同样需要在前头加上 @ 符号
                            $r = @mysqli_query($dbc, $q);
                            if($r){
                                echo    '<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog"><div class="modal-content"><div class="modal-body btn-success">
                                            添加文章成功！</div></div></div>
                                     </div>
                                     <script>$(function () { $(\'#myModal3\').modal({ keyboard: true})});</script>';
                            }
                            else{
                                echo    '<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                        <div class="modal-dialog"><div class="modal-content"><div class="modal-body btn-danger">
                                            添加文章失败！<br />'.mysqli_error($dbc).'</div></div></div>
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
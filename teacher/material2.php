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
require_once('../php/mysqli_connect.php');
?>
<?php
                        echo '<p id="course_id" style="display:none">'.$_POST['cid'].'</p>';
                        echo '<p id="course_name" style="display:none">'.$_POST['cname'].'</p>';
                ?>
<div class="materialPane">
    <div class="timeline-post videoArea">
        <h2>课程视频资源</h2>
        <div class="form-inline">
            <div class="form-group">
                <?php
                if(isset($_GET['video_index']))
                {
                    $vid = $_GET['video_index'];
                    $query = "SELECT path from video where vid=$vid and valid=true";
                    $result = @mysqli_query($dbc, $query);
                    if ($result) {
                        $row = @mysqli_fetch_array($result, MYSQLI_NUM);
//                        echo var_dump($row);
                        if(mysqli_num_rows($result)>0){
                            $path=$row[0];
                            if(strpos($path,"/video/re/")!=false)
                                $img_path = "../images/img_re.jpg";
                            else
                                $img_path = "../images/img_sem.jpg";
                            echo '<video width="700" height="500" controls poster="'.$img_path.'">
                                    <source src="'.$path.'" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>';
                        }
                    }
                }
                else{
                    $query = "SELECT path from video where path like '/video/re/' and valid=true";
                    $result = @mysqli_query($dbc, $query);
                    if ($result) {
                        $row = @mysqli_fetch_array($result, MYSQLI_NUM);
                        if(mysqli_num_rows($result)>0){
                            echo '<video width="800" height="500" controls poster="../images/img_re.jpg">
                                    <source src="'.$path.'" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>';
                        }
                    }
                    else{
                        $query = "SELECT path from video where path like '/video/sem/' and valid=true";
                        $result = @mysqli_query($dbc, $query);
                        if ($result) {
                            $row = @mysqli_fetch_array($result, MYSQLI_NUM);
                            if(mysqli_num_rows($result)>0){
                                echo '<video width="800" height="500" controls poster="../images/img_sem.jpg">
                                    <source src="'.$path.'" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>';
                            }
                        }
                    }
                }
                ?>

            </div>
        </div>
        <br />
        <div style="clear: both; position: relative;">
            <span class="h3">上传视频</span>
            <div class="form-box">

                <div class="form-group">

                    <p id="cname"></p>
                </div>
<!--                <br />-->
<!--                <br />-->
                <div class="form-group">
                    <input id="uploadVideo" name="video" type="file" class="file" multiple>
                </div>
            </div>
        </div>
    </div>
    <div class="timeline-post fileArea">
        <h2>课程资源</h2>
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
                            $tmp=$_POST['cid'];
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
                                            <td><a style="color: white" href="../php/download_material.php?cid='.$_POST['cid'].'&cata=file&file='.$name.'" class="btn btn-success unwork_a">下载</a>
                                                <a style="color: white" href="../php/delete_material.php?cid='.$_POST['cid'].'&cata=file&file='.$name.'" class="btn btn-danger unwork_a">删除</a>
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
                                            <td><a style="color: white" href="../php/download_material.php?cid='.$_POST['cid'].'&cata=video&file='.$name.'" class="btn btn-success unwork_a">下载</a>
                                                <a style="color: white" href="../php/delete_material.php?cid='.$_POST['cid'].'&cata=video&file='.$name.'" class="btn btn-danger unwork_a">删除</a>
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
            <div class="panel panel-info" data-toggle="collapse" data-parent="#fileList"
                 href="#managementVideo">
                
                <div id="managementVideo" class="panel-collapse collapse">
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
                            $query="SELECT name,upload_time,size,path FROM file WHERE path like '%/file' and valid=true";
                            $result = @mysqli_query($dbc, $query);
                            //                            echo $query;
                            if($result){
                                while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))//从结果集$r得到关联数组
                                {
                                    $name=$row['name'];
                                    $time=$row["upload_time"];
                                    $size=$row["size"];
                                    $path=$row["path"];
//                                    $filename=str_replace("../material/file/sem/","",$path);
                                    echo '<tr>
                                            <td>'.$name.'</td>
                                            <td>'.$time.'</td>
                                            <td>'.$size.'kb</td>
                                            <td><a style="color: white" href="../php/download_material.php?cata=sem&file='.$name.'" class="btn btn-success unwork_a">下载</a>
                                                <a style="color: white" href="../php/delete_material.php?cata=sem&file='.$name.'" class="btn btn-danger unwork_a">删除</a>
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
        <h3>上传课程资料</h3>
        <div class="form-box">
            <form method="post" class="form-group">
            
<!--            <br />-->
<!--            <br />-->

<!--                <input type="hidden" name="test" value="aaa" />-->
                <input id="uploadFile" name="file" type="file" class="file">
            </form>
        </div>
    </div>
</div>
<script>
    var course_id=document.getElementById("course_id").innerHTML;
    $(".unwork_a").click(function(){
        window.location.href= this.href;
    });
    $(".btn_download").click(function(){
//        alert(this.attr('href'));
        window.location.href= this.href;
    });
    $("#uploadFile").fileinput({
        language: "zh",
        maxFileSize: 1024*1024,
        dataType: 'json',
        uploadAsync: false, //设置上传同步异步 此为同步
        uploadUrl: "../php/file_upload.php",
        uploadExtraData:{
            course: course_id        //上传时要传输的其他参数
        }
    });
    $("#uploadVideo").fileinput({
        language: "zh",
        uploadUrl: "../php/video_upload.php",
        allowedFileExtensions: ['mp4'],
        dataType: 'json',
        uploadAsync: false, //设置上传同步异步 此为同步
        maxFileSize: 1024*1024,
        uploadExtraData:{
            course:course_id        //上传时要传输的其他参数
        }
    });
</script>
<div style="height: 50px;"></div>
<?php
require_once("../include/footer_teacher.html");
?>





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
require_once("../include/material_student_header.html");
require_once('../php/mysqli_connect.php');
?>
<?php
                        echo '<p id="course_id" style="display:none">'.$_POST['cid'].'</p>';
                        echo '<p id="course_name" style="display:none">'.$_POST['cname'].'</p>';
                ?>
<div class="materialPane">
    <div class="timeline-post videoArea" style="height: 600px">
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
    </div>
    </div>
</div>
<script>
$(".unwork_a").click(function(){
        window.location.href= this.href;
    });
    $(".btn_download").click(function(){
//        alert(this.attr('href'));
        window.location.href= this.href;
    });
    </script>
<?php
require_once("../include/footer_student.html");
?>

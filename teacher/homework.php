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
//require_once("../include/material_teacher_header.html");
require_once("../include/homework_teacher.html");
require_once("../include/homework_teacher_header.html");
?>
<style type="text/css">
    .container-gray{
        background: #F0F0F0;
        padding-top:12px;
        padding-bottom:12px;
        padding-left: 12px;
        padding-right: 12px;
        border:1px solid #ccc;
    }
    .container-white{
        padding-top: 12px;
        padding-bottom: 12px;
        border:1px solid #ccc;
    }
    .tr_odd
    {
        background-color: #EBF2FE;
    }
    .tr_even
    {
        background: #B4CDE6;
    }
    .input_control{
        width:360px;
        margin:20px auto;
    }
    input[type="text"],#btn1,#btn2{
        box-sizing: border-box;
        text-align:center;
        font-size:1.4em;
        height:2.7em;
        border-radius:4px;
        border:1px solid #c8cccf;
        color:#6a6f77;
        -web-kit-appearance:none;
        -moz-appearance: none;
        display:block;
        outline:0;
        padding:0 1em;
        text-decoration:none;
        width:50%;
    }
    input[type="text"]:focus{
        border:1px solid #ff7496;
    }
    input[type="date"],#btn1,#btn2{
        box-sizing: border-box;
        text-align:center;
        font-size:1.4em;
        height:2.7em;
        border-radius:4px;
        border:1px solid #c8cccf;
        color:#6a6f77;
        -web-kit-appearance:none;
        -moz-appearance: none;
        display:block;
        outline:0;
        padding:0 1em;
        text-decoration:none;
        width:20%;
    }
    input[type="date"]:focus{
        border:1px solid #ff7496;
    }
    .uploadButton{
        text-decoration:none;  
        background:#d2e4fc;  
        padding: 10px 30px 10px 30px;  
        font-size:16px;  
        font-family: 微软雅黑,宋体,Arial,Helvetica,Verdana,sans-serif;  
         font-weight:bold;  
        border-radius:3px; 
        margin-left: 5px;
        margin-bottom: 5px;
        margin-top: 12px;
    }
</style>

<div>


    <div class="work-list container container-white">
        <div class="dropdown">
            <button type="button" class="btn dropdown-toggle" id="dropdownMenu2" data-toggle="dropdown">
                所有课程<span class="caret"></span>
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
                        <form action="course-homework.php" method="post">
                        <input type="hidden" name="cid" value="'.$row4['course_id'].'">
                        <input type="hidden" name="cname" value="'.$row4['course_name'].'">
                        <button type="submit" class="btn"> '.$row4['course_name'].' </button></form></li>';
                    }
                }
                ?>
            </ul>
        </div>
        <div class="row-fluid container-gray">
            <div class="span12">
                <table class="table table-hover" id="homeworkTable">
                    <thead>
                    <tr>
                        <th>
                            序号
                        </th>
                        <th>
                            作业名称
                        </th>
                        <th>
                            截止时间
                        </th>
                        <th>
                            上交人数
                        </th>
                        <th>
                            全部人数
                        </th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
            

    </div>

    <script type="text/javascript">
    var tableContent=document.createElement('tbody');
                tableContent.setAttribute('class','homeworkTableBody');

                
                    tableContent.setAttribute('class','tr_even');
                
                tableContent.setAttribute('id','homeworkTableBody0');
                homeworkTable=document.getElementById('homeworkTable');
                homeworkTable.appendChild(tableContent);

                var text='<tr><td>'+'-'+'</td><td><a id="viewHwCount'+'-'+'">'+'-'+'</a></td><td><font color=red>'+'-'+'</font></td><td><font color=red>'+'-'+'</font></td><td>'+'-';
                tableContent.innerHTML+=text;</script>
    <!-- <script>
        
        $("#appendFile").fileinput({
        language: "zh",
        maxFileSize: 1024*1024*10,
        dataType: 'json',
        
        uploadAsync: true, //设置上传同步异步 此为同步
        uploadUrl: "../php/file_upload.php",
        uploadExtraData:{
            course: "软件需求工程"       //上传时要传输的其他参数
        }
    });
        </script> -->
        

</div>
<div style="height: 50px;"></div>
<?php
require_once("../include/footer_teacher.html");    

?>

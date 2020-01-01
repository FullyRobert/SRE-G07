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
//require_once("../include/material_teacher_header.html");
require_once("../include/homework_teacher.html");
require_once("../include/homework_ta_header.html");
require_once('../php/mysqli_connect.php');
require_once ('check-right.php');
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
            <?php
            $course_name=$_POST['cname'];
            echo '<button type="button" class="btn dropdown-toggle" id="dropdownMenu1" data-toggle="dropdown">
            '.$course_name.'课程<span class="caret"></span>
            </button>';
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
            <div class="container-gray">
                <h3>发布作业</h3>
                <button class=" uploadButton" id="uploadAppend" onclick="uploadAppend()">上传附件</button>
                  <!-- <a tabindex="500" title="上传选中文件" id="uploadAppend" onclick="uploadAppend()" class="btn btn-default btn-secondary fileinput-upload fileinput-upload-button" href="../php/file_upload.php"><i class="glyphicon glyphicon-upload"></i>  <span class="hidden-xs">上传附件</span></a> -->
                <form method="post" action="" enctype="multipart/form-data">
                        <p>上传附件</p>
                        <!-- <button class="uploadButton" id="uploadAppending" onclick="uploadAppend()">上传附件</button> -->
                        <p>&nbsp;作业名称<br />
                            <input  type="text" id="homeworkname" name="hw_name"/><br />
                            &nbsp;作业要求<br />
                            <input  type="text" name="summary"/><br />
                            &nbsp;截止日期<br />
                            <input  type="date" name="deadline"/></p>
                            <input type="file" onchange="uploadUpdate()" name="file" id="appendFile" style="display:none">
                            <p id="path" style="display:none">123 </p>
                        <button class="uploadButton" style="width:130px; height:60px" type="submit" onclick="win_reload()" >确认发布</button>
                        <?php
                        echo '<li style="display:none">
                        <form  style="display:none" method="post">
                        <input type="hidden" name="cid" value="'.$_POST['cid'].'">
                        <input type="hidden" name="cname" value="'.$_POST['cname'].'">
                        </form></li>
                        <p id="cid" style="display:none">'.$_POST['cid'].'</p>';
                ?>
                </form>
            </div>

    </div>

    <script type="text/javascript">
    
    var jarray;
    var studentNum;
    var cid=document.getElementById("cid").innerHTML;
        $.ajax ({
            url: "./jarray.php",
            type:"POST",
            data:{
                $course_id:cid
            },
            async:false,
            dataType:"json",
            success: function( result ) {
                //console.log(result);
                console.log(result);
                jarray=result["$jarray"];
                jarray=JSON.parse(jarray);
                studentNum=result['$studentNum'];
                studentNum=studentNum;
        }
});   

        var hw_id=new Array();
        var hwName=new Array();
        var deadline=new Array();
        var summary;
        var handinNum=new Array();
        

        for(var count in jarray)
        {
            
            hw_id.push(jarray[count].hw_id);
            hwName.push(jarray[count].hw_name);
            deadline.push(jarray[count].deadline);
            handinNum.push(jarray[count].count);
        }

        function setHwTable(){
            for(var count in hwName)
            {
                var tableContent=document.createElement('tbody');
                tableContent.setAttribute('class','homeworkTableBody');

                if(count%2==0)
                    tableContent.setAttribute('class','tr_even');
                else
                    tableContent.setAttribute('class','tr_odd');
                tableContent.setAttribute('id','homeworkTableBody'+count);
                homeworkTable=document.getElementById('homeworkTable');
                homeworkTable.appendChild(tableContent);

                var text='<tr><td>'+count+'</td><td><a id="viewHwCount'+count+'">'+hwName[count]+'</a></td><td><font color=red>'+deadline[count]+'</font></td><td><font color=red>'+handinNum[count]+'</font></td><td>'+studentNum;
                tableContent.innerHTML+=text;
            }
        }
        setHwTable();

       
        function setHwHref(){
            for(var count in hw_id)
            {
                var thisId='viewHwCount'+count;
                var thisHw=document.getElementById(thisId);

                var thisUrl="./homework_detail.php?cid="+cid+"&hw_id="+hw_id[count];
                thisHw.setAttribute('href',thisUrl);
            }
        }
        setHwHref();

        function uploadAppend(){
            document.getElementById("appendFile").click(); 
        }
        function uploadUpdate(){
            filename = document.getElementById('appendFile').files[0].name;
            document.getElementById('uploadAppend').innerHTML=filename;
        }
//         function uploadFile(){
//             filename = document.getElementById('appendFile').files[0].name;
//             homeworkname= document.getElementById('homeworkname').value;   
//             document.getElementById('path').innerHTML=filename;
//             $.ajax ({
//             url: "./uploadhomework.php",
//             type:"POST",
//             data:{
//                 $hwname:homeworkname,
//                 $filename:filename,
//             },
//             async:false,
//             dataType:"json",
//             success: function( result ) {
//         }
// });   
//         }
//         function uploadFile() {
//             hw_name=document.getElementsByName("hw_name");
//             summary
//         // 以及一些其它要传入的参数
//         // formData.append(key, value);
//         $.ajax({
//             url: "./uploadhomework.php",
//             type: 'POST',
//             data:{
//                 'hw_name':
//                 $_POST["hw_name"])&&isset($_POST["summary"])&&isset($_POST["deadline"]))
// {
//     $filename=$_POST["filename"];
//             },
//             dataType:'json',
//             processData: false,// ⑧告诉jQuery不要去处理发送的数据
//             contentType: false, // ⑨告诉jQuery不要去设置Content-Type请求头
//             success: function (res) {
//                 console.log(res)
//             }
//         });
//     }
    
    // $("#uploadFile").fileinput({
    //     language: "zh",
    //     maxFileSize: 1024*1024,
    //     dataType: 'json',
    //     uploadAsync: false, //设置上传同步异步 此为同步
    //     uploadUrl: "../php/file_upload.php",
    //     uploadExtraData:{
    //         course: "test"       //上传时要传输的其他参数
    //     }
    // });

    </script>
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

if(isset($_POST["hw_name"])&&isset($_POST["summary"])&&isset($_POST["deadline"]))
{
    
    $path=$_FILES["file"]["name"];
    require_once('../php/randID.php');

    if (!check_right($_POST[cid], "post_hw", $dbc)) {
        echo "<script>alert('没有该权限！');location.href='homework.php';</script>";
    }

    $sql="INSERT INTO homework (hw_id,hw_name,path,summary,deadline,course_id,taid) VALUES ('$resultNum','$_POST[hw_name]','$path','$_POST[summary]','$_POST[deadline]','$_POST[cid]','".$tid."');";
    $result=@mysqli_query($dbc,$sql);
            $hw_dir="../homework/" . $_FILES["file"]["name"];

            move_uploaded_file($_FILES["file"]["tmp_name"], $hw_dir);

            $sql="UPDATE homework set hasAppend=1, appendIndex='".$hw_dir."' where hw_id='".$resultNum."' ;";

            $result=@mysqli_query($dbc,$sql);

        

    mysqli_close($dbc); 

}

?>

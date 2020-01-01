
<!-- jQuery -->
<script src="../js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="../js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="../js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="../js/jquery.waypoints.min.js"></script>
	<!-- Stellar Parallax -->
	<script src="../js/jquery.stellar.min.js"></script>
	<!-- Carousel -->
	<script src="../js/owl.carousel.min.js"></script>
	<!-- Flexslider -->
	<script src="../js/jquery.flexslider-min.js"></script>
	<!-- countTo -->
	<script src="../js/jquery.countTo.js"></script>
	<!-- Magnific Popup -->
	<script src="../js/jquery.magnific-popup.min.js"></script>
	<script src="../js/magnific-popup-options.js"></script>
	<!-- Count Down -->
	<script src="../js/simplyCountdown.js"></script>
	<!-- Main -->
	<script src="../js/main.js"></script>
  
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

$course_id=$_GET['cid'];
$tid=$_COOKIE['user_id'];
// $hw_id=$_GET['hw_id'];
$hw_id = $_GET['hw_id'];
require_once("../include/homework_teacher_header.html");
require_once('../php/mysqli_connect.php');


// $query1="select hw_name,deadline,summary from homework where hw_id=".$hw_id.";";
// $queryresult1=mysqli_query($dbc, $query1);
// $array1 = array();
// if ($queryresult1) {
//     $row = mysqli_fetch_array($queryresult1, MYSQLI_ASSOC);
//         array_push($array1,$row);
// } 
// else {
//     echo "no result";
// }
// $jarray1=json_encode($array1);

// $query2="select count(sid) from course where course_id=".$course_id.";";
// $queryresult2 = @mysqli_query($dbc, $query2);
// if ($queryresult2)
//     $row = mysqli_fetch_array($queryresult2, MYSQLI_ASSOC);
// $studentNum=$row['count(sid)'];

// $query3="select count(sid) from student_homework where hw_id=".$hw_id.";";
// $queryresult3 = @mysqli_query($dbc, $query3);
// if ($queryresult3)
//     $row = mysqli_fetch_array($queryresult3, MYSQLI_ASSOC);
// $handinNum=$row['count(sid)'];

// $array=array();
// $query4="select B.sid,B.sname,A.handintime,A.hw_Index,A.grade,A.comment from student_homework as A join student as B on A.sid=B.sid where A.hw_id=".$hw_id.";";
// $queryresult4 = @mysqli_query($dbc, $query4);
// if ($queryresult4)
//     while($row = mysqli_fetch_array($queryresult4, MYSQLI_ASSOC))
//     {
//         array_push($array,$row);
//     }
// else {
//     echo "no result";
// }
// if ($queryresult4)
//     mysqli_free_result($queryresult4);
// $jarray=json_encode($array);

?>
    <div class="teacherViewHomework container container-white">
        <div class="container-gray">
            <h3>查看作业</h3>
            <div class="container-gray" id="homeworkContent">

            </div>
        </div>
  
        <table class="table table-hover" id="homeworkTable">
        <?php
                        echo '<p id="cid" style="display:none">'.$_GET['cid'].'</p>';
                        echo '<p id="hw_id" style="display:none">'.$_GET['hw_id'].'</p>';
                ?>
            <thead>
            <tr>
                <th>
                    序号
                </th>
                <th>
                    学号
                </th>
                <th>
                    姓名
                </th>
                <th>
                    上交时间
                </th>
                <th>
                    下载
                </th>
                <th>
                    点评
                </th>
                <th>
                    分数
                </th>
            </tr>
            </thead>
        </table>
    </div>

    <style type="text/css">
        .tr_odd
        {
            background-color: #EBF2FE;
        }
        .tr_even
        {
            background: #B4CDE6;
        }
        .downloadButton{
            text-decoration:none;
            background:#2f435e;
            color:#f2f2f2;
            padding: 10px 30px 10px 30px;
            font-size:16px;
            font-family: 微软雅黑,宋体,Arial,Helvetica,Verdana,sans-serif;
            font-weight:bold;
            border-radius:3px;
            float:right;
            margin-top: 12px;
        }

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
    </style>
    <script type="text/javascript">
    var jarray1;
    var jarray;
    var studentNum;
    var handinNum;
    var hw_id;
    var cid=document.getElementById("cid").innerHTML;
    var hw_id=document.getElementById("hw_id").innerHTML;
    $.ajax({
            url: "./get_homework.php",
            type: "POST",
            data: {
                $cid:cid,
                $hw_id:hw_id
            },
            async: false,
            dataType: "json",
            success: function(result) {
                
                jarray1 = result["$jarray1"];
                jarray1 = JSON.parse(jarray1);
                jarray = result["$jarray"];
                jarray = JSON.parse(jarray);
                studentNum=result["$studentNum"];
                handinNum=result["$handinNum"];
                hw_id=result["$hw_id"];
                
            },

        });
        
        var hw_name=jarray1[0].hw_name;
        var summary=jarray1[0].summary;
        var deadline=jarray1[0].deadline;
        
        //作业内容
        function setHomeworkContent(){
            var content=document.getElementById("homeworkContent");
            var innerH5_1=document.createElement('h5');
            innerH5_1.innerHTML=hw_name+" : "+summary;
            content.appendChild(innerH5_1);

            var innerFont_1=document.createElement('font');
            innerFont_1.innerHTML="DDL: "+deadline;
            innerFont_1.setAttribute('color','red');
            content.appendChild(innerFont_1);

            var innerH5_2=document.createElement('h5');
            innerH5_2.innerHTML="全部人数："+studentNum;
            content.appendChild(innerH5_2);

            var innerFont_2=document.createElement('font');
            innerFont_2.innerHTML="已提交人数："+handinNum;
            innerFont_2.setAttribute('color','red');
            content.appendChild(innerFont_2);
        }
        setHomeworkContent();

        
        var studentId=new Array();
        var studentName=new Array();
        var handinTime=new Array();
        var studentGrade=new Array();
        var hwIndex=new Array();

        for(var count in jarray)
        {
            studentId.push(jarray[count].sid);
            studentName.push(jarray[count].sname);
            handinTime.push(jarray[count].handintime);
            studentGrade.push(jarray[count].grade);
            hwIndex.push(jarray[count].hw_Index);
        }

        var downloadHomework,homeworkTable;
        homeworkTable=document.getElementById('homeworkTable');
        

        //所有作业列表
        
        function setHomeworkViewTable(){
            for(var count in studentId)
            {
                var url;
            $.ajax ({
            url: "./download_homework.php",
            type:"POST",
            data:{
                $hw_id:hw_id,
                $sid:studentId[count]
            },
            async:false,
            
            success: function( result ) {
                
            url=result;
        }
});   
                var tableContent=document.createElement('tbody');
                tableContent.setAttribute('class','homeworkTableBody');

                if(count%2==0)
                    tableContent.setAttribute('class','tr_even');
                else
                    tableContent.setAttribute('class','tr_odd');
                tableContent.setAttribute('id','homeworkTableBody'+count);
                homeworkTable.appendChild(tableContent);

//                var text='<tr><td>'+count+'</td><td>'+studentId[count]+'</td><td>'+studentName[count]+'</td><td>'+studentState[count]+'</td>'+'<td><lable><input type="checkbox" class="homeworkCheckbox" name="homeworkCheckbox" id="homeworkCheckbox'+count+'">'+'</lable></td>'+'<td><a href="">点评</td>'+'<td>'+studentGrade[count]+'</td>'+'</tr>';
                var text='<tr><td>'+count+'</td><td>'+studentId[count]+'</td><td>'+studentName[count]+'</td><td>'+handinTime[count]+'</td>'+'<td><a class="btn btn-success unwork_a style=" style="color: white" '+url+' ">Download</td>'+'<td><a id="CommentHref'+count+'">点评</td>'+'<td>'+studentGrade[count]+'</td>'+'</tr>';
                console.log("url+"+text);
                tableContent.innerHTML+=text;
            }
        }
        setHomeworkViewTable();

        //全选功能
        $(function(){$("#chooseAll").click(function(){
            var xz = $(this).prop("checked");
            var ck = $(".homeworkCheckbox").prop("checked",xz);
        })
        })

        //下载作业
        function downloadHomework(){
            var object=document.getElementsByName('homeworkCheckbox');
            for(var i=0;i<object.length;i++)
            {
                if(object[i].checked)
                {
                    //alert("download from path: "+hwIndex[i]);
                    var downloadHref=document.createElement('a');
                    downloadHref.setAttribute('href',hwIndex[i]);
                    downloadHref.setAttribute('download','');
                    object[i].appendChild(downloadHref);
                    downloadHref.click();
                }
            }
        }

        function setCommentHref(){
            for(var count in studentId)
            {
                var thisId='CommentHref'+count;
                var thisHw=document.getElementById(thisId);

                var thisUrl="./homework_mark.php?hw_id="+hw_id+"&sid="+studentId[count];
                thisHw.setAttribute('href',thisUrl);
            }
        }
        setCommentHref();

    </script>

<div style="height: 50px;"></div>
<?php
require_once("../include/footer_teacher.html");
?>

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
if (isset($_COOKIE['user_type'])) {
    if ($_COOKIE['user_type'] == '0') {
        $home_url = '../php/logout.php';
        header('Location: ' . $home_url);
    } elseif ($_COOKIE['user_type'] == '1') {
        $home_url = '../teacher/index.php';
        header('Location: ' . $home_url);
    } else if ($_COOKIE['user_type'] == '3') {
        $home_url = './ta/index.php';
        header('Location: ' . $home_url);
    }
} else {
    $home_url = '../index.php';
    header('Location: ' . $home_url);
}
require_once("../include/homework_student_header.html");
?>
<link type="text/css" rel="stylesheet" href="../css/fileinput.css" />
    <script type="text/javascript" src="../js/fileinput.js"></script>
<style type="text/css">
    .container-gray {
        background: #F0F0F0;
        padding-top: 12px;
        padding-bottom: 12px;
        padding-left: 12px;
        padding-right: 12px;
        /*border:1px solid #ccc;*/
    }

    .container-white {
        padding-top: 12px;
        padding-bottom: 12px;
        border: 1px solid #ccc;
    }

    .tr_odd {
        background-color: #EBF2FE;
    }

    .tr_even {
        background: #B4CDE6;
    }

    .input_control {
        width: 360px;
        margin: 20px auto;
    }

    input[type="text"],
    #btn1,
    #btn2 {
        box-sizing: border-box;
        text-align: center;
        font-size: 1.4em;
        height: 2.7em;
        border-radius: 4px;
        border: 1px solid #c8cccf;
        color: #6a6f77;
        -web-kit-appearance: none;
        -moz-appearance: none;
        display: block;
        outline: 0;
        padding: 0 1em;
        text-decoration: none;
        width: 50%;
    }

    input[type="text"]:focus {
        border: 1px solid #ff7496;
    }

    input[type="date"],
    #btn1,
    #btn2 {
        box-sizing: border-box;
        text-align: center;
        font-size: 1.4em;
        height: 2.7em;
        border-radius: 4px;
        border: 1px solid #c8cccf;
        color: #6a6f77;
        -web-kit-appearance: none;
        -moz-appearance: none;
        display: block;
        outline: 0;
        padding: 0 1em;
        text-decoration: none;
        width: 20%;
    }

    input[type="date"]:focus {
        border: 1px solid #ff7496;
    }
</style>

<div>
    <div class="work-list container container-white">
    <p>加入课程 </p>
        <div><p  style="float:left;height:30px;float:left" >课程邀请码:&nbsp;&nbsp;</p><form method="post"><input  style="float:left;width:100px; height:30px" method="post" type="text" id="coursecode" name="coursecode"></form>
        <button class="btn" style="height:30px;width:50px;position:relative;left:20px" onclick="reflush()" type="button" >
                加入
            </button>

    </div>
        <br></br>
        <div class="dropdown">
    <button  type="button" class="btn dropdown-toggle" id="dropdownMenu2" data-toggle="dropdown">
                所有课程<span class="caret"></span>
            </button>

            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu2">
                <?php
                require_once('../php/mysqli_connect.php');
                $tid = $_COOKIE['user_id']; // 当前教师的id
                
                $query4 = "select course_id from course where sid = $tid;";  // 获取当前教师的所有课程
                
                $result4 = @mysqli_query($dbc, $query4);
                if($result4){
                    
                    while ($row4 = mysqli_fetch_array($result4, MYSQLI_ASSOC)) {
                        $query5='select course_name from course_basic where course_id = '.$row4['course_id'].';';  // 获取当前教师的所有课程
                    $result5 = @mysqli_query($dbc, $query5);
                    $row5 = mysqli_fetch_array($result5, MYSQLI_ASSOC);
                    
                        echo '<li>
                        <form action="./course_homework.php" method="post">
                        <input type="hidden" name="cid" value="'.$row4['course_id'].'">
                        <input type="hidden" name="cname" value="'.$row5['course_name'].'">
                        <button type="submit" class="btn"> '.$row5['course_name'].' </button></form></li>';
                    }
                }
                ?>
            </ul>
        </div>
        <div class="row-fluid">
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
                            <th>
                                下载要求
                            </th>
                            <th>
                                成绩
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
    function reflush(){
        
        var code=document.getElementById("coursecode").value;
        console.log(code)
        $.ajax ({
            url: "./join_course.php",
            type:"POST",
            data:{
                $coursecode:code
            },
            async:false,
            
            success: function( result ) {
                
        },
});   
        history.go(0);
    }
    
    // function joincourse(){
    //     $.ajax({
    //         url: "./jarray.php",
    //         type: "POST",
    //         data: {
    //             ja: 123,
    //         },
    //         async: false,
    //         dataType: "json",
    //         success: function(result) {
    //             jarray = result["$jarray"];
    //             jarray = JSON.parse(jarray);
    //             studentNum = result['$studentNum'];
    //         },

    //     });

    // }
        
                var tableContent = document.createElement('tbody');
                tableContent.setAttribute('class', 'homeworkTableBody');

                
                tableContent.setAttribute('class', 'tr_odd');
                tableContent.setAttribute('id', 'homeworkTableBody0');
                homeworkTable = document.getElementById('homeworkTable');
                homeworkTable.appendChild(tableContent);

                var text = '<tr><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>';
                tableContent.innerHTML=text;
                </script>
</div>
<div style="height: 50px;"></div>
<?php
require_once("../include/footer_student.html");
require_once("../include/homework_student_header.html");
?>
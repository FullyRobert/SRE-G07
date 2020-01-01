
<!-- jQuery -->
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
        <div class="container-gray">
            <h3>查看所有作业</h3>
            <?php
                        echo '<li style="display:none">
                        <form style="display:none" method="post">
                        <input type="hidden" name="cid" value="'.$_POST['cid'].'">
                        <input type="hidden" name="cname" value="'.$_POST['cname'].'">
                        </form></li>
                        <p id="cid" style="display:none">'.$_POST['cid'].'</p>';
                ?>
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
        var jarray;
        var studentNum;
        var cid=document.getElementById("cid").innerHTML;
        $.ajax({
            url: "./jarray.php",
            type: "POST",
            data: {
                $course_id:cid
            },
            async: false,
            dataType: "json",
            success: function(result) {
                jarray = result["$jarray"];
                jarray = JSON.parse(jarray);
                studentNum = result['$studentNum'];
            },

        });
        console.log(jarray);
        var hw_id = new Array();
        var hwName = new Array();
        var deadline = new Array();
        var summary;
        var handinNum = new Array();

        for (var count in jarray) {
            hw_id.push(jarray[count].hw_id);
            hwName.push(jarray[count].hw_name);
            deadline.push(jarray[count].deadline);
            handinNum.push(jarray[count].count);
        }

        function setHwTable() {
            for (var count in hwName) {
                var tableContent = document.createElement('tbody');
                tableContent.setAttribute('class', 'homeworkTableBody');

                if (count % 2 == 0)
                    tableContent.setAttribute('class', 'tr_even');
                else
                    tableContent.setAttribute('class', 'tr_odd');
                tableContent.setAttribute('id', 'homeworkTableBody' + count);
                homeworkTable = document.getElementById('homeworkTable');
                homeworkTable.appendChild(tableContent);

                var text = '<tr><td>' + count + '</td><td><a href="" id="viewHwCount' + count + '">' + hwName[count] + '</a></td><td><font color=red>' + deadline[count] + '</font></td><td><font color=red>' + handinNum[count] + '</font></td><td>' + studentNum + '</td>';
                
                $.ajax ({
            url: "./display_hw.php",
            type:"POST",
            data:{
                $hw_name:hwName[count],
                $hw_id:hw_id[count]
            },
            async:false,
            
            success: function( result ) {
                if(result!=0)
            text+=result;
        },
});   
                //text+='<td><p>0</p></td></tr>';
                tableContent.innerHTML=text;
                // tableContent.innerHTML+='<td><a style="color: white"  class="btn btn-success unwork_a style="height: 10px"">Upload</a></td>'
                // console.log(tableContent);
                
            }
        }
        setHwTable();

    //     $("#uploadFile").fileinput({
    //     language: "zh",
    //     maxFileSize: 1024*1024,
    //     dataType: 'json',
    //     uploadAsync: false, //设置上传同步异步 此为同步
    //     uploadUrl: "../php/homework_upload.php",
    //     uploadExtraData:{
    //         course: $("#file_course").val()        //上传时要传输的其他参数
    //     }
    // });

        function setHwHref() {
            for (var count in hw_id) {
                var thisId = 'viewHwCount' + count;
                var thisHw = document.getElementById(thisId);

                var thisUrl = "./dohomework.php?hw_id=" + hw_id[count];
                thisHw.setAttribute('href', thisUrl);
            }
        }
        setHwHref();
    </script>
</div>
<div style="height: 50px;"></div>
<?php
require_once("../include/footer_student.html");

?>
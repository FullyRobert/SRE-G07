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
    else if($_COOKIE['user_type']=='3'){
        $home_url = './ta/index.php';
        header('Location: '.$home_url);
    }
}
else{
    $home_url = '../index.php';
    header('Location: '.$home_url);
}

require_once('../php/mysqli_connect.php');
//print_r($_COOKIE);
?>
<!DOCTYPE HTML>




<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>面向全日制高校的教学平台</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Free HTML5 Website Template by freehtml5.co" />
    <meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />

    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content="" />
    <meta property="og:image" content="" />
    <meta property="og:url" content="" />
    <meta property="og:site_name" content="" />
    <meta property="og:description" content="" />
    <meta name="twitter:title" content="" />
    <meta name="twitter:image" content="" />
    <meta name="twitter:url" content="" />
    <meta name="twitter:card" content="" />

<!--    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">-->
<!--    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400" rel="stylesheet">-->

    <!-- Animate.css -->
    <link rel="stylesheet" href="../css/animate.css">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="../css/icomoon.css">
    <!-- Bootstrap  -->
    <!-- <link rel="stylesheet" href="css/bootstrap-3.3.7-dist/css/bootstrap.css"> -->

    <!-- Magnific Popup -->
    <link rel="stylesheet" href="../css/magnific-popup.css">

    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="../css/owl.carousel.min.css">
    <link rel="stylesheet" href="../css/owl.theme.default.min.css">

    <!-- Flexslider  -->
    <link rel="stylesheet" href="../css/flexslider.css">

    <!-- Pricing -->
    <link rel="stylesheet" href="../css/pricing.css">

    <!-- Theme style  -->
    <link rel="stylesheet" href="../css/style.css">

    <link rel="stylesheet" href="../css/global.css">
    <link rel="stylesheet" href="../css/main.css">
    <link rel="stylesheet" href="../css/bootstrap-3.3.7-dist/css/bootstrap.min.css">
    <script src="../js/jquery.min.js"></script>
<!--    <script src="../js/cookie.js"></script>-->
<!--    <script src="../js/login.js"></script>-->
    <script src="../js/bootstrap.js"></script>
    <script src="../js/modernizr-2.6.2.min.js"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="../js/respond.min.js"></script>
    <![endif]-->

</head>

<body>

<div class="fh5co-loader"></div>

<div id="page">   
    <nav class="fh5co-nav" role="navigation">
        <div class="top-menu">
            <div class="container">
                <div class="row">
                    <div class="col-xs-2">
                        <div id="fh5co-logo" style="width:300px"><a href="index.php"><img src="../images/logo.png"></a></div>
                    </div>
                    <div class="col-xs-10 text-right menu-1">
                        <ul>
                            <li><a href="index.php">主页</a></li>
                            
                            <li><a href="introduction.php">个人介绍</a></li>
                            <li class="active"><a style="background-color: #5bc0de; color: white; padding: 10px;border-radius: 5px;" href="curriculum.php">课程</a></li>
                            <li><a href="homework.php">作业</a></li>
                            <li><a href="material.php">资料</a></li>
                            <li><a href="bbs.php">论坛</a></li>
                            <li><a href="article.php">文章</a></li>
                            <li><a href="manage.php">公告管理</a></li>
                            <li class="btn btn-warning" style="position: relative; left: 80px" id="modifyPassword" onclick=ModifyPassword()><span> 修改密码</span></li>
                            <li ><span style="position: relative; left: 90px" class="glyphicon glyphicon-user"></span></span></li>
                            <li style="position: relative; left: 92px"> <?php print($_COOKIE['user_name']."  ")?></li>
                            <li class="btn btn-warning" style="position: relative; left: 100px" id="logout" data-toggle="modal" data-target="#myModal2"><span> 注销</span></li>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <aside id="fh5co-hero">
        <div class="flexslider">
            <ul class="slides">
                <li style="background-image: url(../images/img_bg_1.jpg);">
                    <div class="overlay-gradient"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 text-center slider-text">
                                <div class="slider-text-inner">
                                    <h1>面向全日制高校的教学平台</h1>
                                    <h2>辅助教学系统</a></h2>
                                    <p><a class="btn btn-primary btn-lg" href="#">开始学习！</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li style="background-image: url(../images/img_bg_2.jpg);">
                    <div class="overlay-gradient"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 text-center slider-text">
                                <div class="slider-text-inner">
                                    <h1>全日制高校 / 教学资源</h1>
                                    <h2>帮助更多师生</h2>
                                    <p><a class="btn btn-primary btn-lg btn-learn" href="#">开始学习！</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
                <li style="background-image: url(../images/img_bg_3.jpg);">
                    <div class="overlay-gradient"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 text-center slider-text">
                                <div class="slider-text-inner">
                                    <h1>教育的目的不在于知识<br />而是行动</h1>
                                    <h2>更加方便地切合课程</h2>
                                    <p><a class="btn btn-primary btn-lg btn-learn" href="#">开始学习！</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
        <div class="sticky-bar">
            <button id="notice" class="btn btn-warning notice" data-toggle="modal" data-target="#myModal">
                <span class="glyphicon glyphicon-exclamation-sign"></span>
                <br  />公<br />告
            </button>
            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header btn-info">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">公告</h4>
                        </div>
                      
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" data-dismiss="modal">我知道了</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabe2">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form class="form-horizontal" action="../php/logout.php" method="post">
                            <div class="modal-header  btn-warning">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="myModalLabel">注销登录</h4>
                            </div>
                            <div class="modal-body">您确定注销现在的登录吗？</div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                                <button type="submit" name="submit" class="btn btn-warning">确定</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <div class="copyrights">Collect from <a href="http://www.cssmoban.com/" title="网站模板">网站模板</a></div>

    <div id="fh5co-course">

    </div>


    <div class="col-md-12 main-content-timeline">
        <div class="timeline-post" style="background: #99CCFF;">
            <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                <h4 color="#FFFFFF" style="font-size:40px;"><font >课程列表</h4>
                <div type="text" name="content0"  style="width:1000px;font-size:25px;background-size:100% 100%;background:rgba(255,255,255,0.5);border-left:7px solid rgba(255,255,255,0.3);border-right:7px solid rgba(255,255,255,0.3);" >
                    <div class="form-box">
            


                    <?php

                    
                    $tid = $_COOKIE['user_id'];

                    $query = "SELECT * FROM course_basic where tid = '$tid'";



                    $result = @mysqli_query($dbc, $query);

                    //$number = mysqli_num_rows($result);

                    while($row = mysqli_fetch_array($result))
                      {
                      
                      echo "<br /><div style='background:rgba(255,255,255,0.5);'><h3 align='left' style='width:70%;margin:0px auto;'>课程名称：" . $row['course_name'] . "</h3>";
                      echo "<h3 align='left' style='width:70%;margin:0px auto;'>课程介绍：" . $row['introduction'] . "</h3>";
                      echo "<h3 align='left' style='width:70%;margin:0px auto;'>邀请码  ：" . $row['invitation'] . "<br /></h3></div>";

                      
                      }

                    
                    ?>
                </div>

                <a href="homework.php" >

                <button  class="btn btn-success" type="button" style="text-align:center;margin:11px 11px 11px 11;display:block;margin:20px auto">查看作业情况</button></a>
            </form>
        </div>
    </div>



     
        <?php
        mysqli_close($dbc);

    require_once("../include/footer_teacher.html");
    ?>

<form id="form1" style="display:none" vertical-align:bottom>
<style>
.black_overlay {
            display: none;
            position: absolute;
            top: 0%;
            left: 0%;
            width: 100%;
            height: 100%;
            background-color: black;
            z-index: 1001;
            -moz-opacity: 0.8;
            opacity: .80;
            filter: alpha(opacity=88);
        }
#form1 {
            #form1display: none;
            position: absolute;
            top: 150px;
            left: 25%;
            width: 50%;
            height: 300px;
            padding: 20px;
            border: 10px solid orange;
            background-color: white;
            z-index: 1002;
            overflow: auto;
            text-align: center;
        }
input{
                border: 1px solid #ccc;
                padding: 1px 0px;
                height:30px;
                border-radius: 3px;
                padding-left:5px;
                -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
                box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
                -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
                -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
                transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s
            }
        input:focus{
                    border-color: #66afe9;
                    outline: 0;
                    -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6);
                    box-shadow: inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(102,175,233,.6)
            }
#oldpassword{
    
}
#newpassword{
    position: relative;
    top:10px;
    
}
#ModifyPasswordSubmit{
    position: relative;
    top:30px;
    

}
#ModifyPasswordCancel{
    position: relative;
    top:30px;
    left:20px;
    
}
#oldtext{

}
#newtext{
    position:relative;
    top: 10px;
}
#modifytext{
    position: relative;
    bottom:20px;
    
}
    </style>
    <h3 id="modifytext">修改密码</h3>
    <p3 id="oldtext" vertical-align:top;>原密码：</p3><input id="oldpassword" type="text" name="oldpass" /><br />
    <p3 id="newtext" vertical-align:top;>新密码：</p3><input id="newpassword" type="text" name="newpass" /><br />
    <button id="ModifyPasswordSubmit" onclick="Confirm()">确认</button>
    <button id="ModifyPasswordCancel">取消</button>
    </form>
    <div id="fade" class="black_overlay"></div>
   
    <script type="text/javascript">
    function ModifyPassword()
    {
        document.getElementById('form1').style.display='block';
        document.getElementById('fade').style.display='block';
        $(".form1").show;
    };

</script>

<script>
    function Confirm(){
        var oldpa=document.getElementById('oldpassword').value;
        var newpa=document.getElementById('newpassword').value;
        if(oldpa==newpa)
        {
            alert("旧密码和新密码必须不同！");
            window.location="http://localhost:8081/SRE-G07/teacher/index.php";
        }
        var $r;
        $.ajax ({
            url: "./modifypassword.php",
            type:"POST",
            data:{
                $oldpass:oldpa,
                $newpass:newpa
            },
            async:false,
            success: function( result ) {
        if(result==0)
        {
            alert("旧密码输入错误！");
            window.location="http://localhost:8081/SRE-G07/teacher/index.php";
        }
        else{
        alert("修改密码成功！");
        window.location="http://localhost:8081/SRE-G07/teacher/index.php";
        
        }
    }
});   
        
    }
</script>
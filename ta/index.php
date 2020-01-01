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
require_once('../php/mysqli_connect.php');
require_once('./check-right.php');
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
                            <li class="active"><a style="background-color: #5bc0de; color: white; padding: 10px;border-radius: 5px;" href="index.php">主页</a></li>
<!--                            <li><a href="introduction.php">个人介绍</a></li>-->
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
                                    <p><a class="btn btn-primary btn-lg" href="#" id="login" data-toggle="modal" data-target="#myModal1">创建课程</a></p>
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
                                    <p><a class="btn btn-primary btn-lg btn-learn" href="#" id="login" data-toggle="modal" data-target="#myModal1">创建课程</a></p>
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
                                    <p><a class="btn btn-primary btn-lg btn-learn" href="#" id="login" data-toggle="modal" data-target="#myModal1">创建课程</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
		<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabe2">
		
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                        <div class="modal-header btn-info">
                            <span class="heading modal-title" id="myModalLabe2">创建课程</span>
                        </div>
                        <div class="modal-body">
                            <?php
                            if (isset($_POST['submit'])) {//判断用户是否提交注册表单，如果是则执行如下代码

                                $course_name = $_POST['name'];
                                $introduction = $_POST['intr'];
                                $taid = $_COOKIE['user_id'];
                                $tid = $_POST['tid'];
                                $invitation = $_POST['invi'];
                                $course_id = $_POST['invi'];

                                if (!check_right($course_id, "modify_course_info", $dbc)) {
                                    echo "<script>alert('没有该权限！');location.href='index.php';</script>";
                                }

                                $query = "SELECT * FROM course_basic WHERE invitation = '$invitation'";
                                $result = @mysqli_query($dbc, $query);

                                if ($result) {
                                    if (mysqli_num_rows($result) > 0) {
                                        echo "<script>alert('邀请码已存在，创建失败！');location.href='index.php';</script>";
                                    } else {
                                        $query = "insert into course_basic(course_id, course_name, introduction, taid, tid, invitation) values ('$course_id', '$course_name','$introduction','$taid','$tid','$invitation')";
                                        $result = @mysqli_query($dbc, $query);
                                        if ($result) {
                                            echo "<script>alert('创建成功！');location.href='index.php';</script>";
                                        }
                                    }
                                }
                            }
                            ?>
                            <div class="form-group">
                                <input class="form-control" name="name" id="inputname" placeholder="课程名">
                                <i class="fa fa-user"></i>
                            </div>
							<div class="form-group">
                                <input class="form-control" name="intr" id="inputintr" placeholder="课程简介">
                                <i class="fa fa-user"></i>
                            </div>
							<div class="form-group">
                                <input class="form-control" name="taid" id="inputintro" placeholder="助教ID">
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
                        <?php
                            require_once('../php/mysqli_connect.php');
                            $tid = $_COOKIE['user_id'];
                            $notice_query = "select content, time from notice where user_type = 0 order by id desc;";
                            $notice_result = @mysqli_query($dbc, $notice_query);
                            while ($notice_tmp_row = mysqli_fetch_array($notice_result, MYSQLI_ASSOC)) {
                                $content = $notice_tmp_row['content'];
                                $time = $notice_tmp_row['time'];
                                echo '
                                <div class="card">
                                    <div class="card-block" style="float:red">
                                        <hr style="height:1px;border:none;border-top:1px solid #555555;" />
                                        <p style="line-height: 1"></p>
                                        <h4>
                                            <font size="3" color="red">发布者: 管理员 （全体公告）</font>
                                        </h4>
                                        <p>内容：'.$content.'</p>
                                        <span class="username text-info">
                                            时间：'.$time.'
                                        </span>
                                        <p style="line-height: 1"><br><br></p>
                                    </div>
                                </div>
                                ';
                            }
                        ?>
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

    <div id="fh5co-testimonial" style="background-image: url(../images/school.jpg);">
        <div class="overlay"></div>
        <div class="container">
            <div class="row animate-box">
                <div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
                    <h2><span>热门课程介绍</span></h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="row animate-box">
                        <div class="owl-carousel owl-carousel-fullwidth">
							<div class="item">
								<div class="testimony-slide active text-center">
									<div class="user" style="background-image: url(images/person3.jpg);"></div>
										<span>宏观经济学（甲）</span>
										<blockquote>
											<p>&ldquo;本课程主要涉及五个方面的内容：一、宏观经济的基本指标：介绍包括GDP的概念及其衡量，为后面的宏观经济模型介绍做铺垫。二、宏观经济模型：重点介绍三个核心的宏观经济模型，它们分别是有效需求决定模型、IS-LM模型和AD-AS模型，通过这三个模型的讲解一方面帮助学生理解现实的经济是怎么运行的，同时也为后面介绍宏观政策提供理论基础。三、宏观经济运行：包括通货膨胀、经济增长和经济周期。四、宏观经济调控及政策：包括财政政策和货币政策及它们的操作方式。五、开放经济的宏观经济学：主要是关注在开放经济条件下，宏观经济政策的效果会发生怎样的变化。课程将采用讲授与讨论相结合的方法。&rdquo;</p>
										</blockquote>
								</div>
							</div>
							<div class="item">
								<div class="testimony-slide active text-center">
									<div class="user" style="background-image: url(images/person3.jpg);"></div>
									<span>微观经济学（甲）</span>
									<blockquote>
										<p>&ldquo;微观经济学是现代经济学基本理论的一个重要组成部分，主要研究市场经济中的消费者和企业的行为及其相互作用，描述市场经济的运行过程，论证市场机制的作用原理，从而解决社会资源的最优配置问题。它所研究的内容可以概括为三个基本问题：生产什么？如何生产？及为谁生产？&rdquo;</p>
									</blockquote>
								</div>
							</div>
							<div class="item">
								<div class="testimony-slide active text-center">
									<div class="user" style="background-image: url(images/person3.jpg);"></div>
									<span>微积分（甲）Ⅰ</span>
									<blockquote>
										<p>&ldquo;《微积分》是以函数为研究对象，运用极限手段（如无穷小与无穷逼近等极限过程），分析处理问题的一门数学学科，教学内容有：无穷级数、矢量代数与空间解析几何、多元函数的微分学、多元函数的积分学、场论初步.课程将采用讲授与讨论相结合的方法.&rdquo;</p>
									</blockquote>
								</div>
							</div>
							<div class="item">
								<div class="testimony-slide active text-center">
									<div class="user" style="background-image: url(images/person3.jpg);"></div>
									<span>Python程序设计</span>
									<blockquote>
										<p>&ldquo;通过介绍Python语言及其编程技术，包括数据的定义、运算及流程控制、程序结构和函数、常用算法和程序设计方法和风格等内容，使学生了解高级程序设计语言的结构，掌握基本的程序设计过程和技巧。本课程以数据科学要求为依据，掌握利用计算机求解简单的大数据问题，初步具备数据科学程序设计能力。&rdquo;</p>
									</blockquote>
								</div>
							</div>
							<div class="item">
								<div class="testimony-slide active text-center">
									<div class="user" style="background-image: url(images/person3.jpg);"></div>
									<span>中国近现代史纲要</span>
									<blockquote>
										<p>&ldquo;本课程，是向大学生讲授中国近代以来抵御外来侵略、争取民族独立、推翻反动统治、实现人民解放的历史，讲授中国人民不断探索国家出路，进而推进中国特色社会主义现代化进程的历史；帮助学生了解国史、国情，深刻领会历史和人民是怎样选择了马克思主义，选择了中国共产党，选择了社会主义道路，进而怎样形成中国特色社会主义理论体系、找到中国特色社会主义道路、开辟中国特色社会主义现代化新局面。课程将采用讲授与讨论相结合的方法。&rdquo;</p>
									</blockquote>
								</div>
							</div>

							<div class="item">
								<div class="testimony-slide active text-center">
									<div class="user" style="background-image: url(images/person3.jpg);"></div>
									<span>马克思主义基本原理概论</span>
									<blockquote>
										<p>&ldquo;本课程旨在帮助学生从整体上把握马克思主义基本理论，从而把握人类社会发展的基本规律，以确立正确的世界观、价值观和人生观。教学内容主要有：世界的物质性及发展规律；实践与认识及其发展规律；人类社会及其发展规律；资本主义的本质及规律；社会主义的发展及其趋势；共产主义崇高理想及其最终实现。&rdquo;</p>
									</blockquote>
								</div>
							</div>
							<div class="item">
								<div class="testimony-slide active text-center">
									<div class="user" style="background-image: url(images/person3.jpg);"></div>
									<span>毛泽东思想和中国特色社会主义理论体系概论</span>
									<blockquote>
										<p>&ldquo;本课程全面系统阐述马克思主义中国化的两大理论成果——毛泽东思想和中国特色社会主义理论体系，其中，重点阐述了习近平新时代中国特色社会主义思想。中国特色社会主义进入新时代，这是我们的基本方位。在此基础上，系统论述习近平新时代中国特色社会主义思想的主要内容——坚持和发展中国特色社会主义的总任务、“五位一体”总体布局、“四个全面”战略布局、全面推进国防和军队现代化建设、中国特色大国外交、坚持和加强党的领导。通过系统学习，帮助学生掌握习近平新时代中国特色社会主义思想的主要内容，坚持中国特色社会主义的道路自信、理论自信、制度自信和文化自信；帮助学生树立共产主义的理想和信念，勇于担当，在实现中华民族伟大复兴的新征程中建功立业。&rdquo;</p>
									</blockquote>
								</div>
							</div>
						</div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div id="fh5co-staff">
		<div class="col-md-6 col-md-offset-3 text-center fh5co-heading">
			<h2><span>热门教师介绍</span></h2>
		</div>
        <div class="container">
            <div class="row">
                <div class="col-md-3 text-center">
                    <div class="staff">
							<div class="staff-img" style="background-image: url(images/staff-1.jpg);">
                            <ul class="fh5co-social">
                                <li>
										<h3><a href="https://person.zju.edu.cn/0097412">金波</a></h3></li>
                            </ul>
                        </div>
							<h3><a href="https://person.zju.edu.cn/0097412">金波</a></h3>
                        <p>副教授，1971年6月生，工学博士。主要从事电液控制系统与深海机电装备的研究工作，共在国内外学术刊物与国际会议上发表论文60余篇，其中作为第一作者或通讯作者被SCI收录5篇，EI收录15篇，ISTP收录5篇。作为第一、二发明人获得国家发明专利、软件著作权共8项。作为主要完成人获得国家技术发明奖二等奖一项，省部级科技进步一等奖两项...</p>
                    </div>
                </div>
                <div class="col-md-3 animate-box text-center">
                    <div class="staff">
                        <div class="staff-img" style="background-image: url(../images/staff-2.jpg);">
                            <ul class="fh5co-social">
                                <li>
										<h3><a href="https://person.zju.edu.cn/0003172">刘玉生</a></h3></li>
                            </ul>
                        </div>
							<h3><a href="https://person.zju.edu.cn/0003172">刘玉生</a></h3>
                        <p>博士，浙江大学计算机学院研究员，博士生导师，CAD&amp;CG国家重点实验室固定研究人员。1995年7月在浙江大学获硕士学位后赴澳门贺田工业有限公司从事机电产品的研发。1997年9月起在浙江大学机械制造及自动化专业攻读博士学位并于2000年9月毕业。同年10月进入浙江大学CAD&amp;CG国家重点实验室从事博士后研究，2002年10月出站后前往在香港城市大学继续从事博士后研究...</p>
                    </div>
                </div>
                <div class="col-md-3 animate-box text-center">
                    <div class="staff">
                        <div class="staff-img" style="background-image: url(../images/staff-3.jpg);">
                            <ul class="fh5co-social">
                                <li>
										<h3><a href="https://person.zju.edu.cn/0092031">邢卫</a></h3></li>
                            </ul>
                        </div>
							<h3><a href="https://person.zju.edu.cn/0092031">邢卫</a></h3>
                        <p>浙江大学计算机科学与技术学院博士，副教授，硕士生导师。1992年起先后在浙江大学工业控制技术国家实验室、浙江大学信息学院控制科学与工程系、浙江大学计算机科学与技术学院任职；1994年晋升讲师，2000年12月晋升副教授；2011年2月至2012年7月作为援疆干部，任塔里木大学信息工程学院副院长，学校信息化工作领导小组办公室常务副主任...</p>
                    </div>
                </div>
                <div class="col-md-3 animate-box text-center">
                    <div class="staff">
                        <div class="staff-img" style="background-image: url(../images/staff-4.jpg);">
                            <ul class="fh5co-social">
                                <li>
										<h3><a href="https://person.zju.edu.cn/0090040">林海</a></h3></li>
                            </ul>
                        </div>
							<h3><a href="https://person.zju.edu.cn/0090040">林海</a></h3>
                        <p>主要从事计算机图形学、科学计算可视化、虚拟现实等方面的研究，承担国家自然科学基金项目三项，国家863科技计划项目二项，军工项目多项。目前的研究工作具体主要在：高分辨率多屏拼接显示技术;体数据可视化算法研究;医学数据可视化;基于CPU/GPU混合集群的大规模体数据可视化;基于图形加速的计算电磁学等方面。</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="message-box">
        <?php
        //            $page_title = '留言板';
        $pages = 0;
        //包含上一级目录的数据库连接文件
        require_once('../php/mysqli_connect.php');
        if(isset($_POST['submitted']))
        {
            //获取用户的输入
            $n = mysqli_real_escape_string($dbc, trim($_POST['inputName']));
            $e = mysqli_real_escape_string($dbc, trim($_POST['inputEmail']));
            $c = mysqli_real_escape_string($dbc, trim($_POST['inputComment']));
            $q = "insert into comment_list(name, email, comment, comment_date) values('$n', '$e', '$c', now())";
            //执行sql语句，同样需要在前头加上 @ 符号
            $r = @mysqli_query($dbc, $q);
        }
        echo '<div>
                    <h2 style="position: relative;left: 25%;top: -30px;">留言板</h2>
                    </div>
                    <div class="col-lg-7">';
        $display = 5;	//每页留言数目
        if(isset($_GET['p']) AND is_numeric($_GET['p']))//获得总页数
        {
            $pages = $_GET['p'];
        }
        else
        {
            $q = "select count(id) from comment_list";
            $r = @mysqli_query($dbc, $q);
            $row = @mysqli_fetch_array($r, MYSQLI_NUM);	//从结果集$r得到数字数组
            $record = $row[0];							//$row[0]即为count(id)
            $pages = ceil($record / $display);			//计算总页数，ceil函数向上舍入为最接近的整数
        }
        if(isset($_GET['s']) && is_numeric($_GET['s']))//获得起始留言编号
        {
            $start = $_GET['s'];
        }
        else
        {
            $start = 0;		//如果首次载入页面，则起始编号为0
        }
        $q = "select name,comment,DATE_FORMAT(comment_date, '%M %d, %Y') as dr from comment_list order by dr limit $start, $display";
        $r = @mysqli_query($dbc, $q);
        if($r){
            $iter = 0;
            while($row = mysqli_fetch_array($r, MYSQLI_ASSOC))//从结果集$r得到关联数组
            {
                echo '<div style="clear: both"><image src="../images/head'.($iter%5+1).'.png" style="" />
                            <div class="panel" style="position: relative;left: 50px;top: -50px;">
                            <div class="panel-body">
                            <h4 style="position: relative;top: -20px;">' . $row['name'] . '</h4>
                            <p style="color: #CDC9C9 ;position: relative;top: -20px;">'. $row['dr'] . '</p>
                            <h5 style="position: relative;top: -20px;">' . $row['comment'] . '</h5>
                            </div></div></div>';
                $iter++;
            }
        }
        //释放结果集
        if($r)
            mysqli_free_result($r);
        //关闭数据库
        mysqli_close($dbc);
        //如果页数大于1，则显示分页
        if($pages > 1)
        {
            $current_page = ($start / $display) + 1;
            echo '<ul class="pager" style="position: relative;top: -50px;">';
            if($current_page != 1)	//当前页不是第一页，则显示向前连接
            {
                echo '<li><a href="index.php?s=' . ($start - $display) . '&p=' . $pages . '">Previous</a></li>';
            }
            if($current_page != $pages)	//当前页不是最后一页，则显示向后连接
            {
                echo '<li><a href="index.php?s=' . ($start + $display) . '&p=' . $pages . '">Next</a></li>';
            }
            echo '</ul>';
        }
        
        echo '</div>';//col-lg-6
        ?>



        <div class="leave-message col-lg-7">
            <form role="form" action="index.php" method="post" style="position: relative;left: 7%; top: -30px;">
                <label for="inputName" class="sr-only">姓名</label>
                <input type="text" name="inputName" class="form-control" placeholder="姓名" maxlength="20" required autofocus>
                <label for="inputEmail" class="sr-only">邮箱</label>
                <input type="email" name="inputEmail" class="form-control" placeholder="邮箱" maxlength="80" required>
                <label for="inputComment" class="sr-only">评论内容</label>
                <textarea class="form-control" name="inputComment" rows="5" placeholder="评论内容" maxlength="100" required></textarea>
                <button class="btn btn-lg btn-primary btn-block" type="submit">评论</button>
                <!-- 隐藏输入框，用于判断用户是否点击提交-->
                <input type = "hidden" name="submitted" value="TRUE">
            </form>
        </div>
    </div>


    <?php
    require_once("../include/footer_teacher.html");
    ?>
</div>
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
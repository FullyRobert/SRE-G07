<?php
//插入连接数据库的相关信息
require_once './php/mysqli_connect.php';
$error_msg = "";
//判断用户是否已经设置cookie，如果未设置$_COOKIE['user_id']时，执行以下代码
if(!isset($_COOKIE['user_id'])){
    if(isset($_POST['submit'])){//判断用户是否提交登录表单，如果是则执行如下代码
        $user_username = mysqli_real_escape_string($dbc,trim($_POST['id']));
        $user_password = mysqli_real_escape_string($dbc,trim($_POST['pwd']));

        if(!empty($user_username)&&!empty($user_password)){
            //MySql中的SHA()函数用于对字符串进行单向加密
            $query = "SELECT * FROM user_signup WHERE name = '$user_username' AND "."password = '$user_password'";
            //用用户名和密码进行查询
            $data = mysqli_query($dbc,$query);
            //若查到的记录正好为一条，则设置COOKIE，同时进行页面重定向

            if(mysqli_num_rows($data)>0){
                $row = mysqli_fetch_array($data);
                setcookie('user_id',$row['id'],time()+3600,"/SRE-G07");
                setcookie('user_name',$row['name'],time()+3600,"/SRE-G07");
                setcookie('user_type',$row['usertype'],time()+3600,"/SRE-G07");
                $home_url = './index.php';
                header('Location: '.$home_url);
            }
            else{
                $error_msg = 'Sorry, you must enter a valid username and password to log in.';
            }
        }else{
            $error_msg = 'Sorry, you must enter a valid username and password to log in.';
        }
		echo $error_msg;
    }
}else{//如果用户已经登录，则直接跳转到已经登录页面
//    echo "enter else";
    if($_COOKIE['user_type']=='1')
        $home_url = './teacher/index.php';
    else if($_COOKIE['user_type']=='2')
        $home_url = './student/index.php';
    else if($_COOKIE['user_type']=='3')
        $home_url = './ta/index.php';
    else{
        $home_url = './index.php';
        // clear cookie to avoid endless redirection
        setcookie('user_type','',time()-3600,"/SRE-G07");
        setcookie('user_id','',time()-3600,"/SRE-G07");
        setcookie('user_name','',time()-3600,"/SRE-G07");
    }

    header('Location: '.$home_url);
}
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

<!--	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">-->
<!--	<link href="https://fonts.googleapis.com/css?family=Roboto+Slab:300,400" rel="stylesheet">-->

	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/bootstrap-3.3.7-dist/css/bootstrap.css">
	<link rel="stylesheet" href="css/magnific-popup.css">
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	<link rel="stylesheet" href="css/flexslider.css">
	<link rel="stylesheet" href="css/pricing.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/global.css">
	<link rel="stylesheet" href="css/main.css">
	<link rel="stylesheet" href="./css/bootstrap-3.3.7-dist/css/bootstrap.min.css">
	<script src="./js/jquery.min.js"></script>
	<script src="./js/cookie.js"></script>
	<script src="./js/login.js"></script>
	<script src="./js/bootstrap.js"></script>
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

</head>

<body>

	<div class="fh5co-loader" name="start"></div>

	<div id="page">
		<nav class="fh5co-nav" role="navigation">
			<div class="top-menu">
				<div class="container">
					<div class="row">
						<div class="col-xs-2">
							<div id="fh5co-logo" style="width:300px"><a href="index.php"><img src="images/logo.png"></a></div>
						</div>
						<div class="col-xs-10 text-right menu-1">
							<ul>
								<li class="active"><a style="background-color: #5bc0de; color: white; padding: 10px;border-radius: 5px;" href="index.php#start">主页</a></li>
								<li><a href="article.php">文章</a></li>
								<li class="btn-cta" id="login" data-toggle="modal" data-target="#myModal2"><a href="#"><span>登录</span></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</nav>

		<aside id="fh5co-hero">
			<div class="flexslider">
				<ul class="slides">
					<li style="background-image: url(images/img_bg_1.jpg);">
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
					<li style="background-image: url(images/img_bg_2.jpg);">
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
					<li style="background-image: url(images/img_bg_3.jpg);">
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
							<div class="modal-body">
							<?php
								// require_once('../php/mysqli_connect.php');
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
							<form class="form-horizontal" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
								<div class="modal-header btn-info">
									<span class="heading modal-title" id="myModalLabe2">用户登录</span>
								</div>
								<div class="modal-body">
									<div class="form-group">
										<input class="form-control" name="id" id="inputEmail3" placeholder="用户名">
										<i class="fa fa-user"></i>
									</div>
									<div class="form-group help">
										<input type="password" class="form-control" name="pwd" id="inputPassword3" placeholder="密　码">
										<i class="fa fa-lock"></i>
										<a href="#" class="fa fa-question-circle"></a>
									</div>
									<div class="form-group">
										<div class="main-checkbox">
											<input type="checkbox" value="None" id="checkbox1" name="check" />
											<label for="checkbox1"></label>
										</div>
										<span class="text">Remember me</span>
										<button id="userLogin" type="submit" name="submit" class="btn-form-temp btn-info">登录</button>


									</div>
                                    <div class="modal-footer">
                                        <div style="clear: both; float: left"><a href="password_find.php">忘记密码？</a></div>
                                        <div style="float: right"><a href="signup.php">立即注册</a></div>
                                    </div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</aside>

		<div class="copyrights">Collect from <a href="http://www.cssmoban.com/" title="网站模板">网站模板</a></div>

		<div id="fh5co-testimonial" style="background-image: url(images/school.jpg);">
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
							<div class="staff-img" style="background-image: url(images/staff-2.jpg);">
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
							<div class="staff-img" style="background-image: url(images/staff-3.jpg);">
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
							<div class="staff-img" style="background-image: url(images/staff-4.jpg);">
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


    <?php
    require_once ("./include/message-box.php");
    ?>

        <br />
<?php
require_once ("./include/footer_index.html");
?>

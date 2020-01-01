<?php
/**
 * Created by PhpStorm.
 * User: momotani
 * Date: 2017/12/26
 * Time: 下午6:59
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
require_once('../php/mysqli_connect.php');

if (isset($_GET['id']) AND is_numeric($_GET['id']))
{
    $id = $_GET['id'];
} else {
    sleep(3);
    header('Location: ' . "./article.php");
}

if (isset($_POST['cid']))
    $course_id = $_POST['cid'];
else
    $course_id = $_GET['cid'];
if (isset($_POST['cname']))
    $course_name = $_POST['cname'];
else
    $course_name = $_GET['cname'];

$query = "select id, course_id, owner, title, content, post_date from posts where id=$id";
$result = @mysqli_query($dbc, $query);
if ($result) {
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
} else {
    echo "no result";
}

$post_id_temp = $id;
$temp_name = $row['owner'];
$temp_query1 = "select sid from student WHERE sname= '$temp_name' ";
$temp_query2 = "select tid from teacher WHERE tname= '$temp_name' ";
$id_result = @mysqli_query($dbc, $temp_query1);
$temp_row = mysqli_fetch_array($id_result, MYSQLI_ASSOC);
$temp_imageid = $temp_row['sid'] % 5 + 1;
if(!$temp_row){
    $id_result = @mysqli_query($dbc, $temp_query2);
    $temp_row = mysqli_fetch_array($id_result, MYSQLI_ASSOC);
    $temp_imageid = $temp_row['tid'] % 5 + 1;
}
$query_temp = "select count(id) as num from replys where post_id=$post_id_temp";
$result_temp = @mysqli_query($dbc, $query_temp);
$num_reply = 0;
if($result_temp){
    $row_temp = mysqli_fetch_array($result_temp, MYSQLI_ASSOC);
    $num_reply = $row_temp['num'];
}
$title = $row['title'];
$owner = $row['owner'];
$post_date = $row['post_date'];
$content = $row['content'];
$course_id = $row['course_id'];
$post_id = $row['id'];

//释放结果集
if ($result)
    mysqli_free_result($result);

require_once('../include/bbs_teacher_header.html');
?>

<div id="body">
    <div class="container">
        <div class="card">
            <div class="card-block">
                <h3>
                    <?php echo $title;?>
                </h3>
                <span class="username text-info">
                        <?php echo '<img src= "../images/head'.(string)$temp_imageid.'.png">'; ?>
                        <?php echo $owner;?>
                    </span>
                <span class="date text-grey m-l-1">
                        <?php echo $post_date;?>
                </span>
                <span class="text-grey"><i class="icon-eye"></i> <?php echo $num_reply;?></span>
                <hr>
                <div class="bbs-content">
                    <?php echo $content?>
                </div>
                <p style="line-height: 1"><br><br></p>
            </div>
        </div>

        <?php
        echo '
        <a href="bbs.php" role="button" class="btn btn-primary" style="color: white;">返回</a>';
        ?>
        <br>
        <br>

        <div class="card">
            <table class="table">
                <thead>
                <tr>
                    <th colspan="2">
                        <b>最新回复</b>
                    </th>
                </tr>

                </thead>
                <tbody>
                <tr>
                    <td style="width: 20px;">
                        <div>
                            <span class="group group-101 m-r-xs"></span>
                        </div>
                    </td>
                </tr>
                <?php
                //$post_id = $row['id'];
                $query = "select id, owner, content, reply_date from replys WHERE post_id= $post_id ";
                $result = @mysqli_query($dbc, $query);
                if($result){
                    while($row1 = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                        $temp_name = $row1['owner'];
                        $temp_id = $row1['id'];
                        $temp_query1 = "select sid from student WHERE sname= '$temp_name' ";
                        $temp_query2 = "select tid from teacher WHERE tname= '$temp_name' ";
                        $id_result = @mysqli_query($dbc, $temp_query1);
                        $temp_row = mysqli_fetch_array($id_result, MYSQLI_ASSOC);
                        $temp_imageid = $temp_row['sid'] % 5 + 1;
                        if(!$temp_row){
                            $id_result = @mysqli_query($dbc, $temp_query2);
                            $temp_row = mysqli_fetch_array($id_result, MYSQLI_ASSOC);
                            $temp_imageid = $temp_row['tid'] % 5 + 1;
                        }
                        echo '<tr>
                                <td style="width: 20px;">
                                    <div>
                                        <span class="group group-101 m-r-xs"></span>
                                    </div>
                                </td>
                                <td class="p-x-0">
                                    <dl class="row small">
                                        <dt>
                                                            <img src= "../images/head'.(string)($temp_imageid).'.png">
                                                            <span class="text-bold" style="font-size: 18px;padding-left: 13px;">
                                                                '.$row1['owner'].'
                                                            </span>
                                            <span class="date text-grey m-l-sm">'.$row1['reply_date'].'</span>
                                        </dt>
                                    </dl>
                                    <div class="message m-t-xs break-all">
                                        '.$row1['content'].'
                                    </div>
                                    <tr class="post">
                                        <td class="td-avatar" aria-hidden="true">
                                        </td>
                                        <td class="p-l-0">
                                            <form action="bbs-delete-reply.php" method="post" >
                                                <input type="hidden" name="reply_id" value="'.$temp_id.'">
                                                <input type="hidden" name="post_id" value="'.$post_id.'">
                                                <input type="hidden" name="cid" value="'.$course_id.'">
                                                <input type="hidden" name="cname" value="'.$course_name.'">
                                                <input type="hidden" name="tmp_id" value="1">
                                                <button type="submit" class="btn btn-danger" style="float: right">　删除　</button>
                                            </form>
                                         </td>
                                    </tr>
                                </td>
                            </tr>';
                    }
                }


                //释放结果集
                if ($result)
                    mysqli_free_result($result);

                //关闭数据库
                mysqli_close($dbc);
                ?>
                <tr class="post">
                    <td class="td-avatar" aria-hidden="true">
                    </td>
                    <td class="p-l-0">
                        <form action="bbs-reply.php" method="post" >
                            <input type="hidden" name="post_id" value="<?php echo $post_id;?>">
                            <input type="hidden" name="tmp_id" value="2">
                            <?php
                            echo '
                            <input type="hidden" name="cid" value='.$course_id.'>';
                            ?>
                            <?php
                            echo '
                            <input type="hidden" name="cname" value='.$course_name.'>';
                            ?>
                            <textarea class="form-control" placeholder="内容" name="content"></textarea>
                            <br>
                            <button type="submit" class="btn btn-sm btn-primary" style="float: right">　回帖　</button>
                        </form>
                    </td>
                </tr>

                </tbody>
            </table>
        </div>

    </div>
</div>


<?php
require_once("../include/footer_teacher.html");
?>

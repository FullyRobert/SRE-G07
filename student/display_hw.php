<?php
require_once '../php/mysqli_connect.php';
header('Content-Type: text/html; charset=gb2312');
$path=$_POST['$hw_name'];
$sid=$_COOKIE['user_id'];
                $query = "SELECT path FROM homework where hw_name='$path'";
                
                $result = @mysqli_query($dbc, $query);
                
                $row = mysqli_fetch_assoc($result);
                
                $name=$row['path'];
                
                $hw_id=$_POST['$hw_id'];
                $query3 = "SELECT grade FROM student_homework where sid=$sid and hw_id =$hw_id";
                $result3 = @mysqli_query($dbc, $query3);
                $row3 = mysqli_fetch_assoc($result3);
                $grade=$row3['grade'];
                $text='<td><a style="color: white" href="../homework/download_material.php?file=' . $name . '" class="btn btn-success unwork_a" style="height: 10px"">Download</a></td><td><p>'.$grade.'</p></td></tr>';
                echo $text;
                // //                            echo $query;
                // if ($result) {
                //     while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) //从结果集$r得到关联数组
                //     {
                //         $path = $row["path"];
                //         //                                    $filename=str_replace("../material/file/sem/","",$path);
                //         $text+='<td><a style="color: white" href="../php/download_material.php?cata=sem&file=' . $path . '" class="btn btn-success unwork_a">下载</a></td></tr> ';
                //         // echo '<tr>
                //         //                     <td>' . $name . '</td>
                //         //                     <td>' . $time . '</td>
                //         //                     <td>' . $size . 'kb</td>
                //         //                     <td><a style="color: white" href="../php/download_material.php?cata=sem&file=' . $name . '" class="btn btn-success unwork_a">下载</a>
                //         //                     </td>
                //         //                    </tr>';
                //     }
                // }
                ?>
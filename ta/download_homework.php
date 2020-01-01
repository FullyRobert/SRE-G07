<?php
require_once '../php/mysqli_connect.php';
header('Content-Type: text/html; charset=gb2312');
$sid=$_POST['$sid'];
$hw_id=$_POST['$hw_id'];
                $query = "SELECT hw_index FROM student_homework where hw_id=$hw_id and sid=$sid";
                $result = @mysqli_query($dbc, $query);
                $row = mysqli_fetch_assoc($result);
                $name=$row['hw_index'];
                $name=substr($name,12);
                
                $text=' href="../homework/download_material.php?file=' . $name;
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
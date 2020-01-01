<?php
function check_right($courseid, $right, $dbc)
{
    $query = "select " . $right . " from ta_right where course_id = '" . $courseid . "' and taid = '" . $_COOKIE['user_id'] . "';";
    $result = @mysqli_query($dbc, $query);
    if($result){
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        if($row){
            $result_int = $row[$right];
            $boolean = $result_int ? true : false;
        }
        else
            $boolean = false;
    }
    else
        $boolean = false;
    return $boolean;
}
<?php
/**
 * Created by PhpStorm.
 * User: Filip
 * Date: 2019-10-10
 * Time: 9:25 PM
 */

    require_once("connection.php");

    $getGrades = "SELECT students.*, student_board.board_id, student_board.id as student_board_id
                  FROM students 
                  INNER JOIN student_board ON student_board.student_id = students.id
                  WHERE student_board.board_id=1";

    $students = mysqli_query($conn, $getGrades);
    $array = [];
    if(mysqli_num_rows($students) > 0) {
        while ($student = mysqli_fetch_assoc($students)) {
            $obj["id"] = $student["id"];
            $obj["first_name"] = $student["first_name"];
            $obj["last_name"] = $student["last_name"];

            $getGradesQuery = "SELECT *
                                FROM grades
                                WHERE sb_id=".$student["student_board_id"]."
                                ORDER BY id DESC";

            $resultGrades = mysqli_query($conn, $getGradesQuery);
            $average = 0;
            $sum = 0;
            $num_grades = 0;
            $grades = [];
            if(mysqli_num_rows($resultGrades) > 0) {
                while ($grade = mysqli_fetch_assoc($resultGrades)) {
                    $num_grades++;
                    $sum += $grade["grade"];
                    $grades[] = $grade["grade"];
                }
            }
            $obj["grades"] = $grades;
            $average = $sum / $num_grades;
            $obj["average"] = $average;
            if($average >= 7) {
                $obj["result"] = "PASS";
            } else {
                $obj["result"] = "FAIL";
            }
            $array[] = $obj;

        }
    }


    print_r(json_encode($array));
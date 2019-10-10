<?php
/**
 * Created by PhpStorm.
 * User: Filip
 * Date: 2019-10-10
 * Time: 9:50 PM
 */

    require_once("connection.php");

    $getGrades = "SELECT students.*, student_board.board_id, student_board.id as student_board_id
              FROM students 
              INNER JOIN student_board ON student_board.student_id = students.id
              WHERE student_board.board_id=2";

    $studentsDb = mysqli_query($conn, $getGrades);
    $array = [];
    if(mysqli_num_rows($studentsDb) > 0) {

        $xml  = new DOMDocument('1.0', 'UTF-8');
        $xml->formatOutput=true;
        $students = $xml->createElement('students');
        $xml->appendChild($students);

        while ($student = mysqli_fetch_assoc($studentsDb)) {
            $studentxml = $xml->createElement('student');
            $students->appendChild($studentxml);

            $student_id = $xml->createElement('id',$student["id"]);
            $studentxml->appendChild($student_id);
            $first_name = $xml->createElement('first_name',$student["first_name"]);
            $studentxml->appendChild($first_name);
            $last_name = $xml->createElement('last_name',$student["last_name"]);
            $studentxml->appendChild($last_name);

            $getGradesQuery = "SELECT *
                                FROM grades
                                WHERE sb_id=".$student["student_board_id"]."
                                ORDER BY id DESC";

            $resultGrades = mysqli_query($conn, $getGradesQuery);
            $average = 0;
            $sum = 0;
            $num_grades = 0;
            $gradesArray = [];
            $isSame = false;
            if(mysqli_num_rows($resultGrades) > 0) {
                $grade = $xml->createElement('grade');
                while ($gradeDb = mysqli_fetch_assoc($resultGrades)) {
                    $num_grades++;
                    $gradesArray[] = $gradeDb["grade"];
                    $sum += $gradeDb["grade"];

                    $gradexml = $xml->createElement('grade',$gradeDb["grade"]);
                    $grade->appendChild($gradexml);
                }
                $studentxml->appendChild($grade);
            }
            //ispitujem da li su ocene sve iste (npr: sve 9 ili 10...)
            if (count(array_unique($gradesArray)) !== 1){
                $key = array_search(min($gradesArray), $gradesArray);
//                $key = key(min($gradesArray));
                unset($gradesArray[$key]);
            }

            $averageGrades = $sum / $num_grades;
            $average = $xml->createElement('average', $averageGrades);
            $studentxml->appendChild($average);

            //ukoliko je najveca ocena veca od 8 i ukupno ima vise od 2 ocene
            if(max($gradesArray) > 8 && $num_grades > 2) {
                $result = $xml->createElement('Result', "PASS");
                $studentxml->appendChild($result);
            } else {
                $result = $xml->createElement('Result',"FAIL");
                $studentxml->appendChild($result);
            }
            $xml->appendChild($students);

        }
        $output = $xml->saveXML();
        $header = "Content-Type:text/xml";
        header($header);
        echo $output;
    }
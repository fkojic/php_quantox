<?php
/**
 * Created by PhpStorm.
 * User: Filip
 * Date: 2019-10-10
 * Time: 7:16 PM
 */
    $first_name = "";
    $last_name = "";
    $board_id = "";
    $boards = [];

    if(isset($_GET["student"])) {

        require_once("connection.php");
        $id = $_GET["student"];
        $getStudentQuery = "SELECT students.*, student_board.board_id
                            FROM students 
                            LEFT JOIN student_board ON student_board.student_id = students.id
                            LEFT JOIN school_boards ON student_board.board_id = school_boards.id
                            WHERE students.id=".$id;

        $result = mysqli_query($conn, $getStudentQuery);
        if(mysqli_num_rows($result) > 0) {
            $student = mysqli_fetch_object($result);
//            echo $student->id;
            $first_name =  $student->first_name;
            $last_name = $student->last_name;
            $board_id = $student->board_id;
        } else {
            header("Location: index.php");
        }

        $getBoardsQuery = "SELECT * FROM school_boards";

        $resultBoards = mysqli_query($conn, $getBoardsQuery);
        $count = mysqli_num_rows($resultBoards);
    }
    ?>

<div class="row dev-list text-center">
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">
        <div class="widget clearfix">
            <img src="resource/uploads/team_01.jpg" alt="" class="img-fluid rounded-circle">
            <div class="widget-title">
                <h3><?php echo $first_name. " ". $last_name; ?></h3>
<!--                            <small>Senior Art Director</small>-->
            </div>
            <!-- end title -->
            <p>Hello guys, I am student :|</p>

            <div class="footer-social">
            </div>
        </div><!--widget -->
    </div><!-- end col -->
    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">
        <div class="widget clearfix">
            <select class="width100" name="board" id="board">
                <option value="0">Choose</option>
                <?php
                    if($count > 0) {
                        while ($row = mysqli_fetch_assoc($resultBoards)) {
                            $selcted = "";
                            if($row["id"] == $board_id) { $selcted = "selected"; }
                            echo "<option value='" . $row["id"] . "'". $selcted .">" . $row["name"] . "</option>";
                        }
                    }
                ?>
            </select>
        </div><!--widget -->
    </div><!-- end col -->
<?php
/**
 * Created by PhpStorm.
 * User: Filip
 * Date: 2019-10-10
 * Time: 7:16 PM
 */
    $student_id = "";
    $first_name = "";
    $last_name = "";
    $board_id = null;
    $boards = [];
    $message = "";
    $student_board_id = null;

    $grades = [];

    if(isset($_GET["student"])) {

        if(isset($_POST["board"])) {

            $checkQuery = "SELECT *
                        FROM student_board 
                        WHERE student_id=".$_GET["student"];

            $check = mysqli_query($conn, $checkQuery);
            if(mysqli_num_rows($check) > 0) {
                $message = "danger_Student is already join!";
            } else {
                $registerQuery = "INSERT INTO student_board(student_id, board_id)
                VALUES ('".$_GET["student"]."','".$_POST["board"]."')";
                $result = mysqli_query($conn, $registerQuery);
                if($result) {
                    $message = "primary_Success!";
                } else {
                    $message = "danger_Problem with connection!";
                }
            }
        }

        $id = $_GET["student"];
        $getStudentQuery = "SELECT students.*, student_board.board_id, student_board.id as student_board_id
                            FROM students 
                            LEFT JOIN student_board ON student_board.student_id = students.id AND student_board.student_id
                            LEFT JOIN school_boards ON student_board.board_id = school_boards.id AND student_board.student_id
                            WHERE students.id=".$id;

        $result = mysqli_query($conn, $getStudentQuery);
        if(mysqli_num_rows($result) > 0) {
            $student = mysqli_fetch_object($result);
            $student_id = $student->id;
            $first_name =  $student->first_name;
            $last_name = $student->last_name;
            $board_id = $student->board_id;
            $student_board_id = $student->student_board_id;
        } else {
            header("Location: index.php");
        }

        $getBoardsQuery = "SELECT * FROM school_boards";

        $resultBoards = mysqli_query($conn, $getBoardsQuery);
        $count = mysqli_num_rows($resultBoards);


        if(isset($_POST["student_board_id"]) && isset($_POST["grades"])) {
            if(sizeof($_POST["grades"])) {
                $gradesArray = array_reverse($_POST["grades"]);

                $getGradesForDeleteQuery = "DELETE FROM `grades` WHERE sb_id=".$_POST["student_board_id"];

                $deleteGrades = mysqli_query($conn, $getGradesForDeleteQuery);

                for($i = 0; $i < sizeof($gradesArray); $i++) {
                    $registerQuery = "INSERT INTO grades(sb_id, grade)
                                    VALUES ('".$_POST["student_board_id"]."','".$gradesArray[$i]."')";
                    $resultGrade = mysqli_query($conn, $registerQuery);
                    if($resultGrade) {
                        $message = "primary_Success change/add grades!";
                    } else {
                        $message = "danger_Failed change/add grades!";
                    }
                }
            }
        }

        if($student_board_id != null) {
            $getGradesQuery = "SELECT *
                                FROM grades
                                WHERE sb_id=".$student_board_id."
                                ORDER BY id DESC";

            $resultGrades = mysqli_query($conn, $getGradesQuery);
            $countGrades = mysqli_num_rows($resultGrades);
        }
    }

    ?>
<?php if($message != "") {
$messageArray = explode('_', $message);
?>
<div class="alert alert-<?php echo $messageArray[0]; ?>" role="alert">
  <?php echo $messageArray[1]; ?>
</div>
<?php } ?>
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
            <div class="pricing-table-space"></div>
            <h4>Boards</h4>
            <form action="index.php?student=<?php echo $student_id; ?>" method="POST" class="pricing-table-features form-horizontal form-bordered form-validate">
                <select class="width100" name="board" id="board">
                    <option value="0">Choose board...</option>
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
                <div class="pricing-table-space"></div>
                <div class="form-group">
                    <button class="btn btn-dark btn-radius btn-brd grd1 effect-1 width100">Join on board</button>
                </div>
            </form>
        </div><!--widget -->
    </div><!-- end col -->
    <?php
        if($student_board_id != null) {
    ?>

    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 wow fadeIn" data-wow-duration="1s" data-wow-delay="0.2s">
        <div class="widget clearfix">
            <div class="pricing-table-space"></div>
            <h4>Grades</h4>
            <button type="button" class="btn btn-primary btn-radius btn-brd grd1 effect-1 width100" id="addGrade">Add Grade</button>
            <div class="pricing-table-space"></div>
            <form action="index.php?student=<?php echo $student_id; ?>" method="POST" class="pricing-table-features form-horizontal form-bordered form-validate">
                <div id="formgrades">
                <?php
                $average = 0;
                if($countGrades > 0) {
                    $average = 0;
                    $sum = 0;
                    $num_grades = 0;
                    while ($grade = mysqli_fetch_assoc($resultGrades)) {
                        $num_grades++;
                        $sum += $grade["grade"];
                        ?>
                            <div class="form-group">
                                <input type="number" min="1" max="10" name="grades[]" value="<?php echo $grade["grade"]; ?>" class="width100 input-group grades" />
                            </div>
                        <?php
                    }
                    $average = $sum / $num_grades;
                }
                ?>
                <?php if($average > 0) { ?>
                <div class="form-group">
                    <h3>Average grade: <b><?php echo $average; ?></b></h3>
                </div>
                <?php } ?>
                <input type="hidden" name="student_board_id" id="student_board_id" value="<?php echo $student_board_id; ?>" />
                </div>
                <div class="pricing-table-space"></div>
                <div class="form-group">
                    <button class="btn btn-dark btn-radius btn-brd grd1 effect-1 width100">Submit grades</button>
                </div>

            </form>
        </div>
    </div>
    <?php
        }
    ?>
</div>

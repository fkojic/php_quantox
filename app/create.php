
<div class="pricing-table pricing-table-highlighted">
    <div class="pricing-table-space"></div>
    <button type="button" class="btn btn-primary" id="showCreate">Add Student</button>
    <div class="pricing-table-space"></div>
</div>
<div class="pricing-table pricing-table-highlighted" style="display: none;" id="createForm">
    <div class="row">
        <div class="col-md-4">
            <br>
        </div>
        <div class="col-md-4">
            <div class="pricing-table-space"></div>
            <form action="../../app/create.php" method="POST" class="pricing-table-features form-horizontal form-bordered form-validate">
                <div class="form-group">
                    <input type="text" class="form-controll width100" id="first_name" name="first_name" />
                </div>
                <div class="form-group">
                    <input type="text" class="form-controll width100" id="last_name" name="last_name" />
                </div>
                <div class="form-group">
                    <button class="btn btn-dark btn-radius btn-brd grd1 effect-1 width100">Create student</button>
                </div>
            </form>
            <div class="pricing-table-space"></div>
        </div>
        <div class="col-md-4">
            <br>
        </div>
    </div>
</div>

<div class="pricing-table pricing-table-highlighted">
    <div class="pricing-table-space"></div>
    <table class="table">
        <?php
        include("connection.php");

        $getStudentsQuery = "SELECT * FROM students";

        $results = mysqli_query($conn, $getStudentsQuery);
        $count = mysqli_num_rows($results);
        if($count > 0 ){
            ?>
            <thead>
            <tr>
                <th>First name</th>
                <th>Last name</th>
                <th>&nbsp;</th>
            </tr>
            </thead>
            <tbody>
            <?php
            while ($row = mysqli_fetch_assoc($results)) {
                ?>
                <tr>
                    <td><?php echo $row["first_name"] ?></td>
                    <td><?php echo $row["last_name"] ?></td>
                    <td><a href="index.php?student=<?php echo $row["id"] ?>" class="btn btn-dark btn-radius btn-brd grd1 effect-1"> More</a></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
            <?php
        } else {
            echo "No students!";
        }
        ?>
    </table>
    <div class="pricing-table-space"></div>
</div>
<?php
    if(isset($_POST["first_name"]) && isset($_POST["last_name"])) {
        $registerQuery = "INSERT INTO students(first_name, last_name)
            VALUES ('".$_POST["first_name"]."','".$_POST["last_name"]."')";
        $result = mysqli_query($conn, $registerQuery);
        if($result) {
            header("Location: index.php");
        }
    }

<?php
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    require_once "config.php";

    $sql = "SELECT * FROM employees WHERE id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        $param_id = trim($_GET["id"]);

        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {

                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);


                $name = $row["name"];
                $address = $row["address"];
                $email = $row["email"];
                $phone = $row["phone"];
                $gender = $row["gender"];
                $dob = $row["dob"];
                $status = $row["status"];
                $skills = $row["skills"];
            } else {
                header("location: error.php");
                exit();
            }
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

  
    mysqli_stmt_close($stmt);

    
    mysqli_close($link);
} else {
   
    header("location: error.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>View Record</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper {
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h1>View Record</h1>
                    </div>
                    <div class="form-group">
                        <label>Name</label>
                        <p class="form-control-static"><?php echo $row["name"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <p class="form-control-static"><?php echo $row["email"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Gender</label>
                        <p class="form-control-static"><?php echo $row["gender"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Phone</label>
                        <p class="form-control-static"><?php echo $row["phone"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>DOB</label>
                        <p class="form-control-static"><?php echo $row["dob"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <p class="form-control-static"><?php echo $row["status"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Skills</label>
                        <p class="form-control-static"><?php echo $row["skills"]; ?></p>
                    </div>

                    <div class="form-group">
                        <label>Address</label>
                        <p class="form-control-static"><?php echo $row["address"]; ?></p>
                    </div>

                    <p><a href="index.php" class="btn btn-primary">Back</a></p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
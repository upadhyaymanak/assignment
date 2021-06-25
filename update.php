<?php

require_once "config.php";


$name = "";
$gender = "";
$email = $dob = $phone = $status = $skills = $address = "";

if (isset($_POST["id"]) && !empty($_POST["id"])) {
    $id = $_POST["id"];

    $input_name = trim($_POST["name"]);
    $name = $input_name;
    $input_email = trim($_POST["email"]);
    $email = $input_email;
    $input_dob = trim($_POST["dob"]);
    $dob = $input_dob;
    $input_gender = trim($_POST["gender"]);
    $gender = $input_gender;
    $input_phone = trim($_POST["phone"]);
    $phone = $input_phone;
    $input_status = trim($_POST["status"]);
    $status = $input_status;
    $input_skills = trim($_POST["skills"]);
    $skills = $input_skills;
    $input_address = trim($_POST["address"]);
    $address = $input_address;


    if (
        !empty($name) && !empty($email) && !empty($dob)
        && !empty($phone) && !empty($gender) && !empty($status) && !empty($skills) && !empty($address)
    ) {
        $sql = "UPDATE employees SET name=?, email=?, dob=?, gender=?, phone=?,  status=?,
        skills=?, $address=?  WHERE id=?";

        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "ssssssssi", $param_name, $param_email, $param_dob, $param_gender, $param_phone,  $param_status, $param_skills, $param_address, $param_id);

            $param_name = $name;
            $param_address = $address;
            $param_email = $email;
            $param_dob = $dob;
            $param_phone = $phone;
            $param_gender = $gender;
            $param_skills = $skills;
            $param_status = $status;
            $param_address = $address;
            $param_id = $id;

            if (mysqli_stmt_execute($stmt)) {
                header("location: index.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
            }
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($link);
} else {
    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        $id =  trim($_GET["id"]);

        $sql = "SELECT * FROM employees WHERE id = ?";
        if ($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $param_id);

            $param_id = $id;

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
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update Record</title>
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
                        <h2>Update Record</h2>
                    </div>
                    <p>Please edit the input values and submit to update the record.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">

                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" value="<?php echo $email; ?>">
                            <span class="help-block">
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <input type="text" name="gender" class="form-control" value="<?php echo $gender; ?>">
                            <span class="help-block">
                        </div>
                        <div class="form-group">
                            <label>DOB</label>
                            <input type="date" name="dob" class="form-control" value="<?php echo $dob; ?>">
                            <span class="help-block">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <input type="text" name="status" class="form-control" value="<?php echo $status; ?>">
                            <span class="help-block">
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control" value="<?php echo $phone; ?>">
                            <span class="help-block">
                        </div>
                        <div class="form-group">
                            <label>Skills</label>
                            <input type="text" name="skills" class="form-control" value="<?php echo $skills; ?>">
                            <span class="help-block">
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="address" class="form-control"><?php echo $address; ?></textarea>

                        </div>

                        <input type="hidden" name="id" value="<?php echo $id; ?>" />
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
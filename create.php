<?php
// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$name = "";
$gender = "";
$email = $dob = $phone = $status = $skills = $address = "";


// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate name
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


    // Prepare an insert statement
    $sql = "INSERT INTO employees (name, email, dob, gender, phone, status, skills, address) VALUES (?, ?, ? , ?, ?, ?, ?, ?)";

    if ($stmt = mysqli_prepare($link, $sql)) {

        mysqli_stmt_bind_param($stmt, "ssssssss", $param_name, $param_email, $param_dob, $param_gender, $param_phone,  $param_status, $param_skills, $param_address);


        $param_name = $name;
        $param_address = $address;
        $param_email = $email;
        $param_dob = $dob;
        $param_phone = $phone;
        $param_gender = $gender;
        $param_skills = $skills;
        $param_status = $status;
        $param_address = $address;



        if (mysqli_stmt_execute($stmt)) {

            header("location: index.php");
            exit();
        } else {
            echo "Something went wrong. Please try again later.";
        }

        mysqli_stmt_close($stmt);
    }
}
mysqli_close($link);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Create Record</title>
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
                        <h2>Create Record</h2>
                    </div>
                    <p>Please fill this form and submit to add employee record to the database.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="<?php echo $name; ?>">

                        </div>
                        <div class="form-group ">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control">

                        </div>
                        <div class="form-group">
                            <label>DOB</label>
                            <input type="date" name="dob" class="form-control" required value="<?php echo $dob; ?>">

                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <select name="gender" required>
                                <option value="<?php echo $gender; ?>"> <?php echo $gender; ?> </option>
                                <option value="male"> Male </option>
                                <option value="female"> Female </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name="phone" class="form-control" minlength="10" maxlength="10" required value="<?php echo $phone; ?>">
                        </div>
                        <div class="form-group">
                            <label>Status</label>
                            <input type="text" name="status" class="form-control" required value="<?php echo $status; ?>">

                        </div>
                        <div class="form-group">
                            <label>Skills</label>
                            <input type="text" name="skills" class="form-control" required value="<?php echo $skills; ?>">

                        </div>

                        <div class="form-group">
                            <label>Address</label>
                            <textarea name="address" class="form-control"><?php echo $address; ?></textarea>

                        </div>

                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="index.php" class="btn btn-default">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
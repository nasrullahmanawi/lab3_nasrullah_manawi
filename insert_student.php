<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card shadow">

                <div class="card-header bg-primary text-white">
                    <h3 class="text-center mb-0">Student Information</h3>
                </div>

                <div class="card-body">

                    <?php

                    if ($_SERVER["REQUEST_METHOD"] == "POST") {

                        $fullName = trim($_POST["full_name"]);
                        $email = trim($_POST["email"]);
                        $department = trim($_POST["department"]);

                        if (
                            empty($fullName) ||
                            empty($email) ||
                            empty($department)
                        ) {

                            echo '<div class="alert alert-warning">
                                    All fields are required.
                                  </div>';

                        } 
                        elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {

                            echo '<div class="alert alert-danger">
                                    Please enter a valid email address.
                                  </div>';

                        } 
                        else {

                            $conn = new mysqli(
                                "localhost",
                                "root",
                                "",
                                "wis_lab"
                            );

                            if ($conn->connect_error) {

                                echo '<div class="alert alert-danger">
                                        Connection failed: ' . $conn->connect_error . '
                                      </div>';

                            } 
                            else {

                                $sql = "INSERT INTO students
                                        (full_name, email, department)
                                        VALUES (?, ?, ?)";

                                $stmt = $conn->prepare($sql);

                                if ($stmt) {

                                    $stmt->bind_param(
                                        "sss",
                                        $fullName,
                                        $email,
                                        $department
                                    );

                                    if ($stmt->execute()) {

                                        echo '<div class="alert alert-success">
                                                Student added successfully.
                                              </div>';

                                    } 
                                    else {

                                        echo '<div class="alert alert-danger">
                                                Error adding student: ' .
                                                $stmt->error .
                                             '</div>';
                                    }

                                    $stmt->close();

                                } 
                                else {

                                    echo '<div class="alert alert-danger">
                                            Error preparing statement: ' .
                                            $conn->error .
                                         '</div>';
                                }

                                $conn->close();
                            }
                        }
                    }

                    ?>

                    <form method="POST">

                        <div class="mb-3">
                            <label for="full_name" class="form-label">
                                Full Name
                            </label>

                            <input
                                type="text"
                                name="full_name"
                                id="full_name"
                                class="form-control"
                                placeholder="Enter full name"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">
                                Email
                            </label>

                            <input
                                type="email"
                                name="email"
                                id="email"
                                class="form-control"
                                placeholder="Enter email address"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="department" class="form-label">
                                Department
                            </label>

                            <input
                                type="text"
                                name="department"
                                id="department"
                                class="form-control"
                                placeholder="Enter department"
                                required
                            >
                        </div>

                        <div class="d-flex gap-2">

                            <button
                                type="submit"
                                class="btn btn-primary flex-grow-1">
                                Save Student
                            </button>

                            <button
                                type="reset"
                                class="btn btn-secondary">
                                Clear
                            </button>

                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>

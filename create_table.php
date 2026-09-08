<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Students Table</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-7">

            <div class="card shadow">
                <div class="card-header bg-success text-white">
                    <h3 class="text-center mb-0">Create Students Table</h3>
                </div>

                <div class="card-body">

                    <?php

                    $conn = new mysqli("localhost", "root", "", "wis_lab");

                    if ($conn->connect_error) {
                        die(
                            '<div class="alert alert-danger">
                                Connection failed: ' . $conn->connect_error . '
                            </div>'
                        );
                    }

                    $sql = "CREATE TABLE students (
                        id INT AUTO_INCREMENT PRIMARY KEY,
                        full_name VARCHAR(100) NOT NULL,
                        email VARCHAR(120) NOT NULL,
                        department VARCHAR(80) NOT NULL,
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
                    )";

                    if ($conn->query($sql) === TRUE) {
                        echo '<div class="alert alert-success">
                                Students table created successfully.
                              </div>';
                    } 
                    else {
                        echo '<div class="alert alert-danger">
                                Error creating table: ' . $conn->error . '
                              </div>';
                    }

                    $conn->close();

                    ?>

                    <div class="text-center mt-3">
                        <a href="insert_student.php" class="btn btn-primary">
                            Add Student
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>

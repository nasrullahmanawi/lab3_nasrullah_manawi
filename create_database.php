<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Database</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <div class="card shadow">
                <div class="card-header bg-primary text-white">
                    <h3 class="text-center mb-0">Create Database</h3>
                </div>

                <div class="card-body">

                    <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {

                        $databaseName = trim($_POST["database_name"]);

                        $conn = new mysqli("localhost", "root", "");

                        if ($conn->connect_error) {
                            echo '<div class="alert alert-danger">
                                    Connection failed: ' . $conn->connect_error . '
                                  </div>';
                        } 
                        elseif (empty($databaseName)) {
                            echo '<div class="alert alert-warning">
                                    Please enter a database name.
                                  </div>';
                        } 
                        elseif (!preg_match("/^[a-zA-Z0-9_]+$/", $databaseName)) {
                            echo '<div class="alert alert-danger">
                                    Database name can contain only letters, numbers, and underscores.
                                  </div>';
                        } 
                        else {

                            $sql = "CREATE DATABASE `$databaseName`";

                            if ($conn->query($sql) === TRUE) {
                                echo '<div class="alert alert-success">
                                        Database <strong>' . htmlspecialchars($databaseName) . '</strong> created successfully.
                                      </div>';
                            } 
                            else {
                                echo '<div class="alert alert-danger">
                                        Error creating database: ' . $conn->error . '
                                      </div>';
                            }
                        }

                        $conn->close();
                    }
                    ?>

                    <form method="POST">

                        <div class="mb-3">
                            <label for="database_name" class="form-label">
                                Database Name
                            </label>

                            <input
                                type="text"
                                name="database_name"
                                id="database_name"
                                class="form-control"
                                placeholder="Enter database name"
                                required
                            >
                        </div>

                        <button type="submit" class="btn btn-primary w-100">
                            Create Database
                        </button>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>

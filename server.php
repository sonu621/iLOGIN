<?php
include("includes/connection.php");

$connection = getDatabaseConnection();

// Insert data to database 
if ($_GET['action'] == "insertData") {
    if (!empty($_POST['name']) && !empty($_POST['gender']) && !empty($_POST['country']) && !empty($_FILES['image']['size'] != 0)) {

        $name = mysqli_real_escape_string($connection, $_POST['name']);
        $gender = mysqli_real_escape_string($connection, $_POST['gender']);
        $country = mysqli_real_escape_string($connection, $_POST['country']);

        // Rename the image before uploading to the database
        $original_name = $_FILES['image']['name'];
        $new_name = uniqid() . time() . '.' . pathinfo($original_name, PATHINFO_EXTENSION);
        $upload_path = 'uploads/' . $new_name;

        // Ensure the uploads directory exists
        if (!is_dir('uploads')) {
            mkdir('uploads', 0777, true);
        }

        if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
            $sql = "INSERT INTO `details` (`id`, `name`, `image`, `country`, `gender`) VALUES (NULL, '$name', '$new_name', '$country', '$gender')";

            if (mysqli_query($connection, $sql)) {
                echo json_encode([
                    'statusCode' => 200,
                    'message' => 'Data inserted successfully'
                ]);
            } else {
                echo json_encode([
                    'statusCode' => 500,
                    'message' => 'Error inserting data: ' . mysqli_error($connection)
                ]);
            }
        } else {
            echo json_encode([
                'statusCode' => 500,
                'message' => 'Error uploading file'
            ]);
        }
    } else {
        echo json_encode([
            'statusCode' => 400,
            'message' => 'All fields are required'
        ]);
    }
}

// Update data in the database
if ($_GET['action'] == "updateData") {
    if (!empty($_POST['id']) && !empty($_POST['name']) && !empty($_POST['gender']) && !empty($_POST['country'])) {

        $id = mysqli_real_escape_string($connection, $_POST['id']);
        $name = mysqli_real_escape_string($connection, $_POST['name']);
        $gender = mysqli_real_escape_string($connection, $_POST['gender']);
        $country = mysqli_real_escape_string($connection, $_POST['country']);

        $sql = "UPDATE `details` SET `name` = '$name', `country` = '$country', `gender` = '$gender'";

        // Check if a new image is uploaded
        if (!empty($_FILES['image']['size'] != 0)) {
            $original_name = $_FILES['image']['name'];
            $new_name = uniqid() . time() . '.' . pathinfo($original_name, PATHINFO_EXTENSION);
            $upload_path = 'uploads/' . $new_name;

            if (move_uploaded_file($_FILES['image']['tmp_name'], $upload_path)) {
                $sql .= ", `image` = '$new_name'";
            } else {
                echo json_encode([
                    'statusCode' => 500,
                    'message' => 'Error uploading file'
                ]);
                exit();
            }
        }

        $sql .= " WHERE `id` = '$id'";

        if (mysqli_query($connection, $sql)) {
            echo json_encode([
                'statusCode' => 200,
                'message' => 'Data updated successfully'
            ]);
        } else {
            echo json_encode([
                'statusCode' => 500,
                'message' => 'Error updating data: ' . mysqli_error($connection)
            ]);
        }
    } else {
        echo json_encode([
            'statusCode' => 400,
            'message' => 'All fields are required'
        ]);
    }
}

// Delete data from the database
if ($_GET['action'] == "deleteData") {
    if (!empty($_POST['id'])) {
        $id = mysqli_real_escape_string($connection, $_POST['id']);

        $sql = "DELETE FROM `details` WHERE `id` = '$id'";

        if (mysqli_query($connection, $sql)) {
            echo json_encode([
                'statusCode' => 200,
                'message' => 'Data deleted successfully'
            ]);
        } else {
            echo json_encode([
                'statusCode' => 500,
                'message' => 'Error deleting data: ' . mysqli_error($connection)
            ]);
        }
    } else {
        echo json_encode([
            'statusCode' => 400,
            'message' => 'ID is required'
        ]);
    }
}
?>
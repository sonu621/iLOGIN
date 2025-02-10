<?php
include "includes/header.php";
include "includes/connection.php";

// logged in users are redirected to the home page
if(isset($_SESSION['email'])){
    header("Location: index.php");
    exit();
}

$firstname = "";
$lastname = "";
$email = "";
$phone = "";
$address = "";
$password = "";
$role = "";

$firstname_error = "";
$lastname_error = "";
$email_error = "";
$phone_error = "";
$address_error = "";
$password_error = "";
$confirm_password_error = "";

$error = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];
    $role = $_POST['role'];

    // Validate firstname
    if (empty($firstname)) {
        $firstname_error = 'First name is required';
        $error = true;
    }

    // Validate lastname
    if (empty($lastname)) {
        $lastname_error = 'Last name is required';
        $error = true;
    }

    // Validate email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $email_error = 'Email format is not valid';
        $error = true;
    }

    $connection = getDatabaseConnection();

    $statement = $connection->prepare("SELECT * FROM users WHERE email = ?");

    // Bind variables to the prepared statement as parameters
    $statement->bind_param("s", $email);

    // Execute the prepared statement
    $statement->execute();

    // Check if email exists
    $statement->store_result();
    if ($statement->num_rows > 0) {
        $email_error = 'Email already exists';
        $error = true;
    }

    // Close statement
    $statement->close();

    // Validate phone
    if (!preg_match('/^(\+?\d{1,3}[- ]?)?\d{9,10}$/', $phone)) {
        $phone_error = 'Phone number is not valid';
        $error = true;
    }

    // Validate password
    if (strlen($password) < 6) {
        $password_error = 'Password must be at least 6 characters';
        $error = true;
    }

    // Validate confirm password
    if ($confirm_password != $password) {
        $confirm_password_error = 'Passwords do not match';
        $error = true;
    }

    // If no errors, proceed with registration
    if (!$error) {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $statement = $connection->prepare("INSERT INTO users (firstname, lastname, email, phone, password, role) VALUES (?, ?, ?, ?, ?, ?)");
        $statement->bind_param("ssssss", $firstname, $lastname, $email, $phone, $hashed_password, $role);
        $statement->execute();
        $statement->close();
        $connection->close();
        header("Location: index.php");
        exit();
    }
}
?>

<div class="container mt-5 col-md-4">
    <form method="post">
        <div class="mb-3">
            <label for="firstname" class="form-label">First Name*</label>
            <input type="text" name="firstname" id="firstname" class="form-control" value="<?=$firstname?>" required>
            <span class="text-danger"><?=$firstname_error?></span>
        </div>
        <div class="mb-3">
            <label for="lastname" class="form-label">Last Name*</label>
            <input type="text" name="lastname" id="lastname" class="form-control" value="<?=$lastname ?>" required>
            <span class="text-danger"><?=$lastname_error?></span>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email*</label>
            <input type="email" name="email" id="email" class="form-control" value="<?=$email?>" required>
            <span class="text-danger"><?=$email_error?></span>
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Phone*</label>
            <input type="phone" name="phone" id="phone" class="form-control" value="<?=$phone?>" required>
            <span class="text-danger"><?=$phone_error?></span>
        </div>
        <div class="mb-3">
            <label for="address" class="form-label">Address</label>
            <input type="text" name="address" id="address" class="form-control"<?=$address?>>
            <span class="text-danger"><?=$address_error?></span>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password*</label>
            <input type="password" name="password" id="password" class="form-control" value="<?=$password?>" required>
            <span class="text-danger"><?=$password_error?></span>
        </div>
        <div class="mb-3">
            <label for="confirm_password" class="form-label">Confirm Password*</label>
            <input type="password" name="confirm_password" id="confirm_password" class="form-control" value="" required>
            <span class="text-danger"><?=$confirm_password_error?></span>
        </div>
        <div class="mb-3">
            <label for="role" class="form-label">Role*</label>
            <select name="role" id="role" class="form-control" required>
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>
            <span class="text-danger"></span>
        </div>
        <div class="row mb-3">
            <div class="col-sm-6 d-grid">
                <button type="submit" class="btn btn-primary">Register</button>
            </div>
            <div class="col-sm-6 d-grid">
                <a href="index.php" class="btn btn-outline-primary">Cancel</a>
            </div>
        </div>
    </form>
</div>

<?php
include"includes/footer.php";
?>
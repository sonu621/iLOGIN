<?php
include("includes/header.php");

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION['email'])){
    header("location: index.php");
    exit;
}

$email = "";
$error = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        $error = "Email and Password are required";
    } else {
        include("includes/connection.php");
        $dbConnection = getDatabaseConnection();

        $statement = $dbConnection->prepare("SELECT id, firstname, lastname, phone, password, role, created_at FROM users WHERE email = ?");
        
        // Bind variables to the prepared statement as parameters
        $statement->bind_param('s', $email);

        // Execute the prepared statement
        $statement->execute();

        // Bind result variables
        $statement->bind_result($id, $firstname, $lastname, $phone, $hashed_password, $role, $created_at);

        if ($statement->fetch()) {
            if (password_verify($password, $hashed_password)) {
                session_start();
                $_SESSION['id'] = $id;
                $_SESSION['firstname'] = $firstname;
                $_SESSION['lastname'] = $lastname;
                $_SESSION['phone'] = $phone;
                $_SESSION['email'] = $email;
                $_SESSION['role'] = $role;
                $_SESSION['created_at'] = $created_at;
                $_SESSION['authenticated'] = true;

                header("Location: index.php");
                exit();
            } else {
                $error = "Invalid email or password";
            }
        } else {
            $error = "Invalid email or password";
        }

        // Close statement
        $statement->close();

        // Close connection
        $dbConnection->close();
    }
}
?>

<div class="container py-5">
    <div class="mx-auto border shadow p-4" style="width: 400px;">
        <h2 class="text-center mb-4">Login</h2>
        <hr>
        <?php if(!empty($error)) { ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
           <strong><?=$error?></strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <?php } ?>
        <form method="post">
            <div class="mb-3">
                <label for="email" class="from-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="<?=$email?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="from-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="row mb-3">
                <div class="col d-grid">
                <button type="submit" class="btn btn-primary">Login</button>
                </div>
                <div class="col d-grid">
                    <a href="index.php" class="btn btn-outline-primary">Cancle</a>
                </div>
            </div>
        </form>
    </div>
</div>

<?php
include("includes/footer.php");
?>
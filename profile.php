<?php
include("includes/header.php");

// Check if the user is already logged in, if not then redirect to the home page
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    header("location: index.php");
    exit;
}
?>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-6 mx-auto border shadow p-4">
            <h2 class="text-center mb-4">Profile</h2>
            <hr>
            <div class="row mb-3">
                <div class="col-sm-4">First Name</div>
                <div class="col-sm-8"><?php echo htmlspecialchars($_SESSION['firstname']); ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4">Last Name</div>
                <div class="col-sm-8"><?php echo htmlspecialchars($_SESSION['lastname']); ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4">Email</div>
                <div class="col-sm-8"><?php echo htmlspecialchars($_SESSION['email']); ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4">Phone</div>
                <div class="col-sm-8"><?php echo htmlspecialchars($_SESSION['phone']); ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4">Role</div>
                <div class="col-sm-8"><?php echo htmlspecialchars($_SESSION['role']); ?></div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-4">Register At</div>
                <div class="col-sm-8"><?php echo htmlspecialchars($_SESSION['created_at']); ?></div>
            </div>
        </div>
    </div>
</div>

<?php
include("includes/footer.php");
?>
<?php
include("includes/header.php");
include("includes/connection.php");

$connection = getDatabaseConnection();
?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Manage Users</h2>
        <button class="btn btn-dark" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
            aria-controls="offcanvasExample">
            Add User
        </button>
    </div>

    <table class="table table-bordered table-striped" id="myTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Image</th>
                <th>Name</th>
                <th>Country</th>
                <th>Gender</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM `details`";
            $result = $connection->query($sql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><?= $row['id'] ?></td>
                        <td><img src="uploads/<?= $row['image'] ?>" alt="<?= $row['name'] ?>" class="preview_img"></td>
                        <td><?= $row['name'] ?></td>
                        <td><?= $row['country'] ?></td>
                        <td><?= $row['gender'] ?></td>
                        <td>
                            <button class="btn btn-sm btn-primary edit-btn" data-id="<?= $row['id'] ?>"
                                data-name="<?= $row['name'] ?>" data-country="<?= $row['country'] ?>"
                                data-gender="<?= $row['gender'] ?>" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <button class="btn btn-sm btn-danger delete-btn" data-id="<?= $row['id'] ?>">
                                <i class="bi bi-trash"></i>
                            </button>
                        </td>
                    </tr>
                    <?php
                }
            } else {
                ?>
                <tr>
                    <td colspan="6" class="text-center">No records found</td>
                </tr>
                <?php
            }
            ?> 
        </tbody>
    </table> 
</div>

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel"
    style="width: 600px;">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Add New User</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <form id="insertForm" action="server.php?action=insertData" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id" id="user_id">
            <div class="mb-3">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="John Doe" required>
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Upload Image</label>
                <div class="d-flex align-items-center">
                    <img class="preview_img me-3"
                        src="https://w7.pngwing.com/pngs/178/595/png-transparent-user-profile-computer-icons-login-user-avatars-thumbnail.png"
                        alt="img">
                    <div class="file-upload text-secondary">
                        <input type="file" name="image" id="image" class="form-control">
                        <span class="fs-4 fw-2">Choose file..</span>
                        <span>Or drag and drop file here</span>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="country" class="form-label">Country</label>
                <select name="country" id="country" class="form-control" required>
                    <option value="USA">USA</option>
                    <option value="UK">UK</option>
                    <option value="India">India</option>
                    <!-- Add more countries as needed -->
                </select>
            </div>
            <div class="mb-3">
                <label for="gender" class="form-label">Gender</label>
                <div>
                    <input type="radio" name="gender" id="gender_male" value="male" required>
                    <label for="gender_male">Male</label>
                    &nbsp;&nbsp;
                    <input type="radio" name="gender" id="gender_female" value="female" required>
                    <label for="gender_female">Female</label>
                </div>
            </div>
            <div class="mb-3 d-flex justify-content-start">
                <button type="submit" class="btn btn-primary me-1">Submit</button>
                <button type="button" class="btn btn-secondary me-1" data-bs-dismiss="offcanvas">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- Toast container -->
<div class="position-fixed bottom-0 end-0 p-3 toast-container" style="z-index: 11"></div>

<?php
include("includes/footer.php");
?>
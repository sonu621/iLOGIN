</div> <!-- Closing the container div from header.php -->
<footer class="py-5 bg-body-tertiary mt-auto">
    <div class="container">
        <div class="row">
            <div class="col text-center">
                <small class="d-block text-muted">&copy; 2025-<?php echo date("Y") ?></small>
            </div>
        </div>
    </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script>
    $(document).ready(function() {
        $('#myTable').DataTable();

        $(".file-upload input").change(function() {
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(".preview_img").attr("src", e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }
        });

        // Function to insert or update data in the database
        $("#insertForm").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            var actionUrl = $("#user_id").val() ? "server.php?action=updateData" : "server.php?action=insertData";
            $.ajax({
                url: actionUrl,
                type: "POST",
                data: formData,
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    var response = JSON.parse(response);
                    if (response.statusCode == 200) {
                        showToast('Success', response.message, 'success');
                        location.reload();
                    } else {
                        showToast('Error', response.message, 'danger');
                    }
                }
            });
        });

        // Function to populate the form with user data for editing
        $(".edit-btn").click(function() {
            var id = $(this).data("id");
            var name = $(this).data("name");
            var country = $(this).data("country");
            var gender = $(this).data("gender");
            var role = $(this).data("role");

            $("#user_id").val(id);
            $("#name").val(name);
            $("#country").val(country);
            $("input[name='gender'][value='" + gender + "']").prop("checked", true);
            $("#role").val(role);
            $("#offcanvasExampleLabel").text("Edit User");
            $("#insertForm").attr("action", "server.php?action=updateData");
        });

        // Function to delete user data
        $(".delete-btn").click(function() {
            var id = $(this).data("id");
            if (confirm("Are you sure you want to delete this user?")) {
                $.ajax({
                    url: "server.php?action=deleteData",
                    type: "POST",
                    data: { id: id },
                    success: function(response) {
                        console.log(response);
                        var response = JSON.parse(response);
                        if (response.statusCode == 200) {
                            showToast('Success', response.message, 'success');
                            location.reload();
                        } else {
                            showToast('Error', response.message, 'danger');
                        }
                    }
                });
            }
        });

        function showToast(title, message, type) {
            var toastHTML = `
                <div class="toast align-items-center text-bg-${type} border-0" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex">
                        <div class="toast-body">
                            <strong>${title}:</strong> ${message}
                        </div>
                        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            `;
            var toastContainer = $('.toast-container');
            toastContainer.append(toastHTML);
            var toastElement = toastContainer.children().last();
            var toast = new bootstrap.Toast(toastElement);
            toast.show();
        }
    });
</script>
</body>

</html>
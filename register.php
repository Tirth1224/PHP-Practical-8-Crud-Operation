<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enrollment = $_POST['enrollment'];
    $name = $_POST['name'];
    $branch = $_POST['branch'];
    $password = hashPassword($_POST['password']);
    $photo = $_FILES['photo']['name'];
    $target = "uploads/" . basename($photo);

    if (move_uploaded_file($_FILES['photo']['tmp_name'], $target)) {
        $sql = "INSERT INTO students (enrollment, name, branch, password, photo) VALUES ('$enrollment', '$name', '$branch', '$password', '$target')";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['message'] = "Registration successful! Please log in.";
            header('Location: login.php');
        } else {
            $_SESSION['error'] = "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $_SESSION['error'] = "Failed to upload photo.";
    }
}
?>

<?php include 'templates/header.php'; ?>
<div class="container mt-5">
    <h2 class="text-center">Register</h2>
    <div class="card">
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" class="mt-4">
                <div class="mb-3">
                    <label for="enrollment" class="form-label">Enrollment</label>
                    <input type="text" class="form-control" id="enrollment" name="enrollment" required>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="branch" class="form-label">Branch</label>
                    <input type="text" class="form-control" id="branch" name="branch" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Photo</label>
                    <input type="file" class="form-control" id="photo" name="photo" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Register</button>
            </form>
        </div>
    </div>
</div>
<?php include 'templates/footer.php'; ?>

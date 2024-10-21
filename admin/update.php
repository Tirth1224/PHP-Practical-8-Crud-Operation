<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $enrollment = $_POST['enrollment'];
    $name = $_POST['name'];
    $branch = $_POST['branch'];
    $photo = $_FILES['photo']['name'];
    $target = "../uploads/" . basename($photo);

    if ($photo) {
        move_uploaded_file($_FILES['photo']['tmp_name'], $target);
        $sql = "UPDATE students SET enrollment='$enrollment', name='$name', branch='$branch', photo='$target' WHERE id='$id'";
    } else {
        $sql = "UPDATE students SET enrollment='$enrollment', name='$name', branch='$branch' WHERE id='$id'";
    }

    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Record updated successfully!";
        header('Location: index.php');
    } else {
        $_SESSION['error'] = "Error updating record: " . $conn->error;
    }
} else {
    $id = $_GET['id'];
    $sql = "SELECT * FROM students WHERE id='$id'";
    $result = $conn->query($sql);
    $student = $result->fetch_assoc();
}
?>

<?php include '../templates/header.php'; ?>
<div class="container mt-5">
    <h2 class="text-center">Update Student Record</h2>
    <div class="card">
        <div class="card-body">
            <form method="POST" enctype="multipart/form-data" class="mt-4">
                <input type="hidden" name="id" value="<?php echo $student['id']; ?>">
                <div class="mb-3">
                    <label for="enrollment" class="form-label">Enrollment</label>
                    <input type="text" class="form-control" id="enrollment" name="enrollment" value="<?php echo $student['enrollment']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $student['name']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="branch" class="form-label">Branch</label>
                    <input type="text" class="form-control" id="branch" name="branch" value="<?php echo $student['branch']; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="photo" class="form-label">Photo</label>
                    <input type="file" class="custom-file-input" id="photo" name="photo">
                    <label class="custom-file-label" for="photo">Choose file</label>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Update</button>
            </form>
        </div>
    </div>
</div>
<?php include '../templates/footer.php'; ?>

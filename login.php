<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $enrollment = $_POST['enrollment'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM students WHERE enrollment = '$enrollment'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $student = $result->fetch_assoc();
        if (verifyPassword($password, $student['password'])) {
            $_SESSION['student_id'] = $student['id'];
            $_SESSION['enrollment'] = $student['enrollment'];
            $_SESSION['name'] = $student['name'];
            $_SESSION['photo'] = $student['photo'];
            header('Location: welcome.php');
        } else {
            $_SESSION['error'] = "Invalid password.";
        }
    } else {
        $_SESSION['error'] = "Invalid enrollment number.";
    }
}
?>

<?php include 'templates/header.php'; ?>
<div class="container mt-5">
    <h2 class="text-center">Login</h2>
    <div class="card">
        <div class="card-body">
            <form method="POST" class="mt-4">
                <div class="mb-3">
                    <label for="enrollment" class="form-label">Enrollment</label>
                    <input type="text" class="form-control" id="enrollment" name="enrollment" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Login</button>
            </form>
        </div>
    </div>
</div>
<?php include 'templates/footer.php'; ?>

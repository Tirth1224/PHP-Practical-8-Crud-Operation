<?php
include 'config.php';

if (!isset($_SESSION['student_id'])) {
    header('Location: login.php');
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];

    $student_id = $_SESSION['student_id'];
    $sql = "SELECT password FROM students WHERE id = '$student_id'";
    $result = $conn->query($sql);
    $student = $result->fetch_assoc();

    if (verifyPassword($current_password, $student['password'])) {
        $new_password_hashed = hashPassword($new_password);
        $sql = "UPDATE students SET password = '$new_password_hashed' WHERE id = '$student_id'";
        if ($conn->query($sql) === TRUE) {
            $_SESSION['message'] = "Password changed successfully!";
        } else {
            $_SESSION['error'] = "Error updating password: " . $conn->error;
        }
    } else {
        $_SESSION['error'] = "Current password is incorrect.";
    }
}
?>

<?php include 'templates/header.php'; ?>
<div class="container mt-5">
    <h2 class="text-center">Change Password</h2>
    <div class="card">
        <div class="card-body">
            <form method="POST" class="mt-4">
                <div class="mb-3">
                    <label for="current_password" class="form-label">Current Password</label>
                    <input type="password" class="form-control" id="current_password" name="current_password" required>
                </div>
                <div class="mb-3">
                    <label for="new_password" class="form-label">New Password</label>
                    <input type="password" class="form-control" id="new_password" name="new_password" required>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Change Password</button>
            </form>
        </div>
    </div>
</div>
<?php include 'templates/footer.php'; ?>

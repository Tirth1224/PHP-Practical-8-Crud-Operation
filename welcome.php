<?php
include 'config.php';
if (!isset($_SESSION['student_id'])) {
    header('Location: login.php');
    exit;
}
?>

<?php include 'templates/header.php'; ?>
<div class="container mt-5 text-center">
    <h2>Welcome, <?php echo $_SESSION['name']; ?>!</h2>
    <img src="<?php echo $_SESSION['photo']; ?>" alt="Profile Photo" class="img-thumbnail rounded-circle img-center">
    <p>This is the welcome page.</p>
    <div class="welcome-buttons mt-3">
        <a href="change_password.php" class="btn btn-secondary">Change Password</a>
        <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
</div>
<?php include 'templates/footer.php'; ?>

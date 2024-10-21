<?php
include 'config.php';

$order = $_GET['order'] ?? 'name';
$search = $_GET['search'] ?? '';

$sql = "SELECT * FROM students WHERE name LIKE '%$search%' OR enrollment LIKE '%$search%' ORDER BY $order";
$result = $conn->query($sql);
?>

<?php include '../templates/header.php'; ?>
<div class="container mt-5">
    <h2 class="text-center">Student Records</h2>
    <div class="text-center mb-4">
        <form method="GET" class="form-inline justify-content-center">
            <input type="text" class="form-control mr-2" name="search" placeholder="Search by name or enrollment" value="<?php echo $search; ?>">
            <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th><a href="?order=enrollment">Enrollment</a></th>
                <th><a href="?order=name">Name</a></th>
                <th><a href="?order=branch">Branch</a></th>
                <th>Photo</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['enrollment']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['branch']; ?></td>
                    <td><img src="../<?php echo $row['photo']; ?>" alt="Profile Photo" class="img-thumbnail" width="100"></td>
                    <td>
                        <a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-warning">Edit</a>
                        <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<?php include '../templates/footer.php'; ?>

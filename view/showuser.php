<?php
require_once __DIR__ . '/../controller/usercontroller.php';

$controller = new UserController();

if (isset($_POST['addUser'])) {
    $offer = new User($_POST['email'], $_POST['pwd']);
    $controller->addUser($offer);
}

if (isset($_GET['deleteId'])) {
    $controller->deleteUser($_GET['deleteId']);
}

if (isset($_POST['updateUser'])) {
    $controller->updateUser($_POST['id'], $_POST['email'], $_POST['pwd']);
}


$users = $controller->getUsers();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management</title>
</head>
<body>

    <h2>User Management</h2>

    <form method="POST">
        <h3>Add a User</h3>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="pwd" placeholder="Password" required>
        <button type="submit" name="addUser">Add User</button>
    </form>

    <hr>

    <h3>User List</h3>
    <?php if (!empty($users)): ?>
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Password</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?php echo $user['id']; ?></td>
                        <td><?php echo $user['email']; ?></td>
                        <td><?php echo $user['pwd']; ?></td>
                        <td>
                            <button onclick="openUpdateForm(<?php echo $user['id']; ?>, '<?php echo $user['email']; ?>', '<?php echo $user['pwd']; ?>')">Modify</button>
                            <a href="?deleteId=<?php echo $user['id']; ?>" onclick="return confirm('Are you sure you want to delete this user?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No users found</p>
    <?php endif; ?>

    <hr>

    <div id="updateForm" style="display:none;">
        <h3>Modify a User</h3>
        <form method="POST">
            <input type="hidden" name="id" id="updateId">
            <input type="email" name="email" id="updateEmail" placeholder="Email" required>
            <input type="password" name="pwd" id="updatePwd" placeholder="Password" required>
            <button type="submit" name="updateUser">Update</button>
            <button type="button" onclick="closeUpdateForm()">Cancel</button>
        </form>
    </div>

    <script>
        function openUpdateForm(id, email, pwd) {
            document.getElementById('updateForm').style.display = 'block';
            document.getElementById('updateId').value = id;
            document.getElementById('updateEmail').value = email;
            document.getElementById('updatePwd').value = pwd;
        }

        function closeUpdateForm() {
            document.getElementById('updateForm').style.display = 'none';
        }
    </script>

</body>
</html>

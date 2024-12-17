<?php
require_once '../classes/Database.php';
require_once '../classes/User.php';

use Classes\Database;
use Classes\User;

$db = (new Database())->connect();
$userModel = new User($db);

// Fetch all users
$users = $userModel->getAll();
$db = null; // Close connection
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD OOP with PDO</title>
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <div class="container">
        <h1>User List</h1>
        <button class="btn addUser" id="addUserBtn">Add User</button>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $nCount = 1;
                foreach ($users as $user): ?>
                    <tr>
                        <td><?= $nCount++ ?></td>
                        <td><?= htmlspecialchars($user['name']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td class="posBtn">
                            <button class="btn edit-btn" data-id="<?= $user['id'] ?>" data-name="<?= htmlspecialchars($user['name']) ?>" data-email="<?= htmlspecialchars($user['email']) ?>">Edit</button>
                            <button class="btn delete-btn" data-id="<?= $user['id'] ?>">Delete</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <?php include '../views/modal_form.php'; ?>

    <script src="js/scripts.js"></script>
</body>

</html>
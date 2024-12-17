<?php
require_once '../classes/Database.php';
require_once '../classes/User.php';

use Classes\Database;
use Classes\User;

$response = ['success' => false, 'message' => 'Invalid request'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = (new Database())->connect();
    $userModel = new User($db);

    $id = $_POST['id'] ?? null;
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $action = $_POST['action'] ?? null;

    try {
        if ($action === 'delete' && $id) {
            $userModel->delete($id);
        } elseif ($id) {
            $userModel->update($id, ['name' => $name, 'email' => $email]);
        } else {
            $userModel->create(['name' => $name, 'email' => $email]);
        }
        $response['success'] = true;
    } catch (Exception $e) {
        $response['message'] = $e->getMessage();
    }

    $db = null;
}

echo json_encode($response);

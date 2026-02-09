<?php
class AdminController {
    private $db;

    public function __construct() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header("Location: index.php?action=login");
            exit;
        }
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function dashboard() {
        $userModel = new User($this->db);
        $users = $userModel->all(); 
        include __DIR__ . '/../views/admin/dashboard.php';
    }

    public function storeUser() {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $role = $_POST['role'];

        if (!empty($username) && !empty($email) && !empty($password)) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $userModel = new User($this->db);
            $userModel->create($username, $email, $hash, $role);
        }
        header("Location: index.php?action=admin");
    }

    public function editUser($id) {
        $userModel = new User($this->db);
        $user = $userModel->find($id);
        
        if (!$user) {
            header("Location: index.php?action=admin");
            exit;
        }
        
        include __DIR__ . '/../views/admin/edit_user.php';
    }

    public function updateUser($id) {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $role = $_POST['role'];

        if (!empty($username) && !empty($email)) {
            $userModel = new User($this->db);
            $userModel->update($id, $username, $email, $role);
        }
        header("Location: index.php?action=admin");
    }

    public function deleteUser($id) {
        $userModel = new User($this->db);
        if ($id) {
            $query = "DELETE FROM users WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        }
        header("Location: index.php?action=admin");
    }
}
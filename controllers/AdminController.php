<?php
class AdminController {
    private $db;

    public function __construct() {
        // Protección: Solo administradores pueden entrar aquí
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header("Location: index.php?action=login");
            exit;
        }
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function dashboard() {
        $userModel = new User($this->db);
        $users = $userModel->all(); // Obtenemos todos los usuarios para la tabla
        include __DIR__ . '/../views/admin/dashboard.php';
    }

    public function updateRole() {
        $id = $_POST['user_id'];
        $role = $_POST['role'];
        $userModel = new User($this->db);
        $userModel->updateRole($id, $role); // Usamos el método que añadiremos al modelo
        header("Location: index.php?action=admin");
    }
}
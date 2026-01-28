<?php

require_once __DIR__ . '/../models/User.php';

class UserController {
    private $userModel;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->userModel = new User($db);
    }

    protected function render(string $view, array $data = []) {
        extract($data);
        include __DIR__ . '/../views/' . $view;
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $pass = $_POST['password'];
            $user = $this->userModel->findByEmail($email);

            if ($user && password_verify($pass, $user['password_hash'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['username'] = $user['username'];
                header("Location: index.php?action=posts");
                exit;
            } else {
                $error = "Credenciales incorrectas.";
                return $this->render('auth/login.php', compact('error'));
            }
        }
        return $this->render('auth/login.php');
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];

            if (empty($username) || empty($email) || empty($password)) {
                $error = "Todos los campos son obligatorios.";
                return $this->render('auth/register.php', compact('error'));
            }

            if ($this->userModel->findByEmail($email)) {
                $error = "El email ya está registrado.";
                return $this->render('auth/register.php', compact('error'));
            }

            $hash = password_hash($password, PASSWORD_DEFAULT);
            if ($this->userModel->create($username, $email, $hash)) {
                header("Location: index.php?action=login");
                exit;
            } else {
                $error = "Error al registrar el usuario.";
                return $this->render('auth/register.php', compact('error'));
            }
        }
        return $this->render('auth/register.php');
    }

    public function logout() {
        session_unset();
        session_destroy();
        header("Location: index.php?action=login");
        exit;
    }
    public function profile($id = null) {
        // If no ID provided, show current user's profile
        if ($id === null) {
            if (!isset($_SESSION['user_id'])) {
                header("Location: index.php?action=login");
                exit;
            }
            $id = $_SESSION['user_id'];
        }

        $user = $this->userModel->find($id);
        if (!$user) {
            header("Location: index.php?action=posts");
            exit;
        }

        require_once __DIR__ . '/../models/Post.php';
        
        $database = new Database();
        $db = $database->getConnection();
        $postModel = new Post($db);

        $posts = $postModel->getByUser($id);

        return $this->render('users/profile.php', compact('user', 'posts'));
    }
}

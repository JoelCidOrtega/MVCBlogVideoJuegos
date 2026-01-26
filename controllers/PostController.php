<?php

require_once __DIR__ . '/../models/Post.php';

class PostController {
    private $postModel;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->postModel = new Post($db);
    }

    protected function render(string $view, array $data = []) {
        extract($data);
        include __DIR__ . '/../views/' . $view;
    }

    public function index() {
        $posts = $this->postModel->allWithAuthor();
        return $this->render('posts/index.php', ['posts' => $posts]);
    }

    public function show($id) {
        $post = $this->postModel->find($id);
        if (!$post) {
            header("Location: index.php?action=posts");
            exit;
        }
        return $this->render('posts/show.php', compact('post'));
    }

    public function create() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }
        return $this->render('posts/create.php');
    }

// Modificar el método store en PostController.php
    public function store() {
        if (!isset($_SESSION['user_id'])) exit;

        $title = htmlspecialchars(trim($_POST['title']));
        $content = htmlspecialchars(trim($_POST['content']));
        $image_path = null;

        // Gestión de subida de imágenes
        if (!empty($_FILES['image']['name'])) {
            $target_dir = "public/uploads/";
            if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
            
            $file_name = time() . "_" . basename($_FILES["image"]["name"]);
            $target_file = $target_dir . $file_name;

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image_path = $target_file; // Guardar ruta en BD
            }
        }

        $this->postModel->store($title, $content, $image_path, $_SESSION['user_id']);
        header("Location: index.php?action=posts");
    }

    public function edit($id) {
        $post = $this->postModel->find($id);
        
        if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'admin' && $_SESSION['user_id'] != $post['user_id'])) {
            header("Location: index.php?action=posts");
            exit;
        }

        return $this->render('posts/edit.php', compact('post'));
    }

    public function update($id) {
        $post = $this->postModel->find($id);
        if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'admin' && $_SESSION['user_id'] != $post['user_id'])) {
            header("Location: index.php?action=posts");
            exit;
        }

        $title = trim($_POST['title']);
        $content = trim($_POST['content']);
        $image_url = trim($_POST['image_url'] ?? '');
        
        $this->postModel->update($id, $title, $content, $image_url);
        header("Location: index.php?action=show_post&id=$id");
    }

    public function destroy($id) {
        $post = $this->postModel->find($id);
        if (!isset($_SESSION['user_id']) || ($_SESSION['role'] !== 'admin' && $_SESSION['user_id'] != $post['user_id'])) {
            header("Location: index.php?action=posts");
            exit;
        }

        $this->postModel->delete($id);
        header("Location: index.php?action=posts");
    }
    
}

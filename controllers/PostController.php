<?php

require_once __DIR__ . '/../models/Post.php';
require_once __DIR__ . '/../models/Comment.php';

class PostController {
    private $postModel;
    private $db;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->postModel = new Post($db);
        $this->db = $db;
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
        $related_posts = $this->postModel->getRelatedPosts($id, $post['title']);
        $comments = (new Comment($this->db))->getByPost($id);
        return $this->render('posts/show.php', compact('post', 'comments', 'related_posts'));
    }

    public function create() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }
        return $this->render('posts/create.php');
    }

    public function store() {
        if (!isset($_SESSION['user_id'])) exit;

        $title = htmlspecialchars(trim($_POST['title']));
        $content = htmlspecialchars(trim($_POST['content']));
        $image_path = trim($_POST['image_url'] ?? '');

        if (empty($image_path) && !empty($_FILES['image']['name'])) {
            $target_dir = "public/uploads/";
            if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
            
            $file_name = time() . "_" . basename($_FILES["image"]["name"]);
            $target_file = $target_dir . $file_name;

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                $image_path = $target_file;
            }
        }

        // 1. Guardamos el post una sola vez y capturamos el ID
        $postId = $this->postModel->store($title, $content, $image_path, $_SESSION['user_id']);

        if ($postId) {
            $payload = [
                'id' => $postId,
                'title' => $title,
                'content' => $content,
                'author' => $_SESSION['username'],
                'url' => "http://localhost:8086/index.php?action=show_post&id=" . $postId
            ];
            
            // 2. Ahora este método ya existe abajo y no dará error
            $this->notifyN8N($payload);
        }

        // ELIMINADO: Se borró la segunda llamada a $this->postModel->store que duplicaba el post
        header("Location: index.php?action=posts");
    }

    private function notifyN8N($payload) {
        // CAMBIO: Añadimos "-test" a la URL para que n8n lo capture mientras editas el flujo
        $url = "http://mvc_n8n:5678/webhook-test/nueva-publicacion"; 
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json'
        ]);
        curl_setopt($ch, CURLOPT_TIMEOUT, 5); 
        
        // Opcional: Para debuggear si hay error de conexión
        $response = curl_exec($ch);
        $error = curl_error($ch);
        curl_close($ch);
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
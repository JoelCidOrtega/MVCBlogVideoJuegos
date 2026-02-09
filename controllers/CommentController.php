<?php
require_once __DIR__ . '/../models/Comment.php';
require_once __DIR__ . '/../config/Database.php';

class CommentController {
    private $commentModel;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->commentModel = new Comment($db);
    }

    public function store() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }

        $post_id = $_POST['post_id'] ?? null;
        $content = trim($_POST['content'] ?? '');

        if ($post_id && !empty($content)) {
            $this->commentModel->store($post_id, $_SESSION['user_id'], $content);
        }

        header("Location: index.php?action=show_post&id=" . $post_id);
    }

    public function delete($id) {
        if (!isset($_SESSION['user_id'])) {
            header("Location: index.php");
            exit;
        }
        $this->commentModel->delete($id);
        header("Location: " . $_SERVER['HTTP_REFERER']);
    }
}

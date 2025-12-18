<?php

require_once __DIR__ . '/../models/Comment.php';

class CommentController {
    private $commentModel;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        $this->commentModel = new Comment($db);
    }

    protected function render(string $view, array $data = []) {
        extract($data);
        include __DIR__ . '/../views/' . $view;
    }

    public function store() {
        if (empty($_SESSION['user_id'])) {
            header("Location: index.php?action=login");
            exit;
        }

        $postId = $_GET['post_id'];
        $text = trim($_POST['text']);

        if ($text === '') {
            header("Location: index.php?action=show_post&id=$postId");
            exit;
        }

        $this->commentModel->store($postId, $_SESSION['user_id'], $text);
        
        header("Location: index.php?action=show_post&id=$postId");
    }

    public function destroy($id) {
        $comment = $this->commentModel->find($id);
        if (!$comment) {
            header("Location: index.php?action=posts");
            exit;
        }

        $isOwner = isset($_SESSION['user_id']) && $comment['user_id'] == $_SESSION['user_id'];
        $isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';

        if (!$isOwner && !$isAdmin) {
            header("Location: index.php?action=show_post&id=" . $comment['post_id']);
            exit;
        }

        $this->commentModel->delete($id);
        
        header("Location: index.php?action=show_post&id=" . $comment['post_id']);
    }
}

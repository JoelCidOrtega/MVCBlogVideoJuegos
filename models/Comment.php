<?php
class Comment {
    private $db;
    public function __construct($db) { $this->db = $db; }

    public function getByPost($post_id) {
        $stmt = $this->db->prepare("SELECT comments.*, users.username FROM comments 
                                    JOIN users ON comments.user_id = users.id 
                                    WHERE post_id = ? ORDER BY created_at DESC");
        $stmt->execute([$post_id]);
        return $stmt->fetchAll();
    }

    public function store($post_id, $user_id, $content) {
        $stmt = $this->db->prepare("INSERT INTO comments (post_id, user_id, content) VALUES (?, ?, ?)");
        return $stmt->execute([$post_id, $user_id, htmlspecialchars($content)]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM comments WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
<?php

class Comment {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function byPost($postId) {
        $stmt = $this->db->prepare("SELECT comments.*, users.username FROM comments JOIN users ON comments.user_id = users.id WHERE post_id = ? ORDER BY created_at DESC");
        $stmt->execute([$postId]);
        return $stmt->fetchAll();
    }

    public function allWithPost() {
        $stmt = $this->db->query("SELECT comments.*, posts.title, users.username FROM comments JOIN posts ON comments.post_id = posts.id JOIN users ON comments.user_id = users.id ORDER BY comments.created_at DESC");
        return $stmt->fetchAll();
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM comments WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function store($postId, $userId, $text) {
        $stmt = $this->db->prepare("INSERT INTO comments (post_id, user_id, text) VALUES (?, ?, ?)");
        $stmt->execute([$postId, $userId, $text]);
        return $this->db->lastInsertId();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM comments WHERE id = ?");
        return $stmt->execute([$id]);
    }
}

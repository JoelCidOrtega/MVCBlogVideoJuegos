<?php

class Post {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function all() {
        $stmt = $this->db->query("SELECT * FROM posts ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    public function allWithAuthor() {
        $stmt = $this->db->query("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id ORDER BY posts.created_at DESC");
        return $stmt->fetchAll();
    }

    public function getByUser($user_id) {
        $stmt = $this->db->prepare("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id WHERE posts.user_id = ? ORDER BY posts.created_at DESC");
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT posts.*, users.username FROM posts JOIN users ON posts.user_id = users.id WHERE posts.id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function store($title, $content, $image_url, $user_id) {
        $stmt = $this->db->prepare("INSERT INTO posts (title, content, image_url, user_id) VALUES (?, ?, ?, ?)");
        try {
            $stmt->execute([$title, $content, $image_url, $user_id]);
        } catch (PDOException $e) {
            if ($e->getCode() === '42S22' || stripos($e->getMessage(), 'Unknown column') !== false) {
                $stmt2 = $this->db->prepare("INSERT INTO posts (title, content, user_id) VALUES (?, ?, ?)");
                $stmt2->execute([$title, $content, $user_id]);
            } else {
                throw $e;
            }
        }

        return $this->db->lastInsertId();
    }

    public function update($id, $title, $content, $image_url) {
        $stmt = $this->db->prepare("UPDATE posts SET title = ?, content = ?, image_url = ? WHERE id = ?");
        try {
            return $stmt->execute([$title, $content, $image_url, $id]);
        } catch (PDOException $e) {
            if ($e->getCode() === '42S22' || stripos($e->getMessage(), 'Unknown column') !== false) {
                $stmt2 = $this->db->prepare("UPDATE posts SET title = ?, content = ? WHERE id = ?");
                return $stmt2->execute([$title, $content, $id]);
            }
            throw $e;
        }
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM posts WHERE id = ?");
        return $stmt->execute([$id]);
    }
    public function getRelatedPosts($id, $title, $limit = 3) {
    // Buscamos posts similares por título y contenido, excluyendo el post actual
    // Usamos MATCH AGAINST para obtener una puntuación de relevancia
    $query = "SELECT p.*, u.username, 
              MATCH(p.title, p.content) AGAINST(:title) as relevance
              FROM posts p
              JOIN users u ON p.user_id = u.id
              WHERE p.id != :id
              HAVING relevance > 0
              ORDER BY relevance DESC
              LIMIT :limit";
    
    $stmt = $this->db->prepare($query);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    $stmt->bindValue(':title', $title);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->execute();
    
    return $stmt->fetchAll();
}
}

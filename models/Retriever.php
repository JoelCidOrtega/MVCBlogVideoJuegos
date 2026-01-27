<?php

class Retriever {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function search(string $query): array {
        $stmt = $this->db->prepare(
            "SELECT id, title, content, MATCH(title, content) AGAINST(? IN NATURAL LANGUAGE MODE) AS score 
             FROM posts 
             WHERE MATCH(title, content) AGAINST(? IN NATURAL LANGUAGE MODE)
             ORDER BY score DESC 
             LIMIT 5"
        );
        $stmt->execute([$query, $query]);
        return $stmt->fetchAll();
    }
}

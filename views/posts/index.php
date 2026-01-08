<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="posts-container">
    <h1>Blog de Videojuegos</h1>
    
    <?php if (isset($_SESSION['user_id'])): ?>
        <p><a href="index.php?action=create_post" class="button">Nuevo Post</a></p>
    <?php endif; ?>

    <div class="posts-grid">
        <?php foreach ($posts as $post): ?>
            <article class="post-card">
                <h2><?= htmlspecialchars($post['title']) ?></h2>
                <div class="post-meta">
                    Por <?= htmlspecialchars($post['username']) ?> | <?= date('d/m/Y', strtotime($post['created_at'])) ?>
                </div>
                <p>
                    <?= nl2br(htmlspecialchars(substr($post['content'], 0, 150))) ?>...
                </p>
                <a href="index.php?action=show_post&id=<?= $post['id'] ?>">Leer más</a>
            </article>
        <?php endforeach; ?>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>

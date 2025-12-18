<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="post-detail">
    <article>
        <h1><?= htmlspecialchars($post['title']) ?></h1>
        <div class="post-meta">
            Autor: <?= htmlspecialchars($post['username']) ?> | Fecha: <?= date('d/m/Y', strtotime($post['created_at'])) ?>
        </div>
        
        <?php if (!empty($post['image_url'])): ?>
            <img src="<?= htmlspecialchars($post['image_url']) ?>" alt="Imagen del post" style="max-width: 100%; height: auto; margin: 20px 0;">
        <?php endif; ?>

        <div class="content">
            <?= nl2br(htmlspecialchars($post['content'])) ?>
        </div>
        
        <?php if (isset($_SESSION['user_id']) && ($_SESSION['role'] === 'admin' || $_SESSION['user_id'] == $post['user_id'])): ?>
            <div class="actions" style="margin-top: 20px;">
                <a href="index.php?action=edit_post&id=<?= $post['id'] ?>" class="button">Editar</a>
                <a href="index.php?action=delete_post&id=<?= $post['id'] ?>" onclick="return confirm('¿Seguro?')" class="button delete">Borrar</a>
            </div>
        <?php endif; ?>
    </article>

    <hr>

    <div class="comments-section">
        <h3>Comentarios (<?= count($comments) ?>)</h3>
        
        <?php if (isset($_SESSION['user_id'])): ?>
            <form method="POST" action="index.php?action=comment_store&post_id=<?= $post['id'] ?>">
                <div class="form-group">
                    <textarea name="text" rows="3" required placeholder="Escribe un comentario..."></textarea>
                </div>
                <button type="submit">Enviar Comentario</button>
            </form>
        <?php else: ?>
            <p><a href="index.php?action=login">Inicia sesión</a> para comentar.</p>
        <?php endif; ?>

        <div class="comments-list">
            <?php foreach ($comments as $comment): ?>
                <div class="comment-item" style="border-top: 1px solid #eee; padding: 10px 0;">
                    <strong><?= htmlspecialchars($comment['username']) ?></strong>
                    <small>(<?= date('d/m/Y H:i', strtotime($comment['created_at'])) ?>)</small>
                    <p><?= nl2br(htmlspecialchars($comment['text'])) ?></p>
                    
                    <?php if (isset($_SESSION['user_id']) && ($_SESSION['role'] === 'admin' || $_SESSION['user_id'] == $comment['user_id'])): ?>
                        <a href="index.php?action=delete_comment&id=<?= $comment['id'] ?>" onclick="return confirm('¿Borrar comentario?')" style="color: red;">Borrar</a>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>

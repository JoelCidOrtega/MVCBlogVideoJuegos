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

</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>

<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="user-form">
    <h2>Editar Post</h2>
    
    <?php if (isset($error)): ?>
        <div class="alert">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php?action=update_post&id=<?= $post['id'] ?>">
        <div class="form-group">
            <label>Título</label>
            <input type="text" name="title" value="<?= htmlspecialchars($post['title']) ?>" required>
        </div>

        <div class="form-group">
            <label>URL de Imagen</label>
            <input type="url" name="image_url" value="<?= htmlspecialchars($post['image_url'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label>Contenido</label>
            <textarea name="content" rows="10" required><?= htmlspecialchars($post['content']) ?></textarea>
        </div>

        <button type="submit">Actualizar Post</button>
        <a href="index.php?action=show_post&id=<?= $post['id'] ?>" style="margin-left: 10px;">Cancelar</a>
    </form>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>

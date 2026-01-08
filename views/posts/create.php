<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="user-form">
    <h2>Crear Nuevo Post</h2>
    
    <?php if (isset($error)): ?>
        <div class="alert">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php?action=store_post">
        <div class="form-group">
            <label>Título</label>
            <input type="text" name="title" required>
        </div>
        
        <div class="form-group">
            <label>URL de Imagen (Opcional)</label>
            <input type="url" name="image_url" placeholder="https://...">
        </div>

        <div class="form-group">
            <label>Contenido</label>
            <textarea name="content" rows="10" required></textarea>
        </div>

        <button type="submit">Publicar</button>
    </form>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>

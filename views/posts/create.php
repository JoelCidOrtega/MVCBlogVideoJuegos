<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="user-form">
    <h2>Crear Nuevo Post</h2>
    
    <?php if (isset($error)): ?>
        <div class="alert">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

<form method="POST" action="index.php?action=store_post" enctype="multipart/form-data">
    <div class="form-group">
        <label>Título del Videojuego</label>
        <input type="text" name="title" required>
    </div>
    <div class="form-group">
        <label>Imagen Destacada</label>
        <input type="file" name="image" accept="image/*">
    </div>
    <div class="form-group">
        <label>Análisis / Contenido</label>
        <textarea name="content" rows="8" required></textarea>
    </div>
    <button type="submit">Publicar en el Blog</button>
</form>

<?php include __DIR__ . '/../layout/footer.php'; ?>

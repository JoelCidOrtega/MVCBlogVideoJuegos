<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="user-form">
    <h2>Iniciar Sesión</h2>
    
    <?php if (isset($error)): ?>
        <div class="alert">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php?action=login">
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>
        <div class="form-group">
            <label>Contraseña</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit">Entrar</button>
    </form>
    <p>
        ¿No tienes cuenta? <a href="index.php?action=register">Regístrate aquí</a>
    </p>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>

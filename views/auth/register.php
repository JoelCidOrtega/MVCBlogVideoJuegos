<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="user-form">
    <h2>Registro</h2>
    
    <?php if (isset($error)): ?>
        <div class="alert">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php?action=register">
        <div class="form-group">
            <label>Usuario</label>
            <input type="text" name="username" required>
        </div>
        <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" required>
        </div>
        <div class="form-group">
            <label>Contraseña</label>
            <input type="password" name="password" required>
        </div>
        <button type="submit">Registrarse</button>
    </form>
    <p>
        ¿Ya tienes cuenta? <a href="index.php?action=login">Inicia sesión</a>
    </p>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>

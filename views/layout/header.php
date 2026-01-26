<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog de Videojuegos</title>
    <link rel="stylesheet" href="public/style.css">
</head>
<body>
    <header>
        <nav>
            <div class="logo">
                <a href="index.php">GameBlog</a>
            </div>
                <ul>
                    <li><a href="index.php?action=posts">Inicio</a></li>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <li><a href="index.php?action=create_post">Nuevo Post</a></li>
                        
                        <?php if ($_SESSION['role'] === 'admin'): ?>
                            <li><a href="index.php?action=admin" style="color: var(--secondary-pink); font-weight: bold;">PANEL ADMIN</a></li>
                        <?php endif; ?>
                        
                        <li><a href="index.php?action=logout">Salir (<?= htmlspecialchars($_SESSION['username'] ?? '') ?>)</a></li>
                    <?php else: ?>
                        <li><a href="index.php?action=login">Entrar</a></li>
                        <li><a href="index.php?action=register">Registro</a></li>
                    <?php endif; ?>
                </ul>
        </nav>
    </header>
    <main class="container">

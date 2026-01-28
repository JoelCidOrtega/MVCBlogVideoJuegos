<!DOCTYPE html>
<html lang="es" class="h-full bg-slate-900">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GameBlog</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="h-full text-slate-300 flex flex-col antialiased">
    <header class="bg-slate-800 border-b border-slate-700">
        <div class="max-w-5xl mx-auto px-4 h-16 flex items-center justify-between">
            <a href="index.php" class="text-xl font-bold text-white hover:text-blue-400 transition-colors">
                GameBlog
            </a>
            
            <div class="flex items-center gap-6">
                <nav class="hidden md:flex gap-4 text-sm font-medium">
                    <a href="index.php?action=posts" class="hover:text-white transition-colors">Inicio</a>
                    <?php if (isset($_SESSION['user_id']) && $_SESSION['role'] === 'admin'): ?>
                        <a href="index.php?action=admin" class="hover:text-white transition-colors">Admin</a>
                    <?php endif; ?>
                </nav>

                <div class="flex items-center gap-3">
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <a href="index.php?action=profile" class="text-sm text-slate-400 hover:text-white transition-colors mr-2">Mi Perfil</a>
                        <span class="text-sm text-slate-400 hidden sm:inline-block"><?= htmlspecialchars($_SESSION['username']) ?></span>
                        
                        <a href="index.php?action=create_post" class="bg-blue-600 hover:bg-blue-500 text-white px-4 py-2 rounded text-sm font-bold transition-colors shadow-lg shadow-blue-900/20">
                            + Publicar
                        </a>

                        <a href="index.php?action=logout" class="text-sm text-slate-400 hover:text-red-400 ml-2">Salir</a>
                    <?php else: ?>
                        <a href="index.php?action=login" class="text-sm font-medium hover:text-white">Entrar</a>
                        <a href="index.php?action=register" class="text-sm font-bold text-blue-400 hover:text-blue-300">Registro</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </header>
    
    <main class="flex-grow py-8 px-4">
        <div class="max-w-5xl mx-auto">
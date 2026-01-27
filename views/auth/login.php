<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="max-w-sm mx-auto mt-12 bg-slate-800 p-6 rounded border border-slate-700 shadow-lg">
    <h2 class="text-xl font-bold text-white mb-6 text-center">Iniciar Sesión</h2>
    
    <?php if (isset($error)): ?>
        <div class="bg-red-900/20 text-red-200 p-3 rounded mb-4 text-xs border border-red-900/30">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="index.php?action=login" class="space-y-4">
        <div>
            <label class="block text-xs font-bold text-slate-400 mb-1 uppercase">Email</label>
            <input type="email" name="email" required class="w-full bg-slate-900 border border-slate-600 rounded p-2 text-white focus:border-blue-500 outline-none text-sm">
        </div>
        
        <div>
            <label class="block text-xs font-bold text-slate-400 mb-1 uppercase">Contraseña</label>
            <input type="password" name="password" required class="w-full bg-slate-900 border border-slate-600 rounded p-2 text-white focus:border-blue-500 outline-none text-sm">
        </div>

        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 rounded text-sm transition-colors">
            Entrar
        </button>
    </form>
    
    <div class="mt-4 text-center">
        <a href="index.php?action=register" class="text-xs text-blue-400 hover:text-white">¿No tienes cuenta? Regístrate</a>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>

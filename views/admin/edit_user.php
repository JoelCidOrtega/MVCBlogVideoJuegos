<?php include __DIR__ . '/../../views/layout/header.php'; ?>

<div class="max-w-2xl mx-auto mt-8">
    <div class="bg-slate-800 rounded border border-slate-700 p-6 shadow-lg">
        <h2 class="text-xl font-bold text-white mb-6 border-b border-slate-700 pb-2">Editar Usuario</h2>
        
        <form method="POST" action="index.php?action=update_user&id=<?= $user['id'] ?>" class="space-y-4">
            <div>
                <label class="block text-sm font-bold text-slate-400 mb-1">Nombre de Usuario</label>
                <input type="text" name="username" value="<?= htmlspecialchars($user['username']) ?>" required class="w-full bg-slate-900 border border-slate-600 rounded p-2 text-white focus:border-blue-500 outline-none">
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-400 mb-1">Email</label>
                <input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required class="w-full bg-slate-900 border border-slate-600 rounded p-2 text-white focus:border-blue-500 outline-none">
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-400 mb-1">Rol</label>
                <select name="role" class="w-full bg-slate-900 border border-slate-600 rounded p-2 text-white focus:border-blue-500 outline-none">
                    <option value="subscriber" <?= $user['role'] === 'subscriber' ? 'selected' : '' ?>>Suscriptor</option>
                    <option value="writer" <?= $user['role'] === 'writer' ? 'selected' : '' ?>>Redactor</option>
                    <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Administrador</option>
                </select>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-700">
                <a href="index.php?action=admin" class="px-4 py-2 border border-slate-600 text-slate-400 rounded hover:text-white hover:border-slate-500 text-sm transition-colors">Cancelar</a>
                <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded text-sm shadow transition-colors">
                    Guardar Cambios
                </button>
            </div>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../../views/layout/footer.php'; ?>

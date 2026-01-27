<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="max-w-5xl mx-auto px-4">
    <div class="border-b border-slate-700 pb-4 mb-6">
        <h1 class="text-2xl font-bold text-white">Administración</h1>
        <p class="text-slate-400 text-sm">Gestionar usuarios y permisos.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <section class="md:col-span-1">
            <div class="bg-slate-800 p-4 rounded border border-slate-700">
                <h3 class="text-sm font-bold text-white mb-3 uppercase tracking-wide border-b border-slate-700 pb-2">Nuevo Usuario</h3>
                <form action="index.php?action=store_user" method="POST" class="space-y-3">
                    <input type="text" name="username" placeholder="Nombre" required class="w-full bg-slate-900 border border-slate-600 rounded p-2 text-sm text-white focus:border-blue-500 outline-none">
                    <input type="email" name="email" placeholder="Email" required class="w-full bg-slate-900 border border-slate-600 rounded p-2 text-sm text-white focus:border-blue-500 outline-none">
                    <input type="password" name="password" placeholder="Contraseña" required class="w-full bg-slate-900 border border-slate-600 rounded p-2 text-sm text-white focus:border-blue-500 outline-none">
                    <select name="role" class="w-full bg-slate-900 border border-slate-600 rounded p-2 text-sm text-white focus:border-blue-500 outline-none">
                        <option value="subscriber">Suscriptor</option>
                        <option value="writer">Redactor</option>
                        <option value="admin">Administrador</option>
                    </select>
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 rounded text-sm transition-colors shadow">
                        Añadir
                    </button>
                </form>
            </div>
        </section>

        <section class="md:col-span-3">
            <div class="bg-slate-800 rounded border border-slate-700 overflow-hidden">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-slate-900 text-slate-400 text-xs uppercase">
                        <tr>
                            <th class="px-4 py-2 border-b border-slate-700 font-bold">ID</th>
                            <th class="px-4 py-2 border-b border-slate-700 font-bold">Usuario</th>
                            <th class="px-4 py-2 border-b border-slate-700 font-bold">Email</th>
                            <th class="px-4 py-2 border-b border-slate-700 font-bold">Rol</th>
                            <th class="px-4 py-2 border-b border-slate-700 font-bold text-right">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm text-slate-300 divide-y divide-slate-700">
                        <?php foreach ($users as $u): ?>
                        <tr class="hover:bg-slate-700/50 transition-colors">
                            <td class="px-4 py-2 font-mono text-xs text-slate-500"><?= $u['id'] ?></td>
                            <td class="px-4 py-2 font-bold text-white"><?= htmlspecialchars($u['username']) ?></td>
                            <td class="px-4 py-2 text-slate-400"><?= htmlspecialchars($u['email']) ?></td>
                            <td class="px-4 py-2 text-slate-400">
                                <?= htmlspecialchars(ucfirst($u['role'])) ?>
                            </td>
                            <td class="px-4 py-2 text-right space-x-2">
                                <a href="index.php?action=edit_user&id=<?= $u['id'] ?>" class="text-blue-400 hover:text-blue-300 font-bold text-xs uppercase hover:underline">
                                    Editar
                                </a>
                                <a href="index.php?action=delete_user&id=<?= $u['id'] ?>" onclick="return confirm('¿Eliminar?')" class="text-red-400 hover:text-red-300 font-bold text-xs uppercase hover:underline">
                                    Borrar
                                </a>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>
<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="max-w-2xl mx-auto">
    <div class="bg-slate-800 rounded border border-slate-700 p-6 shadow-lg">
        <h2 class="text-xl font-bold text-white mb-6 border-b border-slate-700 pb-2">Nueva Publicación</h2>
        
        <?php if (isset($error)): ?>
            <div class="bg-red-900/20 text-red-200 p-3 rounded mb-4 text-sm border border-red-900/30">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form method="POST" action="index.php?action=store_post" enctype="multipart/form-data" class="space-y-4">
            <div>
                <label class="block text-sm font-bold text-slate-400 mb-1">Título</label>
                <input type="text" name="title" required class="w-full bg-slate-900 border border-slate-600 rounded p-2 text-white focus:border-blue-500 outline-none">
            </div>
            
            <div>
                <label class="block text-sm font-bold text-slate-400 mb-1">Imagen (Opcional)</label>
                <input type="file" name="image" accept="image/*" class="w-full text-slate-500 text-sm file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:bg-slate-700 file:text-white hover:file:bg-slate-600">
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-400 mb-1">Contenido</label>
                <textarea name="content" rows="10" required class="w-full bg-slate-900 border border-slate-600 rounded p-2 text-white focus:border-blue-500 outline-none font-sans"></textarea>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-slate-700">
                <a href="index.php" class="px-4 py-2 border border-slate-600 text-slate-400 rounded hover:text-white hover:border-slate-500 text-sm transition-colors">Cancelar</a>
                <button type="submit" class="px-6 py-2 bg-blue-600 hover:bg-blue-500 text-white font-bold rounded text-sm shadow transition-colors">
                    Publicar
                </button>
            </div>
        </form>
    </div>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>

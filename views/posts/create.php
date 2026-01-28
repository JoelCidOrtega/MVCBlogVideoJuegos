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
            
            <div class="bg-slate-900/50 p-4 rounded border border-slate-700">
                <label class="block text-sm font-bold text-slate-400 mb-3">Imagen de Portada (Opcional)</label>
                
                <div class="space-y-4">
                    <div>
                        <label class="text-xs text-slate-500 uppercase font-bold mb-1 block">Opción 1: Pegar URL</label>
                        <input type="url" name="image_url" id="image_url" 
                               class="w-full bg-slate-800 border border-slate-600 rounded p-2 text-white focus:border-blue-500 outline-none placeholder-slate-600 text-sm" 
                               placeholder="https://..."
                               onchange="if(this.value) document.getElementById('image_file').value = '';">
                    </div>

                    <div class="relative flex py-1 items-center">
                        <div class="flex-grow border-t border-slate-700"></div>
                        <span class="flex-shrink-0 mx-2 text-slate-600 text-[10px] uppercase">O</span>
                        <div class="flex-grow border-t border-slate-700"></div>
                    </div>

                    <div>
                        <label class="text-xs text-slate-500 uppercase font-bold mb-1 block">Opción 2: Subir Archivo</label>
                        <input type="file" name="image" id="image_file" accept="image/*" 
                               class="w-full text-slate-400 text-sm file:mr-4 file:py-2 file:px-4 file:rounded file:border-0 file:bg-slate-700 file:text-white hover:file:bg-slate-600 cursor-pointer"
                               onchange="if(this.value) document.getElementById('image_url').value = '';">
                    </div>
                </div>
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

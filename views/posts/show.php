<?php include __DIR__ . '/../layout/header.php'; ?>

<article class="max-w-3xl mx-auto bg-slate-800 rounded border border-slate-700 overflow-hidden shadow-sm">
    <div class="p-6 border-b border-slate-700">
        <h1 class="text-2xl md:text-3xl font-bold text-white mb-3"><?= htmlspecialchars($post['title']) ?></h1>
        <div class="text-xs text-slate-400 uppercase tracking-wide flex items-center gap-2">
            Por <span class="text-blue-400 font-bold"><?= htmlspecialchars($post['username']) ?></span> 
            <span>•</span> 
            <span><?= date('d M Y', strtotime($post['created_at'])) ?></span>
        </div>
    </div>

    <?php if (!empty($post['image_url']) || !empty($post['image_path'])): 
        $img = !empty($post['image_path']) ? $post['image_path'] : $post['image_url'];
        if (!empty($img)):
            $isUrl = filter_var($img, FILTER_VALIDATE_URL) || strpos($img, 'http') === 0;
            if ($isUrl) {
                $src = $img;
            } else {
                if (strpos($img, 'public/uploads') === false) {
                    $src = 'public/uploads/' . basename($img);
                } else {
                    $src = $img;
                }
            }
    ?>
        <div class="w-full bg-slate-900 flex justify-center border-b border-slate-700">
            <img src="<?= htmlspecialchars($src) ?>" 
                 alt="<?= htmlspecialchars($post['title']) ?>" 
                 class="max-h-[600px] w-auto object-contain"
                 onerror="this.style.display='none'">
        </div>
    <?php endif; endif; ?>

    <div class="p-8 text-slate-300 leading-relaxed text-base whitespace-pre-line">
        <?= nl2br(htmlspecialchars($post['content'])) ?>
    </div>

    <?php if (isset($_SESSION['user_id']) && ($_SESSION['role'] === 'admin' || $_SESSION['user_id'] == $post['user_id'])): ?>
        <div class="p-4 bg-slate-900/50 border-t border-slate-700 flex gap-3">
            <a href="index.php?action=edit_post&id=<?= $post['id'] ?>" class="px-4 py-2 bg-slate-700 text-white rounded text-sm hover:bg-slate-600 font-bold transition-colors">
                Editar
            </a>
            <a href="index.php?action=delete_post&id=<?= $post['id'] ?>" onclick="return confirm('¿Borrar?')" class="px-4 py-2 bg-red-900/30 text-red-200 border border-red-900/50 rounded text-sm hover:bg-red-900/50 font-bold transition-colors">
                Eliminar
            </a>
        </div>
    <?php endif; ?>
</article>

<div class="max-w-3xl mx-auto mt-6 mb-12">
    <a href="index.php" class="text-sm text-slate-500 hover:text-white font-bold flex items-center gap-1 transition-colors">
        <span>&larr;</span> Volver a la lista
    </a>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>

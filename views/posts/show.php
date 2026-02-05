<?php include __DIR__ . '/../layout/header.php'; ?>

<article class="max-w-3xl mx-auto bg-slate-800 rounded border border-slate-700 overflow-hidden shadow-sm">
    <div class="p-6 border-b border-slate-700">
        <h1 class="text-2xl md:text-3xl font-bold text-white mb-3"><?= htmlspecialchars($post['title']) ?></h1>
        <div class="text-xs text-slate-400 uppercase tracking-wide flex items-center gap-2">
            Por <a href="index.php?action=profile&id=<?= $post['user_id'] ?>" class="text-blue-400 font-bold hover:text-blue-300 transition-colors"><?= htmlspecialchars($post['username']) ?></a> 
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

<div class="max-w-xl mx-auto mt-8 bg-slate-800 p-6 rounded border border-slate-700 shadow-sm">
    <h3 class="text-xl font-bold text-white mb-4 border-b border-slate-700 pb-2">Comentarios</h3>

    <?php if (!empty($comments)): ?>
        <div class="space-y-4 mb-8">
            <?php foreach ($comments as $comment): ?>
                <div class="border-b border-slate-700 pb-4 last:border-0 last:pb-0">
                    <div class="flex justify-between items-start mb-2">
                        <div class="text-sm">
                            <span class="text-blue-400 font-bold"><?= htmlspecialchars($comment['username']) ?></span>
                            <span class="text-slate-500 text-xs ml-2"><?= date('d M Y H:i', strtotime($comment['created_at'])) ?></span>
                        </div>
                        <?php if (isset($_SESSION['user_id']) && ($_SESSION['role'] === 'admin' || $_SESSION['user_id'] == $comment['user_id'])): ?>
                            <a href="index.php?action=delete_comment&id=<?= $comment['id'] ?>" 
                               onclick="return confirm('¿Borrar comentario?')"
                               class="text-red-400 hover:text-red-300 text-xs font-bold px-2 py-1 bg-red-900/20 rounded">
                                Eliminar
                            </a>
                        <?php endif; ?>
                    </div>
                    <p class="text-slate-300 text-sm whitespace-pre-line"><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p class="text-slate-500 italic mb-6">Sé el primero en comentar.</p>
    <?php endif; ?>

    <?php if (isset($_SESSION['user_id'])): ?>
        <form action="index.php?action=store_comment" method="POST" class="mt-6">
            <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
            <div class="mb-3">
                <label for="content" class="block text-slate-400 text-sm font-bold mb-2">Añadir comentario:</label>
                <textarea name="content" id="content" rows="3" required
                    class="w-full bg-slate-900 border border-slate-700 rounded p-3 text-slate-200 focus:outline-none focus:border-blue-500 transition-colors"
                    placeholder="Escribe tu opinión..."></textarea>
            </div>
            <button type="submit" class="bg-blue-600 hover:bg-blue-500 text-white font-bold py-2 px-4 rounded text-sm transition-colors">
                Publicar comentario
            </button>
        </form>
    <?php else: ?>
        <div class="bg-slate-900/50 p-4 rounded text-center border border-slate-700 border-dashed">
            <p class="text-slate-400 text-sm">
                <a href="index.php?action=login" class="text-blue-400 hover:text-blue-300 font-bold">Inicia sesión</a> 
                para dejar un comentario.
            </p>
        </div>
    <?php endif; ?>
</div>
<?php if (!empty($related_posts)): ?>
<div class="max-w-3xl mx-auto mt-8">
    <h3 class="text-sm font-bold text-blue-400 mb-4 uppercase tracking-widest">También te puede interesar:</h3>
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <?php foreach ($related_posts as $r): ?>
            <a href="index.php?action=show_post&id=<?= $r['id'] ?>" class="group block bg-slate-800 border border-slate-700 rounded-lg overflow-hidden hover:border-blue-500 transition-all shadow-sm">
                <?php 
                $img = !empty($r['image_path']) ? $r['image_path'] : $r['image_url'];
                if (!empty($img)):
                    $isUrl = filter_var($img, FILTER_VALIDATE_URL) || strpos($img, 'http') === 0;
                    $src = $isUrl ? $img : (strpos($img, 'public/uploads') === false ? 'public/uploads/' . basename($img) : $img);
                ?>
                    <img src="<?= htmlspecialchars($src) ?>" class="w-full h-24 object-cover opacity-80 group-hover:opacity-100 transition-opacity">
                <?php else: ?>
                    <div class="w-full h-24 bg-slate-900 flex items-center justify-center text-slate-700">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                <?php endif; ?>
                <div class="p-3">
                    <h4 class="text-white font-bold text-xs line-clamp-2 group-hover:text-blue-400 transition-colors">
                        <?= htmlspecialchars($r['title']) ?>
                    </h4>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>
<?php endif; ?>
<div class="max-w-3xl mx-auto mt-6 mb-12">
    <a href="index.php" class="text-sm text-slate-500 hover:text-white font-bold flex items-center gap-1 transition-colors">
        <span>&larr;</span> Volver a la lista
    </a>
</div>



<?php include __DIR__ . '/../layout/footer.php'; ?>

<?php include __DIR__ . '/../layout/header.php'; ?>

<?php if (!isset($_SESSION['user_id'])): ?>
    <div class="mb-6 p-3 bg-slate-800/50 border border-slate-700 rounded text-center text-sm text-slate-400">
        <a href="index.php?action=register" class="text-blue-400 hover:text-blue-300 font-bold">Regístrate</a> para publicar tus posts.
    </div>
<?php endif; ?>

<?php if (empty($posts)): ?>
    <div class="bg-slate-800 p-8 rounded border border-slate-700 text-center">
        <p class="text-slate-400">No hay publicaciones aún.</p>
    </div>
<?php else: ?>
    <div class="flex flex-col gap-6 max-w-3xl mx-auto">
        <?php foreach ($posts as $post): ?>
            <article class="bg-slate-800 rounded border border-slate-700 overflow-hidden shadow-sm">
                <?php 
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
                    <div class="h-64 w-full bg-slate-900 overflow-hidden relative group">
                        <img src="<?= htmlspecialchars($src) ?>" 
                             alt="<?= htmlspecialchars($post['title']) ?>" 
                             class="w-full h-full object-cover opacity-90 group-hover:opacity-100 transition-opacity duration-500"
                             onerror="this.onerror=null; this.src='https://via.placeholder.com/800x400?text=No+Image'; this.parentElement.style.display='none';"> 
                    </div>
                <?php endif; ?>

                <div class="p-6">
                    <div class="flex justify-between items-center text-xs text-slate-500 mb-2 uppercase tracking-wide">
                        <span class="text-blue-400 font-bold"><?= htmlspecialchars($post['username']) ?></span>
                        <span><?= date('d M Y', strtotime($post['created_at'])) ?></span>
                    </div>

                    <h2 class="text-xl font-bold text-white mb-2">
                        <a href="index.php?action=show_post&id=<?= $post['id'] ?>" class="hover:text-blue-400">
                            <?= htmlspecialchars($post['title']) ?>
                        </a>
                    </h2>
                    
                    <p class="text-slate-400 text-sm mb-4 line-clamp-3">
                        <?= nl2br(htmlspecialchars(substr($post['content'], 0, 200))) ?>...
                    </p>
                    
                    <a href="index.php?action=show_post&id=<?= $post['id'] ?>" class="text-sm font-bold text-blue-400 hover:text-white uppercase transition-colors">
                        Leer más &rarr;
                    </a>
                </div>
            </article>
        <?php endforeach; ?>
    </div>
<?php endif; ?>

<?php include __DIR__ . '/../layout/footer.php'; ?>

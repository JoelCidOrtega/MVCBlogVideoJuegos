<?php include __DIR__ . '/../layout/header.php'; ?>

<div class="max-w-4xl mx-auto">
    <!-- Profile Header -->
    <div class="bg-slate-800 rounded border border-slate-700 p-8 shadow-lg mb-8 text-center md:text-left md:flex items-center gap-8">
        <div class="w-32 h-32 bg-slate-700 rounded-full flex items-center justify-center text-4xl font-bold text-slate-400 mx-auto md:mx-0 shrink-0 border-4 border-slate-600">
            <?= strtoupper(substr($user['username'], 0, 1)) ?>
        </div>
        <div>
            <h1 class="text-3xl font-bold text-white mb-2"><?= htmlspecialchars($user['username']) ?></h1>
            <div class="flex flex-wrap gap-4 justify-center md:justify-start text-sm text-slate-400">
                <span class="bg-blue-900/30 text-blue-300 px-3 py-1 rounded-full border border-blue-900/50 capitalize">
                    <?= htmlspecialchars($user['role']) ?>
                </span>
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Miembro desde: <?= date('d M Y', strtotime($user['created_at'])) ?>
                </span>
                <span class="flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path></svg>
                    Publicaciones: <?= count($posts) ?>
                </span>
            </div>
        </div>
    </div>

    <!-- User Posts -->
    <h2 class="text-xl font-bold text-white mb-6 flex items-center gap-2">
        <span>Publicaciones de <?= htmlspecialchars($user['username']) ?></span>
        <div class="h-px bg-slate-700 flex-grow ml-4"></div>
    </h2>

    <?php if (empty($posts)): ?>
        <p class="text-slate-500 italic text-center py-12 bg-slate-900/50 rounded border border-slate-700 border-dashed">
            Este usuario aún no ha publicado nada.
        </p>
    <?php else: ?>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($posts as $post): ?>
                <article class="bg-slate-800 rounded border border-slate-700 overflow-hidden hover:border-blue-500/50 transition-colors flex flex-col h-full shadow-lg group">
                    <?php if (!empty($post['image_url']) || !empty($post['image_path'])): 
                        $img = !empty($post['image_path']) ? $post['image_path'] : $post['image_url'];
                        if (!empty($img)):
                             // Logic to handle uploads path vs URL
                            $src = $img;
                            if (strpos($img, 'http') !== 0 && strpos($img, 'public/uploads') === false && !filter_var($img, FILTER_VALIDATE_URL)) {
                                $src = 'public/uploads/' . basename($img);
                            }
                    ?>
                        <div class="aspect-video w-full bg-slate-900 overflow-hidden relative">
                             <img src="<?= htmlspecialchars($src) ?>" 
                                  alt="<?= htmlspecialchars($post['title']) ?>" 
                                  class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                  onerror="this.style.display='none'">
                        </div>
                    <?php endif; endif; ?>
                    
                    <div class="p-5 flex flex-col flex-grow">
                        <div class="text-xs text-slate-400 mb-2"><?= date('d M Y', strtotime($post['created_at'])) ?></div>
                        <h3 class="text-lg font-bold text-white mb-2 line-clamp-2 group-hover:text-blue-400 transition-colors">
                            <a href="index.php?action=show_post&id=<?= $post['id'] ?>">
                                <?= htmlspecialchars($post['title']) ?>
                            </a>
                        </h3>
                        <p class="text-slate-400 text-sm mb-4 line-clamp-3">
                            <?= htmlspecialchars(substr($post['content'], 0, 100)) ?>...
                        </p>
                        <div class="mt-auto pt-4 border-t border-slate-700/50">
                            <a href="index.php?action=show_post&id=<?= $post['id'] ?>" class="text-blue-400 text-sm font-bold hover:text-blue-300">Leer más &rarr;</a>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../layout/footer.php'; ?>

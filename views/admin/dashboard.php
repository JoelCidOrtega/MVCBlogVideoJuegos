<?php include __DIR__ . '/../layout/header.php'; ?>

<h2>Gestión de Usuarios</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Usuario</th>
            <th>Email</th>
            <th>Rol</th>
            <th>Acción</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $u): ?>
        <tr>
            <td><?= $u['id'] ?></td>
            <td><?= htmlspecialchars($u['username']) ?></td>
            <td><?= htmlspecialchars($u['email']) ?></td>
            <td>
                <form method="POST" action="index.php?action=update_role">
                    <input type="hidden" name="user_id" value="<?= $u['id'] ?>">
                    <select name="role" onchange="this.form.submit()">
                        <option value="subscriber" <?= $u['role'] == 'subscriber' ? 'selected' : '' ?>>Suscriptor</option>
                        <option value="writer" <?= $u['role'] == 'writer' ? 'selected' : '' ?>>Redactor</option>
                        <option value="admin" <?= $u['role'] == 'admin' ? 'selected' : '' ?>>Admin</option>
                    </select>
                </form>
            </td>
            <td><a href="#" style="color: red;">Eliminar</a></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include __DIR__ . '/../layout/footer.php'; ?>
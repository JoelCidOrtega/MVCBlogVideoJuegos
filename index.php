<?php

session_start();

require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/controllers/PostController.php';
require_once __DIR__ . '/controllers/UserController.php';

$action = $_GET['action'] ?? 'posts';

switch ($action) {
    case 'login':
        (new UserController())->login();
        break;
    case 'register':
        (new UserController())->register();
        break;
    case 'logout':
        (new UserController())->logout();
        break;

    case 'posts':
        (new PostController())->index();
        break;
    case 'show_post':
        $id = $_GET['id'] ?? 0;
        (new PostController())->show($id);
        break;
    case 'create_post':
        (new PostController())->create();
        break;
    case 'store_post':
        (new PostController())->store();
        break;
    case 'edit_post':
        $id = $_GET['id'] ?? 0;
        (new PostController())->edit($id);
        break;
    case 'update_post':
        $id = $_GET['id'] ?? 0;
        (new PostController())->update($id);
        break;
    case 'delete_post':
        $id = $_GET['id'] ?? 0;
        (new PostController())->destroy($id);
        break;

    case 'admin':
        require_once 'controllers/AdminController.php';
        (new AdminController())->dashboard();
        break;
    case 'update_role':
        require_once 'controllers/AdminController.php';
        (new AdminController())->changeRole();
        break;

    default:
        (new PostController())->index();
        break;
}

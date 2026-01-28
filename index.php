<?php

session_start();

require_once __DIR__ . '/config/Database.php';
require_once __DIR__ . '/controllers/PostController.php';
require_once __DIR__ . '/controllers/UserController.php';
require_once __DIR__ . '/controllers/CommentController.php';

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
    case 'profile':
        (new UserController())->profile($_GET['id'] ?? null);
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

    case 'store_comment':
        (new CommentController())->store();
        break;
    case 'delete_comment':
        $id = $_GET['id'] ?? 0;
        (new CommentController())->delete($id);
        break;

    case 'store_user':
        require_once 'controllers/AdminController.php';
        (new AdminController())->storeUser();
        break;
    case 'admin':
        require_once 'controllers/AdminController.php';
        (new AdminController())->dashboard();
        break;
    case 'edit_user':
        require_once 'controllers/AdminController.php';
        (new AdminController())->editUser($_GET['id'] ?? 0);
        break;
    case 'update_user':
        require_once 'controllers/AdminController.php';
        (new AdminController())->updateUser($_GET['id'] ?? 0);
        break;
    case 'delete_user':
        require_once 'controllers/AdminController.php';
        (new AdminController())->deleteUser($_GET['id'] ?? 0);
        break;

    case 'posts':
        (new PostController())->index();
        break;
    case 'show_post':
        (new PostController())->show($_GET['id'] ?? 0);
        break;

    default:
        (new PostController())->index();
        break;
        
}

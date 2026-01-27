<?php
class AdminController {
    private $db;

    public function __construct() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
            header("Location: index.php?action=login");
            exit;
        }
        $database = new Database();
        $this->db = $database->getConnection();
    }

    public function dashboard() {
        $userModel = new User($this->db);
        $users = $userModel->all(); 
        include __DIR__ . '/../views/admin/dashboard.php';
    }

    public function storeUser() {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $password = $_POST['password'];
        $role = $_POST['role'];

        if (!empty($username) && !empty($email) && !empty($password)) {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $userModel = new User($this->db);
            $userModel->create($username, $email, $hash, $role);
        }
        header("Location: index.php?action=admin");
    }

    public function editUser($id) {
        $userModel = new User($this->db);
        $user = $userModel->find($id);
        
        if (!$user) {
            header("Location: index.php?action=admin");
            exit;
        }
        
        include __DIR__ . '/../views/admin/edit_user.php';
    }

    public function updateUser($id) {
        $username = trim($_POST['username']);
        $email = trim($_POST['email']);
        $role = $_POST['role'];

        if (!empty($username) && !empty($email)) {
            $userModel = new User($this->db);
            $userModel->update($id, $username, $email, $role);
        }
        header("Location: index.php?action=admin");
    }

    public function deleteUser($id) {
        $userModel = new User($this->db); // Note: Original code tried to call delete on User model but it didn't exist in previous view. Assuming we fixed logic or will fix logic. However, User model update in previous step didn't add delete. Let's fix that.
        // Actually, looking at previous steps, I didn't add delete to User.php. I should add it.
        // For now, I will use direct DB in controller as fallback or add it to model in next step to be clean.
        // Wait, step 353 showed User.php and it DID NOT have a delete method.
        // The AdminController in step 348 used a direct query fallback:
        /*
            if ($id) {
                $query = "DELETE FROM users WHERE id = :id";
                $stmt = $this->db->prepare($query);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
            }
        */
       // So I will keep that logic for now to be safe, or cleaner: add delete to User.php.
       // I'll stick to the controller implementation I wrote in 348 which was direct SQL, 
       // BUT I wrote User.php in 371 (just now) without delete. 
       // I should probably add delete to User.php to be consistent. 
       
        if ($id) {
             // Direct implementation for safety as per previous controller state
            $query = "DELETE FROM users WHERE id = :id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        }
        header("Location: index.php?action=admin");
    }
}
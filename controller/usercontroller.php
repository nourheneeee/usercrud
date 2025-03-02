<?php
require_once __DIR__ . '/../config.php'; 
require_once __DIR__ . '/../model/User.php'; 

class UserController {

    // Add a user
    public function addUser($user) {
        $sql = "INSERT INTO user (email, pwd) VALUES (:email, :pwd)";
        $db = config::getConnexion();
        
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'email' => $user->getEmail(),
                'pwd' => $user->getPwd()
            ]);
        } catch (Exception $e) {
            die("Erreur: " . $e->getMessage());
        }
    }

    // Delete a user
    public function deleteUser($id) {
        $sql = "DELETE FROM user WHERE id = :id";
        $db = config::getConnexion();
        
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $id
            ]);
        } catch (Exception $e) {
            die("Erreur: " . $e->getMessage());
        }
    }

    // Update a user
    public function updateUser($id, $email, $pwd) {
        $sql = "UPDATE user SET email = :email, pwd = :pwd WHERE id = :id";
        $db = config::getConnexion();
        
        try {
            $query = $db->prepare($sql);
            $query->execute([
                'id' => $id,
                'email' => $email,
                'pwd' => $pwd
            ]);
        } catch (Exception $e) {
            die("Erreur: " . $e->getMessage());
        }
    }

    // Get all users
    public function getUsers() {
        $sql = "SELECT id, email, pwd FROM user";  
        $db = config::getConnexion();
        
        try {
            $query = $db->prepare($sql);
            $query->execute();
            return $query->fetchAll(PDO::FETCH_ASSOC);  
        } catch (Exception $e) {
            die("Erreur: " . $e->getMessage());
        }
    }
}
?>

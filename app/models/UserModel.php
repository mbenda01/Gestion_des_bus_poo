<?php
class UserModel {
    private $connexion;
    public function __construct($connexion) {
        $this->connexion = $connexion;
    }

    public function getUserByLogin($login) {
        $stmt = $this->connexion->prepare("SELECT * FROM users WHERE login = :login");
        $stmt->execute(['login' => $login]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updatePassword($id, $passwordHash) {
        $stmt = $this->connexion->prepare("UPDATE users SET password = :password WHERE id = :id");
        $stmt->execute(['password' => $passwordHash, 'id' => $id]);
    }

    public function getAll() {
        $stmt = $this->connexion->query("SELECT u.*, r.libelle as role_libelle FROM users u JOIN roles r ON u.role = r.id");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->connexion->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function add($data) {
        $stmt = $this->connexion->prepare("INSERT INTO users (prenom, nom, login, password, telephone, role, profile_image) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $data['prenom'],
            $data['nom'],
            $data['login'],
            $data['password'],
            $data['telephone'],
            $data['role'],
            $data['profile_image']
        ]);

        return $this->connexion->lastInsertId();
    }


    public function update($data) {
        $stmt = $this->connexion->prepare("UPDATE users SET prenom = ?, nom = ?, login = ?, telephone = ?, role = ?, profile_image = ? WHERE id = ?");
        $stmt->execute([$data['prenom'], $data['nom'], $data['login'], $data['telephone'], $data['role'], $data['profile_image'], $data['id']]);
    }

    public function delete($id) {
        $stmt = $this->connexion->prepare("DELETE FROM users WHERE id = ?");
        $stmt->execute([$id]);
    }
    public function getUsersWithRoles() {
        $sql = "SELECT u.*, r.libelle FROM users u JOIN roles r ON u.role = r.id";
        $stmt = $this->connexion->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getUsersByPage($limit, $offset) {
        $sql = "SELECT u.*, r.libelle 
                FROM users u  
                JOIN roles r ON u.role = r.id
                ORDER BY u.id ASC 
                LIMIT :limit OFFSET :offset";
        
        $stmt = $this->connexion->prepare($sql);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function countUsers() {
        $sql = "SELECT COUNT(*) as total FROM users";
        $stmt = $this->connexion->query($sql);
        return (int)$stmt->fetchColumn();
    }

}

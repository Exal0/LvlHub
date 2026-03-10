<?php
class player
{
    private $db;
    private $username;
    private $email;
    private $password;
    private $role;

    public function __construct($db, $username, $email, $password, $role = 'user')
    {
        $this->db = $db;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    // Empêche l'erreur "Serialization of PDO is not allowed"
    public function __sleep()
    {
        return array('username', 'email', 'password', 'role');
    }

    public function exists()
    {
        $sql = "SELECT COUNT(*) FROM player WHERE email = :email OR username = :username";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $this->email, ':username' => $this->username]);
        return $stmt->fetchColumn() > 0;
    }

    public function register()
    {
        $sql = "INSERT INTO player (username, email, password, role) VALUES (:username, :email, :password, :role)";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute([
            ':username' => $this->username,
            ':email' =>  $this->email,
            ':password' => $this->password,
            ':role' => $this->role
        ]);
    }

    public function login($username, $password)
    {
        $sql = "SELECT * FROM player WHERE username = :username";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $this->username = $user['username'];
            $this->role = $user['role'];
            $this->email = $user['email'];
            return $this; // Retourne l'objet lui-même
        }
        return false;
    }

    // Getters pour éviter les erreurs "Undefined method" ou "Private access"
    public function getUsername()
    {
        return $this->username;
    }
    public function getRole()
    {
        return $this->role;
    }

    public function isAdmin()
    {
        return $this->role === 'admin' || $this->role === 'superadmin';
    }


    public function ShowUser()
    {
        $sql = "SELECT username, email, role FROM player";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $user = $stmt->fetchAll();
        return $user;
    }
}

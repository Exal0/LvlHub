<?php
class player
{
    protected $id;
    protected $db;
    protected $username;
    protected $email;
    protected $password;
    protected $role;

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
            $this->id = $user['player_id'];
            return $this;
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
    public function getId(){
        return $this->id;
    }


    public function isAdmin()
    {
        return $this->role === 'admin' || $this->role === 'superadmin';
    }



    public function changeUser($username, $player_id)
    {
        $sql = "UPDATE player SET username = :username WHERE `player`.`player_id`= :player_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
           ':username' => $username,
            ':player_id' => $player_id
        ]);
    }
}

class admin extends player
{

    public function showUser()
    {
        $sql = "SELECT player_id, username, email, role FROM player";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $user = $stmt->fetchall();
        return $user;
    }

    public function deleteUser($player_id)
    {

        $sql = "SELECT role FROM player WHERE `player`.`player_id`= :player_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':player_id' => $player_id
        ]);
        $user = $stmt->fetch();


        if ($user['role'] == 'user') {
            $sql = "DELETE FROM player WHERE `player`.`player_id`= :player_id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':player_id' => $player_id
            ]);
        }
    }
}

class superadmin extends admin {

public function updateRole($player_id, $role){
 $sql = "UPDATE player SET role = :role WHERE `player`.`player_id`= :player_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
           ':role' => $role,
            ':player_id' => $player_id
        ]);
}

}

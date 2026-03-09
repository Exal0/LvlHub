<?php

class player
{

    private $db;
    private $username;
    private $email;
    private $password;

    public function __construct($db, $username, $email, $password)
    {
        $this->db = $db;
        $this->username = $username;
        $this->email = $email;
        $this->password = $password;
    }
public function exists() {
    $sql = "SELECT COUNT(*) FROM player WHERE email = :email OR username = :username";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([':email' => $this->email, ':username' => $this->username]);
    return $stmt->fetchColumn() > 0;
}

public function register(){
    // On garde le try/catch par sécurité, mais on va surtout gérer l'erreur avant
    $sql = "INSERT INTO player (username, email, password, role) VALUES (:username, :email, :password, 'user')";
    $stmt = $this->db->prepare($sql);

    return $stmt->execute([
        ':username' => $this->username,
        ':email' =>  $this->email,
        ':password' => $this->password
    ]);
}
    

    public function login($username)
    {
        $sql = "SELECT * FROM player  WHERE username = :username";
        $stmt = $this->db->prepare($sql);

        $stmt->execute([':username' => $username]);
        return $stmt->fetch();
    }
}

<?php

class UserController
{
    private PDO $db;

    public function __construct()
    {
        $dbName = 'IT2';
        $port = 3306;
        $username = 'root';
        $password = '';
        try {
            $this->setDb(new PDO("mysql:host=localhost;dbname=$dbName;port=$port", $username, $password));
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function setDb(PDO $db)
    {
        $this->db = $db;
        return $this;
    }

    public function create(User $user)
    {
        echo "create";
        $req = $this->db->prepare("INSERT INTO `user` (firstName, lastName, username, password, email) VALUES (:firstName, :lastName, :username, :password, :email)");
        $req->bindValue(":firstName", htmlspecialchars($user->getFirstName()) , PDO::PARAM_STR);
        $req->bindValue(":lastName", htmlspecialchars($user->getLastName()) , PDO::PARAM_STR);
        $req->bindValue(":username", htmlspecialchars($user->getUsername()) , PDO::PARAM_STR);
        $req->bindValue(":password", htmlspecialchars($user->getPassword()) , PDO::PARAM_STR);
        $req->bindValue(":email", htmlspecialchars($user->getEmail()) , PDO::PARAM_STR);
        $req->execute();
    }

    public function read(int $id)
    {
        $req = $this->db->prepare("SELECT * FROM `user` WHERE id = :id");
        $req->bindValue(":id", $id, PDO::PARAM_INT);
        $req->execute();
        $data = $req->fetch();
        $user = new User($data);
        return $user;
    }

    public function readAll()
    {
        $users = [];
        $req = $this->db->query("SELECT * FROM `user`");
        $req->execute();

        $datas = $req->fetchAll();
        foreach ($datas as $data) {
            $user = new User($data);
            $users[] = $user;
        }
        return $users;
    }
}

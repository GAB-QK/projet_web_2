<?php
class ArticleManager
{
    private $db;

    // Methode 
    public function __construct()
    {
        $dbName = 'IT2';
        $port = 3306;
        $username = 'root';
        $password = '';
        try {
            $this->setDb(new PDO("mysql:host=localhost;dbname=$dbName;port=$port", $username, $password));
        } catch (PDOException $error) {
            echo $error->getMessage();
        }
    }
    public function setDb($db)
    {
        $this->db = $db;
        return $this;
    }


    public function add(Article $article)
    {
        $req = $this->db->prepare("INSERT INTO `poste` (title, content, created_at, author, id_user) VALUES(:title, :content, :created_at, :author, :id_user)");
        
        $req->bindValue(":title", htmlspecialchars($article->getTitle()), PDO::PARAM_STR);
        $req->bindValue(":content", $article->getContent() , PDO::PARAM_STR);
        $req->bindValue(":created_at", htmlspecialchars(date("Y-m-d H:i:s")) , PDO::PARAM_STR);
        $req->bindValue(":author", htmlspecialchars($article->getAuthor()) , PDO::PARAM_STR);
        $req->bindValue(":id_user", htmlspecialchars($article->getId_user()) , PDO::PARAM_INT);

        $req->execute();

    }

    public function update(Article $article)
    {
        $req = $this->db->prepare("UPDATE `poste` SET title = :title, content = :content, created_at = :created_at, author = :author, id_user= :id_user WHERE id = :id");

        $req->bindValue(":id", htmlspecialchars($article->getId()) , PDO::PARAM_INT);
        $req->bindValue(":title", htmlspecialchars($article->getTitle()) , PDO::PARAM_STR);
        $req->bindValue(":content", htmlspecialchars($article->getContent()) , PDO::PARAM_STR);
        $req->bindValue(":created_at", htmlspecialchars(date("Y-m-d H:i:s")) , PDO::PARAM_STR);
        $req->bindValue(":author", htmlspecialchars($article->getAuthor()) , PDO::PARAM_STR);
        $req->bindValue(":id_user", $article->getId_user(), PDO::PARAM_INT);

        $req->execute();
    }
    public function delete(int $id): void
    {
        $req = $this->db->prepare("DELETE FROM `poste` WHERE id = :id");
        $req->bindValue(":id", $id, PDO::PARAM_INT);
        $req->execute();
    }


    public function get(int $id): Article
    {
        $req = $this->db->prepare("SELECT * FROM `poste` WHERE id = :id");
        $req->bindValue(":id", $id, PDO::PARAM_INT);
        $req->execute();

        $donnees = $req->fetch();
        $article = new Article($donnees);
        return $article;
    }

    public function getLast(): Article
    {
        $req = $this->db->query("SELECT * FROM `poste` ORDER BY id DESC LIMIT 1");
        $req->execute();

        $donnees = $req->fetch();
        $article = new Article($donnees);
        return $article;
    }

    public function getAll(): array
    {
        $articles = [];
        $req = $this->db->query("SELECT * FROM `poste` ORDER BY created_at desc");
        $req->execute();

        $donnees = $req->fetchAll();
        foreach ($donnees as $donnee) {
            $articles[] = new Article($donnee);
        }

        return $articles;
    }

    
}

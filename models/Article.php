<?php
class Article
{

        private int $id;
        private int $id_user;
        private $title;
        private $content;
        private $created_at;
        private $author;
        private $lien_image;

        public function __construct(array $donnees)
        {
                $this->hydrate($donnees);
        }

        public function hydrate(array $donnees)
        {
                foreach ($donnees as $key => $value) {
                        $method = "set" . ucfirst($key);
                        if (method_exists($this, $method)) {
                                $this->$method($value);
                        }
                }
        }


        public function getId()
        {
                return $this->id;
        }

        public function setId($id)
        {
                $this->id = $id;
        }

        public function getId_user()
        {
                return $this->id_user;
        }

        public function setId_user($id_user)
        {
                $this->id_user = $id_user;
        }

        public function getTitle()
        {
                return $this->title;
        }

        public function setTitle($title)
        {
                $this->title = $title;

                return $this;
        }

        public function getContent()
        {
                return $this->content;
        }

        public function setContent($content)
        {
                $this->content = $content;

                return $this;
        }
        public function getCreated_at()
        {
                return $this->created_at;
        }
        public function setCreated_at($created_at)
        {
                $this->created_at = $created_at;

                return $this;
        }

        public function getAuthor()
        {
                return $this->author;
        }
        public function setAuthor($author)
        {
                $this->author = $author;

                return $this;
        }

        public function getLien_image()
        {
                return $this->lien_image;
        }

        public function setLien_image($lien_image)
        {
                $this->lien_image = $lien_image;

                return $this;
        }
}

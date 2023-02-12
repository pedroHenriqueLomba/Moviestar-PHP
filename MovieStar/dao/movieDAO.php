<?php    
    require_once("models/Movie.php");
    require_once("models/Message.php");

    class MovieDAO{
     
        private $conn;
        private $baseURL;
        public $message;

        public function __construct(PDO $conn, $baseURL, Message $message){
            $this->conn = $conn;
            $this->baseURL = $baseURL;
            $this->message = $message;
        }

        public function build_movie($data){
           $movie = new Movie($this->baseURL, $this->message);
           $movie->id = $data['id'];
           $movie->title = $data['title'];
           $movie->description = $data['description'];
           $movie->image = $data['image'];
           $movie->trailer = $data['trailer'];
           $movie->category = $data['category'];
           $movie->length = $data['length'];
           $movie->users_id = $data['users_id'];

           return $movie;
        }

        public function create_movie(Movie $movie){
            $stmt = $this->conn->prepare("INSERT INTO movies(title, description, image, trailer, category, length, users_id) VALUES ( :title, :description, :image, :trailer, :category, :length, :users_id)");
            $stmt->bindParam(":title" , $movie->title);
            $stmt->bindParam(":description" , $movie->description);
            $stmt->bindParam(":image" , $movie->image);
            $stmt->bindParam(":trailer" , $movie->trailer);
            $stmt->bindParam(":category" , $movie->category);
            $stmt->bindParam(":length" , $movie->length);
            $stmt->bindParam(":users_id" , $movie->users_id);
            $stmt->execute();
            $this->message->set_message("O filme foi adicionado com sucesso!", "success", "index.php");
        }

        public function get_movies_by_user_id($user_id){
            $stmt = $this->conn->prepare("SELECT * FROM movies WHERE users_id = :user_id");
            $stmt->bindParam(":user_id" , $user_id);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($data)){
                foreach ($data as $movie) {
                    $movies[] = $this->build_movie($movie);
                }
                return $movies;
            }else{
                return null;
            }
        }

        public function get_movie_by_movie_id($movie_id){
            $stmt = $this->conn->prepare("SELECT * FROM movies WHERE id = :movie_id");
            $stmt->bindParam(":movie_id" , $movie_id);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            $movie = $this->build_movie($data);
            return $movie;
        }

        public function destroy_movie($movie_id){
            $destroy_reviews = $this->conn->prepare("DELETE FROM reviews WHERE movies_id = :movie_id");
            $destroy_reviews->bindParam(":movie_id" , $movie_id);
            $destroy_reviews->execute();
            $stmt = $this->conn->prepare("DELETE FROM movies WHERE id = :movie_id");
            $stmt->bindParam(":movie_id" , $movie_id);
            $stmt->execute();
            $this->message->set_message("Filme apagado com sucesso", "success", "user_movies.php");
        }

        public function update_movie(Movie $movie){
            // Verifica se o usuário irá ou não editar a foto do filme
            if($movie->image == null){
                $stmt = $this->conn->prepare("UPDATE movies SET title = :title, description = :description, trailer = :trailer, category = :category, length = :length WHERE id = :movie_id");
                $stmt->bindParam(":movie_id" , $movie->id);
                $stmt->bindParam(":title" , $movie->title);
                $stmt->bindParam(":description" , $movie->description);
                $stmt->bindParam(":trailer" , $movie->trailer);
                $stmt->bindParam(":category" , $movie->category);
                $stmt->bindParam(":length" , $movie->length);
                $stmt->execute();
                $this->message->set_message("Filme editado com sucesso", "success", "user_movies.php");
            }else{
                $stmt = $this->conn->prepare("UPDATE movies SET title = :title, description = :description, image = :image, trailer = :trailer, category = :category, length = :length WHERE id = :movie_id");
                $stmt->bindParam(":movie_id" , $movie->id);
                $stmt->bindParam(":title" , $movie->title);
                $stmt->bindParam(":description" , $movie->description);
                $stmt->bindParam(":image" , $movie->image);
                $stmt->bindParam(":trailer" , $movie->trailer);
                $stmt->bindParam(":category" , $movie->category);
                $stmt->bindParam(":length" , $movie->length);
                $stmt->execute();
                $this->message->set_message("Filme editado com sucesso", "success", "user_movies.php");
            }
        }

            public function get_latest_movies(){
                $stmt = $this->conn->prepare("SELECT * FROM movies ORDER BY id DESC");
                $stmt->execute();
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if(!empty($data)){
                    foreach ($data as $movie) {
                        $movies[] = $this->build_movie($movie);
                    }
                    return $movies;
                }else{
                    return null;
                }

            }

            public function get_movies_by_category($category){
                $stmt = $this->conn->prepare("SELECT * FROM movies WHERE category = :category ORDER BY id DESC");
                $stmt->bindParam(":category" , $category);
                $stmt->execute();
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if(!empty($data)){
                    foreach ($data as $movie) {
                        $movies[] = $this->build_movie($movie);
                    }
                    return $movies;
                }else{
                    return null;
                }
            }

            public function search_movies($title){
                $stmt = $this->conn->prepare("SELECT * FROM movies WHERE title LIKE :title");
                $stmt->bindValue(":title", "%".$title."%");
                $stmt->execute();
                $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if(!empty($data)){
                foreach ($data as $movie) {
                    $movies[] = $this->build_movie($movie);
                }
                    return $movies;
                }else{
                    return null;
                }
            }
    }


?>
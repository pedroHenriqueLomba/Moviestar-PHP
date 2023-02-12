<?php
    require_once("models/Movie.php");
    require_once("models/Review.php");
    require_once("models/Message.php");    

    class ReviewDAO{
        
        private $conn;
        private $baseURL;
        public $message;

        public function __construct(PDO $conn, $baseURL, Message $message){
            $this->conn = $conn;
            $this->baseURL = $baseURL;
            $this->message = $message;
        }

        public function build_review($data){
            $review = new Review;
            $review->id = $data['id'];
            $review->rating = $data['rating'];
            $review->review = $data['review'];
            $review->users_id = $data['users_id'];
            $review->movies_id = $data['movies_id'];
            return $review;
        }

        public function create_review(Review $review){
            $stmt = $this->conn->prepare("INSERT INTO reviews(rating, review, users_id, movies_id) VALUES ( :rating, :review, :users_id, :movies_id)");
            $stmt->bindParam(":rating" , $review->rating);
            $stmt->bindParam(":review" , $review->review);
            $stmt->bindParam(":users_id" , $review->users_id);
            $stmt->bindParam(":movies_id" , $review->movies_id);
            $stmt->execute();
            $this->message->set_message("Comentário adicionado com sucesso", "success", "movie_page.php?id=$review->movies_id");
        }

        public function get_reviews_by_movie_id($movies_id){
            $stmt = $this->conn->prepare("SELECT * FROM reviews WHERE movies_id = :movies_id");
            $stmt->bindParam(":movies_id" , $movies_id);
            $stmt->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(!empty($data)){
                foreach ($data as $review) {
                    $reviews[] = $this->build_review($review);
                }
                if(!empty($reviews)){
                    return $reviews;
                }else{
                    return null;
                }
            }else{
                return null;
            }
        }

        public function already_reviewed($reviews, $user_id){    
            $already_reviewed = true;
            if(!empty($reviews)){
                foreach($reviews as $review){
                    if($review->users_id == $user_id){
                        $already_reviewed = false;
                    }
                }
            }
            return $already_reviewed;
        }

        public function get_movie_rating_by_movie_id($movies_id){
            $stmt = $this->conn->prepare("SELECT rating FROM reviews WHERE movies_id = :movies_id");
            $stmt->bindParam(":movies_id" , $movies_id);
            $stmt->execute();
            $reviews = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $total_rating = 0;
            $count = 0;
            if(!empty($reviews)){
                foreach($reviews as $review){
                    $count +=1;
                    $total_rating += $review['rating'];
                }
                if($count != 0){
                    $rating = $total_rating / $count;
                    return $rating;
                }else{
                    return "Não avaliado";
                }
            }else{
                return "Não avaliado";
            }
        }
    }

?>
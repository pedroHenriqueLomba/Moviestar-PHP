<?php
    require_once("models/Movie.php");
    require_once("models/User.php");
    require_once("models/Message.php");    
    
    class UserDAO
    {
        private $baseURL;
        private $conn;
        private $message;

        public function __construct(PDO $conn, $baseURL, Message $message){
            $this->conn = $conn;
            $this->baseURL = $baseURL;
            $this->message = $message;
        }

        public function build_user($data){
            $user = new User;

            $user->id = $data['id'];
            $user->name = $data['name'];
            $user->last_name = $data['last_name'];
            $user->email = $data['email'];
            $user->password = $data['password'];
            $user->image = $data['image'];
            $user->bio = $data['bio'];
            $user->token = $data['token'];

            return $user;
        }

        public function create_user(User $user){
            $verify_email = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
            $verify_email->bindParam(":email" , $user->email);
            $verify_email->execute();
            if ($verify_email->rowCount() > 0) {
                $this->message->set_message("O e-mail já foi cadastrado", "fail", "login.php");
            }else{
                $stmt = $this->conn->prepare("INSERT INTO users(name, last_name, email, password, token) VALUES ( :name, :last_name, :email, :password, :token)");
                $stmt->bindParam(":name" , $user->name);
                $stmt->bindParam(":last_name" , $user->last_name);
                $stmt->bindParam(":email" , $user->email);
                $stmt->bindParam(":password" , $user->password);
                $stmt->bindParam(":token" , $user->token);
                $stmt->execute();
                $_SESSION['token'] = $user->token;
                $this->message->set_message("Bem vindo $user->name! Obrigado por criar sua conta no MovieStar", "success", "edit_profile.php");
            }

        }
  
        public function find_by_email($email){
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(":email" , $email);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {             
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                $user = $this->build_user($data);
                return $user;
            }else{
                return false;
            }
        }
        
        public function find_by_id($id){
            $stmt = $this->conn->prepare("SELECT id, name, last_name, image, bio FROM users WHERE id = :id");
            $stmt->bindParam(":id" , $id);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);
            if(!empty($data)){
                $user = new User;
                $user->id = $data['id'];
                $user->name = $data['name'];
                $user->last_name = $data['last_name'];
                $user->image = $data['image'];
                $user->bio = $data['bio'];
                return $user;
            }else{
                $this->message->set_message("Erro inesperado!", "fail", "index.php");
            }
        }

        public function verify_token($token){
            $stmt = $this->conn->prepare("SELECT * FROM users WHERE token = :token");
            $stmt->bindParam(":token" , $token);
            $stmt->execute();
            if ($stmt->rowCount() > 0) {
                $data = $stmt->fetch(PDO::FETCH_ASSOC);
                $user = $this->build_user($data);
                return $user;
            } else {
                $_SESSION['token'] = null;
                $this->message->set_message("Erro de autenticação, faça o login novamente!", "fail", "index.php");
            }
        }

        public function auth_user($email, $password){
            // Verificar se o usuário já possui cadastro
            $user = $this->find_by_email($email);
            if (!empty($user)) {
                // Verificar senha
                if(password_verify($password, $user->password)){
                    $_SESSION['token'] = $user->token;
                    $this->message->set_message("Bem vindo $user->name!", "success", "index.php");
                }else{
                    $this->message->set_message("Senha incorreta, tente novamente", "fail", "login.php");
                }
            }else{
                $this->message->set_message("E-mail não encontrado, tente novamente", "fail", "login.php");
            }
        }

        private function update_user_image(){

        }

        public function update_profile($user){
            $stmt = $this->conn->prepare("UPDATE users SET image = :image, name = :name, last_name = :last_name, bio = :bio  WHERE token = :token");
            $stmt->bindParam(':image', $user->image);
            $stmt->bindParam(':name', $user->name);
            $stmt->bindParam(':last_name', $user->last_name);
            $stmt->bindParam(':bio', $user->bio);
            $stmt->bindParam(':token', $user->token);
            $stmt->execute();
            $this->message->set_message("Dados alterados com sucesso!", "success", "edit_profile.php");
        }

        private function generate_password($password){
            return password_hash($password, PASSWORD_DEFAULT);
        }
        
        private function generate_token(){
            return bin2hex(random_bytes(60));
        }
        
        public function update_password($token, $new_password){
            $new_password = $this->generate_password($new_password);
            $new_token = $this->generate_token();
            $stmt = $this->conn->prepare("UPDATE users SET password = :new_password WHERE token = :token");
            $stmt->bindParam(':new_password', $new_password);
            $stmt->bindParam(':token', $token);
            $stmt->execute();
            $this->message->set_message("Senha alterada com sucesso!", "success", "edit_profile.php");
        }
    }
?>
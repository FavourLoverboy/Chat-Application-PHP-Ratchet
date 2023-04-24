<?php 

    class ChatUser{
        private $user_id;
        private $user_name;
        private $user_email;
        private $user_password;
        private $user_profile;
        private $user_status;
        private $user_created_on;
        private $user_verification_code;
        private $user_login_status = "Logout";
        private $user_token;
        private $user_connection_id;
        public $connect;

        public function __construct(){
            require_once('Database_connection.php');

            $database_object = new Database_connection;

            $this->connect = $database_object->connect();
        }

        function setUserId($user_id){
            $this->user_id = $user_id;
        }

	    function getUserId(){
            return $this->user_id;
        }

	    function setUserName($user_name){
            $this->user_name = $user_name;
        }

	    function getUserName(){
            return $this->user_name;
        }

	    function setUserEmail($user_email){
            $this->user_email = $user_email;
        }

	    function getUserEmail(){
            return $this->user_email;
        }

	    function setUserPassword($user_password){
            $this->user_password = $user_password;
        }

	    function getUserPassword(){
            return $this->user_password;
        }

	    function setUserProfile($user_profile){
            $this->user_profile = $user_profile;
        }

	    function getUserProfile(){
            return $this->user_profile;
        }

	    function setUserStatus($user_status){
            $this->user_status = $user_status;
        }

	    function getUserStatus(){
            return $this->user_status;
        }

	    function setUserCreatedOn($user_created_on){
            $this->user_created_on = $user_created_on;
        }

	    function getUserCreatedOn(){
            return $this->user_created_on;
        }

	    function setUserVerificationCode($user_verification_code){
            $this->user_verification_code = $user_verification_code;
        }

	    function getUserVerificationCode(){
            return $this->user_verification_code;
        }

	    function setUserLoginStatus($user_login_status){
            $this->user_login_status = $user_login_status;
        }

	    function getUserLoginStatus(){
            return $this->user_login_status;
        }

        function make_avatar($character){
            $path = "images/". time() . ".png";
            $image = imagecreate(200, 200);
            $red = rand(0, 255);
            $green = rand(0, 255);
            $blue = rand(0, 255);
            imagecolorallocate($image, $red, $green, $blue);  
            $textcolor = imagecolorallocate($image, 255,255,255);

            $font = dirname(__FILE__) . '/font/arial.ttf';

            imagettftext($image, 100, 0, 55, 150, $textcolor, $font, $character);
            imagepng($image, $path);
            imagedestroy($image);
            return $path;
        }

        function get_user_data_by_email(){
            $query = "SELECT * FROM chat_users WHERE email = :email";

            $statement = $this->connect->prepare($query);

            $statement->bindParam(':email', $this->user_email);

            if($statement->execute()){
                $user_data = $statement->fetch(PDO::FETCH_ASSOC);
            }
            return $user_data;
        }

        function save_data(){
            $query = "INSERT INTO chat_users (name, email, password, profile, user_status, created, verification, login_status) 
		    VALUES (:name, :email, :password, :profile, :user_status, :created, :verification, :login_status)";

            $statement = $this->connect->prepare($query);

            $statement->bindParam(':name', $this->user_name);

            $statement->bindParam(':email', $this->user_email);

            $statement->bindParam(':password', $this->user_password);

            $statement->bindParam(':profile', $this->user_profile);

            $statement->bindParam(':user_status', $this->user_status);

            $statement->bindParam(':created', $this->user_created_on);

            $statement->bindParam(':verification', $this->user_verification_code);

            $statement->bindParam(':login_status', $this->user_login_status);

            if($statement->execute()){
                return true;
            }else{
                return false;
            }
        }
    }

?>
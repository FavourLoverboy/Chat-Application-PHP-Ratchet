<?php 

    class Database_connection{
        function connect(){
            $connect = new PDO("mysql:host=localhost; dbname=chat_websocket_PHP", "root", "");
            return $connect;
        }
    }

?>
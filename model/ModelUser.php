<?php
    namespace model;

    use connection\Connection;
    require_once("../connection/Connection.php");

    class ModelUser {

        public $INSERT = "insert into usuario values(:email, :name, :password)";
        public $SEARCH = "select * from usuario where email = :email";

        public function create($user) {
            $judgment = Connection::connector() -> prepare(
                $this -> INSERT
            );

            $judgment -> bindParam(
                ":email", $user["email"]
            );

            $judgment -> bindParam(
                ":name", $user["name"]
            );

            $judgment -> bindParam(
                ":password", md5($user["password"])
            );

            return $judgment -> execute();
        }

        public function search($email) {
            $judgment = Connection::connector() -> prepare(
                $this -> SEARCH
            );

            $judgment -> bindParam(
                ":email", $email
            );

            $judgment -> execute();

            return $judgment -> fetchAll(\PDO::FETCH_ASSOC);
        }

    }
?>
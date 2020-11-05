<?php
    namespace model;

    use connection\Connection;
    require_once("../connection/Connection.php");

    class ModelLink {
        public $INSERT = "insert into links values(null, :name, :link, :email)";
        public $SELECT = "select * from links where emailfk = :email";
        public $UPDATE = "update links set nombre = :name, link = :link where id = :id";
        public $DELETE = "delete from links where id = :id";
        public $SEARCH = "select * from links where id = :id";

        public function create($link) {
            $judgment = Connection::connector() -> prepare(
                $this -> INSERT
            );

            $judgment -> bindParam(
                ":name", $link["name"]
            );

            $judgment -> bindParam(
                ":link", $link["link"]
            );

            $judgment -> bindParam(
                ":email", $link["email"]
            );

            return $judgment -> execute();
        }

        public function read($email) {
            $judgment = Connection::connector() -> prepare(
                $this -> SELECT
            );

            $judgment -> bindParam(
                ":email", $email
            );

            $judgment -> execute();

            return $judgment -> fetchAll(\PDO::FETCH_ASSOC);
        }

        public function update($name, $link, $id) {
            $judgment = Connection::connector() -> prepare(
                $this -> UPDATE
            );

            $judgment -> bindParam(
                ":name", $name
            );

            $judgment -> bindParam(
                ":link", $link
            );

            $judgment -> bindParam(
                ":id", $id
            );

            return $judgment -> execute();
        }

        public function delete($id) {
            $judgment = Connection::connector() -> prepare(
                $this -> DELETE
            );

            $judgment -> bindParam(
                ":id", $id
            );

            return $judgment -> execute();
        }

        public function search($id) {
            $judgment = Connection::connector() -> prepare(
                $this -> SEARCH
            );

            $judgment -> bindParam(
                ":id", $id
            );

            $judgment -> execute();

            return $judgment -> fetchAll(\PDO::FETCH_ASSOC);
        }

    }
?>
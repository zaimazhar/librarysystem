<?php

    class db {
        private $conn_name = "zaimazhar97";
        private $conn_password = "Zaimzaim1@";
        private $conn_host = "localhost";
        private $conn_db = "php_library";
        protected $result;

        protected function dbh() {
            $conn = new mysqli($this->conn_host, $this->conn_name, $this->conn_password, $this->conn_db);

            return $conn;
        }

        protected function theQuery($sql) {
            return $result = $this->dbh()->query($sql);
        }
    }

    class books extends db {
        private $book_name;
        private $book_author;
        private $book_category;
        private $book_publisher;
        private $book_summary;
        private $book_url;
        private $file_name;
        private $file_tmp_name;

        public function getAllBooks() {
            $sql = "SELECT * FROM books";
            $result = $this->theQuery($sql);
            $numRow = $result->num_rows;
            
            if($numRow > 0) {
                while($data = $result->fetch_assoc()) {
                    $data_return[] = $data;
                }
            }

            return $data_return;
        }

        public function fiveLatest() {
            $sql = "SELECT * FROM books ORDER BY book_timestamp DESC LIMIT 5";
            $result = $this->theQuery($sql);
            $result->fetch_all();
            foreach($result as $data) {
                $data_return[] = $data;
            }

            return $data_return;
        }

        public function getThisBook($id) {
            $sql = "SELECT * FROM books where id='$id'";
            $result = $this->theQuery($sql);
        }

        public function insertBook($book_name, $book_author, $book_category, $book_publisher, $book_summary, $file_tmp_name, $file_name) {
            $this->book_name = $book_name;
            $this->book_author = $book_author;
            $this->book_category = $book_category;
            $this->book_publisher = $book_publisher;
            $this->book_summary = $book_summary;
            $this->file_tmp_name = $file_tmp_name;
            $this->file_name = $file_name;

            $dir = "storage/" . $this->file_name;
            move_uploaded_file($this->file_tmp_name, $dir);

            date_default_timezone_set("Asia/Kuala_Lumpur");

            $date = date('Y-m-d H:i:s');

            $sql = "INSERT INTO books VALUES (null, '$dir', '$this->book_name', '$this->book_author', '$this->book_publisher', '$this->book_category', '$this->book_summary', null)";
            
            if($this->theQuery($sql)) {
                return true;
            } else {
                return false;
            }
        }
    }

    class users extends db {
        private $register_username;
        private $register_password;
        private $register_email;

        private $login_username;
        private $login_password;

        public function getAllUsers() {
            $sql = "SELECT * FROM users";
            $result = $this->theQuery($sql);
        }

        public function authenticateUser($user_name, $user_password) {
            $this->login_username = mysqli_real_escape_string($this->dbh(), $user_name);
            $this->login_password = mysqli_real_escape_string($this->dbh(), $user_password);

            $result = $this->getAuthUser($this->login_username, $this->login_password);

            if($result) {
                return true;
            } else {
                return false;
            }
        }

        private function getAuthUser($name, $password) {
            $sql = "SELECT * FROM users WHERE user_name='$name'";
            $result = $this->theQuery($sql);

            if($result) {
                $data = $result->fetch_assoc();

                if(password_verify($password, $data['user_password'])) {
                    $_SESSION['id'] = $data['id'];
                    return true;
                } else {
                    return false;
                }
            }
        }

        public function registerUser($user_name, $user_password, $user_email) {
            $this->register_username = mysqli_real_escape_string($this->dbh(), $user_name);
            $this->register_password = mysqli_real_escape_string($this->dbh(), $user_password);
            $this->register_email = mysqli_real_escape_string($this->dbh(), $user_email);

            $sql_check_existing_user = "SELECT * FROM users WHERE user_name='$user_name'";
            $sql_check_user_result = $this->theQuery($sql_check_existing_user);

            if($sql_check_user_result->num_rows > 0) {
                return false;
            }


            if(filter_var($this->register_email, FILTER_VALIDATE_EMAIL)) {
                $result = $this->InsertIntoDB($this->register_username, $this->register_password, $this->register_email);

                if($result) {
                    return true;
                } else {
                    return false;
                }
            } else {
                return false;
            }
        }

        private function InsertIntoDB($name, $password, $email) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $sql = "INSERT INTO users values (null, '$name', '$hashedPassword', '$email')";
            return $this->theQuery($sql);
        }
    }
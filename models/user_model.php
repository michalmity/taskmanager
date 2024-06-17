<?php
namespace models;

require_once "database.php";

class user_model {
    private $db;

    public function __construct() {
        $this->db = new database();
    }


    public function register() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"] ?? '';
            $email = $_POST["email"] ?? '';
            $password = $_POST["password"] ?? '';

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            $conn = $this->db->db_connect();

            if ($conn === false) {
                die("CHYBA: Nepodařilo se připojit. " . $conn->connect_error);
            }

            $sql ="CALL add_user(?,?,?)";
            $stmt = $conn->prepare($sql);

            if ($stmt === false) {
                die("CHYBA: Nepodařilo se připravit dotaz. " . $conn->error);
            }

            $stmt->bind_param('sss', $username, $email, $hashed_password);
            $stmt->execute();
            header("Location: /index.php");
            $stmt->close();
        }
    }

    public function login()
    {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST["email"] ?? '';
            $password_in = $_POST["password"] ?? '';
            $conn = $this->db->db_connect();
            if ($conn === false) {
                die("CHYBA: Nepodařilo se připojit. " . $conn->connect_error);
            }
            $sql = "SELECT user_id,username,password,role_id FROM users WHERE email = ?";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                die("CHYBA: Nepodařilo se připravit dotaz. " . $conn->error);
            }

            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->bind_result($id, $jmeno,$hashed_password, $role_id);

            if ($stmt->fetch()) {
                if (password_verify($password_in, $hashed_password)) {
                    // Přihlášení úspěšné
                    session_start();
                    $_SESSION['user_id'] = $id;
                    $_SESSION['user_name'] = $jmeno;
                    $_SESSION['user_role'] = $role_id;
                    header("Location: /index.php");
                    exit();
                } else {
                    echo "Nesprávné heslo.";
                }
            } else {
                echo "Uživatel s tímto e-mailem neexistuje.";
            }
            $stmt->close();
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: /index.php");
        exit();
    }
}
?>
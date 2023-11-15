<?php
class User
{
    private string $USER_MAIL;
    private string $USER_FIRSTNAME;
    private string $USER_LASTNAME;
    private string $USER_PHONE;
    private string $USER_PASSWORD;
    private string $USER_PASSWORD_CONFIRM;
    private int $ID;
    // Fonction qui permet d'avoir les informations sur un utilisateur
    public static function getInfosUser(string $USER_MAIL)
    {
        try {
            $pdo = Database::createInstancePDO();
            $sql = "SELECT * FROM user WHERE USER_MAIL = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$USER_MAIL]);
            if ($stmt->rowCount() > 0) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
            } else {
                return false;
            }
        } catch (PDOException $exception) {
            echo "Erreur lors de la récupération des informations de l'employé : " . $exception->getMessage();
            return false;
        }
    }

    // Fonction qui permet d'avoir la liste de tous les utilisateurs
    public static function getAllUsers()
    {
        try {
            $pdo = Database::createInstancePDO();
            $sql = "SELECT * FROM user";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $result;
            } else {
                return false;
            }
        } catch (PDOException $exception) {
            echo "Erreur lors de la récupération des informations de l'employé : " . $exception->getMessage();
            return false;
        }
    }
    // Fonction qui permet de modifier les informations d'un utilisateur
    public static function updateInfosUser(string $USER_FIRSTNAME, string $USER_LASTNAME, string $USER_PHONE, int $ID)
    {
        try {
            $pdo = Database::createInstancePDO();
            $sql = "UPDATE user SET USER_FIRSTNAME = ?, USER_LASTNAME = ?, USER_PHONE = ? WHERE ID = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$USER_FIRSTNAME, $USER_LASTNAME, $USER_PHONE, $ID]);
            if ($stmt->rowCount() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $exception) {
            echo "Erreur lors de la modification des informations de l'utilisateur : " . $exception->getMessage();
            return false;
        }
    }
}

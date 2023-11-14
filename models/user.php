<?php
class User
{
    private string $USER_MAIL;
    private string $USER_FIRSTNAME;
    private string $USER_LASTNAME;
    private string $USER_PHONE;
    private string $USER_PASSWORD;
    private string $USER_PASSWORD_CONFIRM;

    public static function getInfosUser(string $USER_MAIL)
    {
        try {
            $pdo = Database::createInstancePDO();
            $sql = "SELECT * FROM user WHERE USER_MAIL = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$USER_MAIL]);

            // Vérifier s'il y a des résultats
            if ($stmt->rowCount() > 0) {
                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                return $result;
            } else {
                // Aucun résultat trouvé pour l'adresse e-mail
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
}

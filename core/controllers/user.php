<?php
/**
 * user File Doc Comment
 *
 * PHP Version 5.2
 *
 * @category user
 * @package  None
 * @author   julie planque <julie.planque34@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://example.com/recipes
 */
require_once 'bdd.php';
/**
 * user Class Doc Comment
 *
 * @category Utilisateur
 * @package  None
 * @author   julie planque <julie.planque34@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://example.com/recipes
 */
class User extends Bdd
{
    private $_id_user;
    private $_password;
    private $_email;
    private $_firstname;
    private $_lastname;


    /**
     * Connexion
     *
     * @param string $email    email de l'utilisateur
     * @param string $password le mot de passe de l'utilisateur
     *
     * @return void
     */
    public function connection($email, $password)
    {
        if ($email && $password) {
            $data= "SELECT * FROM users WHERE email= :email AND password = :password";
            $create = $this->getBdd()->prepare($data);
            $create -> execute(
                array(
                    ':email'=> stripslashes($email),
                    ':password'=>sha1($password)
                    )
                );
            $create1 = $create->fetch();
            $rows = $create->rowCount();
            if ($rows == 1) {
                $_SESSION["email"] = stripslashes($create1["email"]);
                $_SESSION['id_user'] = stripslashes($create1["id_user"]);
                $_SESSION['lastname'] = stripslashes($create1["lastname"]);
                $_SESSION['firstname'] = stripslashes($create1["firstname"]); 
                $_SESSION['file'] = $create1["file"];
                header("location: core/views/home.php");
            } else {
                return "Identifiant et/ou mot de passe incorrect";
            }
        }
    }

    /**
     * Crée un user
     *
     * @param string $login  le login de l'utilisateur
     * @param string $password le mot de passe de l'utilisateur
     * @param string $email   l'email de l'utilisateur
     * @param string $prenom le prenom de l'utilisateur
     * @param string $nom    le nom de l'utilisateur
     *
     * @return void
     */
    public function registration($firstname, $lastname, $email, $password)
    {
        if (!empty(trim($firstname)) && !empty(trim($lastname)) && !empty(trim($email)) && !empty(trim($password))) {
            $data="SELECT * FROM users WHERE email = :email";
            $create = $this->getBdd()->prepare($data);
            $create -> execute(
                array(
                    ':email' => $email
                    )
                );            
            $value = $create->fetchAll();
            $rows = $create->rowCount();

            if ($rows == 0) {
                $data="INSERT INTO users(firstname, lastname, email, password, file) VALUES (:firstname, :lastname, :email, :password, :file)";
                $create = $this->getBdd()->prepare($data);
                $create -> execute(
                    array(
                     ':firstname'=> addslashes($firstname),
                     ':lastname'=> addslashes($lastname),
                     ':email'=> addslashes($email),  
                     ':password'=> sha1($password),                            
                     ':file' => "0.png"
                     )
                    );
                return "Votre inscrition est reussi";
                header("location: index.php");

            } else {
                return "* Email deja pris";
            } 
        }
        else {
            return "* Champs mal remplis";
        }
    }

    /**
     * Deconnexion
     *
     * @return void
     */
    public function logOut($dir)
    {
        $membre=array();
        session_destroy();
        header('Location: '.$dir.'index.php');
        
    }


    /**
     * Mise à jour des infos utilisateur
     *
     * @param string $firstname prénom utilisateur
     * @param string $lastname   nom utilisateur
     * @param string $password le mot de passe utilisateur
     * @param string $email   le mail utilisateur
     * @param int    $id     l'id utilisateur
     *
     * @return bool
     */
    public function updateUser($firstname, $lastname, $email, $password, $file)
    {
        if (empty(trim($firstname)) || empty(trim($lastname)) || empty(trim($email)))
        {
            return "Champs manquants";
        }
        if(isset($file) && !empty($file) && $file["size"] > 0)
        {
            // get the file extension
            $imageFileType = pathinfo(basename($file['name']),PATHINFO_EXTENSION);
            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ){
                return "Uniquement les photos type jpg, jpeg, png et gif.";
            }
            // Check file size
            if ($file["size"] > 500000) {
                return "L'image ne doit pas être supérieur à 500ko";
            }

            $newName = $_SESSION['id_user'] . '.' . $imageFileType;
            move_uploaded_file($file["tmp_name"], 
                "../../assets/images_users/" . $newName);
        }
        else
            $newName = $_SESSION['file'];

        $updateUser= 'UPDATE users SET firstname = :firstname, lastname = :lastname, email = :email, file =:file WHERE id_user = :id_user';
        $reussi= $this->getBdd()->prepare($updateUser);
        $reussi -> execute(
            array(
                ":firstname" => addslashes($firstname),
                ":lastname" => addslashes($lastname),
                ":email"=> addslashes($email),
                ":file" => $newName,
                ":id_user" => $_SESSION["id_user"]
                )
            );

        $_SESSION["email"] = $email;
        $_SESSION['lastname'] = $lastname;
        $_SESSION['firstname'] = $firstname; 
        $_SESSION['file'] = $newName;

        if (isset($password) && !empty($password))
        {
            $updateUser= 'UPDATE users SET password=:password WHERE id_user = :id_user';
            $reussi= $this->getBdd()->prepare($updateUser);
            $reussi -> execute(
                array(
                    ":password" => sha1($password),
                    ":id_user" => $_SESSION["id_user"]
                    )
                );
        }

        return "Changements effectués";
    }

    /**
     * Insert Article
     *
     * @param string $title        title article
     * @param string $message      message article
     * @param string $file         file article
     *
     * @return void
     */
    public function insertArticle($title, $message, $file)
    {
        if(isset($file) && !empty($file) && $file["size"] > 0)
        {
            // get the file extension
            $imageFileType = pathinfo(basename($file['name']),PATHINFO_EXTENSION);

            if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") 
            {
                return "Uniquement les photos type jpg, jpeg, png et gif.";
            }
             // Check file size
            if ($file["size"] > 500000) {
                return "L'image ne doit pas être supérieur à 500ko";
            }
        }

        if(empty(trim($title)) || empty(trim($message)))
        {
            return "Le titre et le message doivent être renseignés";
        }

        if (strlen($message) > 120) {
            return "Le nombre de caractere maximum a été dépassé";
        }

        $insert='INSERT INTO message( title, message, id_user, date) VALUES (:title, :message, :id_user, NOW())';
        $go = $this->getBdd()->prepare($insert);
        $go->execute(
            array(
                ":title" => addslashes($title),
                ":message" => addslashes($message),
                ":id_user" => $_SESSION["id_user"]
                )
            );

        if(isset($file) && !empty($file) && $file["size"] > 0)
        {
            $data= "SELECT id_message FROM message WHERE id_user= :id_user AND title = :title AND message=:message";
            $create = $this->getBdd()->prepare($data);
            $create -> execute(
                array(
                    ':id_user'=> $_SESSION['id_user'],
                    ':title'=> addslashes($title),
                    ':message' => addslashes($message)
                    )
                );
            $create1 = $create->fetch();

            $id_message = $create1['id_message'];

            $newName = $id_message . '.' . $imageFileType;

            move_uploaded_file($file["tmp_name"], 
                "../../assets/images_articles/" . $newName);

                // changer le champs file, puisqu'on en a un unique maintenant
            $updateMessage= 'UPDATE message SET file = :file WHERE id_message = :id_message';
            $reussi= $this->getBdd()->prepare($updateMessage);
            $reussi -> execute(
                array(
                    ":file" => $newName,
                    ":id_message" => $id_message
                    )
                );
        }
    } 

    /**
     * Affichage article
     *
     * @return void
     */
    public function afficheMessage($page) 
    {
        $maxArticleParPage = 3;
        $offset = ($page - 1) * 3;
        $update = 'SELECT * FROM message WHERE id_user = :id_user ORDER BY date desc LIMIT 3 OFFSET '.$offset;
        $envoie = $this->getBdd()->prepare($update);
        $envoie -> execute(
            array(
                ":id_user" => $_SESSION["id_user"]
                )
            );
        $value = $envoie->fetchAll();
        return $value;
    } 

    /**
     * Comptage articles
     *
     * @return int
     */
    public function countArticles() 
    {
        $update = 'SELECT count(*) as nbArticles FROM message WHERE id_user = :id_user';
        $envoie = $this->getBdd()->prepare($update);
        $envoie -> execute(
            array(
                ":id_user" => $_SESSION["id_user"]
                )
            );
        $value = $envoie->fetch();
        return $value['nbArticles'];
    } 

    /**
     * update article
     *
     * @param int    $title l'id du client
     * @param int    $message  l'id du livre
     * @param string $date_res  la date de réservation
     * @param string $duree     duree de la réservation
     * @param int    $id_user  l'id de la reservation
     *
     * @return void
     */
    public function updateArticle($title, $message, $file, $id_message) 
    {
       if(empty(trim($title)) || empty(trim($message)))
       {
        return "Le titre et le message doivent être renseignés";
    }

    if (strlen($message) > 120) {
        return "Le nombre de caractere maximum a été dépassé";
    }

    if(isset($file) && !empty($file) && $file["size"] > 0)
    {
            // get the file extension
        $imageFileType = pathinfo(basename($file['name']),PATHINFO_EXTENSION);
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {

            return "Uniquement les photos type jpg, jpeg, png et gif.";
        }
            // Check file size
        if ($file["size"] > 500000) {
            return "L'image ne doit pas être supérieur à 500ko";
        }

        $newName = $id_message . '.' . $imageFileType;
        move_uploaded_file($file["tmp_name"], 
            "../../assets/images_articles/" . $newName);

        $update = 'UPDATE message SET file=:file WHERE id_message = :id_message AND id_user =:id_user ';
        $reussi= $this->getBdd()->prepare($update);
        $reussi -> execute(
            array(
                ":file" => $newName,
                ":id_message" => $id_message,
                ":id_user"=> $_SESSION["id_user"]
                )
            );
    }

    $update = 'UPDATE message SET title = :title, message = :message WHERE id_message = :id_message AND id_user =:id_user ';
    $reussi= $this->getBdd()->prepare($update);
    $reussi -> execute(
        array(
            ":title" => addslashes($title),
            ":message" => addslashes($message),
            ":id_message" => $id_message,
            ":id_user"=> $_SESSION["id_user"]
            )
        );
}

    /**
     * Supression du message
     *
     * @param int $id_message id du message
     *
     * @return void
     */
    public function deleteMessage($id_message)
    {

        $delete= 'DELETE FROM message WHERE  id_message = :id_message AND id_user = :id_user';
        $reussi= $this->getBdd()->prepare($delete);
        $reussi -> execute(
            array(
                ":id_message" => $id_message,
                ":id_user"=> $_SESSION["id_user"]
                )
            );
    }


}
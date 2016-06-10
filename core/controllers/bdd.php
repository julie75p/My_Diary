<?php
/**
 * Bdd File Doc Comment
 *
 * PHP Version 5.2
 *
 * @category Bdd
 * @package  None
 * @author   julie planque <julie.planque34@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://example.com/recipes
 */
session_start();
/**
 * Bdd Class Doc Comment
 *
 * @category Bdd
 * @package  None
 * @author   julie planque <julie.planque34@gmail.com>
 * @license  http://opensource.org/licenses/gpl-license.php GNU Public License
 * @link     http://example.com/recipes
 */
Class Bdd
{
    protected $bdd;
    /**
     * Construc connexion
     *
     * @return void
     */
    public function __construct() 
    {
        try
        {
            $this->bdd = new PDO('mysql:host=localhost;dbname=mydiary', 'root', '');
        }
        catch(Exception $e){
            die('Erreur : '.$e->getMessage());
        }
    }
     /**
      *  Bdd
      *
      * @return void
      */
    public function getBdd() 
    {
        return $this->bdd;
    }
    
}
?>
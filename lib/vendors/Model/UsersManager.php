<?php
namespace Model;
 
use \OCFram\Manager;
use \Entity\User;
 
abstract class UsersManager extends Manager
{
  /**
   * Méthode permettant d'ajouter un utilisateur.
   * @param $user News L'utilisateur à ajouter
   * @return void
   */
  abstract protected function add(User $user);
 
  /**
   * Méthode permettant d'enregistrer un utilisateur.
   * @param $user User l'utilisateur à enregistrer
   * @see self::add()
   * @see self::modify()
   * @return void
   */
  public function save(User $user)
  {
    if ($user->isValid())
    {
      $user->isNew() ? $this->add($user) : $this->modify($user);
    }
    else
    {
      throw new \RuntimeException('La nom d\'utilisateur doit être validé pour être enregistré');
    }
  }
  /**
   * Méthode permettant de supprimer un utilisateur.
   * @param $id int L'identifiant de l'utilisateur à supprimer
   * @return void
   */
  abstract public function delete($id);

  abstract public function getByLogin($login);

    /**
   * Méthode retournant une news précise.
   * @param $id int L'identifiant de la news à récupérer
   * @return News La news demandée
   */
  abstract public function getUnique($id);
 
}
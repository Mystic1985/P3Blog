<?php
namespace Model;
 
use \Entity\User;
 
class UsersManagerPDO extends UsersManager
{
  protected function add(User $user)
  {
    $q = $this->dao->prepare('INSERT INTO users SET id = :id, username = :username, password = :password');
 
    $q->bindValue(':id', $user->id(), \PDO::PARAM_INT);
    $q->bindValue(':username', $user->username());
    $q->bindValue(':password', sha1($user->password()));
 
    $q->execute();
 
    $user->setId($this->dao->lastInsertId());
  }
 
  public function delete($id)
  {
    $this->dao->exec('DELETE FROM users WHERE id = '.(int) $id);
  }
 
  public function getUsersList()
  {
    $q = $this->dao->query('SELECT id, username FROM users');
 
    $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');
    
    return $q->fetchAll();
  }

  public function getByLogin($login)
  {
    $q = $this->dao->prepare('SELECT id, username, password FROM users WHERE username = :login');

    $q->bindValue(':login', $login);
    $q->execute();
 
    $q->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');
    
    return $q->fetch();
  }

  public function getUnique($id)
  {
    $requete = $this->dao->prepare('SELECT id, username, password FROM users WHERE id = :id');
    $requete->bindValue(':id', (int) $id, \PDO::PARAM_INT);
    $requete->execute();
 
    $requete->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, '\Entity\User');
 
    if ($user = $requete->fetch())
    {
      return $user;
    }
 
    return null;
  }
 
}
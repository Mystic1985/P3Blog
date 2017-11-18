<?
namespace Entity;
 
use \OCFram\Entity;
 
class User extends Entity
{
  protected $id,
            $username,
            $password;
 
  const USERNAME_INVALIDE = 1;
  const PASSWORD_INVALIDE = 2;
 
  public function isValid()
  {
    return !(empty($this->username) || empty($this->password));
  }
 
  public function setUsername($username)
  {
  	if(empty($this->username))
  	{
  		$this->erreurs[] = self::USERNAME_INVALIDE;
  	}
    $this->username = $username;
  }
 
  public function setPassword($password)
  {
    if (empty($password))
    {
      $this->erreurs[] = self::PASSWORD_INVALIDE;
    }
 
    $this->password = $password;
  }
 
 public function id()
 {
 	return $this->id;
 }

 public function username()
 {
 	return $this->username;
 }

 public function password()
 {
 	return $this->password;
 }

}
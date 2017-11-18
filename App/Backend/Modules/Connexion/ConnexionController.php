<?php

namespace App\Backend\Modules\Connexion;
 
use \OCFram\BackController;
use \OCFram\HTTPRequest;
 
class ConnexionController extends BackController
{
  public function executeIndex(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Connexion');
 
    if ($request->postExists('login'))
    {
      $login = $request->postData('login');
      $password = $request->postData('password');
      
      $manager = $this->managers->getManagerOf('Users');
      $user = $manager->getByLogin($login);

      if ($user && $login == $user->username() && sha1($password) == $user->password())
      {
        $this->app->user()->setAuthenticated(true);
        $this->app->httpResponse()->redirect('.');
      }
      
      else
      {
        $this->app->user()->setFlash('Le pseudo ou le mot de passe est incorrect.');
      }
    }
  }
}
<?php
namespace App\Backend\Modules\Users;
 
use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\User;
use \FormBuilder\UserFormBuilder;
use \OCFram\FormHandler;

 
class UsersController extends BackController
{

    public function executeIndex(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Liste des utilisateurs');
 
    $manager = $this->managers->getManagerOf('Users');
 
    $this->page->addVar('listUsers', $manager->getUsersList());
  }
  
  public function executeDeleteUser(HTTPRequest $request)
  {
    $usersId = $request->getData('id');
 
    $this->managers->getManagerOf('Users')->delete($usersId);
 
    $this->app->user()->setFlash('L\'utilisateur a bien été supprimé de la base de données !');
 
    $this->app->httpResponse()->redirect('/admin/users-list.html');
  }

  public function executeAddUser(HTTPRequest $request)
  {
    $this->processForm($request);
 
    $this->page->addVar('title', 'Ajout d\'un utilisateur');
  }

  public function processForm(HTTPRequest $request)
  {
    if ($request->method() == 'POST')
    {
        $user = new User([
        'username' => $request->postData('username'),
        'password' => $request->postData('password'),
      ]);
 
      if ($request->getExists('id'))
      {
        $user->setId($request->getData('id'));
      }
    }
    else
    {
      // L'identifiant de la news est transmis si on veut la modifier
      if ($request->getExists('id'))
      {
        $user = $this->managers->getManagerOf('Users')->getUnique($request->getData('id'));
      }
      else
      {
        $user = new User;
      }
    }
      
    $formBuilder = new UserFormBuilder($user);
    $formBuilder->build();
 
    $form = $formBuilder->form();
 
    $formHandler = new FormHandler($form, $this->managers->getManagerOf('Users'), $request);
 
    if ($formHandler->process())
    {
      $this->app->user()->setFlash($user->isNew() ? 'L\'utilisateur a bien été ajouté !' : 'L\'utilisateur a bien été modifié !');
 
      $this->app->httpResponse()->redirect('/admin/users-list.html');
    }
 
    $this->page->addVar('form', $form->createView());
  }
}


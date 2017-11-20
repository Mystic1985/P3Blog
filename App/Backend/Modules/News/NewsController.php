<?php
namespace App\Backend\Modules\News;
 
use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\News;
use \Entity\Comment;
use \FormBuilder\CommentFormBuilder;
use \FormBuilder\NewsFormBuilder;
use \OCFram\FormHandler;
 
class NewsController extends BackController
{
    public function executeIndex(HTTPRequest $request)
  {

    //Récupération du numéro de page sous la forme d'une variable
    $page = $request->getData('page');
    $nombreNews = $this->app->config()->get('nombre_news'); //nombre_news = 5
    //Si on a numéro de page, alors on calcule le numéro du premier billet à afficher sous forme de variable
    if(isset($page)) 
    {
      $min = $page * $nombreNews - $nombreNews;
    }
    //Sinon, la première page sera affichée par défaut
    else
    {
      $min = 0;
      $page = 1;
    }
    // Création d'une variable pour accéder à la page précédente
    if($page > 1)
    {
      $pageprecedente = $page - 1;
    }

    else
    {
      $pageprecedente = 1;
    }
    //Création d'une variable pour accéder à la page suivante
    $pagesuivante = $page + 1;

    $this->page->addVar('title', 'Gestion des billets');
 
    $manager = $this->managers->getManagerOf('News');
    //Création d'une variable pour afficher la dernière page de la liste des billets
    $lastPage = ceil($manager->count() / $nombreNews);
    $listeNews = $manager->getList($min, $nombreNews);

    //Si le numéro de la page actuel est égal au numéro de la dernière page :
    if($page == $lastPage)
    {
      $pagesuivante = $lastPage;
    }

    else
    {
      $pagesuivante = $page + 1;
    }
    
    //Transmission des variables à la vue
    $this->page->addVar('page', $page);
    $this->page->addVar('pagePrecedente', $pageprecedente);
    $this->page->addVar('pageSuivante', $pagesuivante);
    $this->page->addVar('listeNews', $listeNews);
    $this->page->addVar('nombreNews', $manager->count());
    $this->page->addVar('lastPage', $lastPage);
  }

 
  public function executeDelete(HTTPRequest $request)
  {
    $newsId = $request->getData('id');
 
    $this->managers->getManagerOf('News')->delete($newsId);
    $this->managers->getManagerOf('Comments')->deleteFromNews($newsId);
 
    $this->app->user()->setFlash('Le billet a bien été supprimé !');
 
    $this->app->httpResponse()->redirect('.');
  }
 
  public function executeDeleteComment(HTTPRequest $request)
  {
    $this->managers->getManagerOf('Comments')->delete($request->getData('id'));
 
    $this->app->user()->setFlash('Le commentaire a bien été supprimé !');
 
    $this->app->httpResponse()->redirect('/admin/comments-signales.html');
  }
 

  public function executeInsert(HTTPRequest $request)
  {
    $this->processForm($request);
 
    $this->page->addVar('title', 'Ajout d\'une news');
  }
 
  public function executeUpdate(HTTPRequest $request)
  {
    $this->processForm($request);
 
    $this->page->addVar('title', 'Modification d\'une news');
  }
 
  public function executeUpdateComment(HTTPRequest $request)
  {
    $this->page->addVar('title', 'Modification d\'un commentaire');
 
    if ($request->method() == 'POST')
    {
      $comment = new Comment([
        'id' => $request->getData('id'),
        'auteur' => $request->postData('auteur'),
        'contenu' => $request->postData('contenu')
      ]);
    }
    else
    {
      $comment = $this->managers->getManagerOf('Comments')->get($request->getData('id'));
    }
 
    $formBuilder = new CommentFormBuilder($comment);
    $formBuilder->build();
 
    $form = $formBuilder->form();
 
    $formHandler = new FormHandler($form, $this->managers->getManagerOf('Comments'), $request);
 
    if ($formHandler->process())
    {
      $this->app->user()->setFlash('Le commentaire a bien été modifié');
 
      $this->app->httpResponse()->redirect('/admin/comments-signales.html');
    }
 
    $this->page->addVar('form', $form->createView());
  }
 
  public function processForm(HTTPRequest $request)
  {
    if ($request->method() == 'POST')
    {
      $news = new News([
        'auteur' => $request->postData('auteur'),
        'titre' => $request->postData('titre'),
        'contenu' => $request->postData('contenu')
      ]);
 
      if ($request->getExists('id'))
      {
        $news->setId($request->getData('id'));
      }
    }
    else
    {
      // L'identifiant de la news est transmis si on veut la modifier
      if ($request->getExists('id'))
      {
        $news = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));
      }
      else
      {
        $news = new News;
      }
    }
 
    $formBuilder = new NewsFormBuilder($news);
    $formBuilder->build();
 
    $form = $formBuilder->form();
 
    $formHandler = new FormHandler($form, $this->managers->getManagerOf('News'), $request);
 
    if ($formHandler->process())
    {
      $this->app->user()->setFlash($news->isNew() ? 'Le billet a bien été ajouté !' : 'Le billet a bien été modifié !');
 
      $this->app->httpResponse()->redirect('/admin/');
    }
 
    $this->page->addVar('form', $form->createView());
  }

  public function executeIndexCommentsSignales()
  {
    $this->page->addVar('title', 'Gestion des commentaires');
 
    $manager = $this->managers->getManagerOf('Comments');
 
    $this->page->addVar('listComments', $manager->getListSignales());
  }
}
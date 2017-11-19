<?php
namespace App\Frontend\Modules\News;
 
use \OCFram\BackController;
use \OCFram\HTTPRequest;
use \Entity\Comment;
use \FormBuilder\CommentFormBuilder;
use \OCFram\FormHandler;
 
class NewsController extends BackController
{
  public function executeIndex(HTTPRequest $request)
  {
    // On récupère le nombre de billets à afficher (5) et le nombre de caractères (200)
    $nombreNews = $this->app->config()->get('nombre_news'); 
    $nombreCaracteres = $this->app->config()->get('nombre_caracteres');
 
    // On ajoute une définition pour le titre.
    $this->page->addVar('title', 'Liste des '.$nombreNews.' derniers billets');
 
    // On récupère le manager des billets.
    $manager = $this->managers->getManagerOf('News');
    
    // On récupère la liste des billets à afficher ($nombreNews = 5)
    $listeNews = $manager->getList(0, $nombreNews); 
 
    // On parcourt la liste des billets pour récupérer le nombre de caractères de chaque billet
    foreach ($listeNews as $news)
    {
      if (strlen($news->contenu()) > $nombreCaracteres) // Si la longueur du billet dépasse 200 caractères, on récupère les 200 premiers caractères du billet
      {
        $debut = substr($news->contenu(), 0, $nombreCaracteres);
        $debut = substr($debut, 0, strrpos($debut, ' ')) . '...';
 
        $news->setContenu($debut);
      }
    }
 
    // On ajoute la variable $listeNews à la vue.
    $this->page->addVar('listeNews', $listeNews);
  }
 
  public function executeShow(HTTPRequest $request)
  {
    $news = $this->managers->getManagerOf('News')->getUnique($request->getData('id'));
 
    if (empty($news))
    {
      $this->app->httpResponse()->redirect404();
    }
 
    $this->page->addVar('title', $news->titre());
    $this->page->addVar('news', $news);
    $this->page->addVar('comments', $this->managers->getManagerOf('Comments')->getListOf($news->id()));
  }
 
  public function executeInsertComment(HTTPRequest $request)
  {
    // Si le formulaire a été envoyé.
    if ($request->method() == 'POST')
    {
      $comment = new Comment([
        'news' => $request->getData('news'),
        'auteur' => $request->postData('auteur'),
        'contenu' => $request->postData('contenu')
      ]);
    }
    else
    {
      $comment = new Comment;
    }
 
    $formBuilder = new CommentFormBuilder($comment);
    $formBuilder->build();
 
    $form = $formBuilder->form();
 
    $formHandler = new FormHandler($form, $this->managers->getManagerOf('Comments'), $request);
 
    if ($formHandler->process())
    {
      $this->app->user()->setFlash('Le commentaire a bien été ajouté, merci !');
 
      $this->app->httpResponse()->redirect('news-'.$request->getData('news').'.html');
    }
 
    $this->page->addVar('comment', $comment);
    $this->page->addVar('form', $form->createView());
    $this->page->addVar('title', 'Ajout d\'un commentaire');
  }

  public function executeSignalComment(HTTPRequest $request)
  {
    $commentid = $request->getData('commentid'); 
    $manager = $this->managers->getManagerOf('Comments');
    $manager->signalComment($commentid);

    $this->app->user()->setFlash('Le commentaire a bien été signalé !');

    $this->app->httpResponse()->redirect('.');
  }
}
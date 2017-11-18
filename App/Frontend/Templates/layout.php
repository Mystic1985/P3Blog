<!DOCTYPE html>
<html>
  <head>
    <title>
      <?= isset($title) ? $title : 'Billet simple pour l\'Alaska' ?>
    </title>
 
    <meta charset="utf-8" />
 

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" link href="/css/blog.css" />
    <script src="js/jquery.js"></script>
    <script src='https://cloud.tinymce.com/stable/tinymce.min.js'></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script>
    tinymce.init({
    selector: 'textarea'
  });
  </script>
  </head>
 
  <body >
    <div class="container">

    <div id="wrap">
      <header class="row">
        <div class="col-lg-12">
          <img src="/images/plume.jpg" class="img-rounded" alt="Pulme"><div class="text-center font-italic font-weight-bold"><h1 class="title"><a href="/">Billet simple pour l'Alaska</a></h1></div>
        </div>
        <div class="col-lg-12">
        <div class="text-center font-italic font-weight-bold"><h3 class="subtitle">Le blog de Jean Forteroche</h3></div>
        </div>
      </header>
      
     
       <nav class="nav navbar-custom">
        <div class="container-fluid">
          <ul class="nav navbar-nav">
            <li> <a href="/">Accueil</a></li>
            <?php if ($user->isAuthenticated()) { ?>
            <li> <a href="/admin/">Administration</a> </li>
            <li> <a href="/admin/news-insert.html">Rédiger un billet</a> </li>
           <?php } ?>
          </ul>
        </div>
      </nav>
      </div>
  
      <div id="content-wrap">
        <section id="main">
          <?php if ($user->hasFlash()) echo '<p style="text-align: center;">', $user->getFlash(), '</p>'; ?>
 
          <?= $content ?>
        </section>
      </div>
 
            <footer class="text-center">
        <div class="row">
          <div class="col-lg-12">
            <a class="btn btn-primary btn-sm" href="#"><i class="fa fa-twitter"></i></a>
            <a class="btn btn-primary btn-sm" href="#"><i class="fa fa-facebook"></i></a>
            <a class="btn btn-primary btn-sm" href="#"><i class="fa fa-google-plus"></i></a>
          </div>
        </div>
      </footer>
    </div>
    </div>
  </body>
</html>
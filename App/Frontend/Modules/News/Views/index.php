<?php

foreach ($listeNews as $news)
{
?>
  <h2 class="newstitle"><a href="news-<?= $news['id'] ?>.html"><?= $news['titre'] ?></a></h2>
  <p><?= nl2br($news['contenu']) ?></p>
<?php
}
?>
<a class="btn btn-default btn-xs" href="/"><span class="glyphicon glyphicon-fast-backward" aria-hidden="true"></span></a> <a class="btn btn-default btn-xs" href="page-<?php echo $pagePrecedente ?>.html"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span></a> <strong><?php echo $page ?></strong> <a class="btn btn-default btn-xs" href="page-<?php echo $pageSuivante ?>.html"><span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></a>  <a class="btn btn-default btn-xs" href="page-<?php echo $lastPage ?>.html"><span class="glyphicon glyphicon-fast-forward" aria-hidden="true"></span></a>

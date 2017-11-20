<div class="col-lg-12 text-center"><h4>Il y a actuellement <?= $nombreNews ?> billets en ligne :</h4></div>

<div class="row">
	<section class="col-lg-12 col-xs-8 table-responsive">
		<table class="table table-bordered table-striped table-condensed">
		<div class="text-right"><a href="/admin/news-insert.html"><i class="fa fa-plus-circle" aria-hidden="true"></i> Ajouter un billet</a></div>
  		<tr><th class="text-center">Auteur</th><th class="text-center">Titre</th><th class ="text-center">Date d'ajout</th><th class="text-center">Dernière modification</th><th class="text-center">Action</th></tr>
		<?php
		foreach ($listeNews as $news)
		{
  		echo '<tr><td >', $news['auteur'], '</td><td>', $news['titre'], '</td><td>le ', $news['dateAjout']->format('d/m/Y à H\hi'), '</td><td>', ($news['dateAjout'] == $news['dateModif'] ? '-' : 'le '.$news['dateModif']->format('d/m/Y à H\hi')), '</td><td><a class="btn btn-default btn-sm" href="news-update-', $news['id'], '.html"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a> <a class="btn btn-default btn-sm" href="news-delete-', $news['id'], '.html"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td></tr>', "\n";
		}
		?>
		</table>
	</section>
</div>
	<a class="btn btn-default btn-xs" href="/admin/news-1.html"><span class="glyphicon glyphicon-fast-backward" aria-hidden="true"></span></a> <a class="btn btn-default btn-xs" href="/admin/news-<?php echo $pagePrecedente ?>.html"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span></a> <strong><?php echo $page ?></strong> <a class="btn btn-default btn-xs" href="/admin/news-<?php echo $pageSuivante ?>.html"><span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></a>  <a class="btn btn-default btn-xs" href="/admin/news-<?php echo $lastPage ?>.html"><span class="glyphicon glyphicon-fast-forward" aria-hidden="true"></span></a>

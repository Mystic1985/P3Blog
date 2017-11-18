<div class="col-lg-12 text-center"><h4>Liste des commentaires signalés :</h4></div><br /><br />

<div class="row">
	<section class="col-lg-offset-2 col-lg-8 table-responsive">
		<table class="table table-bordered table-striped table-condensed">
  <tr><th class="text-center">Auteur</th><th class="text-center">Contenu</th><th class="text-center">Action</th></tr>
<?php
foreach ($listComments as $comment)
{
  echo '<tr><td>', $comment['auteur'], '</td><td>', $comment['contenu'], '</td><td><a class="btn btn-default btn-sm"href="comment-update-', $comment['id'], '.html"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a> <a  class="btn btn-default btn-sm" href="comment-delete-', $comment['id'], '.html"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a></td></tr>', "\n";
}
?>
</table>
</section>
</div>
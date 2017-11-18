<div class="col-lg-12 text-center"><h4>Liste des utilisateurs :</h4></div>
 
 <div class="row">
 	<section class="col-lg-offset-2 col-lg-8 table-responsive">
		<table class="table table-bordered table-striped table-condensed">
		<div class="text-right"><a href="/admin/users-add.html"><i class="fa fa-plus-circle" aria-hidden="true"></i> Ajouter un utilisateur</a></div>
  <tr><th class="text-center">Nom d'utilisateur</th><th class="text-center">Action</th></tr>
<?php
foreach ($listUsers as $users)
{
  echo '<tr><td>', $users['username'], '</td><td><a class="btn btn-default btn-sm" href="users-delete-', $users['id'], '.html"><span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a><tr>';
}


?>
		</table>
	</section>
</div>
</div>
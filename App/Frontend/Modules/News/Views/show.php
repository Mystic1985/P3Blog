<h2 class="text-center"><?= $news['titre'] ?></h2>
<p class="text-center">Par <em><?= $news['auteur'] ?></em>, le <?= $news['dateAjout']->format('d/m/Y à H\hi') ?></p>
<div class="contenubillet"<p class="text-center"><?= nl2br($news['contenu']) ?></p>
 
<?php if ($news['dateAjout'] != $news['dateModif']) { ?>
  <p><small><em>Modifié le <?= $news['dateModif']->format('d/m/Y à H\hi') ?></em></small></p>
<?php } ?>
 
<div><a href="commenter-<?= $news['id'] ?>.html"><i class="fa fa-plus-circle" aria-hidden="true"></i> Ajouter un commentaire</a></div>
 
<?php
if (empty($comments))
{
?>
<p>Aucun commentaire n'a encore été posté.</p>
<?php
}
 
foreach ($comments as $comment)
{
?>
<fieldset>
  <p>
    Posté par <strong><?= htmlspecialchars($comment['auteur']) ?></strong> le <?= $comment['date']->format('d/m/Y à H\hi') ?>
    <?php if ($user->isAuthenticated()) { ?> -
      <a href="admin/comment-update-<?= $comment['id'] ?>.html">Modifier</a> |
      <a href="admin/comment-delete-<?= $comment['id'] ?>.html">Supprimer</a>
    <?php } ?>
  </p>
  <p><?= nl2br(htmlspecialchars($comment['contenu'])) ?></p>

  <div><a href="/comment-signaler-<?= $comment['id'] ?>.html"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Signaler un commentaire</a></div>
</fieldset>
<?php
}
?></div>
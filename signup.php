<?php require('actions/signupAction.php'); ?>

<!DOCTYPE html>
<html lang="fr">
<?php include 'includes/head.php'; ?>

<br><br>
<form class="container" method="POST">

  <?php
  if (isset($errorMsg)) {
    echo '<p>' . $errorMsg . '</p>';
  }
  ?>

  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Pseudo</label>
    <input type="text" class="form-control" name="pseudo">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Nom</label>
    <input type="text" class="form-control" name="lastname">
  </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Prénom</label>
    <input type="text" class="form-control" name="frirstname">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" name="password">
  </div>
  <button type="submit" class="btn-solid theme-primary" name="validate">S'inscrire</button>
</form>

</html>
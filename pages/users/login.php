<?php
    use Core\Auth\DBAuth;
    $app2 = App::getInstance();
    $auth2 = new DBAuth($app2->getDb());

    if($auth2->logged()){
        header('location: admin.php');
    }
?>

<div class="row">
    <div class="col-md-4 col-md-offset-4">
        <h1 class="connect">Connexion</h1>
        <hr class="my-separator">

        <form method="post" action="admin.php">
            <input class="form-control" type="text" name="username" placeholder="Nom d'utilisateur" maxlength="30" required/>
            </br>
            <input class="form-control" type="password" name="password" placeholder="Mot de passe" required/>
            </br>
            <input class="btn btn-success size" type="submit">
        </form>
    </div>
</div>
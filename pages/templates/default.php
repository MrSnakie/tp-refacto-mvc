<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta charset="utf-8">
    <title><?= App::getInstance()->titre; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Stephane B.">

    <!-- Bootstrap core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">

    <!-- Personnal CSS -->
    <link rel="stylesheet" type="text/css" href="css/style.min.css">
  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">MON PETIT SITE</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav navbar-right">
            <?= $admin ?>
            <li><a href="index.php?p=<?= $connect ?>"><?= $connect ?></a></li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End navigation -->

    <!-- Container -->
    <div class="container">

      <div class="starter-template">
        <?= $content; ?>
      </div>

    </div>
    <!-- End container -->

  </body>
</html>
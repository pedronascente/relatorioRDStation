<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="apple-touch-icon-precomposed" type="image/x-icon" href="assets/img/favicons/apple-touch-icon-57x57-4bd12ef533ed79a707b2aa03de3d2da476c13b54f593ec1fc6de7a0f9fbe9a96.png" sizes="57x57" />
  <link rel="apple-touch-icon-precomposed" type="image/x-icon" href="assets/img/favicons/apple-touch-icon-114x114-aa43269c50a14dd201ab2880f3a609aa809ff65d81587d5278addf50abe54283.png" sizes="114x114" />
  <link rel="apple-touch-icon-precomposed" type="image/x-icon" href="assets/img/favicons/apple-touch-icon-72x72-74c844a43006728e10d175cea4e6c4e1327ab77b9090fd20209eb0e824932629.png" sizes="72x72" />
  <link rel="apple-touch-icon-precomposed" type="image/x-icon" href="assets/img/favicons/apple-touch-icon-144x144-45fa753fab5f0671bee6c9bcfd9a6129ec4a129e362f491e4279d9e4d8786905.png" sizes="144x144" />
  <link rel="apple-touch-icon-precomposed" type="image/x-icon" href="assets/img/favicons/apple-touch-icon-60x60-56de29edf99dcd1a5a08bb2d43d3ab132bc88a96894121d9a64cd3ac37d1430e.png" sizes="60x60" />
  <link rel="apple-touch-icon-precomposed" type="image/x-icon" href="assets/img/favicons/apple-touch-icon-120x120-01bdf39a24684e979113751df7991b309beb05fffc8afa1ad83e54cdec950c23.png" sizes="120x120" />
  <link rel="apple-touch-icon-precomposed" type="image/x-icon" href="assets/img/favicons/apple-touch-icon-76x76-9e8c5b42a0797c020de9f9fee4ae3248933716ceddb955bfd7cdbe7ec206f85b.png" sizes="76x76" />
  <link rel="apple-touch-icon-precomposed" type="image/x-icon" href="assets/img/favicons/apple-touch-icon-152x152-e7a0a8f21016a1c872482631e461c9e9588b8d9636ed766d8ca96cac6a1104bd.png" sizes="152x152" />
  <link rel="apple-touch-icon-precomposed" type="image/x-icon" href="assets/img/favicons/apple-touch-icon-180x180-0d779b988617e6bba3a0c0f4a530e7e5d3539bd00a5ffb6b2f9912b696b1ae5a.png" sizes="180x180" />
  <link rel="icon" type="image/png" href="assets/img/favicons/favicon-196x196-1d3f83deb557878bbd0acdef6806f481aadc845ca00d764732cc3b26f50787af.png" sizes="196x196" />
  <link rel="icon" type="image/png" href="assets/img/favicons/favicon-96x96-4579ab55c4ba5209483d964b61aaa5289a44fef2e40203bab6d76e5d7afdf3b7.png" sizes="96x96" />
  <link rel="icon" type="image/png" href="assets/img/favicons/favicon-32x32-3aa544656167904ab6939b8d7c94d1b94475faec8619335c71024c60ad1e375f.png" sizes="32x32" />
  <link rel="icon" type="image/png" href="assets/img/favicons/favicon-16x16-7e72cad12dd542036d17cecfa58723fe339a385007b5c9d7988efb466b17c45b.png" sizes="16x16" />
  <link rel="icon" type="image/png" href="assets/img/favicons/favicon-128-2a7dbbc8d7642b80640ab6475343986ecda85fa1006180bccaa09165bcd3cf08.png" sizes="128x128" />

  <title>Login</title>

  <!-- Bootstrap core CSS -->
  <link href="assets/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="assets/css/signin.css" rel="stylesheet">
</head>

<body class="text-center">
  <form class="form-signin" action="app/Controllers/LoginController.php" method="post">
    <img class="mb-4" src="assets/img/apple-touch-icon-114x114-aa43269c50a14dd201ab2880f3a609aa809ff65d81587d5278addf50abe54283.png" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Olá</h1>
    <?php if (isset($_SESSION['nao_autenticado'])) { ?>
      <div class="alert alert-danger text-center" role="alert">
        ERRO: Usuário ou senha inválidos.
      </div>
    <?php } ?>
    <label class="sr-only">Email</label>
    <input type="email" id="inputEmail" name="email" class="form-control" value="admin@rd.com.br" placeholder="Email address" required autofocus><br>
    <label class="sr-only">Senha</label>
    <input type="password" name="password" id="inputPassword" class="form-control" value="123" placeholder="Password" required>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
    <p class="mt-5 mb-3 text-muted">&copy; <?php echo date('Y'); ?></p>
  </form>
</body>

</html>
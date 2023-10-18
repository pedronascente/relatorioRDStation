<div class="bg-white p-5 card mb-5">
	<h4 class="alert-heading">Criar um aplicativo na RD Station App Store !</h4>
	<p> No fluxo OAuth de autenticação, seu aplicativo possui duas credenciais, que chamamos de client_id e client_secret. <br>Essas credenciais são utilizadas para gerar tokens de acesso.
		Uma vez que um token de acesso tenha sido gerado, ele será utilizado nas trocas de mensagens via API.</p>
	<p> # Atenção: quando você for criar seu aplicativo na <b>RD Station App Store</b>, você deve informar os seguintes campos abaixo:</p>
	<ul>
		<li><b>Nome : </b> <?php echo $app; ?></li>
		<li><b>URLs de Callback :</b> <?php echo _URL_ . "/callback/index.php?app=$app" ?></li>
	</ul>
	<hr>
	<div class="text-center">
		<a href="<?php echo APPSTORE_RDSTATION; ?>" class="btn btn-primary" title="Criar um aplicativo na RD Station App Store" target="_blank">
			Clique aqui criar seu Aplicativo na RD Station App Store
		</a>
	</div>
</div>

<div class="bg-white p-5 card mb-5">
	<div class="text-center">
		<h4 class="alert-heading mb-4">Registrar credenciais !</h4>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-lg-8 offset-lg-2">
				<div class="card mb-5">
					<div class="card-body">
						<div class="text-center">
							<p>Agora que seu aplicativo foi criado na RD Station App Store, Registre suas credênciais no formulário abaixo.</p>
						</div>
						<form action="<?php echo _URL_ ?>/app/Controllers/RegistrarCredenciaisController.php" method="post">
							<input type="hidden" name="nome" value="<?php echo $app; ?>" required="">
							<input type="hidden" name="app" value="<?php echo _URL_ . "/app/index.php?app=$app" ?>" required="">
							<input type="hidden" name="callback" value="<?php echo _URL_ . "/callback/index.php?app=$app"; ?>" required="">

							<div class="form-group">
								<label>Nome:</label>
								<input type="text" value="<?php echo $app; ?>" class="form-control" required="" disabled="true">
							</div>
							<br>

							<div class="form-group">
								<label>Cliente ID:</label>
								<input type="text" name="client_id" value="" class="form-control" required="">
							</div>
							<br>

							<div class="form-group">
								<label>Client Secret:</label>
								<input type="text" name="client_secret" value="" class="form-control" required="">
							</div>
							<br>

							<div class="form-group">
								<label>URLs de Callback:</label>
								<input type="text" value="<?php echo _URL_ . "/callback/index.php?app=$app" ?>" class="form-control" disabled="true">
							</div>
							<br>
							<div class="text-center">
								<button type="submit" class="btn btn-primary">Enviar</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<hr>

	<div class="bg-white p-5 card mb-5">
		<p>Atenção: esta imagem é apenas uma mera ilustração. </p>
		<img src="<?php echo _URL_ ?>/assets/img/img-exemplo-credenciais.jpg" class="img-fluid" alt="Responsive image">
	</div>
<div class="bg-white p-5 card mb-5" >
	<h4 class="alert-heading">Credenciais Registrada !</h4>
	<p>Parabéns você registrou suas credenciais com sucesso!</p>
	<a href='https://api.rd.services/auth/dialog?client_id=<?php echo $config["client_id"];?>&redirect_uri=<?php echo $config["callback"];?>' class="btn btn-primary">
		Clique para Autenticar
	</a>
</div>
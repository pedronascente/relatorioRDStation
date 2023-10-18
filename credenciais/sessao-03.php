<div class="alert alert-success" role="alert">
	Parabéns Autenticação realizada com sucesso!
</div>

<div class="bg-white p-5 card mb-5">
	<h4 class="alert-heading">Configurações de Integração!</h4>
	<p># Atenção! Esta API está configurada para integrar sites com as seguintes tecnologias:  </p>
	<hr>
	<ul>
		<li><a href="https://wordpress.com/pt-br/" target="_blank"> CMS - WordPress</a></li>
		<li><a href="https://calderaforms.com/" target="_blank">Pluig - Caldera Forms</a></li>
		<li><a href="https://www.wordpress-estimation-payment-forms.com/documentation/ "  target="_blank">Pluig - Estimation & Payment Forms</a></li>
	</ul>

	<p># Para enviar os dados do Formulário [ Estimation & Payment Forms] faça os seguintes passos :</p>

	<ul>
		<li class="p-1">Faça uma conexão via FTP no seu site, e localize o arquivo: "www/wp-admin/admin-ajax.php"</li>
		<li class="p-1">Acrescente este script no topo do arquivo:</li>
		<li class="p-1"><img src="<?php echo _URL_?>/assets/img/admin-ajax.jpg" class="img-fluid" alt="Responsive image"></li>
		<li class="p-1">
			Nos arquivos em anexo existe um arquivo (.php), para cada plugin. Portanto, procure pelo arquivo:<br>  
			"FormatarDadosEstimationPaymentForms.php"
		</li class="p-1">
		<li class="p-1">cole aqui : www/wp-wp-admin/</li>
		<ul>
			<li class="p-1"><b>Lembrando este arquivo tem que ser editado de acordo com sua necessidade.</b></li>
		</ul>
	</ul>	

	<hr>

	<p># Para enviar os dados do Formulário [ Caldera Forms ] faça os seguintes passos :</p>

	<ul>
		<li class="p-1">Faça uma conexão via FTP no seu site, e localize o arquivo: "www/wp-content/plugins/caldera-forms/includes/ajax.php"</li>
		<li class="p-1">Acrescente este script no topo do arquivo:</li>
		<li class="p-1"><img src="<?php echo _URL_?>/assets/img/ajax.jpg" class="img-fluid" alt="Responsive image"></li>
		<li class="p-1">Nos arquivos em anexo existe um arquivo (.php), para cada plugin. Portanto procure pelo arquivo :<br>
			"FormatarDadosCalderaFormsForms.php)"
		</li>
		<li class="p-1">cole aqui :  www/wp-content/plugins/caldera-forms/includes/</li>
		<ul>
			<li class="p-1"><b>Lembrando este arquivo tem que ser editado de acordo com sua necessidade.</b></li>
		</ul>
	</ul>

	<hr>

	<div class="text-center">
		<a href="<?php echo _URL_?>/arquivos_integracao_rdstation.rar" class="btn btn-danger" download>
		Baixar Arquivos de integração
	</a>
	</div>

</div>

<div class="bg-white p-5 card mb-5" >
	<h4 class="alert-heading">Campos Personalizados !</h4>
	<p># Atenção : Todos os campos do seu formuário que você julgar interesante para integração, tem que ser criados no RD Station, para ser vinculados nos seus arquivos de Integração:</p>
	<hr>
	<a href="https://app.rdstation.com.br/campos-personalizados" class="btn btn-primary">
		Criar campos personalizados no RD Station
	</a>
	<p class="p-2"># Aqui abaixo está a relação de todos os campos personalizados do RD Station :</p>
	   <ul>
	   		<li class="p-2">Faça uma busca dos campos personalizados que você criou ;</li>
	   		<li class="p-2">Cada campo personalizado possui um  ID de indentificação = <b>api_identifier</b>, 
	   		este id serve para você relacionar os campos dos formuários do seu site, com os campos personalizados no RD Staion. </li>
	   		<li class="p-2">Exemplo de configuração do Formulário [ Estimation & Payment Forms] :<img src="<?php echo _URL_?>/assets/img/exemplo_campo_personalizado1.jpg" class="img-fluid" alt="Responsive image"></li>
	   		<li class="p-2"><img src="<?php echo _URL_?>/assets/img/exemplo_campo_personalizado2.jpg" class="img-fluid" alt="Responsive image"></li>
	   </ul>
</div>
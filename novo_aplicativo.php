<?php
include_once __DIR__ . "/config.php";
include_once __DIR__ . "/includes/head.php";
require __DIR__ . '/vendor/autoload.php';

use App\Model\Conecta;

$conecta = new Conecta();
$array_lista_aplicativos = $conecta->listar_os_aplicativos_registrados();

?>

<div class="bg-white p-5 card mb-5">
	<h4 class="alert-heading">Novo Aplicativo!</h4>
	<p># Caso seja sua primeira integração , crie seu Aplicativo abaixo para cadastrar suas credenciais:</p>
	<hr>

	<form action="<?php echo _URL_ ?>/app/controllers/NovoAplicativoController.php" method="post">
		<div class="form-group">
			<label>Nome:</label>
			<input type="text" name="nome" class="form-control" placeholder="Digite o nome do Aplicativo" required="">
		</div>
		<br>
		<button type="submit" class="btn btn-primary">Criar novo app</button>
	</form>

</div>

<div class="bg-white p-5 card mb-5">
	<h4 class="alert-heading">Autenticação !</h4>
	<p>Para que uma API possa ser acionada é preciso realizar uma autenticação para garantir que os dados transacionados estejam protegidos.<br> Existem três métodos principais para fazer isso: autenticação básica HTTP, Chaves da API e OAuth. No RD Station utilizamos os métodos de autenticação OAuth e Chaves de API.</p>
	<p># Clique no Aplicativo que corresponde à sua integração para efetuar Autenticação:</p>
	<hr>
	<table class="table table-striped">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">App</th>
				<th scope="col">Ação</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if ($array_lista_aplicativos) {
				foreach ($array_lista_aplicativos as $value) {
					$id = $value["id"];
					$nome = $value["nome"];
					$url = _URL_ . "/app/controllers/DeleteAplicativoController.php?id={$id}";
					$_li  = '<tr>';
					$_li .= '<td>' . $id . '</td>';
					$_li .= '<th scope="row"><a href="' . _URL_ . '/registrar_credenciais.php?app=' . $nome . '">' . $nome . '</a></th>';
					$_li .= '<td><a  id="delete" class="btn btn-outline-danger" data-url="' . $url . '"  title="Delete">Delete</a></td>';
					$_li .= '</tr>';
					echo $_li;
				}
			} else {
				echo '<tr><td colspan="2">nenhum app registrado! :(</td></tr>';
			}
			?>
		</tbody>
	</table>
</div>

<?php include_once __DIR__ . '/includes/footer.php'; ?>
<script>
	$(function() {
		$('a#delete').click(function() {
			var url = $(this).attr('data-url');
			if (confirm("Deseja deletar este registro ?")) {
				$(this).attr("href", url);
			}
		});
	});
</script>
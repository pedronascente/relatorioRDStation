	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
	<!-- Inclua o Bootstrap Datepicker CSS e JS -->
	<link rel="stylesheet" href="<?php echo _URL_ ?>/assets/plugin/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
	<script src="<?php echo _URL_ ?>/assets/js/jquery-3.6.0.min.js"></script>
	<script src="<?php echo _URL_ ?>/assets/plugin/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
	<script src="<?php echo _URL_ ?>/assets/plugin/bootstrap-datepicker/js/bootstrap-datepicker.pt-BR.min.js"></script>

	<script>
		$(function() {
			$('.datepicker').datepicker({
				format: 'dd/mm/yyyy',
				language: 'pt-BR',
				autoclose: true // Adicione esta opção
			});
		});

		$('a#delete').click(function() {
			var url = $(this).attr('data-url');
			if (confirm("Deseja deletar este registro ?")) {
				$(this).attr("href", url);
			}
		});
	</script>

	</body>

	</html>
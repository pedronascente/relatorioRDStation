<?php
session_start(); // Inicie a sessão

include_once __DIR__ .  "/config.php";
include_once __DIR__ .  "/includes/head.php";
require __DIR__ . '/vendor/autoload.php';

use App\Model\Relatorio;

$relatorio = new Relatorio();

if (isset($_SESSION['filtro'])) {
  $filtro = $_SESSION['filtro'];
} else {
  $filtro = null; // Defina como null para busca sem parâmetro
  $filtro_modificado =  date('m/d/Y');
}

$resultado = $relatorio->gerarRelatorio($filtro);

if ($filtro !== null) {
  $filtro_explode = explode('-', $filtro);

  $filtro_modificado = $filtro_explode[2] . '/' . $filtro_explode[1] . '/' . $filtro_explode[0];
} else {
  $filtro = null;
}

?>

<div class="row">
  <div class="col-md" style="margin: 15px 0 15px 0;">
    <div class="alert alert-dark" role="alert">
      <h4>Filtro</h4>
      <hr>
      <form action="<?php echo _URL_ ?>/filtro.php" method="POST">
        <div class="input-group">
          <input type="text" name="filtro" class="form-control datepicker" placeholder="__/__/__ " value="<?php echo $filtro_modificado; ?>">
          <div class="input-group-append">
            <button class="btn btn-primary" type="submit">Pesquisar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<div class="row">
  <div class="col-md" style="margin: 15px 0 15px 0;">
    <div class="alert alert-primary" role="alert">
      <b>Volpato</b>
    </div>
  </div>
</div>

<div class="row">
  <?php if (isset($resultado)) { ?>
    <?php foreach ($resultado as $k => $p) { ?>
      <?php if ($p['empresa'] == 'volpato') { ?>
        <div class="col-md text-center">
          <div class="card text-white <?php echo $p['cor']; ?> mb-3">
            <div class="card-header"><?php echo $p['campanha']; ?></div>
            <div class="card-body">
              <h5 class="card-title"><span style="font-size:2rem"><?php echo $p['total']; ?></span> Leads</h5>
            </div>
          </div>
        </div>
      <?php }  ?>
    <?php }  ?>
  <?php }  ?>
</div>
<div class="row">
  <div class="col-md" style="margin: 15px 0 15px 0; ">
    <div class="alert alert-warning" role="alert">
      <b>Easyseg</b>
    </div>
  </div>
</div>
<div class="row">
  <?php if (isset($resultado)) { ?>
    <?php foreach ($resultado as $k => $p) { ?>
      <?php if ($p['empresa'] == 'easyseg') { ?>
        <div class="col-md text-center">
          <div class="card text-white <?php echo $p['cor']; ?> mb-3">
            <div class="card-header"><?php echo $p['campanha'] ?></div>
            <div class="card-body">
              <h5 class="card-title"><span style="font-size:2rem"><?php echo $p['total']; ?></span> Leads</h5>
            </div>
          </div>
        </div>

      <?php }  ?>
    <?php }  ?>
  <?php }  ?>
</div>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>
<!-- Inclua o Bootstrap Datepicker CSS e JS -->
<link rel="stylesheet" href="<?php echo _URL_ ?>/assets/plugin/bootstrap-datepicker/css/bootstrap-datepicker.min.css">
<script src="<?php echo _URL_ ?>/assets/js/jquery-3.6.0.min.js"></script>
<script src="<?php echo _URL_ ?>/assets/plugin/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo _URL_ ?>/assets/plugin/bootstrap-datepicker/js/bootstrap-datepicker.pt-BR.min.js"></script>

<script>
  $(document).ready(function() {
    $('.datepicker').datepicker({
      format: 'dd/mm/yyyy',
      language: 'pt-BR',
      autoclose: true // Adicione esta opção
    });
  });
</script>

<?php include_once(__DIR__ .  "/includes/footer.php"); ?>
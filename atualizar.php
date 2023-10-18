<?php
include_once __DIR__ .  "/config.php";
include_once __DIR__ .  "/includes/head.php";
require __DIR__ . '/vendor/autoload.php';

use App\Model\ProcessContatosJob;
use App\Model\Relatorio;

$processContatosJob = new ProcessContatosJob();
$relatorio = new Relatorio();

$segmentacoes  = [
  [
    'empresa' => 'volpato',
    'servico' => 'portaria',
    'campanha' => 'sites_volpato_portaria',
    'id' => 4662729,
    'cor' => 'bg-dark',
  ], [
    'empresa' => 'volpato',
    'servico' => 'portaria',
    'campanha' => 'FB.portariavirtual.rs',
    'id' => 4857434,
    'cor' => 'bg-dark',
  ], [
    'empresa' => 'volpato',
    'servico' => 'rastreamento',
    'campanha' => 'sites_volpato_rastreamento',
    'id' => 4691668,
    'cor' => 'bg-danger',
  ], [
    'empresa' => 'volpato',
    'servico' => 'rastreamento',
    'campanha' => 'sites_volpato_rastreamento_frota',
    'id' => 4716439,
    'cor' => 'bg-danger',
  ], [
    'empresa' => 'volpato',
    'servico' => 'rastreamento',
    'campanha' => '[Volpato]  FB.rastreamento.rs',
    'id' => 6937130,
    'cor' => 'bg-danger',
  ], [
    'empresa' => 'volpato',
    'servico' => 'rastreamento',
    'campanha' => 'volpatocomseguro.com',
    'id' => 6964838,
    'cor' => 'bg-danger',
  ], [
    'empresa' => 'volpato',
    'servico' => 'rastreamento',
    'campanha' => '[Volpato] FB.rastreamento.sp',
    'id' => 10232546,
    'cor' => 'bg-danger',
  ], [
    'empresa' => 'volpato',
    'servico' => 'alarme',
    'campanha' => 'FB_volpato.alarme.rs.fb',
    'id' => 4839243,
    'cor' => 'bg-primary',
  ], [
    'empresa' => 'volpato',
    'servico' => 'alarme',
    'campanha' => 'sites_volpato_Alarme',
    'id' => 6105109,
    'cor' => 'bg-primary',
  ], [
    'empresa' => 'easyseg',
    'servico' => 'portaria',
    'campanha' => 'sites_easyseg_portaria',
    'id' => 4697825,
    'cor' => 'bg-dark',
  ], [
    'empresa' => 'easyseg',
    'servico' => 'portaria',
    'campanha' => '[Easyseg] FB.Portaria.SP',
    'id' => 4839223,
    'cor' => 'bg-dark',
  ], [
    'empresa' => 'easyseg',
    'servico' => 'portaria',
    'campanha' => '[Easyseg] FB.Portaria.PR',
    'id' => 8108725,
    'cor' => 'bg-dark',
  ], [
    'empresa' => 'easyseg',
    'servico' => 'portaria',
    'campanha' => 'sites_easyseg_portaria_curitiba(DDD)',
    'id' => 7122976,
    'cor' => 'bg-dark',
  ], [
    'empresa' => 'easyseg',
    'servico' => 'portaria',
    'campanha' => 'sites_easyseg_portaria_Rio Grande Do Sul(DDD)',
    'id' => 7407517,
    'cor' => 'bg-dark',
  ], [
    'empresa' => 'easyseg',
    'servico' => 'portaria',
    'campanha' => 'blog-easyseg-portaria',
    'id' => 8502931,
    'cor' => 'bg-dark',
  ], [
    'empresa' => 'easyseg',
    'servico' => 'rastreamento',
    'campanha' => "[Easyseg] FB.Rastreador.Geral",
    'id' => 7757820,
    'cor' => 'bg-danger',
  ], [
    'empresa' => 'easyseg',
    'servico' => 'rastreamento',
    'campanha' => "sites_easyseg_rastreamento",
    'id' => 4561131,
    'cor' => 'bg-danger',
  ], [
    'empresa' => 'easyseg',
    'servico' => 'rastreamento',
    'campanha' => "blog-easyseg-rastreamento",
    'id' => 8502812,
    'cor' => 'bg-danger',
  ], [
    'empresa' => 'easyseg',
    'servico' => 'alarme',
    'campanha' => 'sites_easyseg_alarme',
    'id' => 5173014,
    'cor' => 'bg-primary',
  ], [
    'empresa' => 'easyseg',
    'servico' => 'alarme',
    'campanha' => '[Easyseg] FB.Alarme.RS',
    'id' => 7787234,
    'cor' => 'bg-primary',
  ], [
    'empresa' => 'easyseg',
    'servico' => 'alarme',
    'campanha' =>   'blog-easyseg-alarme',
    'id' => 8502949,
    'cor' => 'bg-primary',
  ], [
    'empresa' => 'easyseg',
    'servico' => 'alarme',
    'campanha' => '[Easyseg] FB.Alarme.SP',
    'id' => 10074290,
    'cor' => 'bg-primary',
  ], [
    'empresa' => 'easyseg',
    'servico' => 'alarme',
    'campanha' => '[Easyseg] FB.Alarme.PR',
    'id' => 10074306,
    'cor' => 'bg-primary',
  ]
];

foreach ($segmentacoes as $segmentacao) {
  $contatos = $processContatosJob->getContatosDaSegmentacao($segmentacao);
  if ($contatos) {
    foreach ($contatos as $contato) {
      // Verifique se o registro já existe na base de dados antes de inserir
      if (!$relatorio->existeContato($contato)) {
        $ee = $relatorio->insert($contato);
        //echo 'Inserido: ' . $contato['campanha']  . PHP_EOL . '<br><hr>';
      }
    }
  }
}

?>
<div class="alert alert-success" role="alert">
  Base atualizada com sucesso.
  <a href="<?php echo _URL_ ?>/relatorio.php" class="btn btn-danger">Voltar</a>
</div>

<script src="<?php echo _URL_ ?>/assets/js/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>


<?php include_once(__DIR__ .  "/includes/footer.php"); ?>
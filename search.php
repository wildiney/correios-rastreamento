<?php
if($_POST){
$dados = array(
	'P_ITEMCODE' 	=> '',
	'P_LINGUA'		=> '001',
	'P_TESTE'			=> '',	
	'P_TIPO'			=> '001',
	'P_COD_UNI'		=> $_POST['cod_rastreio'],
	'Z_ACTION'		=> ''
);

$cURL = curl_init('http://websro.correios.com.br/sro_bin/txect01$.QueryList');
curl_setopt($cURL, CURLOPT_ENCODING, "" );  
curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
curl_setopt($cURL, CURLOPT_POST, true);
curl_setopt($cURL, CURLOPT_POSTFIELDS, $dados);

$resultado = curl_exec($cURL);

curl_close($cURL);

$regex = "/<table(.*)table>/is";
preg_match($regex, $resultado, $matches);
$vaichegar = $matches[0];

$patterns = array();
$patterns[0] = '/border cellpadding=1 hspace=10/'; 
$replaces = array();
$replaces[0] = 'class="custom_table"';
$vaichegar = preg_replace($patterns,$replaces,$vaichegar);
if($vaichegar){
	$status = $vaichegar;
	} else {
		$status = "Não existe registro deste código";
	}
} else {
	header("location:index.php");
	}
?>

<!DOCTYPE html>
<html>
  <head>
  <title>Correios</title>
  <meta charset="ISO-8859-1">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.css" />
  <style type="text/css">
  	#content{padding-bottom:80px;}
  	.anuncio_wrapper{bottom:10px; position:absolute; left:0; margin-top:20px; width:100%; height:60px; background:#999; text-align:center;}
    .anuncio{ margin:0 auto; padding:0; width:290px;}
  	.custom_table{border:2px solid #000; border-collapse:collapse; font-size:0.7em; width:100%;}
  	.custom_table td{border:1px solid #066; padding:2px;}
    
  </style>
  <script src="http://code.jquery.com/jquery-1.8.2.min.js"></script>
  <script src="http://code.jquery.com/mobile/1.2.0/jquery.mobile-1.2.0.min.js"></script>
  <script type="text/javascript">
	$(document).ready(function(){
		$.mobile.loadingMessage  = "Carregando";
		$.mobile.page.prototype.options.backBtnText = "Voltar";	
	});
  </script>
  </head>
  <body>
  <div data-role="page" data-add-back-btn="true">
    <div data-role="header">
      <h1>Correios</h1>
    </div>
    <!-- /header -->
    
    <div id="content" data-role="content">
    <h1>Rastreamento Correios</h1>
      <div class="rastreamento">
      <?php echo $status;?>
      </div>
      <p>Deseja efetuar uma <a href="index.php" data-transition="slidedown">nova pesquisa</a>?</p>
      <div class="anuncio_wrapper">
      	<div class="anuncio">
				<script type="text/javascript"><!--
        google_ad_client = "ca-pub-3074448490604551";
        /* 234 x 60 */
        google_ad_slot = "8371756197";
        google_ad_width = 234;
        google_ad_height = 60;
        //-->
        </script>
        <script type="text/javascript" src="http://pagead2.googlesyndication.com/pagead/show_ads.js">
				</script>
        </div>
      </div>
    </div>
    <!-- /content --> 
    
  </div>
  <!-- /page -->

  </body>
</html>

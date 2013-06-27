<?php
require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;
$deviceType = ($detect->isMobile() ? ($detect->isTablet() ? 'tablet' : 'phone') : 'computer');
$scriptVersion = $detect->getScriptVersion();

$list = 'joel';
$skypeon = 'off';
$formstatus = 'none'; 

if (file_exists("s.php")){
	$skypeon = 'on';
}

if(isset($_POST['Submit'])){
	
		if (isset($_POST['nome']) & isset($_POST['email'])){	
		$emailsender = "joelgouveia@gmail.com";
		 
		/* Verifica qual é o sistema operacional do servidor para ajustar o cabeçalho de forma correta. Não alterar */
		if(PHP_OS == "Linux") $quebra_linha = "\n"; //Se for Linux
		elseif(PHP_OS == "WINNT") $quebra_linha = "\r\n"; // Se for Windows
		else die("Este script nao esta preparado para funcionar com o sistema operacional de seu servidor");
		 
		// Passando os dados obtidos pelo formulário para as variáveis abaixo
		$nomeremetente     = isset($_POST['nome']) ? trim($_POST['nome']) : '-';
		$emailremetente    = isset($_POST['email']) ? trim($_POST['email']) : '-';
		$emaildestinatario = $emailsender;
		$comcopia          = '';
		$comcopiaoculta    = '';
		$assunto			= 'Formulário de Contato Joel Gouveia';
		$mensagem           = "<br><b>Formulário de Contato Joel Gouveia</b><br><br>".
							"<br><br><b>Nome:</b> ".(isset($_POST['nome']) ? trim($_POST['nome']) : 'n').
							"<br><br><b>Porte:</b> ".(isset($_POST['porte']) ? trim($_POST['porte']) : 'p').
							"<br><br><b>Empresa:</b> ".(isset($_POST['empresa']) ? trim($_POST['empresa']) : 'e').
							"<br><br><b>Telefone:</b> ".(isset($_POST['telefone']) ? trim($_POST['telefone']) : 't').
							"<br><br><b>Operadora Cel:</b> ".(isset($_POST['operadora']) ? trim($_POST['operadora']) : 'o').
							"<br><br><b>Celular:</b> ".(isset($_POST['celular']) ? trim($_POST['celular']) : 'c').
							"<br><br><b>Cidade:</b> ".(isset($_POST['cidade']) ? trim($_POST['cidade']) : 'c').
							"<br><br><b>E-mail:</b> ".(isset($_POST['email']) ? trim($_POST['email']) : 'e').
							"<br><br><b>URL site:</b> ".(isset($_POST['www']) ? trim($_POST['www']) : 'w').
							"<br><br><b>Indicação:</b> ".(isset($_POST['indica']) ? trim($_POST['indica']) : 'i').
							"<br><br><b>Mensagem:</b> ".(isset($_POST['mensagem']) ? trim($_POST['mensagem']) : 'm').
							"<br><br><b>Countdown:</b> ".(isset($_POST['countdown']) ? trim($_POST['countdown']) : 'c').
							"<br><br><b>IP de origem:</b> ".$_SERVER["REMOTE_ADDR"];
		 
		 
		/* Montando a mensagem a ser enviada no corpo do e-mail. */
		$mensagemHTML = $mensagem;
		 
		 
		/* Montando o cabeçalho da mensagem */
		$headers = "MIME-Version: 1.1".$quebra_linha;
		//$headers .= "Content-type: text/html; charset=iso-8859-1".$quebra_linha;
		$headers .= "Content-Type: text/html; charset=ISO-8859-1".$quebra_linha;
		// Perceba que a linha acima contém "text/html", sem essa linha, a mensagem não chegará formatada.
		$headers .= "From: ".$emailsender.$quebra_linha;
		$headers .= "Return-Path: " . $emailsender . $quebra_linha;
		// Esses dois "if's" abaixo são porque o Postfix obriga que se um cabeçalho for especificado, deverá haver um valor.
		// Se não houver um valor, o item não deverá ser especificado.
		if(strlen($comcopia) > 0) $headers .= "Cc: ".$comcopia.$quebra_linha;
		if(strlen($comcopiaoculta) > 0) $headers .= "Bcc: ".$comcopiaoculta.$quebra_linha;
		$headers .= "Reply-To: ".$emailremetente.$quebra_linha;
		// Note que o e-mail do remetente será usado no campo Reply-To (Responder Para)
		 
		/* Enviando a mensagem */
		mail($emaildestinatario, $assunto, $mensagemHTML, $headers);
		$formstatus = 'ok';
		} else {
			
		$formstatus = 'fail'; 	
		}

}
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.5">
<title>Joel Gouveia | Designer</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css">
<link href="css/bootstrap-responsive.css" rel="stylesheet" type="text/css">
<link href="css/custom.css" rel="stylesheet" type="text/css">

<!--[if lt IE 9]>
<script src="js/html5.js"></script>
<link href="css/custom_ie.css" rel="stylesheet" type="text/css">
<![endif]-->

<!--[if lte IE 9]>
<script src="js/custom_ie.js"></script> 
<![endif]-->

<?php
if(preg_match('/msie [2-6]/i',$_SERVER['HTTP_USER_AGENT'])) {
	$mensagemHTML = "Origem:".$_SERVER["REMOTE_ADDR"].
					"<br>HTTP_USER_AGENT:".$_SERVER['HTTP_USER_AGENT'];
	mail('joelgouveia@gmail.com', 'Joel Gouveia Site - IE6', $mensagemHTML);
  } 

?>
<!--[if lt IE 7]>
<style>
.container-fluid, .container{display:none;}
</style>
<script src="js/jquery-1.7.2.min.js"></script> 
<script src="js/jquery.adeus.ie6.demo.js"></script> 
<![endif]-->

</head>

<body>
<?php
	$checkmob = $detect->isMobile();

	
	if ($formstatus == 'fail') { ?>
    <style>
	.alert {padding-top: 30px; padding-bottom:30px;}
	</style>
	<div class="alert fade in alert-error" >
	  <button type="button" class="close" data-dismiss="alert">&times;</button>
	  <h4>Atenção!</h4>
	  O campo 'Nome' e 'E-mail' precisam estar preenchidos. Clique em contato e tente novamente!
	</div>
<?php } else if($formstatus == 'ok') { ?>
	<div class="alert fade in alert-success" >
	  <button type="button" class="close" data-dismiss="alert">&times;</button>
	  <h4>Obrigado!</h4>
	  O formulário foi preenchido corretamente. Aguarde o contato em breve!
	</div>
<?php } ?>




<div class="nav-tab"> <img src="img/joelgouveia-tab.png" alt="Logotipo Joel Gouveia" title="Joel Gouveia" class="pull-left" />
  <nav class="pagination pagination-right pull-right">
                            <?php
if ($skypeon == 'on') { ?>
<div class="pull-right skype-tab">
	<a href="skype:joelgouveia?chat"><img src="img/skype.png" /></a>
</div>
<?php } ?>
    <ul id="menuh" class="nav">
      <li class="active"><a href="#projetos">Projetos</a></li>
      <li><a href="#ferramentas">Serviços</a></li>
      <li><a href="#foco">Foco</a></li>
      <li><a href="#perfil">Perfil</a></li>
      <li><a class="launchmodal" href="">Contato</a></li>
    </ul>

  </nav>
</div>
<div class="nav-mob">
  <nav class="navbar">
                      <?php
if ($skypeon == 'on') { ?>
<div class="pull-right skype-mob">
	<a href="skype:joelgouveia?chat"><img src="img/skype.png" /></a>
</div>
<?php } ?>
    <div class="navbar-inner"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </a> <img src="img/joelgouveia-tab.png" alt="Logotipo Joel Gouveia" title="Joel Gouveia" class="pull-left" />

      <div class="nav-collapse">
        <ul class="nav" id="menum">
          <li class="active"><a href="#projetos">Projetos</a></li>
          <li><a href="#ferramentas">Serviços</a></li>
          <li><a href="#foco">Foco</a></li>
          <li><a href="#perfil">Perfil</a></li>
          <li><a class="launchmodal" href="">Contato</a></li>
        </ul>

      </div>

    </div>
  </nav>
</div>
<div class="nav-tab-compl row-fluid"></div>
<div class="container-fluid bar01"> </div>
<div class="container-fluid bg01">
  <div class="container">
    <div class="row-fluid dep"><img class="pull-right" src="img/designeprojeto.png" width="132" height="30" alt="Design é projeto"></div>
    <header class="row-fluid" > 
      <!---->
      <div class="nav-lateral">
        <nav  data-spy="affix" class="span2 pull-left"> <span class="span12"> <img src="img/joelgouveia.png" alt="Logotipo Joel Gouveia" title="Joel Gouveia" class="logo" /> </span>
          <div>
            <ul id="menuv" class="span12 nav bs-docs-sidenav">
              <li><a href="#projetos"><i class="icon-chevron-right"></i> Projetos</a></li>
              <li><a href="#foco"><i class="icon-chevron-right"></i> Foco</a></li>
              <li><a href="#ferramentas"><i class="icon-chevron-right"></i> Serviços</a></li>
              <li><a href="#perfil"><i class="icon-chevron-right"></i> Perfil</a></li>
              <li><a class="launchmodal" href=""><i class="icon-chevron-right"></i> Contato</a></li>
            </ul>
<?php
if ($skypeon == 'on') { ?>
<a href="skype:joelgouveia?chat"><img src="img/skype.png" /></a>

<?php } ?>
          </div>
  
        </nav>


      </div>
      <!---->
      <div class="carousel slide span10 shadow pull-right" id="projetos">
        <div class="carousel-inner">
          <div class="item active"> <img src="img/projetos/<?php if($checkmob){echo 'mob-';}?>struderia-projeto.jpg" alt="Struderia" title="Struderia" class="galeria">
            <div class="carousel-caption">
              <h4><span>Struderia</span></h4>
              <p class="hidem"><span>Criação da Marca e Panfleto | Criação e programação do Site</span> </p>
              <p class="hidem"><span class="where">@Agência Vegas</span></p>
            </div>
          </div>
          <div class="item"> <img src="img/projetos/<?php if($checkmob){echo 'mob-';}?>adrianaart-projeto.jpg" alt="Adriana Art" title="Adriana Art"  class="galeria">
            <div class="carousel-caption">
              <h4><span>Adriana Art</span></h4>
              <p class="hidem"><span>Criação do Logotipo e Cartão de visita | Criação e programação do Site e E-mail marketing</span></p>
              <p class="hidem"><span class="where">@Agênvia Vegas</span></p>
            </div>
          </div>
          <div class="item "> <img src="img/projetos/<?php if($checkmob){echo 'mob-';}?>bebidagelada-projeto.jpg" alt="Bebida Gelada" title="Bebida Gelada" class="galeria">
            <div class="carousel-caption">
              <h4><span>Bebida Gelada</span></h4>
              <p class="hidem"><span>Criação da Marca, Cartão de visita dobrável, Imã | Criação e programação do Site</span> </p>
              <p class="hidem"><span class="where">@Agênvia Vegas</span></p>
            </div>
          </div>
          <div class="item "> <img src="img/projetos/<?php if($checkmob){echo 'mob-';}?>bethmaciel-site.jpg" alt="Beth Maciel" title="Beth Maciel" class="galeria">
            <div class="carousel-caption">
              <h4><span>Beth Maciel</span></h4>
              <p class="hidem"><span>Criação e programação do Site e Galeria de imagens</span></p>
              <p class="hidem"><span class="where">@JoelGouveia</span></p>
            </div>
          </div>
          <div class="item "> <img src="img/projetos/<?php if($checkmob){echo 'mob-';}?>daffer-site.jpg" alt="Daffer Química" title="Daffer Química" class="galeria">
            <div class="carousel-caption">
              <h4><span>Daffer Química</span></h4>
              <p class="hidem"><span>Criação e programação do Site com categorização de produtos por cor</span></p>
              <p class="hidem"><span class="where">@Agência Vegas</span></p>
            </div>
          </div>
          <div class="item "> <img src="img/projetos/<?php if($checkmob){echo 'mob-';}?>fazendamaria-grafico.jpg" alt="Fazenda Maria" title="Fazenda Maria" class="galeria">
            <div class="carousel-caption">
              <h4><span>Fazenda Maria</span></h4>
              <p class="hidem"><span>Criação de Mini-Folder | Criação e programação de E-mail marketing</span></p>
              <p class="hidem"><span class="where">@Agência Vegas</span></p>
            </div>
          </div>
          <div class="item "> <img src="img/projetos/<?php if($checkmob){echo 'mob-';}?>joyee-site.jpg" alt="Joyee" title="Joyee" class="galeria">
            <div class="carousel-caption">
              <h4><span>Joyee</span></h4>
              <p class="hidem"><span>Criação do Site</span></p>
              <p class="hidem"><span class="where">@WebTeam Rolemak</span></p>
            </div>
          </div>
          <div class="item "> <img src="img/projetos/<?php if($checkmob){echo 'mob-';}?>marcas.jpg" alt="Marcas" title="Marcas" class="galeria">
            <div class="carousel-caption">
              <h4><span>Marcas</span></h4>
              <p class="hidem"><span>Criação para Perfis Diferenciados</span></p>
              <p class="hidem"><span class="where">@Agência Vegas</span></p>
            </div>
          </div>
          <div class="item "> <img src="img/projetos/<?php if($checkmob){echo 'mob-';}?>republica-impressos.jpg" alt="República dos Camarões" title="República dos Camarões" class="galeria">
            <div class="carousel-caption">
              <h4><span>República dos Camarões</span></h4>
              <p class="hidem"><span>Criação de Mini-Folder, E-mail marketing e Cardápio</span></p>
              <p class="hidem"><span class="where">@Phase Publicidade</span></p>
            </div>
          </div>
          <div class="item "> <img src="img/projetos/<?php if($checkmob){echo 'mob-';}?>zoopas-lamina.jpg" alt="Zoopas" title="Zoopas" class="galeria">
            <div class="carousel-caption">
              <h4><span>Zoopas</span></h4>
              <p class="hidem"><span>Criação de Folder com verniz localizado</span> </p>
              <p class="hidem"><span class="where">@Agência Vegas</span></p>
            </div>
          </div>
          <div class="item "> <img src="img/projetos/<?php if($checkmob){echo 'mob-';}?>zoje-especial.jpg" alt="Zoje" title="Zoje" class="galeria">
            <div class="carousel-caption">
              <h4><span>Zoje</span></h4>
              <p class="hidem"><span>Conteúdo on-line especial animado e interativo.</span> </p>
              <p class="hidem"><span class="where">@WebTeam Rolemak</span></p>
            </div>
          </div>
          <div class="item "> <img src="img/projetos/<?php if($checkmob){echo 'mob-';}?>zoje-lamina.jpg" alt="Zoje" title="Zoje" class="galeria">
            <div class="carousel-caption">
              <h4><span>Zoje</span></h4>
              <p class="hidem"><span>Criação de Lâminas</span></p>
              <p class="hidem"><span class="where">@WebTeam Rolemak</span></p>
            </div>
          </div>
          <div class="item "> <img src="img/projetos/<?php if($checkmob){echo 'mob-';}?>zoje-site.jpg" alt="Zoje" title="Zoje" class="galeria">
            <div class="carousel-caption">
              <h4><span>Zoje</span></h4>
              <p class="hidem"><span>Criação e Programação do Site</span> </p>
              <p class="hidem"><span class="where">@WebTeam Rolemak</span></p>
            </div>
          </div>
          <div class="item "> <img src="img/projetos/<?php if($checkmob){echo 'mob-';}?>suporte-site.jpg" alt="Suporte Rolemak" title="Suporte Rolemak" class="galeria">
            <div class="carousel-caption">
              <h4><span>Suporte Rolemak</span></h4>
              <p class="hidem"><span>Criação e programação do Site para suporte técnico diferenciado</span> </p>
              <p class="hidem"><span class="where">@WebTeam Rolemak</span></p>
            </div>
          </div>
        </div>
        <a href="#projetos" class="left carousel-control pprev" data-slide="prev"><img src="img/arrow_l.png" alt="Projeto anterior" title="Projeto anterior"> </a> <a href="#projetos" class="right carousel-control pnext" data-slide="next"> <img src="img/arrow_r.png" alt="Próximo projeto" title="Próximo projeto"></a> </div>
    </header>
  </div>
</div>
<div class="container-fluid bar02" > </div>
<!---->

<div class="container margin01" id="foco">
  <div class="container">
    <section class="row-fluid  " >
      <article class="span5 offset2 margin01">
        <h1>Branding</h1>
        <p>Diferente do que se pensa, design atua também na <a href="#" title="E não somente na invenção 100% original. A melhoria do existente é fator fundamental para a evolução da sociedade." rel="tooltip">melhoria</a> do que existe e a aplicação da <a href="#" title="Definição do problema, coleta e análise de dados, criação, prototipagem e aplicação da solução mais adequada." rel="tooltip">metodologia projetual</a> se destaca ao gerar soluções criativas nos problemas apresentados.</p>
        <p>Essa criatividade direcionada ao desenvolvimento de <a href="#" title="Singularização da marca, diferenciando e a destacando dos demais, como única." rel="tooltip">identidades visuais</a> é fundamental para a empresa obter a personalização necessária para enfrentar os concorrentes de <a href="#" title="A concorrência entre empresas de diferentes portes ficou mais acirrada devido aos destaques individuais presentes na internet" rel="tooltip">diferentes portes</a>.</p>
        <p>É a partir desta <a href="#" title="Características que marcam, e por extensão, permanecem mais tempo na memória." rel="tooltip">personalidade</a> desenvolvida que a empresa se insere no mercado, e, associada à transmissão de valores e experiências, reflete credibilidade em suas operações, a fim de ser referência na mente do consumidor quando de se trata de experiência de consumo em serviço ou produto.</p>
        <p>Para essa gestão, é fundamental o desenvolvimento e aplicação do <a href="#" title="Além de ser um manual de uso da marca, apresenta também a personalidade e a estratégia que esta deve seguir para ter coerência em suas ações e na experiência do usuário." rel="tooltip">brandbook</a> que dá embasamento para decisões projetuais no que se refere ao uso e voz da marca de forma a manter a coerência nos diversos meios de comunicação.</p>
      </article>
      <article class="span5 margin01">
        <h1>Digital</h1>
        <p>Com a disseminação do acesso ao universo digital em desktops e nas plataformas móveis, como smartphones e tablets, as possibilidades criativas são ilimitadas e a <a href="#" title="A implementação do html5 e do css3 dinamizou o desenvolvimento e gerou soluções mais leves e satisfatórias para diversas plataformas." rel="tooltip">(re)evolução das linguagens</a> possibilita o envolvimento cada vez maior com a marca.</p>
        <p>Com a estratégia certa, sites passam a ser <a href="#" title="Como esta que você está lendo!" rel="tooltip">aplicações interativas</a> promovendo a imersão e o vínculo do cliente com a empresa facilitando o acesso ao conteúdo relevante em diversas formas.</p>
        <p>A <a href="#" title="Responsive design" rel="tooltip">adaptação de sites</a> para celular e tablets, não é somente a redução do layout, mas também o relayout da interação e reprocessamento das imagens para que se adeque de modo satisfatório a velocidade da <a href="#" title="E a qualidade atual é juridicamente legal: segundo a Anatel, as empresas devem oferecer no mínimo 20% da banda contratada, mas você deve pagar 100%..." rel="tooltip">internet móvel brasileira</a>.</p>
        <p>Os <a href="#" title="Portal de notícias, cadastro de usuário, entre outros" rel="tooltip">sistemas administrativos</a> também têm migrado para a internet o que possibilita o acesso de qualquer lugar. Com a sua aplicação online a necessidade de hardwares potentes é transferido para a web de modo vantajoso e satisfatório.</p>
      </article>
    </section>
  </div>
</div>
<!---->
<div class="container-fluid bar01"> </div>
<div class="container-fluid bg01" id="ferramentas">
  <div class="container">
    <section class="row-fluid margin01" >
      <article class="span3 offset2">
        <form id="filter">
          <fieldset>
            <legend>Serviços & Ferramentas:</legend>
            <label>
              <input class="inputclass" type="radio" name="type" value="pglobal.html" checked="checked">
              Global;</label>
            <label>
              <input type="radio" name="type" value="pid.html">
              Identidade visual;</label>
            <label>
              <input type="radio" name="type" value="psite.html">
              Site (desktop e mobile);</label>
            <label>
              <input type="radio" name="type" value="psjs.html">
              Site + Galeria/Slider/Animações/etc;</label>
            <label>
              <input type="radio" name="type" value="psadm.html">
              Site administrável (login/notícias/etc);</label>
            <label>
              <input type="radio" name="type" value="psiteadap.html">
              Adaptação de Site para plafatorma mobile;</label>
            <label>
              <input type="radio" name="type" value="pseo.html">
              Otimização de Sites para o Google/Bing;</label>
            <label>
              <input type="radio" name="type" value="papp.html">
              Aplicativos Web para plataforma mobile;</label>
            <label>
              <input type="radio" name="type" value="pman.html">
              Manutenção de Sites.</label>
            <label class="clearfix" >
              <input type="button" class="btn btn-info orcamento btn_orcA" value="Fazer orçamento">
            </label>
          </fieldset>
        </form>
      </article>
      <article class="span7">
        <ul id="applications" class="image-grid">
          <!-- global -->
          <li data-id="id-10" data-type="all"> <img width="100" height="100" src="img/tools/lapis.png" /> <strong>Criação</strong> </li>
          <li data-id="id-1" data-type="all"> <img width="100" height="100" src="img/tools/ai.png" /> <strong>Illustrator</strong> </li>
          <li data-id="id-2" data-type="all"> <img width="100" height="100" src="img/tools/ajax.png" /> <strong>Ajax</strong> </li>
          <li data-id="id-3" data-type="all"> <img width="100" height="100" src="img/tools/css.png" /> <strong>CSS 3</strong> </li>
          <li data-id="id-4" data-type="all"> <img width="100" height="100" src="img/tools/dw.png" /> <strong>Dreamweaver</strong> </li>
          <li data-id="id-6" data-type="all"> <img width="100" height="100" src="img/tools/html.png" /> <strong>xHTML 5</strong> </li>
          <li data-id="id-7" data-type="all"> <img width="100" height="100" src="img/tools/id.png" /> <strong>Indesign</strong> </li>
          <li data-id="id-8" data-type="all"> <img width="100" height="100" src="img/tools/joomla.png" /> <strong>Joomla!</strong> </li>
          <li data-id="id-9" data-type="all"> <img width="100" height="100" src="img/tools/jquery.png" /> <strong>Js/Jquery</strong> </li>
          <li data-id="id-11" data-type="all"> <img width="100" height="100" src="img/tools/mysql.png" /> <strong>Mysql</strong> </li>
          <li data-id="id-12" data-type="all"> <img width="100" height="100" src="img/tools/php.png" /> <strong>PHP</strong> </li>
          <li data-id="id-13" data-type="all"> <img width="100" height="100" src="img/tools/ps.png" /> <strong>Photoshop</strong> </li>
          <li data-id="id-14" data-type="all"> <img width="100" height="100" src="img/tools/seo.png" /> <strong>SEO (Google/Bing)</strong> </li>
          <li data-id="id-15" data-type="all"> <img width="100" height="100" src="img/tools/wordpress.png" /> <strong>Wordpress</strong> </li>
        </ul>
      </article>
      <div class="bnt_orcB">
        <div class="span5">
          <input type="button" class="btn btn-info orcamento btn_orcB" value="Fazer orçamento">
        </div>
      </div>
    </section>
  </div>
</div>
<div class="container-fluid bar02"> </div>
<div class="clearfix"></div>
<!---->
<div class="container margin01" id="perfil">
  <section class="row-fluid margin01">
    <div class="imgfaceA">
      <article class="span2 offset2"> <img src="img/art2.jpg" class="img-circle shadow"> </article>
    </div>
    <div class="imgfaceB">
      <article class="span3 offset2 imgfaceB"> <img src="img/art2.jpg" class="img-circle shadow"><br>
        <br>
      </article>
    </div>
    <article class="span4">
      <p>Paulistano de 27 anos, designer a mais de 8, formado pela Universidade Presbiteriana Mackenzie, focado em inovação, universo digital e projetos sociais, possuo experiências na criação e desenvolvimento de identidades corporativas, sites para desktop, tablets e celulares, além de sistemas e aplicativos para a internet.</p>
      <p>Projeto a experiência da marca, desde a criação e aplicações gráficas e digitais até o seu gerenciamento, apresentando conceitos e pesquisas que direcionam cada decisão tomada em conjunto com o cliente.</p>
    </article>
    <article class="span4">
      <p>No universo digital, combino a experiência do usuário com as linguagens mais atualizadas, trabalhando sempre com a compatibilidade entre navegadores modernos e dispositivos móveis e com o melhor de cada plataforma.</p>
      <p> Também sou diretor criador e criativo do projeto Ligaturas, que possui como objetivo disseminar o design através de projetos sociais com ações que tragam resultados e melhoria na realidade das pessoas.</p>
      <p class="pull-right"> Saiba mais: <a href="#" class="btn_lin">linkedin</a> </p>
    </article>
  </section>
</div>
<!---->
<div class="container-fluid bar01"> </div>
<footer class="container-fluid bg01" >
  <div class="container" >
    <section class="row-fluid">
      <article class="offset2 span10"> <span class="pull-left">&copy; 2013 - Joel Gouveia. Todos os direitos reservados.</span> <span class="pull-right"><a href="#madeby" class="pull-right" data-toggle="modal"><img src="img/desenvolvido-por-joelgouveia.png" alt="Logotipo Joel Gouveia" title="Joel Gouveia" class="logo" width="115" height="32"></a></span> </article>
    </section>
  </div>
  </div>
</footer>
<div class="container-fluid bar02" > </div>
<!-- modal madeby-->
<section id="madeby" class="modal hide fade">
  <header class="modal-header border01">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h3>OBRIGADO!</h3>
  </header>
  <div class="modal-body">
    <p>Seu interesse em conhecer quem projetou <?php if (isset($_GET) & !empty($_GET)){ echo "AQUI"; }?> serve como motivação para a continua melhoria nos trabalhos.</p>
    <p>Fique a vontade para navegar, conhecer outros trabalhos e entrar em contato.</p>
    <p class="jass">Ass.: Joel Gouveia</p>
                                <?php
if ($skypeon == 'on') { ?>
<div class="pull-right skype-tab">
	<a href="skype:joelgouveia?chat"><img src="img/skype.png" /></a>
</div>
<?php } ?>
  </div>
</section>

<!--modal contato-->
<section id="launch" class="modal hide fade">
  <header class="modal-header">
    <button type="button" class="close" data-dismiss="modal">&times;</button>
    <h3>                            <?php
if ($skypeon == 'on') { ?>
<div class="pull-left skype-tab">
	<a href="skype:joelgouveia?chat"><img src="img/skype.png" /></a>
</div>
<?php } ?> Entre em contato: </h3>
  </header>
  <div class="modal-body">
    <form class="contactform" id="formv" action="index.php" method="post" >
      <fieldset>
        <input type="text" name="nome" id="nome" placeholder="Nome" maxlength="50">
        <div class="input-prepend">
          <div class="btn-group">
            <button class="btn dropdown-toggle width01" data-toggle="dropdown"> Porte <span class="caret"></span> </button>
            <ul class="dropdown-menu">
              <li>
                <label>
                  <input type="radio" name="porte" value="PF">
                  Pessoa Física</label>
              </li>
              <li>
                <label>
                  <input type="radio" name="porte" value="PL">
                  Profissional Liberal</label>
              </li>
              <li>
                <label>
                  <input type="radio" name="porte" value="ME">
                  Micro Empresa</label>
              </li>
              <li>
                <label>
                  <input type="radio" name="porte" value="PE">
                  Pequena Empresa</label>
              </li>
              <li>
                <label>
                  <input type="radio" name="porte" value="MED">
                  Média Empresa</label>
              </li>
              <li>
                <label>
                  <input type="radio" name="porte" value="GE">
                  Grande Empresa</label>
              </li>
              <li>
                <label>
                  <input type="radio" name="porte" value="ONG">
                  ONG / Cooperativa</label>
              </li>
            </ul>
          </div>
          <input maxlength="50" type="text" name="empresa" id="empresa" placeholder="Ramo / Empresa" class="input-medium">
        </div>
      </fieldset>
      <fieldset>
        <input type="tel" placeholder="Telefone" maxlength="50" id="telefone" name="telefone">
        <div class="input-prepend">
          <div class="btn-group">
            <button class="btn dropdown-toggle width01" data-toggle="dropdown"> Operadora <span class="caret"></span> </button>
            <ul class="dropdown-menu">
              <li>
                <label>
                  <input type="radio" name="operadora" value="Claro">
                  Claro</label>
              </li>
              <li>
                <label>
                  <input type="radio" name="operadora" value="Oi">
                  Oi</label>
              </li>
              <li>
                <label>
                  <input type="radio" name="operadora" value="Tim">
                  Tim</label>
              </li>
              <li>
                <label>
                  <input type="radio" name="operadora" value="Vivo">
                  Vivo</label>
              </li>
            </ul>
          </div>
          <input type="tel" placeholder="Celular" class="input-medium" name="celular" id="celular" maxlength="50">
        </div>
      </fieldset>
      <fieldset>
        <input type="text" placeholder="Cidade/País" name="cidade" id="cidade" maxlength="50">
        <input type="email" placeholder="E-mail" name="email" id="email" maxlength="50">
      </fieldset>
      <fieldset>
        <input type="text" placeholder="Site atual, se houver" name="www" id="www" maxlength="50">
        <select id="reason">
          <option value="pglobal.html">Orçamento Global</option>
          <option value="pid.html">Orçamento Identidade Visual</option>
          <option value="psite.html">Orçamento Site (desktop e mobile)</option>
          <option value="psjs.html">Orçamento Site + Galeria/Slider/Animações/etc</option>
          <option value="psadm.html">Orçamento Site administrável (login/notícias/etc)</option>
          <option value="psiteadap.html">Adaptação de Site para plataforma mobile</option>
          <option value="pseo.html">Orçamento Otimização de Sites para o Google/Bing</option>
          <option value="papp.html">Orçamento Aplicativos Web para smartphones e tablets</option>
          <option value="pman.html">Orçamento Manutenção de Sites</option>
          <option value="Outro">Outro Motivo</option>
        </select>
      </fieldset>
      <fieldset>
        <input type="text" placeholder="De onde chegou? (indicação, google, etc.)" class="span4" id="indica" maxlength="50" name="indica">
      </fieldset>
      <fieldset>
        <textarea placeholder="Digite sua mensagem" rows="5" name="mensagem" id="mensagem" class="span4 message"  onKeyDown="limitText(this.form.mensagem,this.form.countdown,450);" onKeyUp="limitText(this.form.mensagem,this.form.countdown,450);"></textarea>
        <div class="clearfix"></div>
        <span class="carac"><font size="1"> Você tem
        <input readonly type="text" name="countdown" size="3"  class="span1" value="450">
        caracteres restando.</font></span>
      </fieldset>
      <input type="submit" class="btn btn-primary" value="Enviar" name="Submit">
    </form>
  </div>
</section>



<script src="js/jquery-1.7.2.min.js"></script> 
<script src="js/bootstrap.min.js"></script> 
<script src="js/jquery.mobile.custom.min.js"></script> 
<script src="js/easing.1.3.js"></script> 
<script src="js/jquery-animate-css-rotate-scale.js"></script> 
<script src="js/jquery-css-transform.js"></script> 
<script src="js/quicksand.js"></script> 
<script src="js/jquery.scrollTo-1.4.3.1-min.js"></script> 
<script src="js/jquery.validate.js"></script> 
<script src="js/methods.js"></script> 
<script src="js/jquery.maskedinput.js"></script> 
<script src="js/custom.js"></script>
<?php 
/*if (isset($_GET) & !empty($_GET)){
//	if ($_GET=='joel'){
		 ?>
<script>
$('#madeby').modal('toggle');
	</script>

<?php	}
//} 
*/
?>







</body>
</html>

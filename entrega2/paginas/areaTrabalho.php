<?php 

session_start();

$_SESSION['user'] = 'Eu';//enquanto aguarda login e select do BD apenas... :)

$catAtivo    = 5000;
$catInativo  = 2000;
$prodAtivo   = 1;
$prodInativo = 34;

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<script></script>
<title>Área de Trabalho</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="Michel Ikeda Francisco" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="..\css\menu.css">
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script src="..\script\script.js"></script>
</head>

<body bgcolor="#E0E0E0">
	<table class="tabelaMenu" align="left">
		<tr> <p class="ola">Bem vindo, <?php echo $_SESSION['user']; ?>!</p></tr>
		<tr><td> 
			<div id='cssmenu'>
			<ul>
			   <li class='active'><a href='areaTrabalho.php'><span>Home</span></a></li>
			   <li class='has-sub'><a href='#'><span>Produtos</span></a>
				  <ul>
					 <li><a href='cadastroProduto.php'><span>Cadastro</span></a></li>
					 <li><a href='editarProduto.php'><span>Edição</span></a></li>
					 <li class='last'><a href='pesquisaProduto.php'><span>Pesquisar</span></a></li>
				  </ul>
			   </li>
			   <li class='has-sub last'><a href='#'><span>Categorias</span></a>
				  <ul>
					 <li><a href='cadastroCategoria.php'><span>Cadastro</span></a></li>
					 <li><a href='editarCategoria.php'><span>Edição</span></a></li>
					 <li class='last'><a href='pesquisaCategoria.php'><span>Pesquisar</span></a></li>
				  </ul>
			   </li>
			</ul>
			</div>
	</td></tr></table>
	<table class="tabelaTrabalhar" align="center">
	<tr><td colspan="4"> <p class="escolha">Escolha a ação desejada no menu lateral!</p></td></tr>
	<tr><td colspan="4"> <br><br> Como estamos hoje?</td></tr>
	<tr><td colspan="2"> <br>Produtos </td><td colspan="2"> <br>Categorias</td></tr><br>
	<tr><td> Ativos  : <td><?php echo $prodAtivo; ?></td></td>  <td>Ativos  : <td><?php echo  $catAtivo; ?></td></td></tr><br>
	<tr><td> Inativos: <td><?php echo $prodInativo; ?></td></td><td>Inativos: <td><?php echo  $catInativo; ?></td></td></tr>
	</table>
</html>
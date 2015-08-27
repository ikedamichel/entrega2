<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="Michel Ikeda Francisco" />
<meta name="viewport" content="width=device-width, initial-scale=1">
</html>
<?php
$resposta		= 'Por favor rever campos do cadastro de produto!';//caso default = erro
$uploadOk 		= 1;
$prodName    	= '';
$prodDescrip 	= '';
$prodUnitVal 	= 0;
$prodDescVal 	= 0;
$prodEstoqueVal = 0;
$flagPossuiFoto = 0;
$flagDesconto 	= 0;
$prodImagem 	= '';


if(isSet ($_POST['prodAtivo'])){
	$prodAtivo=$_POST['prodAtivo'];
}else{
	$prodAtivo = 0;
}

if(isSet ($_POST['prodName'])){
	$prodName=$_POST['prodName'];
}else{
	$uploadOk = 0;
}

if(isSet ($_POST['prodDescrip'])){
	$prodDescrip=$_POST['prodDescrip'];
	$flagDesconto=1;
}else{
	$uploadOk = 0;
}

if ($uploadOk == 0) {
	$resposta =  "Por favor rever os dados do produto!";
}else{
	$resposta = $_POST['prodName']." cadastrado com sucesso!";
	$conecta = new mysqli('localhost', 'root', '', 'entrega2') or print (mysql_error()); 
	$query	= "insert into produtos (flagProdAtivo, flagPossuiFoto, flagDesconto, tituloProd, descriProd, valorProdUnit, valorDescProdUnit, fotoProd, estoqueProdAtual, estoqueProdAguardaVenda, estoqueProdVendido) values (".$prodAtivo.", ".$flagPossuiFoto.", ".$flagDesconto.", '".$prodName."', '".$prodDescrip."', ".$prodUnitVal.", ".$prodDescVal.", '".$prodImagem."', ".$prodEstoqueVal.", 0, 0)";
	$result = $conecta->query($query);		
}

echo $redirect = "cadastroCategoria.php?cadastrOK=$resposta";
header("location:$redirect");
?>
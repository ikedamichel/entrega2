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

if(isSet ($_POST['prodUnitVal'])){
	$prodUnitVal=floatval($_POST['prodUnitVal']);
}else{
	$uploadOk = 0;
}

if(isSet ($_POST['prodDescVal'])){
	$prodDescVal=floatval($_POST['prodDescVal']);
}

if(isSet ($_FILES['imagem']["name"])){
	$prodImagem=$_FILES['imagem']["name"];
	$flagPossuiFoto=1;
	
}else{
	$uploadOk = 0;
}


if($uploadOk = 1){
		
	//TRATAMENTO DA IMAGEM
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["imagem"]["name"]);

	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Confere se é imagem ou falso arquivo
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["imagem"]["tmp_name"]);
		if($check !== false) {
			$resposta =  "Arquivo é uma imagem! - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			$resposta =  "Erro - Arquivo não é uma imagem. Tente novamente";
			$uploadOk = 0;
		}
	}
	// Confere se o arquivo já existe
	if (file_exists($target_file)) {
		$resposta =  "Desculpe, o arquivo já existe.";
		$uploadOk = 0;
	}
	// Confere o tamanho da imagem 2MB máximo
	if ($_FILES["imagem"]["size"] > 2100000) {
		$resposta =  "Desculpe, sua imagem passou de 2MB.";
		$uploadOk = 0;
	}
	// Confere formatos específicos de imagem
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		$resposta =  "Desculpe, apenas os formatos JPG, JPEG, PNG & GIF são permitidos.";
		$uploadOk = 0;
	}
	
		
	// Confere se a variável $uploadOk = 0 por causa de algum condicional acima
	if ($uploadOk == 0) {
		$resposta =  "Por favor rever os dados do produto!";
	// Se tudo estiver OK, tenta fazer upload do arquivo
	} else {
		if (move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file)) {
			$resposta = $_POST['prodName']." cadastrado com sucesso!";
			$conecta = new mysqli('localhost', 'root', '', 'entrega2') or print (mysql_error()); 
			$query	= "insert into produtos (flagProdAtivo, flagPossuiFoto, flagDesconto, tituloProd, descriProd, valorProdUnit, valorDescProdUnit, fotoProd, estoqueProdAtual, estoqueProdAguardaVenda, estoqueProdVendido) values (".$prodAtivo.", ".$flagPossuiFoto.", ".$flagDesconto.", '".$prodName."', '".$prodDescrip."', ".$prodUnitVal.", ".$prodDescVal.", '".$prodImagem."', ".$prodEstoqueVal.", 0, 0)";
			$result = $conecta->query($query);		
		} else {
			$resposta =  "Desculpe, houve um erro interno no envio da imagem. Tente novamente por favor.";
		}
	}
}

echo $redirect = "cadastroProduto.php?cadastrOK=$resposta";
header("location:$redirect");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<?php 

session_start();
$_SESSION['user'] = 'Eu';

if(isset($_GET['cadastrOK'])) {
	$resposta = $_GET['cadastrOK'];
	echo "<script>if(window.alert('$resposta')) { window.close ()} else { window.close () } </script>";
}

?>
<title>Área de Trabalho</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="author" content="Michel Ikeda Francisco" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="..\css\cadastroProduto.css">
<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
<script src="..\script\script.js"></script>
<script language="javascript">
function somenteNumero(campo){  
var digits="0123456789"  
var campo_temp   
    for (var i=0;i<campo.value.length;i++){  
        campo_temp=campo.value.substring(i,i+1)   
        if (digits.indexOf(campo_temp)==-1){  
            campo.value = campo.value.substring(0,i);  
        }  
    }  
}  

function MascaraMoeda(objTextBox, SeparadorMilesimo, SeparadorDecimal, e){  
    var sep = 0;  
    var key = '';  
    var i = j = 0;  
    var len = len2 = 0;  
    var strCheck = '0123456789';  
    var aux = aux2 = '';  
    var whichCode = (window.Event) ? e.which : e.keyCode;  
    if (whichCode == 13) return true;  
    key = String.fromCharCode(whichCode); // Valor para o código da Chave  
    if (strCheck.indexOf(key) == -1) return false; // Chave inválida  
    len = objTextBox.value.length;  
    for(i = 0; i < len; i++)  
        if ((objTextBox.value.charAt(i) != '0') && (objTextBox.value.charAt(i) != SeparadorDecimal)) break;  
    aux = '';  
    for(; i < len; i++)  
        if (strCheck.indexOf(objTextBox.value.charAt(i))!=-1) aux += objTextBox.value.charAt(i);  
    aux += key;  
    len = aux.length;  
    if (len == 0) objTextBox.value = '';  
    if (len == 1) objTextBox.value = '0'+ SeparadorDecimal + '0' + aux;  
    if (len == 2) objTextBox.value = '0'+ SeparadorDecimal + aux;  
    if (len > 2) {  
        aux2 = '';  
        for (j = 0, i = len - 3; i >= 0; i--) {  
            if (j == 3) {  
                aux2 += SeparadorMilesimo;  
                j = 0;  
            }  
            aux2 += aux.charAt(i);  
            j++;  
        }  
        objTextBox.value = '';  
        len2 = aux2.length;  
        for (i = len2 - 1; i >= 0; i--)  
        objTextBox.value += aux2.charAt(i);  
        objTextBox.value += SeparadorDecimal + aux.substr(len - 2, len);  
    }
    return false;  
}
</script>  


</head>

<body bgcolor="#E0E0E0">
	<table class="tabelaMenu" align="left">
		<tr> <p class="ola">Bem vindo, <?php echo  $_SESSION['user']; ?>!</p></tr>
		<tr><td> 
			<div id='cssmenu'>
			<ul>
			   <li class='active'><a href='areaTrabalho.php'><span>Home</span></a></li>
			   <li class='has-sub'><a href='#'><span>Produtos</span></a>
				  <ul>
					 <li><a href='cadastroProduto.php'><span>Cadastro</span></a></li>
					 <li><a href='editarProduto.php'><span>Edição</span></a></li>
				  </ul>
			   </li>
			   <li class='has-sub last'><a href='#'><span>Categorias</span></a>
				  <ul>
					 <li><a href='cadastroCategoria.php'><span>Cadastro</span></a></li>
					 <li><a href='editarCategoria.php'><span>Edição</span></a></li>
				  </ul>
			   </li>
			</ul>
			</div>
	</td></tr></table>
	<table class="tabelaTrabalhar" align="center">
		<form method="POST" action="executaCadastroProd.php" class="cadastrarProduto" enctype="multipart/form-data">
			<tr><td colspan="2"> <p class="escolha">Cadastre seu produto!</p><br></td></tr>
			<tr><td><br> Produto Ativo? </td><td><br>  <INPUT TYPE="checkbox" VALUE="1" NAME="prodAtivo"> **Marque para "SIM"</td></tr><br>
			<tr><td><br> Título do Produto: </td><td><br> <INPUT TYPE = "Text" size="50" VALUE ="" NAME = "prodName"></td></tr><br>
			<tr><td><br> Descrição do Produto: </td><td><br> <textarea cols="51" VALUE ="" NAME = "prodDescrip"></textarea></td></tr><br>
			<tr><td><br> Valor Unitário: </td><td><br> <input type="text" name="prodUnitVal"  onKeyPress="return(MascaraMoeda(this,'.',',',event))"></td></tr><br>
			<tr><td><br> Valor Desconto Unitário: </td><td><br> <input type="text" name="prodDescVal"  onKeyPress="return(MascaraMoeda(this,'.',',',event))"></td></tr><br>
			<tr><td><br> Quantidade em Estoque: </td><td><br> <input name="prodEstoqueVal" id="prodEstoqueVal" onKeyUp="javascript:somenteNumero(this);" value=""></td></tr><br>
			<tr><td><br> Foto do Produto: </td><td><br> <input type="file" name="imagem" id="imagem"></td></tr><br>
			<tr><td colspan="2" class="btnCadastrar"><br><input type="submit" value="Cadastrar!" name="submit"></td></tr>
		</form>
	</table>
</html>
<?php 

session_start();

$_SESSION['user'] = 'Eu';

?>

<!DOCTYPE html PUBLIC '-//W3C//DTD XHTML 1.0 Transitional//EN' 'http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd'>
<html xmlns='http://www.w3.org/1999/xhtml' xml:lang='en' lang='en'>
<head>
<script></script>
<title>Pesquisa Produtos</title>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<meta name='author' content='Michel Ikeda Francisco' />
<meta name='viewport' content='width=device-width, initial-scale=1'>
<link rel='stylesheet' href='..\css\pesquisa.css'>
<script src='http://code.jquery.com/jquery-latest.min.js' type='text/javascript'></script>
<script src='..\script\script.js'></script>
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

<body bgcolor='#E0E0E0'>
	<table class='tabelaMenu' align='left'>
		<tr> <p class='ola'>Bem vindo, <?php echo  $_SESSION['user'] ?>!</p></tr>
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
	<table class='tabelaTrabalhar' align='left'>
			<tr><td colspan='2'> <p class='escolha'>Localize seu produto!</p><br></td></tr>
			<form method="POST" action="editarProduto.php" class="cadastrarProduto" enctype="multipart/form-data">
			<tr><td> Título/Nome do Produto: </td><td><INPUT TYPE = 'Text' size='50' VALUE ='' NAME = 'consultar'></td><td colspan='2' class='btnLocalizar'><input type='submit' value='Localizar!' name='submit'></td></tr><br>
			</form>
	</table>
	<?php
	//executa consulta
	if (isset($_POST['consultar'])) {
		$conecta = new mysqli('localhost', 'root', '', 'entrega2') or print (mysql_error()); 
		$query	= "SELECT idProd, flagProdAtivo, tituloProd, descriProd, valorProdUnit, valorDescProdUnit, fotoProd, estoqueProdAtual FROM produtos where tituloProd like '%".$_POST['consultar']."%'";
		$result = $conecta->query($query);
		echo "
				<table class='tabelaConsulta' align='left'>";
		while ($dados = $result->fetch_array(MYSQLI_ASSOC)) {
			if($dados['flagProdAtivo']=1){
				$dados['flagProdAtivo']='Sim';
			}else{
				$dados['flagProdAtivo']='Não';
			}
			
			$dados['tituloProd'] = mb_convert_encoding($dados['tituloProd'], "UTF-8", "ISO-8859-1");
			$dados['descriProd'] = mb_convert_encoding($dados['descriProd'], "UTF-8", "ISO-8859-1");
			$dados['fotoProd'] 	 = mb_convert_encoding($dados['fotoProd'], "UTF-8", "ISO-8859-1");
			
			echo "
				<tr><td>Produto Ativo? </td><td>Título: </td><td>Descrição: </td><td>Valor Unitário: </td><td>Valor Desconto: </td><td>Em estoque: </td><td>Foto do Produto: </td><td>Editar </td><td>Excluir </td></tr>
				<tr><td>".$dados['flagProdAtivo']."</td><td>".$dados['tituloProd']."</td><td>".$dados['descriProd']."</td><td>".$dados['valorProdUnit']."</td><td>".$dados['valorDescProdUnit']."</td><td>".$dados['estoqueProdAtual']."</td><td>".$dados['fotoProd']."</td><td align='center'><a href='editarProduto.php?editar=".$dados['idProd']."'><img src='../images/plus.png' height='25' weigth='25'></a></td><td align='center'><a href='editarProduto.php?excluir=".$dados['idProd']."'><img src='../images/minus.png' height='25' weigth='25'></a></td></tr>
				<tr><td><br><p></p> </td></tr>
				";
		}
		echo "</table>";		
	}
	//executa exclusão
	if (isset($_GET['excluir'])) {
		$conecta = new mysqli('localhost', 'root', '', 'entrega2') or print (mysql_error()); 
		$query	= "DELETE FROM produtos WHERE idProd=".$_GET['excluir'];
		$result = $conecta->query($query);
		echo "<script>if(window.alert('Produto removido!')) { window.location='';} else { window.close () } </script>";
	}
	
	//executa edição
	if ( isset($_GET['executarEdicao']) ) {
		if(isset($_POST['prodName']) && isset($_POST['prodDescrip']) && isset($_POST['prodUnitVal']) && isset($_POST['prodDescVal'])){	
			$flagAtivo	  =0;
			$flagFoto	  =0;
			$flagDesconto =0;
			
			if(isset($_POST['prodAtivo'])){
				$flagAtivo = 1;
			}
			
			if(isset($_FILES['imagem']["name"]	)){
				$flagFoto = 1;
			}
			
			if(isset($_POST['prodDescVal'])){
				$flagDesconto = 1;
			}
			
			if(isset($_POST['prodEstoqueVal'])){
				$estoque = $_POST['prodEstoqueVal'];
			}
			
			$conecta = new mysqli('localhost', 'root', '', 'entrega2') or print (mysql_error());
			$query	= "UPDATE produtos SET flagProdAtivo=".$flagAtivo.", flagPossuiFoto=".$flagFoto.", flagDesconto=".$flagDesconto.", tituloProd='".$_POST['prodName']."', descriProd='".$_POST['prodDescrip']."', valorProdUnit=".$_POST['prodUnitVal'].", valorDescProdUnit=".$_POST['prodDescVal'].", fotoProd='".$_FILES['imagem']["name"]."', estoqueProdAtual=".$estoque." WHERE idProd=".$_POST['idProd'];
			var_dump($query);
			$result = $conecta->query($query);
			echo "<script>if(window.alert('Produto editado!')) { window.location='';} else { window.close () } </script>";
		}else{
			echo "<script>if(window.alert('Por favor rever os dados!')) { window.location='';} else { window.close () } </script>";	
		}
	}
	//exibe opções de edição
	if (isset($_GET['editar'])) {		
		$conecta = new mysqli('localhost', 'root', '', 'entrega2') or print (mysql_error()); 
		$query	= "SELECT idProd, flagProdAtivo, tituloProd, descriProd, valorProdUnit, valorDescProdUnit, fotoProd, estoqueProdAtual FROM produtos where idProd=".$_GET['editar'];
		$result = $conecta->query($query);
		$dados = $result->fetch_array(MYSQLI_ASSOC);
		
		echo "
				<table class='tabelaEdita' align='left'>";
		
		echo "
				<form method='POST' action='editarProduto.php?executarEdicao=sim' class='editarProduto' enctype='multipart/form-data'>
					<tr><td colspan='2'> <p class='escolha'>Edite seu produto!</p><br></td></tr>
					<tr><td><br> Produto Ativo? </td><td><br>  <INPUT TYPE='checkbox' VALUE='1' id='prodAtivo' class='prodAtivo' NAME='prodAtivo'> **Marque para 'SIM'</td></tr><br>
					<tr><td><br> Título do Produto: </td><td><br> <INPUT TYPE = 'Text' size='50' VALUE ='".$dados['tituloProd']."' NAME='prodName' class='prodName' id='prodName'></td></tr><br>
					<tr><td><br> Descrição do Produto: </td><td><br> <INPUT TYPE = 'Text' VALUE ='".$dados['descriProd']."' NAME = 'prodDescrip'></td></tr><br>
					<tr><td><br> Valor Unitário: </td><td><br> <input type='text' id='prodUnitVal' class='prodUnitVal' name='prodUnitVal'  onKeyPress='return(MascaraMoeda(this,'.',',',event))' value='".$dados['valorProdUnit']."'></td></tr><br>
					<tr><td><br> Valor Desconto Unitário: </td><td><br> <input type='text' id='prodDescVal' class='prodDescVal' name='prodDescVal'  onKeyPress='return(MascaraMoeda(this,'.',',',event))' value='".$dados['valorDescProdUnit']."'></td></tr><br>
					<tr><td><br> Quantidade em Estoque: </td><td><br> <input name='prodEstoqueVal' class='prodEstoqueVal' id='prodEstoqueVal' onKeyUp='javascript:somenteNumero(this);' value='".$dados['estoqueProdAtual']."'></td></tr><br>
					<tr><td><br> Foto do Produto: </td><td><br> <input type='file' name='imagem' class='imagem' id='imagem' value='".$dados['fotoProd']."'> <input type='hidden' name='idProd' value='".$_GET['editar']."'></td></tr><br>
					<tr><td colspan='1' class='btnEdita'><br><input type='submit' value='Editar!' name='submit'></td></tr>
				</form>";
		
		echo "</table>";
	}
	?>
	</body>
</html>
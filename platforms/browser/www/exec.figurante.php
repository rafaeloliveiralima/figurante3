<?php

session_start();
require_once('classes/conexao.class.php');
require_once('classes/figurante.class.php');

/* if (!isset($_SESSION['s_idusuario'])) {
  header("Location: index.php");
  }
 */
$conexao = new Conexao;
$conn = $conexao->Conectar();

$Classe = new Figurante(); // <-- Alterar o nome da classe
$Classe->conn = $conn;

$operacao = $_REQUEST['op'];
$id = $_REQUEST['id'];
$idfigurante = $_REQUEST['idfigurante'];
$nome = $_REQUEST['nome'];
$documento = $_REQUEST['documento'];

if (($operacao == 'I') || ($operacao == 'A')) {

    $idchamado = $_REQUEST['id'];
    $nome = $_REQUEST['nome'];
    $documento = $_REQUEST['documento'];

    $Classe->idchamado = $idchamado;
    $Classe->nome = pg_escape_string(utf8_decode(trim($nome)));
    $Classe->documento = pg_escape_string(utf8_decode(trim($documento)));
}

if ($operacao == 'I') {
    $result = $Classe->incluir();
	if ($result!=0)
	{
/*		$msg_telegram = 'Novo chamado '.chr(10);
		$msg_telegram .= 'Solicitante: '.$Classe->solicitante. chr(10);
		$msg_telegram .= 'Animal: '.$Classe->animal. chr(10);
		$msg_telegram .= 'Descrição: '.$Classe->descricao. chr(10);
		$msg_telegram .= 'Local: '.$Classe->local. chr(10);
		$msg_telegram = $msg_telegram;
		$apiToken = "585866996:AAGl018A9au_2Qtw05ql4s4p-HTacPODNv4";
		$data= array ('chat_id' => '@fauna_jb','text' => $msg_telegram);
		$response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" . http_build_query($data) );
*/
	}
	echo $result;
}




if ($operacao == 'A') {

    $result = $Classe->alterar($id);
    echo $result;
}

if ($operacao == 'E') {
    if (!empty($id)) {
        $result = $Classe->excluir($id);
    } else {
        $box = $_POST['id_'];
        while (list ($key, $val) = @each($box)) {
            $result = $Classe->excluir($val);
        }
    }
}
?>




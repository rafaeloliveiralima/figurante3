<?php error_reporting(0);
ini_set("display_errors", 0 );
require_once('classes/conexao.class.php');

$conexao = new Conexao;
$conn = $conexao->Conectar();

$operacao = $_REQUEST['op'];
$id = $_REQUEST['id'];

$sql = 'select * from figurante where idfigurante = '.$id;
$res = pg_exec($conn,$sql);
$row = pg_fetch_array($res);

//$myObj->name = "John";
//$myObj->age = 30;
//$myObj->city = "New York";


$myObj->idfigurante = utf8_encode($row['idfigurante']);
$myObj->nome= utf8_encode($row['nome']);
$myObj->documento= utf8_encode($row['documento']);
$myObj->blusa= utf8_encode($row['blusa']);
$myObj->calca= utf8_encode($row['calca']);
$myObj->sapato= utf8_encode($row['sapato']);
$myObj->acessorio= utf8_encode($row['acessorio']);
$myJSON = json_encode($myObj);

echo $myJSON;
?>
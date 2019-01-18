<?php
class Conexao{
	function Conectar($host = 'pgsql.tempustecnologia.com',$dbname = 'tempustecnologia43',$user = 'tempustecnologia43',$password = 'arcade1')
	{
		$conn = pg_connect("host=$host dbname = $dbname user = $user password = $password ");
		return $conn;
	}
}

?>
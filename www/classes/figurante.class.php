<?php
class Figurante
{
	var $conn;
	var $idfigurante;
	var $nome;
	var $documento;

	function incluir()
	{
 		$sql = "insert into figurante (nome,documento) values (
									'".$this->nome."','".$this->documento."')";
									
								
		$resultado = pg_exec($this->conn,$sql);
       	if ($resultado){
			$sql = "select max(idfigurante) from figurante";
			$res = pg_exec($this->conn,$sql);
			$row = pg_fetch_array($res);
			return $row[0];
	   	}
	   	else
	   	{
	    	return false;
	   	}
	}
	

	function alterar($id)
	{
       	$sql = "update figurante set nome = '".$this->nome."', documento = '".$this->documento."'
			 where idfigurante='".$id."' ";
//			 echo $sql;
		$resultado = pg_exec($this->conn,$sql);
//exit;
       if ($resultado){
	      return true;
	   }
	   else
	   {
	      return false;
	   }
	}

	function excluir($id)
	{
		$sql = "delete from figurante where idfigurante= '".$id."' ";
	   	$resultado = pg_exec($this->conn,$sql);
       	if ($resultado){
	     	return true;
	   	}
	   	else
	   	{
	    	return false;
	   	}
	}

	function getDados($row)
	{
		   	$this->idfigurante = $row['idfigurante'];
		   	$this->nome= $row['nome'];
		   	$this->documento  = $row['documento'];
	}

	
	

	function listaCombo($nomecombo,$id,$refresh,$class='class="form-control"',$idusuario='')
	{
		global $combo_usuario;
		
	   	$sql = "select * from empresa where idempresa = idempresa ";
		if (!empty($idusuario))
		{
			$sql.=' and idempresa in (select distinct idempresa from lote where idusuario = '.$idusuario.')';
		}
		$sql.=" order by SIGLA ";
		$res = pg_exec($this->conn,$sql);
		$s = '';
		if ($refresh == 'S')
		{
			$s = " onChange='submit();'";
		}
		$html = "<select name='".$nomecombo."' id = '".$nomecombo."' ".$s." ".$class.">";
		$html.="<option value = ''>Selecione o Empresa</option>";
		while ($row = pg_fetch_array($res))
		{
			$s = '';
			if ($id == $row['idempresa'])
			{
			   $s = "selected";
			}
		   $html.="<option value='".$row['idempresa']."' ".$s." >".$row['sigla']." (".$row['empresa'].") </option> ";
	    }
		$html .= '</select>';
		return $html;	
	}


	
	function getById($id)

	{

		if (empty($id)){

	    	$id = 0;

	   	}

	   	$sql = 'select * from figurante where idfigurante= '.$id;
		$result = pg_exec($this->conn,$sql);
		if (pg_num_rows($result)>0){
	    	$row = pg_fetch_array($result);
		   	$this->getDados($row);
			return 1;
		}
		else
		{
    		return 0;
		}
	}


}

?>
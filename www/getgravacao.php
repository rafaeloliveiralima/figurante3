<?php
require_once('classes/conexao.class.php');

$conexao = new Conexao;
$conn = $conexao->Conectar();

$operacao = $_REQUEST['op'];
$filtro = $_REQUEST['filtro'];
$sql = 'select * from gravacao where idgravacao = idgravacao ';

if (!empty($filtro))
{
	//$sql.=" and (nome ilike '%".$filtro."%' or documento ilike '%".$filtro."%')";
}

$sql.= ' order by gravacao desc ';
$res = pg_exec($conn,$sql);
$dir = "./upload"; 


// esse seria o "handler" do diretório
$dh = opendir($dir); 

?>
<h4>Gravação</h4>
			  <p>
			  </p>
			  <table class="table">
				<thead>
				  <tr>
					<th>Gravação</th>
				  </tr>
				</thead>
				<tbody>
				  <?php 
				  while ($row=pg_fetch_array($res))
				  {
					  ?>
				  <tr >
					<td><a onclick='setGravacao(<?php echo $row['idgravacao'];?>)'>
					<?php echo $row['gravacao'];?>
					</a>
					</td>
				  </tr>
				  <?php }

				  ?>				  
				</tbody>
			  </table>




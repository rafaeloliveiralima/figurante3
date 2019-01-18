<?php
require_once('classes/conexao.class.php');

$conexao = new Conexao;
$conn = $conexao->Conectar();

$operacao = $_REQUEST['op'];
$filtro = $_REQUEST['filtro'];
$idgravacao = $_REQUEST['idgravacao'];
$sql = 'select * from figurante where idgravacao = '.$idgravacao;

if (!empty($filtro))
{
	$sql.=" and (nome ilike '%".$filtro."%' or documento ilike '%".$filtro."%')";
}

$sql.= ' order by nome desc ';
$res = pg_exec($conn,$sql);
$dir = "./upload"; 


// esse seria o "handler" do diretório
$dh = opendir($dir); 

?>
<h4>Figurantes</h4>
			  <p>
			  </p>
			  <table class="table">
				<thead>
				  <tr>
					<th>ID</th>
					<th>Foto</th>
					<th>Nome</th>
					<th>Documento</th>
				  </tr>
				</thead>
				<tbody>
				  <?php 
				  while ($row=pg_fetch_array($res))
				  {
					  
					  $id=str_pad($row['idfigurante'], 4, "0", STR_PAD_LEFT);
					
					// loop que busca todos os arquivos até que não encontre mais nada
						$imagem = '';
						rewinddir();
						while (false !== ($filename = readdir($dh))) { 
						// verificando se o arquivo é .jpg
							if (substr($filename,-4) == ".jpg") { 
							// mostra o nome do arquivo e um link para ele - pode ser mudado para mostrar diretamente a imagem :)
								if (substr($filename,0,4) == $id) { 
									$imagem = '<img src="http://tempustecnologia.com/acoes/upload/'.$filename.'" width="60px">'; 
								}
							}
						}
											  
					  
					  

					  
					  ?>
				  <tr >
					<td><?php echo $row['idfigurante'];?></td>
					<td><a onclick='carregaatendimento(<?php echo $row['idfigurante'];?>)'><?php echo $imagem;?></a></td>
					<td style="text-transform: none"><a onclick='carregaatendimento(<?php echo $row['idfigurante'];?>)'>
					<?php echo utf8_encode($row['nome']);?>
					</a>
					</td>
					<td>
					<?php echo utf8_encode($row['documento']);?>
					</td>
				  </tr>
				  <?php }

				  ?>				  
				</tbody>
			  </table>




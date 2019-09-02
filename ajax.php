<?php

    
	if (isset($_POST['key'])) {

		include "connection.php";

		if ($_POST['key'] == 'getRowData') { /* carrega os dados no Modal de um registro escolhido --------------------*/
			$rowID = $_POST['rowID'];
			$sql = "SELECT countryName, shortDesc, longDesc FROM country WHERE id=?";
			$query = $pdo->prepare($sql);
			$query->execute(array($rowID));
			$data = $query->fetch(PDO::FETCH_OBJ);

			$jsonArray = array(
				'countryName' => $data->countryName,
				'shortDesc' => $data->shortDesc,
				'longDesc' => $data->longDesc,
			);

			exit(json_encode($jsonArray));
 		}

		if ($_POST['key'] == 'getExistingData') { /* carrega todos os dados da tabela -------------------------------*/
			$start = $_POST['start'];
			$limit = $_POST['limit'];

			$sql = "SELECT id, countryName FROM country LIMIT $start, $limit";
			$query = $pdo->prepare($sql);
			$query->execute();
			$num = $query->rowCount();
			$rows = $query->fetchAll(PDO::FETCH_OBJ);
			
			if ($num > 0) {
				echo $num;
				$response = "";
				foreach($rows as $data){  //imprime cada registro do banco de dados dessa tabela
					$response .= '
						<tr>
							<td>'.$data->id.'</td>
							<td id="country_'.$data->id.'">'.$data->countryName.'</td>
							<td>
								<input type="button" onclick="viewORedit('.$data->id.', \'view\')" value="View" class="btn btn-warning">	
								<input type="button" onclick="viewORedit('.$data->id.', \'edit\')" value="Edit" class="btn btn-primary">
								<input type="button" onclick="deleteRow('.$data->id.')" value="Delete" class="btn btn-danger">
							</td>
						</tr>
					';
				}
				exit($response);
			} else
				exit('reachedMax');
		}

		$rowID = $_POST['rowID'];

		if ($_POST['key'] == 'deleteRow') { /* apaga o registro escolhido */
			$sql = "DELETE FROM country WHERE id=?";
			$sql = $pdo->prepare($sql);
			$sql->execute(array($rowID));
			exit('The Row Has Been Deleted!');
		}

		$name = $_POST['name'];
		$shortDesc = $_POST['shortDesc'];
		$longDesc = $_POST['longDesc'];

		if ($_POST['key'] == 'addNew') {
			$sql = "SELECT id FROM country WHERE countryName = ?";
			$query = $pdo->prepare($sql);
			$query->execute(array($name));
			if ($query->rowCount() > 0)
				exit("Country With This Name Already Exists!");
			else {
				$sql = "INSERT INTO country (countryName, shortDesc, longDesc) 
							VALUES (?,?,?)";
				$query = $pdo->prepare($sql);
				$query->execute(array($name, $shortDesc, $longDesc));

				exit('Country Has Been Inserted!');
			}
		}

		if ($_POST['key'] == 'updateRow') { /* atualiza o registro escolhido */
			$sql = "UPDATE country SET countryName=?, shortDesc=?, longDesc=? WHERE id=?";
			$query = $pdo->prepare($sql);
			$query->execute(array($name, $shortDesc, $longDesc, $rowID));
			exit('success');
		}


	


	}
?>
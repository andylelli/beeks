<?php 

	if (isset($_POST['id'])) 
	{
		$id = $_POST['id'];

		include 'model.php';

		$model = new Model();

		if ($row = $model->edit($id)) 
		{
			$data = array('result' => 'success', 'row' => $row);
		}
		else
		{
			$data = array('result' => 'error');
		}

		echo json_encode($data);
	}

 ?>
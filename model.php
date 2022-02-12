<?php 

class Model 
{

    private $host = "localhost";
    private $username = "andylelli";
    private $password = "Ginogino1";
    private $dbname = "netloftc_beeks";
    private $connection; //create connection
    private $params; //create connection
    public function __construct()
	{
        try {
            $this->connection = new mysqli(
                $this->host,
                $this->username,
                $this->password,
                $this->dbname
            );

            $this->params = json_decode(file_get_contents('params.json'));

        } catch (Exception $e) {
            echo "Connection error " . $e->getMessage();
        }
    } 
	
	// insert book record into database
    public function insert($fields, $values)
    {

        $fields_str = implode(",", $fields);
        $values_str = implode("', '", $values);
        
        $query = "INSERT INTO item (" . $fields_str . ") VALUES ('" . $values_str . "')";     
        
        if ($sql = $this->connection->query($query)) {
            return true;
        } else {
            $this->writeToLog($connection->error);
            return;
        }
    } 
	
	//fetch all book record from database
    public function fetchAll()
    {
        $data = [];
        $data['params'] = $this->params;
        $rows = [];

        $query = "SELECT * FROM item";
        if ($sql = $this->connection->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                array_push($rows, $row);
            }
            $data['rows'] = $rows;
        }       
        $dataLen =  count($data['rows']);
        for ($x = 0; $x < $dataLen; $x++) {        
            unset($data['rows'][$x]['item_image']);
        } 
        return $data;
    } 

    public function searchAll($search, $fields)
    {
        $data = [];
        $data['params'] = $this->params;
        $rows = [];
  

        $arrLen = count($fields);

        $query = "SELECT * FROM item WHERE ";

        for ($x = 0; $x < $arrLen; $x++) {

            $query .= $fields[$x] . ' LIKE "%' . $search . '%"';
            
            if($x != ($arrLen - 1)) {
                $query .=' OR ';
            }

        }
        
        if ($sql = $this->connection->query($query)) {
            while ($row = mysqli_fetch_assoc($sql)) {
                array_push($rows, $row);
            }
            $data['rows'] = $rows;
        }  

        $json = json_decode(file_get_contents('params.json'));
        $params = $json->params; 
    
        $dataLen =  count($data['rows']);
        for ($x = 0; $x < $dataLen; $x++) { 
            
            foreach($params as $param) {

                if(property_exists($param, 'fieldname')) {
                    $fieldname = $param->fieldname;
                    $datatype = $param->datatype;
                    if($datatype == 'image') {
                        unset($data['rows'][$x][$fieldname]);
                    }
                }
            }            
        }   
        $this->writeToLog(print_r($data['rows'], true));   
        return $data;
    }     
	
	//delete book record from database
    public function delete($id)
    {
        $query = "DELETE FROM item WHERE item_id = '" . $id . "' ";
        if ($sql = $this->connection->query($query)) {
            return true;
        } else {
            return;
        }
    } 
	
	//fetch single book record from database
    public function edit($id)
    {
        $data = [];
        $query = "SELECT * FROM item WHERE item_id = '" . $id . "' ";
        if ($sql = $this->connection->query($query)) {
            $row = mysqli_fetch_assoc($sql);
            $data = $row;
        }
        return $data;
    } 
	
	//update book record
    public function update($fields, $values)
    {
        $id = 0;
        $fields_str = implode(",", $fields);
        $values_str = implode("', '", $values);
        
        $query = "UPDATE item SET ";

        $arrLen = count($fields);
        
        for ($x = 1; $x < $arrLen; $x++) {
        
            $query .= $fields[$x] . " = '" . $values[$x] . "'";
            
            if($x != ($arrLen - 1)) {
                $query .=", ";
            }

        }     
        
        $query .= " WHERE item_id = '" . $values[0] . "' ";     

        //$this->writeToLog($query);

        if ($sql = $this->connection->query($query)) {
            return true;
        } else {
            return;
        }      
    }



    public function writeToLog($log_entry){

    	//$log_file = file_get_contents("/home/567470.cloudwaysapps.com/fammrmtndz/public_html/home/QR.txt");
        $log_file = file_get_contents("log.txt");
    
    	$log = date("d/m/y H:i:s - ", time()) . $log_entry . "\r";
    	$log_all = $log_file . $log . "\n";
    
    	//$myFile = "/home/567470.cloudwaysapps.com/fammrmtndz/public_html/home/QR.txt";
        $myFile = "log.txt";
    
    	$fh = fopen($myFile, 'w') or die("can't open file");
    	fwrite($fh, $log_all);
    	fclose($fh);
    	$log_entry = '';
    }     
} 
?>

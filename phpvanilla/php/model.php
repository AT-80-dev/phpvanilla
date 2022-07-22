<?php 

	Class Model
	{
		private $host = 'localhost';
		private $username = 'root';
		private $password = '';
		private $database = 'fileupload';
		private $connection;

		//create connection
		public function __construct()
		{
			try 
			{
				$this->connection = new PDO("mysql:host=$this->host;dbname=$this->database", 
											$this->username, $this->password);
			} 
			catch (PDOException $e) 
			{
				echo "Connection error " . $e->getMessage();
			}
		}

		// insert student new record into database and handle ajax request
		public function insert($data)
		{
            try {
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $fields = [];
                $values = [];

                foreach ($data as $key => $value) {
                    array_push($fields, $key);
                    array_push($values, json_encode($value));
                }

                $field = join(",",$fields);
                $value = join(",",$values);
                
                $sql = "INSERT INTO tbl_file ($field) VALUES ($value)";

                $this->connection->exec($sql);

                return $this->connection->lastInsertId();
              } catch(PDOException $e) {
                return $e->getMessage();
              }
		}

		//fetch all student record from database and handle ajax request 
		public function fetchAllRecords()
		{
            try {
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $stmt = $this->connection->prepare("SELECT * FROM tbl_file");
                $stmt->execute();

                $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                return $stmt->fetchAll();
              } catch(PDOException $e) {
                return $e->getMessage();
              } 
		}

		//delete student record from database and handle ajax request
		public function deleteRecords($id)
		{
            try {
                $sql = "DELETE FROM tbl_file WHERE id='" . $id . "'";
                $this->connection->query($sql);
                return true;
              } catch(PDOException $e) {
                return $e->getMessage();
              } 
		}

		//update student record and handle ajax request
		public function update($data, $id)
		{
            // print_r($data['filename']);
            // exit;
            try {

                $update_stmt=$this->connection->prepare('UPDATE tbl_file SET title=:title,
                                    filename=:filename
																		WHERE 
																		    id=:id');
                $update_stmt->bindParam(':title',$data['title']);
                $update_stmt->bindParam(':filename',$data['filename']);
                $update_stmt->bindParam(':id',$id);
                echo json_encode($update_stmt->execute());	 exit();


              } catch(PDOException $e) {
                return $e->getMessage();
              }
		}
	}
 ?>
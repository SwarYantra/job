<?php
class database
{
	private $db_name='job';
	private $db_pass='';
	private $db_host='localhost';
	private $db_root='root';
	public $link;
	public $result=array();

	public $connection=false;

	public function connect(){
		if(!$this->connection){
			$this->link=mysqli_connect($this->db_host,$this->db_root,$this->db_pass,$this->db_name);

			if($this->link){
				$this->connection=true;
                file_put_contents('php://stderr', print_r("connected", TRUE));
			}
			else{
                file_put_contents('php://stderr', print_r("Not able to connect", TRUE));
			}
		}
		else
		{
            file_put_contents('php://stderr', print_r("already connected..", TRUE));
		}
	}

	public function disconnect()
	{
		if($this->connection)
		{
			$close=mysqli_close($this->link);

			if($close)
			{
				$this->connection=false;
				//dev_Msg("disconnected");
			}
			else
			{
				//test_Msg("Not Able to disonnect");
			}
		}
		else
		{
			//test_Msg("Already disconnected");
		}
	}

	public function tableExist($table){
		$table_count =mysqli_query($this->link,'SHOW TABLE STATUS LIKE "'.$table.'"');

		if($table_count)
		{
			if( mysqli_num_rows($table_count)==1)
			{
				return true;
			}
			else
			{
				//prod_Msg("Duplicate Tables Exist");
				return false;
			}
		}
		else
		{
			//prod_Msg("Table Not Exist");
			return false;
		}
	}

	public function select($tableName,$row='*',$where=null,$value=null,$type=null,$limit=null,$order=null,$seq=null){
		$this->result=null;

		if($this->link)
		{
			$query='';
			if($this->tableExist($tableName))
			{
				$query.='select '.$row.' from '.$tableName;
				if($where)
				{
					$query.=' where ';
					$count=count($where);

					for($i=0;$i<$count;$i++)
					{
						if($i==0){
							$query.=$where[$i].' = ? ';  ///here was =
						}
						else
						{
							$query.=' and '.$where[$i].' = ?';
						}
					}
				}

				if($order)
				{
					$query.=' order by '.$order;
				}

				if($seq){
					$query.=' '.$seq;
				}

				if($limit){
					$query.=' Limit '.$limit;
				}

				$stmt=mysqli_prepare($this->link,$query);

                file_put_contents('php://stderr', print_r("\nSelect Query ".$query."\n", TRUE));

				$a_params = array();

				//counter for number of values
				$num=count($value);

				$a_params[] = & $type;

				for($i = 0; $i < $num; $i++)
				{
					$a_params[] = & $value[$i];
				}

                file_put_contents('php://stderr', print_r($a_params,true));

				//binding value to the function
				call_user_func_array(array($stmt,'bind_param'),$a_params);
					
				$value=$stmt->execute();

                file_put_contents('php://stderr', "\nstatement is".print_r($stmt,true));

				/* store result */
				$stmt->store_result();

				$resultCount=$stmt->num_rows;

				if($resultCount!=0){
					$meta=$stmt->result_metadata();

					$row=array();

					while($field=$meta->fetch_field())
					{
						$params[]=&$row[$field->name];
					}

					call_user_func_array(array($stmt,'bind_result'),$params);

					while($stmt->fetch())
					{
						foreach($row as $key =>$val)
						{
							$c[$key]=$val;
						}
						$hits[]=$c;
					}

                    file_put_contents('php://stderr', "\nSelect Result".print_r($hits,true));
					$this->result=$hits;

					$stmt->close();
				}
				else{
                    file_put_contents('php://stderr', "\nEmpty Result");
				}
			}
		}
		else
		{
            file_put_contents('php://stderr', "Not Conmnected...");
		}
	}

	public function insert($tableName,$row,$value,$type){

		if($this->link)
		{
			if($this->tableExist($tableName))
			{
				$query='';
				$query.='insert into '.$tableName.'('.$row.') values(';

				$count=count($value);

				for($i=0;$i<$count;$i++)
				{
					if($i==0)
					$query.=' ? ';
					else
					$query.=' ,? ';
				}

				$query.=')';
                file_put_contents('php://stderr', "This is".print_r($query,true));
				//dev_Msg("This is insert".print_r($query,true));

				//preparing statement
				$stmt = $this->link->prepare("$query");
				$a_params = array();

				$param_type = '';

				//counter for number of values
				$num=count($value);

				$a_params[] = & $type;

				for($i = 0; $i < $num; $i++)
				{
					$a_params[] = & $value[$i];
				}

				//dev_Msg("This is value".print_r($a_params,true));

				//binding value to the function
				call_user_func_array(array($stmt,'bind_param'),$a_params);
				$ins=$stmt->execute();

				if($ins)
				{
					return true;
				}
				else
				{
					return false;
				}

			}
		}
		else
		{
			//prod_Msg("Not Connected To DB");
		}
	}

    public function delete($tableName,$row,$value,$type){

        if($this->link){
            if($this->tableExist($tableName)){
                $query='';
                $query.='delete from '.$tableName.' where ';

                $count=count($row);

                for($i=0;$i<$count;$i++){
                    if($i==0)
                        $query.=$row[$i].'= ? ';
                    else
                        $query.='and '.$row[$i].'= ? ';
                }

                file_put_contents("php://stderr","\nThis is delete".print_r($query,true));

                //preparing statement
                $stmt = $this->link->prepare("$query");
                $a_params = array();

                $param_type = '';

                //counter for number of values
                $num=count($value);

                $a_params[] = & $type;

                for($i = 0; $i < $num; $i++)
                {
                    $a_params[] = & $value[$i];
                }

                file_put_contents("php://stderr","\nThis is value".print_r($a_params,true));

                //binding value to the function
                call_user_func_array(array($stmt,'bind_param'),$a_params);
                $del=$stmt->execute();

                if($del){
                    return true;
                }
                else{
                    return false;
                }
            }
        }
        else
        {
            file_put_contents("php://stderr","Not Connected To DB");
        }
    }

	public function update($tableName,$row,$value,$where,$type){

		if($this->link)
		{
			if($this->tableExist($tableName))
			{
				$update='update '.$tableName.' Set ';

				$count=count($row);

				for($i=0;$i<$count;$i++)
				{
					if($i==0)
					$update.=$row[$i].' = ?';
					else
					$update.=' , '.$row[$i].' = ?';
				}

				$update.=' where '.$where;

				//preparing statement
				$stmt = $this->link->prepare("$update");

                file_put_contents('php://stderr', "Update is".print_r($update,true));

				$params=array();

				$params[]=&$type;

				for($i = 0; $i < $count; $i++)
				{
					$params[] = & $value[$i];
				}


                file_put_contents('php://stderr', "Params are".print_r($params,true));


                //binding value to the function
				call_user_func_array(array($stmt,'bind_param'),$params);

				$upd=$stmt->execute();

				if($upd){
                    file_put_contents('php://stderr', "Updated");
					return true;
				}else
                    file_put_contents('php://stderr', "Not able to update");
			}
		}
		else
		{
            file_put_contents('php://stderr', "Not connected to database...");
		}
	}


	public function execute($sql){

		$result=mysqli_query($this->link, $sql);
			
		return($result);
	}

    public function selectWithPreparedQuery($query,$value=null,$type=null){
        $this->result=null;
        if($this->link){
            file_put_contents('php://stderr', "\nSelect Satement ".$query);
            file_put_contents('php://stderr', "\nOpening List in MysqliSupport.");
            file_put_contents('php://stderr', "\nThis is Value in Mysqli." . print_r($value, true));
            file_put_contents('php://stderr', "\nThis is type in Mysqli" . print_r($type, true));
            $stmt=mysqli_prepare($this->link,$query);
            if($value){
                $a_params = array();
                //counter for number of values
                $num=count($value);
                $a_params[] = & $type;
                for($i = 0; $i < $num; $i++){
                    $a_params[] = & $value[$i];
                }
                file_put_contents('php://stderr', "Query parameters ".print_r($a_params,true));
                //binding value to the function
                call_user_func_array(array($stmt,'bind_param'),$a_params);
            }
            $value=$stmt->execute();
            file_put_contents('php://stderr', "statement is ".print_r($stmt,true));
            /* store result */
            $stmt->store_result();
            $resultCount=$stmt->num_rows;
            if($resultCount!=0){
                $meta=$stmt->result_metadata();
                $row=array();
                while($field=$meta->fetch_field()){
                    $params[]=&$row[$field->name];
                }
                call_user_func_array(array($stmt,'bind_result'),$params);
                while($stmt->fetch()){
                    foreach($row as $key =>$val){
                        $c[$key]=$val;
                    }
                    $hits[]=$c;
                }
                file_put_contents('php://stderr', "Select Result".print_r($hits,true));

                $this->result=$hits;
                $stmt->close();
            }
            else{
                file_put_contents('php://stderr', "Empty Result");
            }
        }
        else{
            file_put_contents('php://stderr', "Not connected to Database");
        }
    }
}
//creating database class
$db=new Database();

?>

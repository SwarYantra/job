<?php
/**
 * Created by PhpStorm.
 * User: Shivam
 * Date: 2/27/2018
 * Time: 11:12 AM
 */
class HrClientRelation{
    private $hrClientId;
    private $hrId;
    private $clientId;

    /**
     * @return mixed
     */
    public function getHrClientId()
    {
        return $this->hrClientId;
    }

    /**
     * @param mixed $hrClientId
     */
    public function setHrClientId($hrClientId)
    {
        $this->hrClientId = $hrClientId;
    }

    /**
     * @return mixed
     */
    public function getHrId()
    {
        return $this->hrId;
    }

    /**
     * @param mixed $hrId
     */
    public function setHrId($hrId)
    {
        $this->hrId = $hrId;
    }

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param mixed $clientId
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    public function insert($db){

        $db->connect();

        $values=array();
        $row='';
        $type='';
        $table='hr_client_relation';

        if(!empty($this->hrId)){
            if(count($values)>0){
                $row.=',hr_id';
            }else{
                $row.='hr_id';
            }
            $values[count($values)]=$this->hrId;
            $type.='i';
        }

        if(!empty($this->clientId)){
            if(count($values)>0){
                $row.=',client_id';
            }else{
                $row.='client_id';
            }
            $values[count($values)]=$this->clientId;
            $type.='i';
        }

        file_put_contents('php://stderr',print_r("\nInsertion",true));
        file_put_contents('php://stderr',"\nThis is type: ".$type);
        file_put_contents('php://stderr',"\nThis is value: ".print_r($values,true));
        file_put_contents('php://stderr',"\nThis is row:".print_r($row,true));

        $db->insert($table,$row,$values,$type);
        return(mysqli_insert_id($db->link));

        $db->disconnect();
    }

    public function select($db){
        $db->connect();

        $where=array();
        $value=array();
        $table='hr_client_relation';
        $result=array();
        $type='';

        if(!empty($this->hrId)){
            $where[count($where)]='hr_id';
            $value[count($value)]=$this->hrId;
            $type.='i';
        }

        file_put_contents('php://stderr',"\nThis is Selection for the ".$table);
        file_put_contents('php://stderr',"\nThis is where ".print_r($where,true));
        file_put_contents('php://stderr',"\nThis is values ".print_r($value,true));
        file_put_contents('php://stderr',"\nThis is type ".print_r($type,true));

        $db->select($table,'*',$where,$value,$type);
        $result=$db->result;
        $count=count($result);

        $clientList=array();

        for($i=0;$i<$count;$i++){
            $client=new HrClientRelation();

            if(isset($result[$i]['hr_client_id'])){
                $client->setHrClientId($result[$i]['hr_client_id']);
            }if(isset($result[$i]['hr_id'])){
                $client->setHrId($result[$i]['hr_id']);
            }if(isset($result[$i]['client_id'])){
                $client->setClientId($result[$i]['client_id']);
            }

            $clientList[$i]=$client;
        }

        return $clientList;
        $db->disconnect();
}

    public function populate($obj){
        file_put_contents('php://stderr',"Object received".print_r($obj,true));
        if(!empty($obj->hrClientId))
            $this->setHrClientId($obj->hrClientId);
        if(!empty($obj->hrId))
            $this->setHrId($obj->hrId);
        if(!empty($obj->clientId))
            $this->setClientId($obj->clientId);
    }
}
?>
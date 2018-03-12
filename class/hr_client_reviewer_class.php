<?php

/**
 * Created by PhpStorm.
 * User: Shivam
 * Date: 2/27/2018
 * Time: 11:45 AM
 */
class HrClientReviewer
{
    private $hrClientReviewerId;
    private $hrId;
    private $clientId;
    private $userId;

    /**
     * @return mixed
     */
    public function getHrClientReviewerId()
    {
        return $this->hrClientReviewerId;
    }

    /**
     * @param mixed $hrClientReviewerId
     */
    public function setHrClientReviewerId($hrClientReviewerId)
    {
        $this->hrClientReviewerId = $hrClientReviewerId;
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

    /**
     * @return mixed
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * @param mixed $userId
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;
    }

    public function insert($db){
        $db->connect();

        $table='hr_client_reviewer';
        $row='';
        $values=array();
        $type='';

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

        if(!empty($this->userId)){
            if(count($values)>0){
                $row.=',user_id';
            }else{
                $row.='user_id';
            }
            $values[count($values)]=$this->userId;
            $type.='i';
        }

        file_put_contents('php://stderr',"\nThis is Insert");
        file_put_contents('php://stderr',"\nThis is row ".$row);
        file_put_contents('php://stderr',"\nThis is type ".$type);
        file_put_contents('php://stderr','\nThis is values '.print_r($values,true));

        $db->insert($table,$row,$values,$type);

        return(mysqli_insert_id($db->link));

        $db->disconnect();
    }

    public function select($db){
        $db->connect();

        $table='hr_client_reviewer';
        $result=array();
        $values=array();
        $where=array();
        $type='';

        if(!empty($this->hrId)){
            $where[count($where)]='hr_id';
            $values[count($values)]=$this->hrId;
            $type.='i';
        }

        if(!empty($this->clientId)){
            $where[count($where)]='hr_id';
            $values[count($values)]=$this->clientId;
            $type.='i';
        }

        file_put_contents('php://stderr',"\nThis is select...");
        file_put_contents('php://stderr',"\nThis is where ".print_r($where,true));
        file_put_contents('php://stderr',"\nThis is values ".print_r($values,true));
        file_put_contents('php://stderr',"\nThis is Type ".print_r($type,true));

        $db->select($table,'*',$where,$values,$type);
        $result=$db->result;
        $count=count($result);

        $reviewerList=array();

        for($i=0;$i<$count;$i++){

            $reviewer=new HrClientReviewer();

            if(isset($result[$i]['hr_client_reviewer_id'])){
                $reviewer->setHrClientReviewerId($result[$i]['hr_client_reviewer_id']);
            }
            if(isset($result[$i]['hr_id'])){
                $reviewer->setHrId($result[$i]['hr_id']);
            }
            if(isset($result[$i]['client_id'])){
                $reviewer->setClientId($result[$i]['client_id']);
            }
            if(isset($result[$i]['user_id'])){
                $reviewer->setUserId($result[$i]['user_id']);
            }

            $reviewerList[$i]=$reviewer;
        }

        return $reviewerList;

        $db->disconnect();
    }

    public function delete($db){
        $db->connect();

        $value=array();
        $row=array();
        $type='';
        $table='hr_client_reviewer';

        if(!empty($this->hrId)){
            $value[count($value)]=$this->hrId;
            $row[count($row)]='hr_id';
            $type.='i';
        }

        if(!empty($this->clientId)){
            $value[count($value)]=$this->clientId;
            $row[count($row)]='client_id';
            $type.='i';
        }

        if(!empty($this->userId)){
            $value[count($value)]=$this->userId;
            $row[count($row)]='user_id';
            $type.='i';
        }

        file_put_contents('php://stderr',"\nThis is delete for ".$table);
        file_put_contents('php://stderr',"\nThis is row ".print_r($row,true));
        file_put_contents('php://stderr',"\nThis is value ".print_r($value,true));
        file_put_contents('php://stderr',"\nThis type ".print_r($type,true));

        $db->delete($table,$row,$value,$type);
        $db->disconnect();
    }

    public function populate($obj)
    {
        file_put_contents('php://stderr', "Object received" . print_r($obj, true));
        if (!empty($obj->hrClientReviewerId))
            $this->setHrClientReviewerId($obj->hrClientReviewerId);
        if (!empty($obj->hrId))
            $this->setHrId($obj->hrId);
        if (!empty($obj->clientId))
            $this->setClientId($obj->clientId);
        if (!empty($obj->userId))
            $this->setUserId($obj->userId);
    }

}
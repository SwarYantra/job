<?php
/**
 * Created by PhpStorm.
 * User: Shivam
 * Date: 2/6/2018
 * Time: 4:17 PM
 */

class Responsibility
{
private $responsibilityId;
private $openingId;
private $responsibility;

    /**
     * @return mixed
     */
    public function getResponsibilityId()
    {
        return $this->responsibilityId;
    }

    /**
     * @param mixed $responsibilityId
     */
    public function setResponsibilityId($responsibilityId)
    {
        $this->responsibilityId = $responsibilityId;
    }

    /**
     * @return mixed
     */
    public function getOpeningId()
    {
        return $this->openingId;
    }

    /**
     * @param mixed $openingId
     */
    public function setOpeningId($openingId)
    {
        $this->openingId = $openingId;
    }

    /**
     * @return mixed
     */
    public function getResponsibility()
    {
        return $this->responsibility;
    }

    /**
     * @param mixed $responsibility
     */
    public function setResponsibility($responsibility)
    {
        $this->responsibility = $responsibility;
    }
    public function selectList($db){
        //connection made
        $db->connect();

        $where=array();
        $value=array();
        $type='';
        $table='responsibility';

        $result=array();


        if(!empty($this->openingId)){
            $where[count($where)]='opening_id';
            $type.='i';
            $value[count($value)]=$this->openingId;
        }

        file_put_contents('php://stderr', "\nSelect");
        file_put_contents('php://stderr', "\nThis is where".print_r($where,true));
        file_put_contents('php://stderr', "\nThis is value".print_r($value,true));
        file_put_contents('php://stderr', "\nThis is type".print_r($type,true));

        $db->select($table,'*',$where,$value,$type);
        $result=$db->result;

        if(empty($result)){
            return null;
        }
        else{
            $count=count($result);
            $responsibilityList=array();
            for($i=0;$i<$count;$i++){
                $responsibility=new Responsibility();

                if(isset($result[$i]['responsibility_id'])){
                    $responsibility->setResponsibilityId($result[$i]['responsibility_id']);
                }

                if(isset($result[$i]['opening_id'])){
                    $responsibility->setOpeningId($result[$i]['opening_id']);
                }

                if(isset($result[$i]['responsibility'])){
                    $responsibility->setResponsibility($result[$i]['responsibility']);
                }
                $responsibilityList[$i]=$responsibility;
            }
            return $responsibilityList;
        }
        //disconnect
        $db->disconnect();
    }


    //For making the list of of the responsibilities......
    public function populateFromDatabase($result){
        if(empty($result)){
            return null;
        }
        else{
            $count=count($result);
            $responsibilityList=array();
            for($i=0;$i<$count;$i++){
                $responsibility=new Responsibility();
                if(isset($result[$i]['responsibility'])){
                    $responsibility->setResponsibility($result[$i]['responsibility']);
                }

                if(isset($result[$i]['responsibility_id'])){
                    $responsibility->setResponsibilityId($result[$i]['responsibility_id']);
                }

                if(isset($result[$i]['opening_id'])){
                    $responsibility->setOpeningId($result[$i]['opening_id']);
                }

                $responsibilityList[$i]=$responsibility;
            }
            return $responsibilityList;
        }
    }

    public function populate($obj){
        file_put_contents('php://stderr',"Object received".print_r($obj,true));
        if(!empty($obj->responsibility))
            $this->setResponsibility($obj->responsibility);
        if(!empty($obj->responsibilityId))
            $this->setResponsibilityId($obj->responsibilityId);
        if(!empty($obj->openingId))
            $this->setOpeningId($obj->openingId);
    }

    function getJsonData(){
        $var = get_object_vars($this);
        foreach($var as &$value){
            if(is_array($value)){
                $count=count($value);
                for($i=0;$i<$count;$i++){
                    if(method_exists($value[$i],'getJsonData')){
                        $value[$i] = $value[$i]->getJsonData();
                    }
                }
            }
        }
        return $var;
    }
}
?>
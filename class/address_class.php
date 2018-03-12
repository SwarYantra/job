<?php
/**
 * Created by PhpStorm.
 * User: Shivam
 * Date: 2/5/2018
 * Time: 4:56 PM
 */

class Address{
    private $addressId;
    private $line1;
    private $line2;
    private $city;
    private $state;
    private $pincode;

    /**
     * @return mixed
     */
    public function getAddressId()
    {
        return $this->addressId;
    }

    /**
     * @param mixed $addressId
     */
    public function setAddressId($addressId)
    {
        $this->addressId = $addressId;
    }

    /**
     * @return mixed
     */
    public function getLine1()
    {
        return $this->line1;
    }

    /**
     * @param mixed $line1
     */
    public function setLine1($line1)
    {
        $this->line1 = $line1;
    }

    /**
     * @return mixed
     */
    public function getLine2()
    {
        return $this->line2;
    }

    /**
     * @param mixed $line2
     */
    public function setLine2($line2)
    {
        $this->line2 = $line2;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return mixed
     */
    public function getPincode()
    {
        return $this->pincode;
    }

    /**
     * @param mixed $pincode
     */
    public function setPincode($pincode)
    {
        $this->pincode = $pincode;
    }

    public function insert($db){
        //connection made
        $db->connect();

        $value=array();
        $type='';
        $row='';

        $table= 'address';

        if(!empty($this->addressId)){
            if(count($value)>0)
                $row.=',address_id';
            else
                $row.='address_id';
            $value[count($value)]=$this->addressId;
            $type.='i';
        }

        if(!empty($this->line1)){
            if(count($value)>0)
                $row.=',line1';
            else
                $row.='line1';
            $value[count($value)]=$this->line1;
            $type.='s';
        }

        if(!empty($this->line2)){
            if(count($value)>0)
                $row.=',line2';
            else
                $row.='line2';
            $value[count($value)]=$this->line2;
            $type.='s';
        }

        if(!empty($this->city)){
            if(count($value)>0)
                $row.=',city';
            else
                $row.='city';
            $value[count($value)]=$this->userRole;
            $type.='s';
        }

        if(!empty($this->state)){
            if(count($value)>0)
                $row.=',state';
            else
                $row.='state';
            $value[count($value)]=$this->state;
            $type.='s';
        }

        if(!empty($this->pincode)){
            if(count($value)>0)
                $row.=',postal_code';
            else
                $row.='postal_code';
            $value[count($value)]=$this->pincode;
            $type.='s';
        }

        file_put_contents('php://stderr', print_r("\nInsertion", TRUE));
        file_put_contents('php://stderr', "\nThis is row".print_r($row,true));
        file_put_contents('php://stderr', "\nThis is value".print_r($value,true));
        file_put_contents('php://stderr', "\nThis is type".print_r($type,true));

        $db->insert($table,$row,$value,$type);
        return(mysqli_insert_id($db->link));

        //connection removed
        $db->disconnect();
    }

    public function select($db){
        //connection made
        $db->connect();

        $where=array();
        $value=array();
        $type='';
        $table= 'address';

        $result=array();

        if(!empty($this->addressId)){
            $where[count($where)]='address_id';
            $type.='i';
            $value[count($value)]=$this->addressId;
        }


        file_put_contents('php://stderr', "\nSelect");
        file_put_contents('php://stderr', "\nThis is where".print_r($where,true));
        file_put_contents('php://stderr', "\nThis is value".print_r($value,true));
        file_put_contents('php://stderr', "\nThis is type".print_r($type,true));

        $db->select($table,'*',$where,$value,$type);
        $result=$db->result;
        $count=count($db->result);

        $addressList=array();///

        for($i=0;$i<$count;$i++){
            $address=new Address();

            if(isset($result[$i]['address_id'])){
                $address->setAddressId($result[$i]['address_id']);
            }

            if(isset($result[$i]['line1'])){
                $address->setLine1($result[$i]['line1']);
            }

            if(isset($result[$i]['line2'])){
                $address->setLine2($result[$i]['line2']);
            }

            if(isset($result[$i]['city'])){
                $address->setCity($result[$i]['city']);
            }

            if(isset($result[$i]['state'])){
                $address->setState($result[$i]['state']);
            }

            if(isset($result[$i]['postal_code'])){
                $address->setPincode($result[$i]['postal_code']);
            }


            $addressList[$i]=$address;
        }
        return $addressList;

        //disconnect
        $db->disconnect();
    }

    public function update($db){
        //connection made
        //update interview_opening Set interview_opening_id = ? , opening_question_id = ? , `review_expect_flag = ? where interview_opening_id= 1317
        $db->connect();

        $value=array();
        $type='';
        $where='';
        $row=array();

        $table= 'address';

        if(!empty($this->line1)){
            $row[count($value)]='line1';
            $value[count($value)]=$this->line1;
            $type.='s';
        }

        if(!empty($this->line2)){
            $row[count($value)]='line2';
            $value[count($value)]=$this->line2;
            $type.='s';
        }

        if(!empty($this->city)){
            $row[count($value)]='city';
            $value[count($value)]=$this->city;
            $type.='s';
        }

        if(!empty($this->state)){
            $row[count($value)]='state';
            $value[count($value)]=$this->state;
            $type.='s';
        }

        if(!empty($this->pincode)){
            $row[count($value)]='postal_code';
            $value[count($value)]=$this->pincode;
            $type.='s';
        }

        $where='id= '.$this->addressId;


        file_put_contents('php://stderr', "\nUpdation");
        file_put_contents('php://stderr', "\nThis is where".print_r($where,true));
        file_put_contents('php://stderr', "\nThis is value".print_r($value,true));
        file_put_contents('php://stderr', "\nThis is type".print_r($type,true));
        file_put_contents('php://stderr', "\nThis is row".print_r($row,true));

        $db->update($table,$row,$value,$where,$type);

        //connection removed
        $db->disconnect();
    }

    public function populate($obj){
        file_put_contents('php://stderr',"Object received".print_r($obj,true));
        if(!empty($obj->addressId))
            $this->setAddressId($obj->addressId);
        if(!empty($obj->line1))
            $this->setLine1($obj->line1);
        if(!empty($obj->line2))
            $this->setLine2($obj->line2);
        if(!empty($obj->city))
            $this->setCity($obj->city);
        if(!empty($obj->state))
            $this->setState($obj->state);
        if(!empty($obj->pincode))
            $this->setPincode($obj->pincode);
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
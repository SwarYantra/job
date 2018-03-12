<?php
/**
 * Created by PhpStorm.
 * User: Shivam
 * Date: 2/6/2018
 * Time: 5:16 PM
 */

class Company
{
private $companyId;
private $name;
private $logoPath;
private $adminId;
private $description;
private $type;
private $addressId;
private $referenceCode;

    /**
     * @return mixed
     */
    public function getCompanyId()
    {
        return $this->companyId;
    }

    /**
     * @param mixed $compnayId
     */
    public function setCompanyId($compnayId)
    {
        $this->companyId = $compnayId;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getLogoPath()
    {
        return $this->logoPath;
    }

    /**
     * @param mixed $logoPath
     */
    public function setLogoPath($logoPath)
    {
        $this->logoPath = $logoPath;
    }

    /**
     * @return mixed
     */
    public function getAdminId()
    {
        return $this->adminId;
    }

    /**
     * @param mixed $adminId
     */
    public function setAdminId($adminId)
    {
        $this->adminId = $adminId;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

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
    public function getReferenceCode()
    {
        return $this->referenceCode;
    }

    /**
     * @param mixed $referenceCode
     */
    public function setReferenceCode($referenceCode)
    {
        $this->referenceCode = $referenceCode;
    }


    public function selectList($db){
        //connection made
        $db->connect();

        $where=array();
        $value=array();
        $type='';
        $table='company';

        if(!empty($this->companyId)){
            $where[count($where)]='company_id';
            $type.='i';
            $value[count($value)]=$this->companyId;
        }

        if(!empty($this->name)){
            $where[count($where)]='name';
            $type.='s';
            $value[count($value)]=$this->name;
        }

        if(!empty($this->type)){
            $where[count($where)]='type';
            $type.='s';
            $value[count($value)]=$this->type;
        }

        file_put_contents('php://stderr', "\nSelect");
        file_put_contents('php://stderr', "\nThis is where".print_r($where,true));
        file_put_contents('php://stderr', "\nThis is value".print_r($value,true));
        file_put_contents('php://stderr', "\nThis is type".print_r($type,true));

        $db->select($table,'*',$where,$value,$type);
        $result1=$db->result;
        if(empty($result1)){
            return null;
        }
        else{
            $count=count($result1);
            $companyList=array();
            for($i=0;$i<$count;$i++){
                $company=new Company();

                if(isset($result1[$i]['company_id'])){
                    $company->setCompanyId($result1[$i]['company_id']);
                }

                if(isset($result1[$i]['name'])){
                    $company->setName($result1[$i]['name']);
                }

                if(isset($result1[$i]['logo_path'])){
                    $company->setLogoPath($result1[$i]['logo_path']);
                }
                if(isset($result1[$i]['admin_id'])){
                    $company->setAdminId($result1[$i]['admin_id']);
                }
                if(isset($result1[$i]['description'])){
                    $company->setDescription($result1[$i]['description']);
                }
                if(isset($result1[$i]['type'])){
                    $company->setType($result1[$i]['type']);
                }
                if(isset($result1[$i]['address_id'])){
                    $company->setAddressId($result1[$i]['address_id']);
                }
                if(isset($result1[$i]['reference_code'])){
                    $company->setReferenceCode($result1[$i]['reference_code']);
                }
                $companyList[$i]=$company;
            }
            return $companyList;
        }
        //disconnect
        $db->disconnect();
    }

    public function populate($obj){
        file_put_contents('php://stderr',"Object received".print_r($obj,true));
        if(!empty($obj->companyId))
            $this->setCompanyId($obj->companyId);
        if(!empty($obj->name))
            $this->setName($obj->name);
        if(!empty($obj->logoPath))
            $this->setLogoPath($obj->logoPath);
        if(!empty($obj->adminId))
            $this->setAdminId($obj->adminId);
        if(!empty($obj->description))
            $this->setDescription($obj->description);
        if(!empty($obj->type))
            $this->setType($obj->type);
        if(!empty($obj->addressId))
            $this->setAddressId($obj->addressId);
        if(!empty($obj->referenceCode))
            $this->setReferenceCode($obj->referenceCode);
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
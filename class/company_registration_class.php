<?php
/**
 * Created by PhpStorm.
 * User: Shivam
 * Date: 2/7/2018
 * Time: 11:16 AM
 */

class CompanyRegistration
{
    private $registrationId;
    private $registrationCode;
    private $emailId;
    private $phoneNumber;
    private $companyName;
    private $json;
    private $status;
    private $registrationType;

    /**
     * CompanyRegistration constructor.
     */
    public function __construct()
    {
        $this->setRegistrationCode($this->generateRandomString(5));
    }


    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param mixed $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return mixed
     */
    public function getRegistrationId()
    {
        return $this->registrationId;
    }

    /**
     * @param mixed $registrationId
     */
    public function setRegistrationId($registrationId)
    {
        $this->registrationId = $registrationId;
    }

    /**
     * @return mixed
     */
    public function getRegistrationCode()
    {
        return $this->registrationCode;
    }

    /**
     * @param mixed $registrationCode
     */
    public function setRegistrationCode($registrationCode)
    {
        $this->registrationCode = $registrationCode;
    }

    /**
     * @return mixed
     */
    public function getEmailId()
    {
        return $this->emailId;
    }

    /**
     * @param mixed $emailId
     */
    public function setEmailId($emailId)
    {
        $this->emailId = $emailId;
    }

    /**
     * @return mixed
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * @param mixed $phoneNumber
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    /**
     * @return mixed
     */
    public function getCompanyName()
    {
        return $this->companyName;
    }

    /**
     * @param mixed $companyName
     */
    public function setCompanyName($companyName)
    {
        $this->companyName = $companyName;
    }

    /**
     * @return mixed
     */
    public function getJson()
    {
        return $this->json;
    }

    /**
     * @param mixed $json
     */
    public function setJson($json)
    {
        $this->json = $json;
    }

    /**
     * @return mixed
     */
    public function getRegistrationType()
    {
        return $this->registrationType;
    }

    /**
     * @param mixed $registrationType
     */
    public function setRegistrationType($registrationType)
    {
        $this->registrationType = $registrationType;
    }

    public function update($db){
        $db->connect();

        $where='';
        $type='';
        $row=array();
        $values=array();
        $table='company_registration';

        if(!empty($this->status)){
            $row[count($row)]='status';
            $type.='s';
            $values[count($values)]=$this->status;
        }

        $where='registration_id= '.$this->registrationId;

        file_put_contents("php://stderr","\nThis is update Command ");
        file_put_contents("php://stderr","\nWhere ".print_r($where,true));
        file_put_contents("php://stderr","\nRows ".print_r($row,true));
        file_put_contents("php://stderr","\nValues ".print_r($values,true));

        $db->update($table,$row,$values,$where,$type);
        $db->disconnect();
    }

    public function delete($db){

        $db->connect();
        $values=array();
        $row=array();
        $type='';
        $table='company_registration';

        if(!empty($this->registrationId)){
            $values[count($values)]=$this->registrationId;
            $row[count($row)]='registration_id';
            $type.='i';
        }

        file_put_contents("php://stderr","\nThis is delete Command ");
        file_put_contents("php://stderr","\nRows ".print_r($row,true));
        file_put_contents("php://stderr","\nValues ".print_r($values,true));

        $db->delete($table,$row,$values,$type);
        $db->disconnect();
    }

    public function select($db)
    {
        $db->connect();
        $where = array();
        $value = array();
        $type = '';
        $table = 'company_registration';

        if(!empty($this->registrationId)){
         $where[count($where)]='registration_id';
         $value[count($value)]=$this->registrationId;
         $type.='i';
        }

        if (!empty($this->emailId)) {
            $where[count($where)] = 'email_id';
            $value[count($value)] = $this->emailId;
            $type .= 's';
        }

        if (!empty($this->status)) {
            $where[count($where)] = 'status';
            $value[count($value)] = $this->status;
            $type .= 's';
        }

        file_put_contents('php://stderr', print_r("\nInsertion", TRUE));
        file_put_contents('php://stderr', "\nThis is where array " . print_r($where, true));
        file_put_contents('php://stderr', "\nThis is values array " . print_r($value, true));
        file_put_contents('php://stderr', "\nThis is type " . $type);

        $db->select($table, "*", $where, $value, $type);
        $res = $db->result;

        if (!empty($res)) {
            $count = count($res);
            $registered_list = array();
            for ($i = 0; $i < $count; $i++) {
                $companyRegistration = new CompanyRegistration();
                if (isset($res[$i]['registration_id'])) {
                    $companyRegistration->setRegistrationId($res[$i]['registration_id']);
                }

                if (isset($res[$i]['registration_code'])) {
                    $companyRegistration->setRegistrationCode($res[$i]['registration_code']);
                }

                if (isset($res[$i]['email_id'])) {
                    $companyRegistration->setEmailId($res[$i]['email_id']);
                }

                if (isset($res[$i]['phone_number'])) {
                    $companyRegistration->setPhoneNumber($res[$i]['phone_number']);
                }

                if (isset($res[$i]['company_name'])) {
                    $companyRegistration->setCompanyName($res[$i]['company_name']);
                }

                if (isset($res[$i]['json'])) {
                    $companyRegistration->setJson($res[$i]['json']);
                }

                if (isset($res[$i]['registration_type'])) {
                    $companyRegistration->setRegistrationType($res[$i]['registration_type']);
                }

                if (isset($res[$i]['status'])) {
                    $companyRegistration->setStatus($res[$i]['status']);
                }

                $registered_list[] = $companyRegistration;
            }
            return $registered_list;
        } else {
            return null;
        }
        $db->disconnect();
    }

    public function insert($db)
    {
        //connection made
        $db->connect();
        $value = array();
        $type = '';
        $row = '';

        $table = 'company_registration';

        if (!empty($this->registrationCode)) {
            if (count($value) > 0)
                $row .= ',registration_code';
            else
                $row .= 'registration_code';
            $value[count($value)] = $this->registrationCode;
            $type .= 's';
        }

        if (!empty($this->emailId)) {
            if (count($value) > 0)
                $row .= ',email_id';
            else
                $row .= 'email_id';
            $value[count($value)] = $this->emailId;
            $type .= 's';
        }

        if (!empty($this->phoneNumber)) {
            if (count($value) > 0)
                $row .= ',phone_number';
            else
                $row .= 'phone_number';
            $value[count($value)] = $this->phoneNumber;
            $type .= 's';
        }

        if (!empty($this->companyName)) {
            if (count($value) > 0)
                $row .= ',company_name';
            else
                $row .= 'company_name';
            $value[count($value)] = $this->companyName;
            $type .= 's';
        }

        if (!empty($this->json)) {
            if (count($value) > 0)
                $row .= ',json';
            else
                $row .= 'json';
            $value[count($value)] = $this->json;
            $type .= 's';
        }

        if (!empty($this->registrationType)) {
            if (count($value) > 0)
                $row .= ',registration_type';
            else
                $row .= 'registration_type';
            $value[count($value)] = $this->registrationType;
            $type .= 's';
        }

        if (!empty($this->status)) {
            if (count($value) > 0)
                $row .= ',status';
            else
                $row .= 'status';
            $value[count($value)] = $this->status;
            $type .= 's';
        }

        file_put_contents('php://stderr', print_r("\nInsertion", TRUE));
        file_put_contents('php://stderr', "\nThis is row" . print_r($row, true));
        file_put_contents('php://stderr', "\nThis is value" . print_r($value, true));
        file_put_contents('php://stderr', "\nThis is type" . print_r($type, true));

        $db->insert($table, $row, $value, $type);
        return (mysqli_insert_id($db->link));

        //connection removed
        $db->disconnect();
    }

    public function getJsonData()
    {
        $var = get_object_vars($this);
        foreach ($var as &$value) {
            if (is_array($value)) {
                $count = count($value);
                for ($i = 0; $i < $count; $i++) {
                    if (method_exists($value[$i], 'getJsonData')) {
                        $value[$i] = $value[$i]->getJsonData();
                    }
                }
            }
        }
        return $var;
    }

    public function generateRandomString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function populate($obj)
    {
        file_put_contents('php://stderr', "Object received" . print_r($obj, true));
        if (!empty($obj->registrationId))
            $this->setRegistrationId($obj->registrationId);
        if (!empty($obj->registrationCode))
            $this->setRegistrationCode($obj->registrationCode);
        if (!empty($obj->emailId))
            $this->setEmailId($obj->emailId);
        if (!empty($obj->phoneNumber))
            $this->setPhoneNumber($obj->phoneNumber);
        if (!empty($obj->compannyName))
            $this->setCompanyName($obj->compannyName);
        if (!empty($obj->json))
            $this->setJson($obj->json);
        if (!empty($obj->status))
            $this->setStatus($obj->status);
        if (!empty($obj->registrationType))
            $this->setRegistrationType($obj->registrationType);
    }
}

?>
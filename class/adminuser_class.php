<?php

/**
 * Created by PhpStorm.
 * User: Shivam
 * Date: 2/5/2018
 * Time: 2:24 PM
 */
class AdminUser
{
    private $userId;
    private $userName;
    private $mailId;
    private $password;
    private $userRole;
    private $referenceCode;

    /**
     * AdminUser constructor.
     */
    public function __construct()
    {
        //Check that whether reference code is unique or not;
        $this->referenceCode = $this->generateRandomString(5);
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

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return mixed
     */
    public function getMailId()
    {
        return $this->mailId;
    }

    /**
     * @param mixed $mailId
     */
    public function setMailId($mailId)
    {
        $this->mailId = $mailId;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getUserRole()
    {
        return $this->userRole;
    }

    /**
     * @param mixed $userRole
     */
    public function setUserRole($userRole)
    {
        $this->userRole = $userRole;
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

    function generateRandomString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function insert($db)
    {
        //connection made
        $db->connect();

        $value = array();
        $type = '';
        $row = '';

        $table = 'adminuser';

        if (!empty($this->mailId)) {
            if (count($value) > 0)
                $row .= ',mailId';
            else
                $row .= 'mailId';
            $value[count($value)] = $this->mailId;
            $type .= 's';
        }

        if (!empty($this->password)) {
            if (count($value) > 0)
                $row .= ',password';
            else
                $row .= 'password';
            $value[count($value)] = $this->password;
            $type .= 's';
        }

        if (!empty($this->userRole)) {
            if (count($value) > 0)
                $row .= ',userRole';
            else
                $row .= 'userRole';
            $value[count($value)] = $this->userRole;
            $type .= 's';
        }

        if (!empty($this->referenceCode)) {
            if (count($value) > 0)
                $row .= ',reference_code';
            else
                $row .= 'reference_code';
            $value[count($value)] = $this->referenceCode;
            $type .= 's';
        }

        if (!empty($this->userName)) {
            if (count($value) > 0)
                $row .= ',user_name';
            else
                $row .= 'user_name';
            $value[count($value)] = $this->userName;
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

    public function delete($db){

        $db->connect();

        $table='adminuser';
        $value=array();
        $rows=array();
        $type='';

        if(!empty($this->userId)){
            $row[count($rows)]='userId';
            $value[count($value)]=$this->userId;
            $type.='i';
        }

        file_put_contents('php://stderr',"\nThis is delete for ".$table);
        file_put_contents('php://stderr',"\nThis is rows ".print_r($rows,true));
        file_put_contents('php://stderr',"\nThis is Type ".print_r($type,true));
        file_put_contents('php://stderr',"\nThis is Value ".print_r($value,true));

        $db->delete($table,$row,$value,$type);
        $db->disconnect();
    }

    public function select($db)
    {
        //connection made
        $db->connect();

        $where = array();
        $value = array();
        $type = '';
        $table = 'adminuser';

        $result = array();


        if (!empty($this->userId)) {
            $where[count($where)] = 'userId';
            $type .= 'i';
            $value[count($value)] = $this->userId;
        }

        if (!empty($this->mailId)) {
            $where[count($where)] = 'mailId';
            $type .= 's';
            $value[count($value)] = $this->mailId;
        }

        if (!empty($this->password)) {
            $where[count($where)] = 'password';
            $type .= 's';
            $value[count($value)] = $this->password;
        }

        if(!empty($this->userRole)){
            $where[count($where)]='userRole';
            $value[count($value)] = $this->userRole;
            $type.='s';
        }

        file_put_contents('php://stderr', "\nSelect" .$this->userRole);
        file_put_contents('php://stderr', "\nThis is where" . print_r($where, true));
        file_put_contents('php://stderr', "\nThis is value" . print_r($value, true));
        file_put_contents('php://stderr', "\nThis is type" . print_r($type, true));

        $db->select($table, '*', $where, $value, $type);
        $result = $db->result;
        if(empty($result)){
            return null;
        }else {
            $count = count($db->result);
            $adminUserList = array();
            for ($i = 0; $i < $count; $i++) {
                $adminUser = new AdminUser;

                if (isset($result[$i]['userId'])) {
                    $adminUser->setUserId($result[$i]['userId']);
                }

                if (isset($result[$i]['user_name'])) {
                    $adminUser->setUserName($result[$i]['user_name']);
                }

                if (isset($result[$i]['mailId'])) {
                    $adminUser->setMailId($result[$i]['mailId']);
                }

                if (isset($result[$i]['password'])) {
                    $adminUser->setPassword($result[$i]['password']);
                }

                if (isset($result[$i]['userRole'])) {
                    $adminUser->setUserRole($result[$i]['userRole']);
                }

                if (isset($result[$i]['reference_code'])) {
                    $adminUser->setReferenceCode($result[$i]['reference_code']);
                }
                $adminUserList[$i] = $adminUser;
            }
            return $adminUserList;
        }

        //disconnect
        $db->disconnect();
    }

    public function update($db)
    {
        //connection made
        //update interview_opening Set interview_opening_id = ? , opening_question_id = ? , `review_expect_flag = ? where interview_opening_id= 1317
        $db->connect();

        $value = array();
        $type = '';
        $where = '';
        $row = array();

        $table = 'adminuser';

        if (!empty($this->password)) {
            $row[count($value)] = 'password';
            $value[count($value)] = $this->password;
            $type .= 's';
        }

        $where = 'mailId= \''.$this->mailId.'\'';

        file_put_contents('php://stderr', "\nUpdation");
        file_put_contents('php://stderr', "\nThis is where" . print_r($where, true));
        file_put_contents('php://stderr', "\nThis is value" . print_r($value, true));
        file_put_contents('php://stderr', "\nThis is type" . print_r($type, true));
        file_put_contents('php://stderr', "\nThis is row" . print_r($row, true));

        $db->update($table, $row, $value, $where, $type);

        //connection removed
        $db->disconnect();
    }

    public function populate($obj)
    {
        file_put_contents('php://stderr', "Object received" . print_r($obj, true));
        if (!empty($obj->userId))
            $this->setUserId($obj->userId);
        if (!empty($obj->userName))
            $this->setUserName($obj->userName);
        if (!empty($obj->mailId))
            $this->setMailId($obj->mailId);
        if (!empty($obj->password))
            $this->setPassword($obj->password);
        if (!empty($obj->userRole))
            $this->setUserRole($obj->userRole);
        if (!empty($obj->referenceCode))
            $this->setReferenceCode($obj->referenceCode);
    }

    function getJsonData()
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
}

?>
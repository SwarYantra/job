<?php

/**
 * Created by PhpStorm.
 * User: Shivam
 * Date: 3/7/2018
 * Time: 1:18 PM
 */
class Car
{
    private $serverCarId;
    private $userId;
    private $cardId;
    private $status;
    private $context;
    private $action;
    private $result;
    private $qualities;
    private $audioPath;
    private $modifiedBy;
    private $actionType;
    private $rejectMessage;

    /**
     * @return mixed
     */
    public function getServerCarId()
    {
        return $this->serverCarId;
    }

    /**
     * @param mixed $serverCarId
     */
    public function setServerCarId($serverCarId)
    {
        $this->serverCarId = $serverCarId;
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
    public function getCardId()
    {
        return $this->cardId;
    }

    /**
     * @param mixed $cardId
     */
    public function setCardId($cardId)
    {
        $this->cardId = $cardId;
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
    public function getContext()
    {
        return $this->context;
    }

    /**
     * @param mixed $context
     */
    public function setContext($context)
    {
        $this->context = $context;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return mixed
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param mixed $result
     */
    public function setResult($result)
    {
        $this->result = $result;
    }

    /**
     * @return mixed
     */
    public function getQualities()
    {
        return $this->qualities;
    }

    /**
     * @param mixed $qualities
     */
    public function setQualities($qualities)
    {
        $this->qualities = $qualities;
    }

    /**
     * @return mixed
     */
    public function getAudioPath()
    {
        return $this->audioPath;
    }

    /**
     * @param mixed $audioPath
     */
    public function setAudioPath($audioPath)
    {
        $this->audioPath = $audioPath;
    }

    /**
     * @return mixed
     */
    public function getModifiedBy()
    {
        return $this->modifiedBy;
    }

    /**
     * @param mixed $modifiedBy
     */
    public function setModifiedBy($modifiedBy)
    {
        $this->modifiedBy = $modifiedBy;
    }

    /**
     * @return mixed
     */
    public function getActionType()
    {
        return $this->actionType;
    }

    /**
     * @param mixed $actionType
     */
    public function setActionType($actionType)
    {
        $this->actionType = $actionType;
    }

    /**
     * @return mixed
     */
    public function getRejectMessage()
    {
        return $this->rejectMessage;
    }

    /**
     * @param mixed $rejectMessage
     */
    public function setRejectMessage($rejectMessage)
    {
        $this->rejectMessage = $rejectMessage;
    }


    public function select($db)
    {
        $db->connect();

        $table = 'car';
        $type = '';
        $value = array();
        $where = array();

        if (!empty($this->serverCarId)) {
            $where[count($where)] = 'server_car_id';
            $value[count($value)] = $this->serverCarId;
            $type .= 'i';
        }

        if (!empty($this->status)) {
            $where[count($where)] = 'status';
            $value[count($value)] = $this->status;
            $type .= 's';
        }

        file_put_contents('php://stderr', print_r("This is the Table " . $table, true));
        file_put_contents('php://stderr', print_r("\nThis is the Type " . $type, true));
        file_put_contents('php://stderr', "\nThis is the Value " . print_r($value, true));
        file_put_contents('php://stderr', "\nThis is the Where " . print_r($where, true));

        $db->select($table, '*', $where, $value, $type);
        $result = $db->result;

        $carList = array();
        $count = count($result);
        for ($i = 0; $i < $count; $i++) {
            $car = new Car();

            if (isset($result[$i]['server_car_id'])) {
                $car->setServerCarId($result[$i]['server_car_id']);
            }
            if (isset($result[$i]['user_id'])) {
                $car->setUserId($result[$i]['user_id']);
            }
            if (isset($result[$i]['car_id'])) {
                $car->setCardId($result[$i]['car_id']);
            }
            if (isset($result[$i]['status'])) {
                $car->setStatus($result[$i]['status']);
            }
            if (isset($result[$i]['context'])) {
                $car->setContext($result[$i]['context']);
            }
            if (isset($result[$i]['action'])) {
                $car->setAction($result[$i]['action']);
            }
            if (isset($result[$i]['result'])) {
                $car->setResult($result[$i]['result']);
            }
            if (isset($result[$i]['qualities'])) {
                $car->setQualities($result[$i]['qualities']);
            }
            if (isset($result[$i]['audio_path'])) {
                $car->setAudioPath($result[$i]['audio_path']);
            }
            if (isset($result[$i]['modified_by'])) {
                $car->setModifiedBy($result[$i]['modified_by']);
            }
            if (isset($result[$i]['action_type'])) {
                $car->setActionType($result[$i]['action_type']);
            }
            $carList[$i] = $car;
        }
        return $carList;
        $db->disconnect();
    }

    public function update($db)
    {
        $db->connect();
        $table = 'car';
        $type = '';
        $row = array();
        $value = array();
        $where = '';

        if (!empty($this->status)) {
            $row[count($row)] = 'status';
            $value[count($value)] = $this->status;
            $type .= 's';
        }
        if (!empty($this->context)) {
            $row[count($row)] = 'context';
            $value[count($value)] = $this->context;
            $type .= 's';
        }
        if (!empty($this->action)) {
            $row[count($row)] = 'action';
            $value[count($value)] = $this->action;
            $type .= 's';
        }
        if (!empty($this->result)) {
            $row[count($row)] = 'result';
            $value[count($value)] = $this->result;
            $type .= 's';
        }
        if (!empty($this->rejectMessage)) {
            $row[count($row)] = 'reject_message';
            $value[count($value)] = $this->rejectMessage;
            $type .= 's';
        }

        $where = "server_car_id=" . $this->serverCarId;
        file_put_contents('php://stderr', "This is Table: " .print_r( $table, true));
        file_put_contents('php://stderr', "This is row: " .print_r( $row, true));
        file_put_contents('php://stderr', "This is Value: " .print_r( $value, true));
        file_put_contents('php://stderr', "This is Type: " .print_r( $type, true));
        file_put_contents('php://stderr', "This is Where: " .print_r( $where, true));

        $db->update($table, $row, $value, $where, $type);
        $db->disconnect();
    }

    public function populate($obj)
    {
        file_put_contents('php://stderr', "Object received" . print_r($obj, true));
        if (!empty($obj->serverCarId))
            $this->setServerCarId($obj->serverCarId);
        if (!empty($obj->userId))
            $this->setUserId($obj->userId);
        if (!empty($obj->cardId))
            $this->setCardId($obj->cardId);
        if (!empty($obj->status))
            $this->setStatus($obj->status);
        if (!empty($obj->context))
            $this->setContext($obj->context);
        if (!empty($obj->action))
            $this->setAction($obj->action);
        if (!empty($obj->result))
            $this->setResult($obj->result);
        if (!empty($obj->qualities))
            $this->setQualities($obj->qualities);
        if (!empty($obj->audioPath))
            $this->setAudioPath($obj->audioPath);
        if (!empty($obj->modifiedBy))
            $this->setModifiedBy($obj->modifiedBy);
        if (!empty($obj->actionType))
            $this->setActionType($obj->actionType);
        if (!empty($obj->rejectMessage))
            $this->setRejectMessage($obj->rejectMessage);
    }

}

?>
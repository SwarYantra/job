<?php
/**
 * Created by PhpStorm.
 * User: Shivam
 * Date: 3/8/2018
 * Time: 12:21 PM
 */
class Section{
    public $id;
    public $name;
    public $attemptCount;
    public $totalTime;
    public $description;
    /**
     * @var Question[]
     */
    public $questionList;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
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
    public function getQuestionList()
    {
        return $this->questionList;
    }

    /**
     * @param mixed $questionList
     */
    public function setQuestionList($questionList)
    {
        $this->questionList = $questionList;
    }

    /**
     * @return mixed
     */
    public function getAttemptCount()
    {
        return $this->attemptCount;
    }

    /**
     * @param mixed $attemptCount
     */
    public function setAttemptCount($attemptCount)
    {
        $this->attemptCount = $attemptCount;
    }

    /**
     * @return mixed
     */
    public function getTotalTime()
    {
        return $this->totalTime;
    }

    /**
     * @param mixed $totalTime
     */
    public function setTotalTime($totalTime)
    {
        $this->totalTime = $totalTime;
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

    public function populate($obj){
        if(!empty($obj->id)){
            $this->setId($obj->id);
        }
        if(!empty($obj->name)){
            $this->setName($obj->name);
        }
        if(!empty($obj->attemptCount)){
            $this->setAttemptCount($obj->attemptCount);
        }
        if(!empty($obj->totalTime)){
            $this->setTotalTime($obj->totalTime);
        }
        if(!empty($obj->description)){
            $this->setDescription($obj->description);
        }
        if(!empty($obj->questionList)){
            $this->setQuestionList($obj->questionList);
        }
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
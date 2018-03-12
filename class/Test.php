<?php
/**
 * Created by PhpStorm.
 * User: Shivam
 * Date: 3/8/2018
 * Time: 12:21 PM
 */
class Test{
    public $testId;
    public $evaluationType;
    public $openingId;

    /**
     * @var Section[]
     */
    public $sectionList;

    /**
     * @return mixed
     */
    public function getSectionList()
    {
        return $this->sectionList;
    }

    /**
     * @param mixed $sectionList
     */
    public function setSectionList($sectionList)
    {
        $this->sectionList = $sectionList;
    }

    /**
     * @return mixed
     */
    public function getTestId()
    {
        return $this->testId;
    }

    /**
     * @param mixed $testId
     */
    public function setTestId($testId)
    {
        $this->testId = $testId;
    }

    /**
     * @return mixed
     */
    public function getEvaluationType()
    {
        return $this->evaluationType;
    }

    /**
     * @param mixed $evaluationType
     */
    public function setEvaluationType($evaluationType)
    {
        $this->evaluationType = $evaluationType;
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

    public function populate($obj){
        file_put_contents('php://stderr',"Received Object:".print_r($obj,true));
        if(!empty($obj->testId)){
            $this->setTestId($obj->testId);
        }
        if(!empty($obj->evaluationType)){
            $this->setEvaluationType($obj->evaluationType);
        }
        if(!empty($obj->openingId)){
            $this->setTestId($obj->openingId);
        }
        if(!empty($obj->sectionList)){
            $this->setSectionList($obj->sectionList);
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
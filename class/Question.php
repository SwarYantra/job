<?php
/**
 * Created by PhpStorm.
 * User: Shivam
 * Date: 3/8/2018
 * Time: 12:10 PM
 */
class Question{
    public $questionId;
    public $questionText;
    public $questionType;
    /**
     * @var String[]
     */
    public $options;

    /**
     * @return mixed
     */
    public function getQuestionId()
    {
        return $this->questionId;
    }

    /**
     * @param mixed $questionId
     */
    public function setQuestionId($questionId)
    {
        $this->questionId = $questionId;
    }

    /**
     * @return mixed
     */
    public function getQuestionTest()
    {
        return $this->questionTest;
    }

    /**
     * @param mixed $questionTest
     */
    public function setQuestionTest($questionTest)
    {
        $this->questionTest = $questionTest;
    }

    /**
     * @return mixed
     */
    public function getQuestionType()
    {
        return $this->questionType;
    }

    /**
     * @param mixed $questionType
     */
    public function setQuestionType($questionType)
    {
        $this->questionType = $questionType;
    }

    /**
     * @return mixed
     */
    public function getOptions()
    {
        return $this->options;
    }

    /**
     * @param mixed $options
     */
    public function setOptions($options)
    {
        $this->options = $options;
    }

    function populate($obj){
        file_put_contents('php://stderr',"Object Received: ".print_r($obj,true));
        if(!empty($obj->options)) {
            $this->setOptions($obj->options);
        }
        if(!empty($obj->questionId)){
            $this->setQuestionId($obj->questionId);
        }
        if(!empty($obj->questionText)){
            $this->setQuestionTest($obj->questionText);
        }
        if(!empty($obj->questionType)){
            $this->setQuestionType($obj->questionType);
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
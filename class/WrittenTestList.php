<?php
/**
 * Created by PhpStorm.
 * User: Shivam
 * Date: 3/9/2018
 * Time: 3:44 PM
 */
class WrittenTestList{

    /**
     * @var Test[]
     */
    public $writtenTestList;

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
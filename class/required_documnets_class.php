<?php
/**
 * Created by PhpStorm.
 * User: Shivam
 * Date: 2/9/2018
 * Time: 11:34 AM
 */

class RequiredDocument
{
private $documentId;
private $documentName;

    /**
     * @return mixed
     */
    public function getDocumentId()
    {
        return $this->documentId;
    }

    /**
     * @param mixed $documentId
     */
    public function setDocumentId($documentId)
    {
        $this->documentId = $documentId;
    }

    /**
     * @return mixed
     */
    public function getDocumentName()
    {
        return $this->documentName;
    }

    /**
     * @param mixed $documentName
     */
    public function setDocumentName($documentName)
    {
        $this->documentName = $documentName;
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
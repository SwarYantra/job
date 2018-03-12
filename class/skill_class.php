<?php
/**
 * Created by PhpStorm.
 * User: Shivam
 * Date: 2/6/2018
 * Time: 4:14 PM
 */

class Skill
{
private $skillId;
private $openingId;
private $skill;

    /**
     * @return mixed
     */
    public function getSkillId()
    {
        return $this->skillId;
    }

    /**
     * @param mixed $skillId
     */
    public function setSkillId($skillId)
    {
        $this->skillId = $skillId;
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

    /**
     * @return mixed
     */
    public function getSkill()
    {
        return $this->skill;
    }

    /**
     * @param mixed $skill
     */
    public function setSkill($skill)
    {
        $this->skill = $skill;
    }

    public function selectList($db){
        //connection made
        $db->connect();

        $where=array();
        $value=array();
        $type='';
        $table='skill';

        $result=array();


        if(!empty($this->openingId)){
            $where[count($where)]='opening_id';
            $type.='i';
            $value[count($value)]=$this->openingId;
        }

        file_put_contents('php://stderr', "\nSelect");
        file_put_contents('php://stderr', "\nThis is where".print_r($where,true));
        file_put_contents('php://stderr', "\nThis is value".print_r($value,true));
        file_put_contents('php://stderr', "\nThis is type".print_r($type,true));

        $db->select($table,'*',$where,$value,$type);
        $result=$db->result;
        if(empty($result)){
            return null;
        }
        else{
            $count=count($db->result);
            $skillList=array();
            for($i=0;$i<$count;$i++){
                $skill=new Skill;

                if(isset($result[$i]['skill'])){
                    $skill->setSkill($result[$i]['skill']);
                }

                if(isset($result[$i]['skill_id'])){
                    $skill->setSkillId($result[$i]['skill_id']);
                }

                if(isset($result[$i]['opening_id'])){
                    $skill->setOpeningId($result[$i]['opening_id']);
                }

                $skillList[$i]=$skill;
            }
            return $skillList;
        }


        //disconnect
        $db->disconnect();
    }

    public function populate($obj){
        file_put_contents('php://stderr',"Object received".print_r($obj,true));
        if(!empty($obj->skill))
            $this->setSkill($obj->skill);
        if(!empty($obj->skillId))
            $this->setSkillId($obj->skillId);
        if(!empty($obj->openingId))
            $this->setOpeningId($obj->openingId);
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
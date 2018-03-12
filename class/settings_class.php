<?php
/**
 * Created by PhpStorm.
 * User: Shivam
 * Date: 2/6/2018
 * Time: 12:12 PM
 */
class Setting{
    private $settingId;
    private $functionalAreas;
    private $applicationName;
    private $versionList;

    /**
     * @return mixed
     */
    public function getSettingId()
    {
        return $this->settingId;
    }

    /**
     * @param mixed $settingId
     */
    public function setSettingId($settingId)
    {
        $this->settingId = $settingId;
    }

    /**
     * @return mixed
     */
    public function getFunctionalAreas()
    {
        return $this->functionalAreas;
    }

    /**
     * @param mixed $functionalAreas
     */
    public function setFunctionalAreas($functionalAreas)
    {
        $this->functionalAreas = $functionalAreas;
    }

    /**
     * @return mixed
     */
    public function getApplicationName()
    {
        return $this->applicationName;
    }

    /**
     * @param mixed $applicationName
     */
    public function setApplicationName($applicationName)
    {
        $this->applicationName = $applicationName;
    }

    /**
     * @return mixed
     */
    public function getVersionList()
    {
        return $this->versionList;
    }

    /**
     * @param mixed $versionList
     */
    public function setVersionList($versionList)
    {
        $this->versionList = $versionList;
    } ///setting_json


    ///Incomplete method..
    public function insert($db){
        $db->connect();

        $row='';
        $type='';
        $values=array();
        $table='settings';

        if(!empty($this->settingId)){
            if(count($values)>0){
                $row.=',settings_id';
            }else{
                $row.='settings_id';
            }
            $value[count($values)]=$this->settingId;
            $type='i';
        }
    }
///Incomplete Method...

    public function selectList($db){
        //connection made
        $db->connect();

        $where=array();
        $value=array();
        $type='';
        $table='settings';

        $result=array();


        if(!empty($this->applicationName)){
            $where[count($where)]='application_name';
            $type.='s';
            $value[count($value)]=$this->applicationName;
        }

        if(!empty($this->settingId)){
            $where[count($where)]='settings_id';
            $type.='i';
            $value[count($value)]=$this->settingId;
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
            $settingsList=array();
            for($i=0;$i<$count;$i++){
                $settings=new Setting();

                if(isset($result[$i]['settings_id'])){
                    $settings->setSettingId($result[$i]['settings_id']);
                }

                if(isset($result[$i]['functional_areas'])){
                    $settings->setFunctionalAreas($result[$i]['functional_areas']);
                }

                if(isset($result[$i]['application_name'])){
                    $settings->setApplicationName($result[$i]['application_name']);
                }

                if(isset($result[$i]['setting_json'])){
                    $settings->setVersionList($result[$i]['setting_json']);
                }

                $settingsList[$i]=$settings;
            }
            return $settingsList;
        }
        //disconnect
        $db->disconnect();
    }

    public function populate($obj){
        file_put_contents('php://stderr',"Object received".print_r($obj,true));
        if(!empty($obj->settingId))
            $this->setSettingId($obj->settingId);
        if(!empty($obj->functionalAreas))
            $this->setFunctionalAreas($obj->functionalAreas);
        if(!empty($obj->versionList))
            $this->setVersionList($obj->versionList);
        if(!empty($obj->applicationName))
            $this->setApplicationName($obj->applicationName);
    }

    public function update($db){
        $db->connect();
        $where='';
        $row=array();
        $values=array();
        $table='settings';
        $type='';

        if(!empty($this->functionalAreas)){
            $row[count($row)]='functional_areas';
            $values[count($values)]=$this->functionalAreas;
            $type.='s';
        }

        $where="settings_id=".$this->settingId;
        file_put_contents('php://stderr',"\nThis is Update for ".$table);
        file_put_contents('php://stderr',"\nThis is rows ".print_r($row,true));
        file_put_contents('php://stderr',"\nThis is values ".print_r($values,true));
        file_put_contents('php://stderr',"\nThis is type ".print_r($type,true));
        file_put_contents('php://stderr',"\nThis is Select ".$where);

        $db->update($table,$row,$values,$where,$type);
        $db->disconnect();
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
?>
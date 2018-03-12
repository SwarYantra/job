<?php
/**
 * Created by Shivam.
 * User: Shivam
 * Date: 2/6/2018
 * Time: 11:40 AM
 */
class CampaignerUserCount
{
    private $referenceCode;
    private $openingId;
    private $totalShareCount;
    private $selectCount;
    private $rejectCount;

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
    public function getTotalShareCount()
    {
        return $this->totalShareCount;
    }

    /**
     * @param mixed $totalShareCount
     */
    public function setTotalShareCount($totalShareCount)
    {
        $this->totalShareCount = $totalShareCount;
    }

    /**
     * @return mixed
     */
    public function getSelectCount()
    {
        return $this->selectCount;
    }

    /**
     * @param mixed $selectCount
     */
    public function setSelectCount($selectCount)
    {
        $this->selectCount = $selectCount;
    }

    /**
     * @return mixed
     */
    public function getRejectCount()
    {
        return $this->rejectCount;
    }

    /**
     * @param mixed $rejectCount
     */
    public function setRejectCount($rejectCount)
    {
        $this->rejectCount = $rejectCount;
    }


    public function insert($db){
        //connection made
        $db->connect();

        $value=array();
        $type='';
        $row='';

        $table='campaigner_user_count';

        if(!empty($this->referenceCode)){
            if(count($value)>0)
                $row.=',reference_code';
            else
                $row.='reference_code';
            $value[count($value)]=$this->referenceCode;
            $type.='s';
        }

        if(!empty($this->totalShareCount)){
            if(count($value)>0)
                $row.=',totalShareCount';
            else
                $row.='totalShareCount';
            $value[count($value)]=$this->totalShareCount;
            $type.='i';
        }

        if(!empty($this->selectCount)){
            if(count($value)>0)
                $row.=',select_count';
            else
                $row.='select_count';
            $value[count($value)]=$this->selectCount;
            $type.='i';
        }

        if(!empty($this->rejectCount)){
            if(count($value)>0)
                $row.=',reject_count';
            else
                $row.='reject_count';
            $value[count($value)]=$this->rejectCount;
            $type.='i';
        }

        file_put_contents('php://stderr', print_r("\nInsertion", TRUE));
        file_put_contents('php://stderr', "\nThis is row".print_r($row,true));
        file_put_contents('php://stderr', "\nThis is value".print_r($value,true));
        file_put_contents('php://stderr', "\nThis is type".print_r($type,true));

        $db->insert($table,$row,$value,$type);
        return(mysqli_insert_id($db->link));

        //connection removed
        $db->disconnect();
    }



    public function selectList($db){
        //connection made
        $db->connect();

        $where=array();
        $value=array();
        $type='';
        $table='campaigner_user_count';

        $result=array();

        if(!empty($this->referenceCode)){
            $where[count($where)]='reference_code';
            $type.='s';
            $value[count($value)]=$this->referenceCode;
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
            $campaignerUserCountList=array();
            for($i=0;$i<$count;$i++){
                $campaignerUserCount=new CampaignerUserCount;

                if(isset($result[$i]['reference_code'])){
                    $campaignerUserCount->setReferenceCode($result[$i]['reference_code']);
                }

                if(isset($result[$i]['opening_id'])){
                    $campaignerUserCount->setOpeningId($result[$i]['opening_id']);
                }

                if(isset($result[$i]['total_share_count'])){
                    $campaignerUserCount->setTotalShareCount($result[$i]['total_share_count']);
                }

                if(isset($result[$i]['select_count'])){
                    $campaignerUserCount->setSelectCount($result[$i]['select_count']);
                }

                if(isset($result[$i]['reject_count'])){
                    $campaignerUserCount->setRejectCount($result[$i]['reject_count']);
                }

                $campaignerUserCountList[$i]=$campaignerUserCount;
            }
            return $campaignerUserCountList;
        }
        //disconnect
        $db->disconnect();
    }

    public function update($db){
        //connection made
        //update interview_opening Set interview_opening_id = ? , opening_question_id = ? , `review_expect_flag = ? where interview_opening_id= 1317
        $db->connect();

        $value=array();
        $type='';
        $where='';
        $row=array();

        $table='campaigner_user_count';

        /*if(!empty($this->interviewOpeningId)){
            $row[count($value)]='interview_opening_id';
            $value[count($value)]=$this->interviewOpeningId;
            $type.='i';
        }*/

        /*if(!empty($this->referenceCode)){
            $row[count($value)]='reference_code';
            $value[count($value)]=$this->referenceCode;
            $type.='s';
        }*/

        /*if(!empty($this->openingId)){
            $row[count($value)]='opening_id';
            $value[count($value)]=$this->openingId;
            $type.='i';
        }*/

        if(!empty($this->totalShareCount)){
            $row[count($value)]='total_share_count';
            $value[count($value)]=$this->totalShareCount;
            $type.='i';
        }

        if(!empty($this->rejectCount)){
            $row[count($value)]='reject_count';
            $value[count($value)]=$this->rejectCount;
            $type.='i';
        }

        if(!empty($this->selectCount)){
            $row[count($value)]='select_count';
            $value[count($value)]=$this->selectCount;
            $type.='i';
        }

        $where='reference_code= '.$this->referenceCode;


        file_put_contents('php://stderr', "\nUpdation");
        file_put_contents('php://stderr', "\nThis is where".print_r($where,true));
        file_put_contents('php://stderr', "\nThis is value".print_r($value,true));
        file_put_contents('php://stderr', "\nThis is type".print_r($type,true));
        file_put_contents('php://stderr', "\nThis is row".print_r($row,true));

        $db->update($table,$row,$value,$where,$type);

        //connection removed
        $db->disconnect();
    }

    public function populate($obj){
        file_put_contents('php://stderr',"Object received".print_r($obj,true));
        if(!empty($obj->referenceCode))
            $this->setReferenceCode($obj->referenceCode);
        if(!empty($obj->openingId))
            $this->setOpeningId($obj->openingId);
        if(!empty($obj->selectCount))
            $this->setSelectCount($obj->selectCount);
        if(!empty($obj->rejectCount))
            $this->setRejectCount($obj->rejectCount);
        if(!empty($obj->totalShareCount))
            $this->setTotalShareCount($obj->totalShareCount);
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
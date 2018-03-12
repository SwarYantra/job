<?php
/**
 * Created by PhpStorm.
 * User: Shivam
 * Date: 2/6/2018
 * Time: 5:16 PM
 */

require "../support/opening_list_support.php";

class Opening
{
    private $openingId;
    private $hrId;
    private $clientId;
    private $type;
    private $designation;
    private $minExperience;
    private $maxExperience;
    private $location;
    private $salaryMax;
    private $salaryMin;
    private $createDate;
    private $industryType;
    private $applicationStartDate;
    private $applicationEndDate;
    private $jobDescription;
    private $functionalArea;
    private $referenceCode;
    private $skills;
    private $hrCompany;
    private $clientCompany;
    private $responsibilities;
    private $requiredDocumentList;
    private $writtenTest;

    /**
     * @return mixed
     */
    public function getWrittenTest()
    {
        return $this->writtenTest;
    }

    /**
     * @param mixed $writtenTest
     */
    public function setWrittenTest($writtenTest)
    {
        $this->writtenTest = $writtenTest;
    }

    /**
     * @return mixed
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * @param mixed $skills
     */
    public function setSkills($skills)
    {
        $this->skills = $skills;
    }

    /**
     * @return mixed
     */
    public function getHrCompany()
    {
        return $this->hrCompany;
    }

    /**
     * @param mixed $hrCompany
     */
    public function setHrCompany($hrCompany)
    {
        $this->hrCompany = $hrCompany;
    }

    /**
     * @return mixed
     */
    public function getClientCompany()
    {
        return $this->clientCompany;
    }

    /**
     * @param mixed $clientCompany
     */
    public function setClientCompany($clientCompany)
    {
        $this->clientCompany = $clientCompany;
    }

    /**
     * @return mixed
     */
    public function getResponsibilities()
    {
        return $this->responsibilities;
    }

    /**
     * @param mixed $responsibilities
     */
    public function setResponsibilities($responsibilities)
    {
        $this->responsibilities = $responsibilities;
    }

    /**
     * @return mixed
     */
    public function getRequiredDocumentList()
    {
        return $this->requiredDocumentList;
    }

    /**
     * @param mixed $requiredDocumentList
     */
    public function setRequiredDocumentList($requiredDocumentList)
    {
        $this->requiredDocumentList = $requiredDocumentList;
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
    public function getHrId()
    {
        return $this->hrId;
    }

    /**
     * @param mixed $hrId
     */
    public function setHrId($hrId)
    {
        $this->hrId = $hrId;
    }

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param mixed $clientId
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getDesignation()
    {
        return $this->designation;
    }

    /**
     * @param mixed $designation
     */
    public function setDesignation($designation)
    {
        $this->designation = $designation;
    }

    /**
     * @return mixed
     */
    public function getMinExperience()
    {
        return $this->minExperience;
    }

    /**
     * @param mixed $minExperience
     */
    public function setMinExperience($minExperience)
    {
        $this->minExperience = $minExperience;
    }

    /**
     * @return mixed
     */
    public function getMaxExperience()
    {
        return $this->maxExperience;
    }

    /**
     * @param mixed $maxExperience
     */
    public function setMaxExperience($maxExperience)
    {
        $this->maxExperience = $maxExperience;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getSalaryMax()
    {
        return $this->salaryMax;
    }

    /**
     * @param mixed $salaryMax
     */
    public function setSalaryMax($salaryMax)
    {
        $this->salaryMax = $salaryMax;
    }

    /**
     * @return mixed
     */
    public function getSalaryMin()
    {
        return $this->salaryMin;
    }

    /**
     * @param mixed $salaryMin
     */
    public function setSalaryMin($salaryMin)
    {
        $this->salaryMin = $salaryMin;
    }

    /**
     * @return mixed
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * @param mixed $createDate
     */
    public function setCreateDate($createDate)
    {
        $this->createDate = $createDate;
    }

    /**
     * @return mixed
     */
    public function getIndustryType()
    {
        return $this->industryType;
    }

    /**
     * @param mixed $industryType
     */
    public function setIndustryType($industryType)
    {
        $this->industryType = $industryType;
    }

    /**
     * @return mixed
     */
    public function getApplicationStartDate()
    {
        return $this->applicationStartDate;
    }

    /**
     * @param mixed $applicationStartDate
     */
    public function setApplicationStartDate($applicationStartDate)
    {
        $this->applicationStartDate = $applicationStartDate;
    }

    /**
     * @return mixed
     */
    public function getApplicationEndDate()
    {
        return $this->applicationEndDate;
    }

    /**
     * @param mixed $applicationEndDate
     */
    public function setApplicationEndDate($applicationEndDate)
    {
        $this->applicationEndDate = $applicationEndDate;
    }

    /**
     * @return mixed
     */
    public function getJobDescription()
    {
        return $this->jobDescription;
    }

    /**
     * @param mixed $jobDescription
     */
    public function setJobDescription($jobDescription)
    {
        $this->jobDescription = $jobDescription;
    }

    /**
     * @return mixed
     */
    public function getFunctionalArea()
    {
        return $this->functionalArea;
    }

    /**
     * @param mixed $functionalArea
     */
    public function setFunctionalArea($functionalArea)
    {
        $this->functionalArea = $functionalArea;
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

    public function selectList($db)
    {
        //connection made
        $db->connect();

        $where = array();
        $value = array();
        $type = '';
        $table = 'opening';

        $result = array();

        file_put_contents('php://stderr', "\nSelect");
        file_put_contents('php://stderr', "\nThis is where" . print_r($where, true));
        file_put_contents('php://stderr', "\nThis is value" . print_r($value, true));
        file_put_contents('php://stderr', "\nThis is type" . print_r($type, true));

        $db->select($table, '*', $where, $value, $type);///We have to use Prepared Query Here...
        $db->disconnect();
    }


    public function populateFromDatabase($result)
    {
        $count = count($result);
        $openingList = array();

        for ($i = 0; $i < $count; $i++) {
            $opening = new Opening;
            if (isset($result[$i]['opening_id'])) {
                $opening->setOpeningId($result[$i]['opening_id']);
            }
            if (isset($result[$i]['hr_id'])) {
                $opening->setHrId($result[$i]['hr_id']);
            }

            if (isset($result[$i]['client_id'])) {
                $opening->setClientId($result[$i]['client_id']);
            }

            if (isset($result[$i]['type'])) {
                $opening->setType($result[$i]['type']);
            }

            if (isset($result[$i]['designation'])) {
                $opening->setDesignation($result[$i]['designation']);
            }

            if (isset($result[$i]['min_experience'])) {
                $opening->setMinExperience($result[$i]['min_experience']);
            }
            if (isset($result[$i]['max_experience'])) {
                $opening->setMaxExperience($result[$i]['max_experience']);
            }
            if (isset($result[$i]['location'])) {
                $opening->setLocation($result[$i]['location']);
            }
            if (isset($result[$i]['salary_max'])) {
                $opening->setSalaryMax($result[$i]['salary_max']);
            }
            if (isset($result[$i]['salary_min'])) {
                $opening->setSalaryMin($result[$i]['salary_min']);
            }
            if (isset($result[$i]['create_date'])) {
                $opening->setCreateDate($result[$i]['create_date']);
            }
            if (isset($result[$i]['industry_type'])) {
                $opening->setIndustryType($result[$i]['industry_type']);
            }
            if (isset($result[$i]['application_start_date'])) {
                $opening->setApplicationStartDate($result[$i]['application_start_date']);
            }
            if (isset($result[$i]['application_end_date'])) {
                $opening->setApplicationEndDate($result[$i]['application_end_date']);
            }
            if (isset($result[$i]['job_description'])) {
                $opening->setJobDescription($result[$i]['job_description']);
            }
            if (isset($result[$i]['functional_area'])) {
                $opening->setFunctionalArea($result[$i]['functional_area']);
            }
            if (isset($result[$i]['reference_code'])) {
                $opening->setReferenceCode($result[$i]['reference_code']);
            }
            if (isset($result[$i]['salary_min'])) {
                $opening->setSalaryMin($result[$i]['salary_min']);
            }
            if(isset($result[$i]['required_documents'])){
                $opening->setRequiredDocumentList($result[$i]['required_documents']);
            }
            $openingList[] = $opening;
        }
        return $openingList;
    }

    public function populate($obj)
    {
        file_put_contents('php://stderr', "Object received" . print_r($obj, true));
        if (!empty($obj->openingId))
            $this->setOpeningId($obj->openingId);
        if (!empty($obj->hrId))
            $this->setHrId($obj->hrId);
        if (!empty($obj->clientId))
            $this->setClientId($obj->clientId);
        if (!empty($obj->type))
            $this->setType($obj->type);
        if (!empty($obj->designation))
            $this->setDesignation($obj->designation);
        if (!empty($obj->minExperience))
            $this->setMinExperience($obj->minExperience);
        if (!empty($obj->maxExperience))
            $this->setMaxExperience($obj->maxExperience);
        if (!empty($obj->location))
            $this->setLocation($obj->location);
        if (!empty($obj->salaryMax))
            $this->setSalaryMax($obj->salaryMax);
        if (!empty($obj->salaryMin))
            $this->setSalaryMin($obj->salaryMin);
        if (!empty($obj->createDate))
            $this->setCreateDate($obj->createDate);
        if (!empty($obj->industryType))
            $this->setIndustryType($obj->industryType);
        if (!empty($obj->applicationStartDate))
            $this->setApplicationStartDate($obj->applicationStartDate);
        if (!empty($obj->applicationEndDate))
            $this->setApplicationEndDate($obj->applicationEndDate);
        if (!empty($obj->jobDescription))
            $this->setJobDescription($obj->jobDescription);
        if (!empty($obj->functionalArea))
            $this->setFunctionalArea($obj->functionalArea);
        if (!empty($obj->referenceCode))
            $this->setReferenceCode($obj->referenceCode);
        if(!empty($obj->requiredDocumentList))
            $this->setRequiredDocumentList($obj->requiredDocumentList);
    }

    function update($db){
        $db->connect();
        $table='opening';
        $rows=array();
        $values=array();
        $where='';
        $type='';

        if(!empty($this->writtenTest)){
            $rows[count($rows)]='written_test';
            $values[count($values)]=$this->writtenTest;
            $type.='s';
        }

        $where="opening_id=".$this->openingId;
        file_put_contents('php://stderr',"This is table:".$table);
        file_put_contents('php://stderr',"This is rows:".print_r($rows,true));
        file_put_contents('php://stderr',"This is values:".print_r($values,true));
        file_put_contents('php://stderr',"This is type:".$type);
        file_put_contents('php://stderr',"This is where:".$where);

        $db->update($table,$rows,$values,$where,$type);
        $db->disconnect();


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
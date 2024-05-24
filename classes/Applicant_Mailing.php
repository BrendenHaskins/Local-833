<?php

class Applicant_Mailing extends Applicant
{

    private array $_selectionsJobs;
    private array $_selectionsVerticals;
    public function __construct(string $_fname, string $_lname, string $_email, string $_state, string $_phone,
                                string $_link, string $_experience, string $_relocate, string $_bio,
                                array $_selectionsJobs, array $_selectionsVerticals)
    {
        parent::__construct( $_fname,  $_lname,  $_email,  $_state,  $_phone,
                                 $_link,  $_experience,  $_relocate,  $_bio);

        $this->_selectionsJobs = $_selectionsJobs;
        $this->_selectionsVerticals = $_selectionsVerticals;
    }


    public function getSelectionsJobs(): array
    {
        return $this->_selectionsJobs;
    }

    public function setSelectionsJobs(array $selectionsJobs): void
    {
        $this->_selectionsJobs = $selectionsJobs;
    }

    public function getSelectionsVerticals(): array
    {
        return $this->_selectionsVerticals;
    }

    public function setSelectionsVerticals(array $selectionsVerticals): void
    {
        $this->_selectionsVerticals = $selectionsVerticals;
    }



}
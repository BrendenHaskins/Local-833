<?php

class Applicant
{
    private string $_fname;
    private string $_lname;
    private string $_email;
    private string $_state;
    private string $_phone;
    private string $_link;
    private string $_experience;
    private string $_relocate;
    private string $_bio;

    /**
     * @param string $_fname
     * @param string $_lname
     * @param string $_email
     * @param string $_state
     * @param string $_phone
     * @param string $_link
     * @param string $_experience
     * @param string $_relocate
     * @param string $_bio
     */
    public function __construct(string $_fname, string $_lname, string $_email, string $_state, string $_phone,
                                string $_link, string $_experience, string $_relocate, string $_bio)
    {
        $this->_fname = $_fname;
        $this->_lname = $_lname;
        $this->_email = $_email;
        $this->_state = $_state;
        $this->_phone = $_phone;
        $this->_link = $_link;
        $this->_experience = $_experience;
        $this->_relocate = $_relocate;
        $this->_bio = $_bio;
    }


    public function getFname(): string
    {
        return $this->_fname;
    }

    public function setFname(string $fname): void
    {
        $this->_fname = $fname;
    }

    public function getLname(): string
    {
        return $this->_lname;
    }

    public function setLname(string $lname): void
    {
        $this->_lname = $lname;
    }

    public function getEmail(): string
    {
        return $this->_email;
    }

    public function setEmail(string $email): void
    {
        $this->_email = $email;
    }

    public function getState(): string
    {
        return $this->_state;
    }

    public function setState(string $state): void
    {
        $this->_state = $state;
    }

    public function getPhone(): string
    {
        return $this->_phone;
    }

    public function setPhone(string $phone): void
    {
        $this->_phone = $phone;
    }

    public function getLink(): string
    {
        return $this->_link;
    }

    public function setLink(string $link): void
    {
        $this->_link = $link;
    }

    public function getExperience(): string
    {
        return $this->_experience;
    }

    public function setExperience(string $experience): void
    {
        $this->_experience = $experience;
    }

    public function getRelocate(): string
    {
        return $this->_relocate;
    }

    public function setRelocate(string $relocate): void
    {
        $this->_relocate = $relocate;
    }

    public function getBio(): string
    {
        return $this->_bio;
    }

    public function setBio(string $bio): void
    {
        $this->_bio = $bio;
    }
}
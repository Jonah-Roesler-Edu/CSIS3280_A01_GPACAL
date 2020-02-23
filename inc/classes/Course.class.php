<?php

// coursecode,fullname,percentile,credithours

class Course implements ICourse {

    //short name/course code

    private $_sName = "";
    private $_fName = "";
    private $_percent = "";
    private $_cHours = "";
    private $_lGrade = "";
    private $_gpaPoint = "";

    //Default constructor
    function __construct()
    {
                
    }
    
    public function setCourseInfo($code = "X", 
                    $name = "Y", 
                    $percent = 0, 
                    $credit = 0) {

        $this->_sName = $code;
        $this->_fName = $name;
        $this->_percent = $percent;
        $this->_cHours = $credit;
        //Set the percentile because we need it later.
        //Call calcScores to calculate letter grade and GPA points
        $this->calcScores();
    }

    //Getters
    public function getShortName() : string {return $this->_sName; }

    public function getFullName() : string {return $this->_fName; }

    public function getPercentile() : float {return (float) $this->_percent; }
    
    public function getCreditHours() : int { return (int) $this->_cHours; }

    public function getLetterGrade() : string {return $this->_lGrade; }

    public function getGPA(): float {return $this->_gpaPoint; }

    public function setFullName(string $fullName) {
        $this->_fName = $fullName;
    }

    public function setShortName(string $shortName) {
        $this->_sName = $shortName;
    }  

    public function setPercentile(string $percentile) {
        $this->_percent = $percentile;
        $this->calcScores();
    }

    public function setCreditHours(int $creditHours) {
        $this->_cHours = $creditHours;
    }

    //Calculate the GPA points and grade based on percent
    public function calcScores(){
        if($this->_percent > 49) {
            if($this->_percent > 54) {
                if($this->_percent > 59) {
                    if($this->_percent > 64) {
                        if($this->_percent > 69) {
                            if($this->_percent > 74) {
                                if($this->_percent > 79) {
                                    if($this->_percent > 84) {
                                        if($this->_percent > 89) {
                                            if($this->_percent > 94) {
                                                $this->_lGrade = "A+";
                                                $this->_gpaPoint = 4.33;
                                            }else{ 
                                            $this->_lGrade = "A"; 
                                            $this->_gpaPoint = 4;}
                                        }else{  
                                        $this->_lGrade = "A-"; 
                                        $this->_gpaPoint = 3.67;}
                                    }else{ 
                                    $this->_lGrade = "B+"; 
                                    $this->_gpaPoint = 3.33;}
                                }else{
                                $this->_lGrade = "B"; 
                                $this->_gpaPoint = 3;}
                            }else{ 
                            $this->_lGrade = "B-"; 
                            $this->_gpaPoint = 2.67;}
                        }else{ 
                        $this->_lGrade = "C+"; 
                        $this->_gpaPoint = 2.33;}
                    }else{
                    $this->_lGrade = "C";
                    $this->_gpaPoint = 2;}
                }else{ 
                $this->_lGrade = "C-";
                $this->_gpaPoint = 1.67;}
            } else{ 
            $this->_lGrade = "P";
            $this->_gpaPoint = 1;}

        } else { 
        $this->_lGrade = "F";
        $this->_gpaPoint = 0;}
    }

    //Setters



    public function getCourseArray() {
        $courseArr = array();
        $courseArr[] = $this->_sName;
        $courseArr[] = $this->_fName;
        $courseArr[] = $this->_percent;
        $courseArr[] = $this->_cHours;
        $courseArr[] = $this->_lGrade;
        $courseArr[] = $this->_gpaPoint;
        return $courseArr;
    }

}

?>

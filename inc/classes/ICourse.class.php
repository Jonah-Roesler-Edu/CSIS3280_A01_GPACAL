<?php
/*
Thi Hong Gam Tran
    300284929
Jonah Roesler
    300279311
assignment 1 GPA CALCULATOR

CSIS 3280-001
Rahim Virani
*/
interface ICourse {
    
    public function getFullName() : string;

    public function getShortName() : string;

    public function getPercentile() : float;

    public function getLetterGrade() : string;

    public function getCreditHours() : int;

    public function setFullName(string $fullName);

    public function setPercentile(string $percentile);

    public function setShortName(string $shortName);    
    
    public function setCreditHours(int $creditHours);


}
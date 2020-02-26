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
interface ICourseService {

    static function sortCourses();

    static function insertCourse(Course $newCourse) : bool;
    
    static function getCourse(string $shortName) : Course;

    static function getCourses(): array;

    static function deleteCourse(string $shortName) : bool;

    static function updateCourse(Course $updatedCourse) : bool;

    static function writeTranscript() : bool;

    static function parse($contents);

}
    
?>
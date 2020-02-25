<?php
/*
Thi Hong Gam Tran
Jonah Roesler
assignment 1 GPA CALCULATOR

CSIS 3280-001
Rahim Virani
*/


//Reqiure config file
require_once('inc\config.inc.php');

//Require interfaces
require_once("inc\classes\ICourse.class.php");
require_once("inc\classes\ICourseService.class.php");
require_once("inc\classes\IFileService.class.php");

//Require classes
require_once("inc\classes\Course.class.php");

//Require static classes
require_once("inc\classes\CourseService.class.php");
require_once("inc\classes\FileService.class.php");
require_once("inc\classes\Page.class.php");

//Initialize courseService by reading file
CourseService::parseCourseFile( FileService::read() );

//If there was a post to create then create
if(isset($_POST) && !empty($_POST)) {
        // var_dump($_POST);
        if(isset($_POST["flag"]) && $_POST["flag"] == "create") {
                //Assemble the new course
                $course = new Course();
                $course->setCourseInfo(
                        $_POST["crSN"],
                        $_POST["crFN"],
                        $_POST["crPerc"],
                        $_POST["crCredit"]
                );
                // var_dump($course);
                //Add the new course
                courseService::addCourse($course);
        }
        //If then edit.
        else if(isset($_POST["flag"]) && $_POST["flag"] == "edit") {
                //Assemble the new course
                $course = new Course();
                $course->setCourseInfo(
                        $_POST["edSN"],
                        $_POST["edFN"],
                        $_POST["edPerc"],
                        $_POST["edCredit"]
                );
                //Update the course
                courseService::updateCourse($course);
        }
}     

//If the get action was delete then delete
if( isset($_GET["submit"]) && !empty($_GET["submit"]) ) {
        if ($_GET["submit"] == "delete") {
                courseService::deleteCourse($_GET["cName"]);
        }
}




//New page ....
Page::setTitle("GPA Calculator - Thi Hong Gam Tran 29, Jonah Roesler");
Page::htmlHead();

//List Courses
Page::listCourses(courseService::getCourses());

//If someone wanted to edit a course then show the edit form otherwise show the create form
if( isset($_GET["submit"]) && !empty($_GET["submit"] && $_GET["submit"] == "edit") ) {
        $getCourse = CourseService::getCourse($_GET["cName"]);
        Page::editCourse($getCourse);
}
else {
        Page::createCourse();  
}

//Show GPA
Page::showGPA(courseService::getCourses());


//Show the footer
Page::htmlFoot();

?>


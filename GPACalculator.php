<?php
/*

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
require_once("inc\classes\page.class.php");

//If there was a post to create then create
if(isset($_POST) && !empty($_POST)) {
        if(isset($_POST["flag"]) && $_POST["flag"] == "create") {
                //Assemble the new course
                $course = courseService::createCourse();
                //Add the new course
                courseService::addCourse($course);

        }
        //If then edit.
        else if(isset($_POST["flag"]) && $_POST["flag"] == "edit") {
                //Assemble the new course
                $course = courseService::createCourse();
                //Update the course
                updateCourse($updCourse);
        }
}     

//If the get action was delete then delete
if( isset($_GET["submit"]) && !empty($_GET["submit"]) ) {
        if ($_GET["submit"] == "delete") {
                courseService::deteleCourse($_GET["cName"]);
        }
}

//If there was a get to delete then delete

//New page ....
Page::setTitle("GPA Calculator - Thi Hong Gam Tran 29, Jonah Roesler");
Page::htmlHead();

//List Courses
Page::listCourses( CourseService::getCourses());

//Show GPA

//If someone wanted to edit a course then show the edit form otherwise show the create form
if( isset($_GET["submit"]) && !empty($_GET["submit"] && $_GET["submit"] == "edit") ) {
        $getCourse = CourseService::getCourse($_GET["cName"]);
        Page::editForm($getCourse);
}
else {
        Page::createForm();  
}

//Show the footer
Page::htmlFoot();

?>






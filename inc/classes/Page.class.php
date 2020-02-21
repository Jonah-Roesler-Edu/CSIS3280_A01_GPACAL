<?php

class Page  {

    //Title
    static public $_title;

    // <?php }

    static function setTitle($title) {
        self::$_title = $title;
    }

    function listCourses(Array $courses)    {
    ?>
    <table>
        <thead>
            <th>Short Name</th>
            <th>Long Name</th>
            <th>Percentage</th>
            <th>Credit Hours</th>
            <th>Letter Grade</th>
            <th>GPA Points</th>
            <th>Edit</th>
            <th>Delete</th>
        </thead>
        <tbody>      
        <tr>
    <?php
    foreach($courses as $course) {
        echo "<tr>";
        for($x = 0; $x<count($course); $x++) {
            echo "<td>";
            echo $course[$x];
            echo "</td>";
        }
        echo "</tr>";
    ?>
    <form method="GET" action="" enctype="multipart/form-data">
        <input type = "hidden" 
            name = "cName" 
            value="<?php $course->getShortName() ?>">
        <td><input type="submit" name="submit" value="edit"></td>
        <td><input type="submit" name="submit" value="delete"></td>
    </form>
    <?php
    }
    ?>
    </tbody>
    </table>
    <?php 
    }

    function createCourse() { ?>
        <h2>Create Course</h2>
        <form method="POST" action="" enctype="multipart/form-data">
            <input type="hidden" name="flag" value="create">
            <input type="text" name="crSN">
            <input type="text" name="crFN">
            <input type="text" name="crPerc">
            <input type="number" name="crCredit">
        </form>
    <?php }

    function editCourse(Course $course) { ?>
        <h2>Edit Course</h2>
        <form method="POST" action="" enctype="multipart/form-data">
            <input type="hidden" name="flag" value="edit">
            <input type="text" name="edSN">
            <input type="text" name="edFN">
            <input type="text" name="edPerc">
            <input type="number" name="edCredit">
        </form>
    <?php }

    function showGPA(Array $courses)  {
    }

    function htmlHead() {
    ?>
        <!DOCTYPE html>
        <html>
            <head>
                <title><?php echo self::$_title ?></title>
            </head>
            <body>
                <h1><?php echo self::$_title ?></h1>
    <?php
    }

    function htmlFoot() {
    ?>
            </body>
    </html>
    <?php
    }


      
}

?>
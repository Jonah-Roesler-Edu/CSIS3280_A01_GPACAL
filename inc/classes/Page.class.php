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


class Page  {

    //Title
    static public $_title;

    // <?php }

    //Set title
    static function setTitle($title) {
        self::$_title = $title;
    }

    //Take course array
    //List all courses > Sort courses
    //Color courses by PERCENT
    static function listCourses(Array $courses)    {
    
    //Course headers
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

    //Sort courses
    usort($courses, array('courseService', 'courseSort'));

    foreach($courses as $course) {
        // var_dump($course);
        $courseArray = $course->getCourseArray();
        $pecentage = $courseArray[2];
        echo "<tr>";
        for($x=0; $x<count($courseArray);$x++)
        {
            if($pecentage<65)
            {
                echo "<td BGCOLOR='#FF6347'>".$courseArray[$x]."</td>";
            }
            else if($pecentage>=65 && $pecentage <= 73)
            {
                echo "<td BGCOLOR='#FFFF00'>".$courseArray[$x]."</td>";
            }
            //GREEN
            else if($pecentage>=74)
            {
                echo "<td BGCOLOR='#66CDAA'>".$courseArray[$x]."</td>";
            }
        
        }
       
            
      //EDIT and DELETE buttons for each  
    ?>
    <form method="GET" action="" enctype="multipart/form-data">
        <input type = "hidden" 
            name = "cName" 
            value="<?php echo $course->getShortName() ?>">
        <td><input type="submit" name="submit" value="edit"></td>
        <td><input type="submit" name="submit" value="delete"></td>
    </form>
    <?php
        echo "</tr>";
    }
    ?>
    </tbody>
    </table>
    
    <?php 
    }
    

    //CREATE COURSE FORM
    static function createCourse() { ?>
        <h2>Create Course</h2>
        <table>
        <form method="POST" action="" enctype="multipart/form-data">
        <input type="hidden" name="flag" value="create">
        <tr>
            <td>Short Name </td>
            <td>
            <input type="text" name="crSN">
            </td>
        </tr>
        <tr>
            <td>Full Name</td>
            <td>
            <input type="text" name="crFN">
            </td>
        </tr>
        <tr>
            <td>Percentile</td>
            <td> <input type="text" name="crPerc"></td>
        </tr>
        <tr>
            <td>Credit Hours</td>
            <td><input type="number" name="crCredit"></td>
        </tr>
        <tr>
            <td>
            <input type="submit" value="Add">
            </td> 
        </tr>
        </form>
        </table>

       
    <?php }

    //EDIT COURSE FORM
    static function editCourse(Course $course) { ?>
        <h2>Edit Course</h2>
        <table>
        <form method="POST" action="GPACalculator.php" enctype="multipart/form-data">
        <input type="hidden" name="flag" value="edit">
        <tr>
            <td>Short Name</td>  
            <td><input type="text" name="edSN" value = 
                "<?php echo $course->getShortName() ?>"></td>
        </tr>
        <tr>
            <td>Full Name</td>
            <td><input type="text" name="edFN" value = 
                "<?php echo $course->getFullName() ?>"></td>  
        </tr>
        <tr>
            <td>Percent Grade</td>
            <td><input type="text" name="edPerc" value = 
                "<?php echo $course->getPercentile() ?>"></td>
        </tr>
        <tr>
            <td>Credit Hours</td>
            <td><input type="text" name="edCredit" value = 
                "<?php echo $course->getCreditHours() ?>"></td>
        </tr>
        <tr>
            <td><input type="submit" ></td>  
        </tr>
        </table>
        
    <?php }

    //CALCULATE GPA DISPLAY
    static function showGPA(Array $courses)  {
        $gpaTotal = 0;
        
        foreach($courses as $course) {
            // var_dump($course);
            $courseArray = $course->getCourseArray();
            $gpaTotal += $courseArray[5]; 
            
        }
        $averageGPA = $gpaTotal/count($courses);
        ?>
        <h2> <?php echo("The GPA for the courses list is: ".number_format($averageGPA,2,'.',',')); ?></h2>
        <?php
    
    }

    static function htmlHead() {
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

    static function htmlFoot() {
    ?>
            </body>
    </html>
    <?php
    }


      
}

?>

<?php

class Page  {

    //Title
    static public $_title;

    // <?php }

    static function setTitle($title) {
        self::$_title = $title;
    }

    static function listCourses(Array $courses)    {
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
        // var_dump($course);
        $courseArray = $course->getCourseArray();
        $pecentage = $courseArray[2];
        echo "<tr>";
        for($x=0; $x<count($courseArray);$x++)
        {
            if($pecentage<50)
            {
                echo "<td BGCOLOR='#FF6347'>".$courseArray[$x]."</td>";
            }
            if($pecentage>=50 && $pecentage<60)
            {
                echo "<td BGCOLOR='#FF6347'>".$courseArray[$x]."</td>";
            }
            else if($pecentage>=60 && $pecentage<70)
            {
                echo "<td BGCOLOR='#FFA500'>".$courseArray[$x]."</td>";
            }
            else if($pecentage>=70 && $pecentage<80)
            {
                echo "<td BGCOLOR='#FFFF00'>".$courseArray[$x]."</td>";
            }
            else 
            {
                echo "<td BGCOLOR='#66CDAA'>".$courseArray[$x]."</td>";
            }
        
        }
       
            
        
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

<?php


class courseService {

    static private $_courses = array();


//Add the service back
    //Store the courses in an array
    static function addCourse($course) {
        self::$_courses[] = $course;
        self::writeContent(self::$_courses);
    }

    //This function creates a single course
    // static function POSTCourse($POSTARR) {

    //     $course = new Course();
    //     $course->setCourseInfo(
    //         $POSTARR["crSN"],
    //         $POSTARR["crFN"],
    //         $POSTARR["crPerc"],
    //         $POSTARR["crCredit"]);
    //     return $course;
    // }   


    //This function reads a single course given the title.
    static function getCourse(string $shortName) : Course
    {
        try {
            //flag for finding course
            $coursefound = null;
            foreach(self::$_courses as $course) {
                if($course->getShortName() == $shortName) {
                    $coursefound = $course;
                }
            }
            //If you didnt get a proper course back.
            if($coursefound == null) {
                //Exception Mesage the user
                throw new Exception("Course not found");
            }
        }
        catch(Exception $e)
        {
            //Exception to the log file.
           echo error_log("Cannot pull course");
        }
        return $coursefound;
    }

    //This function deletes coursesthe givren course
    static function deleteCourse(string $shortName) 
    {
        //read all the courses in
        for($i=0;$i<count(self::$_courses);$i++)
        {

            if($shortName == self::$_courses[$i]->getShortName())
            {
                //Pull the current course out of the array
                array_splice(self::$_courses,$i,1);
            }
        }
        //Not necessary >> already spliced from $courses
        //New Array for the courses
        // $newArrayCourses = array();
        // foreach(self::$courses as $course)
        // {
        //      //Add it to the arrays
        //     $newArrayCourses[] = $course;
        // }
        
        //OVerwrite the new courses.
        //Write the file

        // file_put_contents("data/transcriptCopy.csv",print_r($newArrayCourses,true));

        self::writeContent(self::$_courses);
    } 


    //This function updates and course in the file.
    static function updateCourse(Course $updateCourse){

        //Find the matching course
        // foreach(self::$_courses as $course) {
        //     if(trim($course->getShortName() ) == trim($updateCourse->getShortName() ) ) {
        //         //replace matching course with updated course
        //         $course = $updateCourse;
        //         $course->setFullName("I WORK HERE");
        //     }
        // }

        for($x = 0; $x < count(self::$_courses); $x++) {
            if( trim(self::$_courses[$x]->getShortName() ) == 
                trim($updateCourse->getShortName() ) ) {
                //replace matching course with updated course
                self::$_courses[$x] = $updateCourse;
            }
        }

        //Write the file
         self::writeContent(self::$_courses);
        
    }

    //This function writes the contents of self::$course to disk
    static function writeContent($courses) {

        //Set the header
        $csvLine = "coursecode,fullname,percentile,credithours\n";
        //Iterate through the courses

        //Assemble the CSV string
        foreach($courses as $course) {
            // $courseLine = $course->getCourseArray();
            // for($y = 0; $y<count($courseLine); $y++) {
            //     if($y == (count($courseLine)-1) ) {
            //         $csvLine .= $courseLine[$y];
            //     }
            //     else {
            //         $csvLine .= ($courseLine[$y] . ",");
            //     }
            // }
            //Should ONLY write the 4 values from headers into data
            //>>>>>coursecode || fullname || percentile || credithours <<<<<
            $csvLine .= $course->getShortName() . ",";
            $csvLine .= $course->getFullName() . ",";
            $csvLine .= $course->getPercentile() . ",";
            $csvLine .= $course->getCreditHours();
            $csvLine .= "\n";
        }
       
        //Write the CSV String
        FileService::write($csvLine);
     
        //Exception Mesage the user

        //Exception to the log file.
    }


    //This function will parse out the CSV contents to the self::$_courses 
    static function parseCourseFile(string $fileContents) {
    
        //Initialize the courses again
        self::$_courses = array();
        
        //Explode by the new line character.
        $lines = explode("\n",$fileContents);
        
        //Iterate through the new lines
        for($i = 1; $i<count($lines);$i++)
        {
            try {
                //Cut up the lines by comma
                $columns = explode(",",$lines[$i]);
                //Make sure the course has the appropriate number
                if(count($columns) == 4)
                {
                    for($j=0; $j<count($columns);$j++)
                    {
                        trim($columns[$j]);
                    }
                    //Build an course
                    $newCourse = new Course();
                    //Populate the attributes
                    $newCourse->setShortName($columns[0]);
                    $newCourse->setFullName($columns[1]);
                    $newCourse->setPercentile($columns[2]);
                    $newCourse->setCreditHours((int) $columns[3]);

                    $newCourse->calcScores();
        
                    //Push the course to the collection
                    self::$_courses[] = $newCourse;
                }
                else {
                    //Throw an exception with the appropriate message
                    throw new Exception("Problem in parsing file.");
                }
                }
                catch (Exception $ex)
                {
                    echo $ex->getMessage();
                }
        }
        //This function returns a list of courses, course objects in an array.
    }
    static function getCourses() {
        return self::$_courses;
    }
 
}

?>

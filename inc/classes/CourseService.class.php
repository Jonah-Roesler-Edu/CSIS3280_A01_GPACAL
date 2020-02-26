<?php
/*
Thi Hong Gam Tran
Jonah Roesler
assignment 1 GPA CALCULATOR

CSIS 3280-001
Rahim Virani
*/

class courseService {

    static private $_courses = array();


//Add the service back
    //Store the courses in an array
    static function addCourse($course) {
        self::$_courses[] = $course;
        self::writeContent(self::$_courses);
    }

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
    
        //OVerwrite the new courses.
        //Write the file

        self::writeContent(self::$_courses);
    } 


    //This function updates and course in the file.
    static function updateCourse(Course $updateCourse){

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
            
            //Should ONLY write the 4 values from headers into data
            //>>>>>coursecode || fullname || percentile || credithours <<<<
            $csvLine .= $course->getShortName() . ",";
            $csvLine .= $course->getFullName() . ",";
            $csvLine .= $course->getPercentile() . ",";
            $csvLine .= $course->getCreditHours();
            $csvLine .= "\n";
        }
    
        //Write the CSV String
        FileService::write($csvLine);

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
                } else {
                    throw new Exception('Incorrect number of COLs at line: ' . ($i-1));
                }
                
                }
                catch (Exception $ex)
                {
                    echo error_log(($ex->getMessage() ), 3, ERRORLOG);
                }
        }
        //This function returns a list of courses, course objects in an array.
    }
    static function getCourses() {
        return self::$_courses;
    }

    //sorts an array of courses
    static function courseSort($aCourse, $bCourse) {
        if($aCourse->getPercentile() > $bCourse->getPercentile() ) {
            return -1;
        }else if ($aCourse->getPercentile() < $bCourse->getPercentile() ) {
            return (1);
        }else {
            return 0;
        }
    }
    
    
   
 
}

?>

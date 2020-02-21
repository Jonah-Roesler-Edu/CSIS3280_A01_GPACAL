<?php


class courseService {

    static private $_courses = array();


//Add the service back
    //Store the courses in an array
    function addCourse($course) {
        $_courses[] = $course;
    }

    //This function creates a single course
    // function createCourse() {
    //     $course = new Course(
    //         $_POST["crSN"],
    //         $_POST["crFN"],
    //         $_POST["crPerc"],
    //         $_POST["crCredit"]);
    //     return $course;
    // }   


    //This function reads a single course given the title.
    static function getCourse(string $shortName) : Course
    {
        try {
            //flag for finding course
            $coursefound = null;
            foreach($_courses as $course) {
                if($course[0] == $shortName) {
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
        for($i=0;$i<count(self::$courses);$i++)
        {
            // $shortName = $_POST["cShortName"];
            if($shortName == self::$courses[$i][0])
            {
                //Pull the current course out of the array
                array_splice($courses,$i,1);
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

        self::writeContent($courses);
    } 


    //This function updates and course in the file.
    function updateCourse(Course $updateCourse){

        //Find the matching course
        foreach(self::$_courses as $course) {
            if($course[0] == $updateCourse[0]) {
                //replace matching course with updated course
                $course = $updateCourse;
            }
        }

        //Write the file
         self::writeContent($updArray);
        
    }

    //This function writes the contents of self::$course to disk
    static function writeContent($courseArr) {
        
        //Set the header
        $csvLine = "coursecode,fullname,percentile,credithours\n";
        //Iterate through the courses

        //Assemble the CSV string
        foreach($courseArr as $courseLine) {
            for($y = 0; $y<count($courseLine); $y++) {
                if($y == (count($courseLine)-1) ) {
                    $csvLine .= $courseLine[$y];
                }
                else {
                    $csvLine .= ($courseLine[$y] . ",");
                }
            }
            $csvLine .= "\n";
        }
       
        //Write the CSV String
        FileService::write($csvLine);
     
        //Exception Mesage the user

        //Exception to the log file.
    }


    //This function will parse out the CSV contents
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
                $columns = explode(",",$lines);
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
                    $newCourse->setPercentage($columns[2]);
                    $newCourse->setCreditHours($columns[3]);
        
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
        function getCourses() {
            return self::$_courses;
        } 
    }
}
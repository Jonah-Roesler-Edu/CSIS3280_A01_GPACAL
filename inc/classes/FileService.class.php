<?php
/*
Thi Hong Gam Tran
Jonah Roesler
assignment 1 GPA CALCULATOR

CSIS 3280-001
Rahim Virani
*/

class FileService implements IFileService {

    static function read() {
        // clear the file cache
        clearstatcache();
        try {
            //try to read the file 
            $fileHandle = fopen(DATA_FILE, 'r');
            if(!$fileHandle)
            {
                throw new Exception("You were not able to open the file");
            }
            else {
                $fileContents = fread($fileHandle,filesize(DATA_FILE)); 
            }
            //check if the contents are empty. if they are then throw an exception
            if(empty($fileContents))
            {
                throw new Exception("We were not able to read file content");
            }
        }
        //catch the exception
        catch(Exception $ex)
        {
            echo error_log(("File Read error " . $ex->getMessage()), 3, ERRORLOG);
        }
        //close the file Handle
        fclose($fileHandle);

        // return the file contents
        return $fileContents;
    }
    
    static function write($fileContents)
    {
        try {
            //open the file handle with the write mode
            $fileHandle = fopen(DATA_FILE,'w');
            //check if the contents are empty, if they are empty, throw exception
            if(!$fileHandle) {
                throw new Exception("Cannot open the file to write");
            }
            fwrite($fileHandle, $fileContents);

        }
        catch(Exception $ex)
        {
            //Write to the error log
            echo error_log(("You cannot write the file " . $ex->getMessage()), 3, ERRORLOG);
        }
        fclose($fileHandle);                
    }
}
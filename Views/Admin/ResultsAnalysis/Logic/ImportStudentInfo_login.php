<?php 

require_once('../../../Model/PDO.php');
require_once('../../../Controller/validate_user_input.php');
require_once('../../PHPExcel/Classes/PHPExcel.php');
$errors=array();
$success=array(); 


function add_student($DBConnect,$StudentComputerID,$Fullname,$Gander,$YearOfStudy,$errors,$success)
{
    $Fullname=test_input($Fullname);
    global $errors;
    global $success;

    $DBConnect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //if($TotalQuiz >=100 || $TotalQuiz <=0){ array_push($errors,"$TotalQuiz is invalid mark value . Range 0 t0 100  $StudentComputerID <br>"); }
    // if($YearOfStudy){ array_push($errors,"$TotalLabs is invalid mark value . Range 0 t0 100  $StudentComputerID<br>"); }

    if(empty($StudentComputerID) || strlen($StudentComputerID ) !=8 || strlen($StudentComputerID ) !=10 || empty($Gander) || strlen($Gander)!=1 || empty($YearOfStudy) ){

        if(empty($StudentComputerID)){   array_push($errors,"studentComputerID is require<br>"); }
        if(strlen($StudentComputerID ) !=8 || strlen($StudentComputerID ) !=10){   array_push($errors,"studentComputerID $StudentComputerID is Invalid <br>"); }
        if(empty($Gander)){ array_push($errors,"Gender value is require for student with ID $StudentComputerID <br>"); }
        if(strlen($Gander)!=1){ array_push($errors,"Gender value is Incorrent for ID $StudentComputerID  use M for male F for Female <br>"); }
        if(empty($YearOfStudy)){ array_push($errors,"Year Of Study is require for student with ID $StudentComputerID <br>"); }

    }else if(!empty($StudentComputerID) && (strlen($StudentComputerID ) ==8 || strlen($StudentComputerID ) ==10) && !empty($Gander) && strlen($Gander)==1 && !empty($YearOfStudy) ){

        try{

            // if($stmt->rowCount()==0 && empty($row)){
            $stmt = $DBConnect->prepare("INSERT INTO `student`(`StudentComputerID`, `FullNames`, `Gander`, `YearOfStudy`, `StudentStatus`) VALUES ($StudentComputerID,'".$Fullname."','".strtoupper($Gander)."','".$YearOfStudy."','1')");
            if($stmt->execute()){ 
                array_push($success,$StudentComputerID." Successful Added  - <br/>"); }
            else{
                array_push($errors, "failed to add record!"); }
            // }

        }catch(PDOException $e ){
            array_push($errors, $e->getMessage()." ");
            array_push($errors, "Database error, please try again later <br>");
        }
    }
    
}


if($_POST )
{

    if(isset($_POST["btn_import_StudentInfo"]) && isset($_FILES["file"]))
    {

        $filename=$_FILES["file"]['tmp_name'];
        $fileType=strtolower(end(explode('.',$_FILES["file"]['name'])));
        $allowedUpload=array('xlsx','xls');

        if(in_array($fileType,$allowedUpload)){


                $excelArray = array();
                $sql;

                try{
                    $importfiletype = PHPExcel_IOFactory::identify($filename);
                    $objectReader = PHPExcel_IOFactory::createReader($importfiletype);
                    $objectPHPExcel = $objectReader->load($filename);

                }catch(Exception $e)
                {
                    array_push($errors, $e->getMessage()."<br/>");
                    die;
                }

                $sheet = $objectPHPExcel -> getSheet(0);
                $heightestRow = $sheet-> getHighestRow();
                $heightestColumn = $sheet-> getHighestColumn();

                try{

                        $DBConnect->beginTransaction();

                        for($row =2;$row <= $heightestRow; $row++ )
                        {

                          $rowData = $sheet -> rangeToArray('A'.$row.':'.$heightestColumn.$row,NULL,TRUE,FALSE);

                          add_Student($DBConnect,$rowData[0][0],$rowData[0][1],$rowData[0][2],$rowData[0][3],$errors,$success);

                        } 
                        $DBConnect->commit();
                }
                catch(Exception $e)
                {
                    array_push($errors, $e->getMessage()."<br/>");
                    $DBConnect->rollBack();
                }
          }else{
              array_push($errors,"Only Excel Format allowed (Xlsx)<br/>");
          }

      }else {
            array_push($errors,"All fields required<br/>");

        }

}

?>
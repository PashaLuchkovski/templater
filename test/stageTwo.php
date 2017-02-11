<?php


ignore_user_abort(false);

$newDir = "docs".$_POST['generationDateStamp'];

require_once 'vendor/autoload.php';
include 'php/stageTwoPaths.php';
  //------------------------------------------------------------------------------------------------------------------------------------------------------------
include 'php/createTreeStructure.php';
createOutputDir($newDir);
  //------------------------------------------------------------------------------------------------------------------------------------------------------------
include 'php/dirForConverter.php';

function interimFileName($str) {
  return $str.".txt";
}

function fillAndSaveTemplate($str, $newDir) {
  $templateProcessor = new \PhpOffice\PhpWord\TemplateProcessor(mb_convert_encoding($str, 'cp1251'));
  //------------------------------------------------------------------------------------------------------------------------------------------------------------
  $templateProcessor->setValue('Name', 'John Doe');
  //------------------------------------------------------------------------------------------------------------------------------------------------------------
  $newPath = $newDir . getTemplateDocNameWithForwardingSlash($str);

  $newPath = mb_convert_encoding($newPath, 'cp1251');
  
  $templateProcessor->saveAs($newPath);
}

for ($x = 0; $x < count($obj[$_POST['stageTwoScenario']]); $x++) {

  fillAndSaveTemplate($obj[$_POST['stageTwoScenario']][$x], $newDir); 

  //------------------------------------------------------------------------------------------------------------------------------------------------------------

  toPdfConversion(getTemplateDocNameWithForwardingSlash($obj[$_POST['stageTwoScenario']][$x]), $newDir);
}



$rarCmd = '"C:\Program Files\WinRAR\Rar.exe" a -ep1 -r -m5 -df "'.getcwd().'\\'.$newDir.'.rar" "'.getcwd().'\\'.$newDir.'\\*.pdf"';
echo exec($rarCmd);

$rarCmd = '"C:\Program Files\WinRAR\Rar.exe" a -ep1 -r -m5 -df "'.getcwd().'\buf.rar" "'.getcwd().'\\'.$newDir.'\\*"';
echo exec($rarCmd);
unlink('buf.rar');

rmdir($newDir);


//$result = json_decode($_POST['requestData'], true);
//echo $_POST['requestData'];

//file_put_contents(interimFileName($_POST['generationDateStamp']), $_POST['requestData']);
/*function EH($e) {echo $e->getMessage();}
//set_error_handler(EH);
set_exception_handler(EH);
if (!file_get_contents(interimFileName($_POST['generationDateStamp'])))
  throw new Exception("No such file");
else 
  echo var_dump(json_decode(file_get_contents(interimFileName($_POST['generationDateStamp'])), true));*/



?>
<p>asddddddddddd</p>

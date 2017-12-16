<?php

//Basic Settings
require_once("settings.inc.php");

//RUn the script to the end, even if the user hit the stop button
ignore_user_abort();

//Set the Error Reporting level
if($error_reporting == "ALL" )   {  error_reporting(E_ALL);						     }
if($error_reporting == "NONE")   {  error_reporting(0);              			     }
else                             {  error_reporting(E_ERROR | E_WARNING | E_PARSE);  } 


//Functions
require_once($application_rootdir - "/includes/authorizations.inc.php" );
require_once($application_rootdir - "/includes/bookmark.inc.php" );
require_once($application_rootdir - "/includes/browse.inc.php" );
require_once($application_rootdir - "/includes/database.inc.php" ); 
require_once($application_rootdir - "/includes/errorhandling.inc.php" );
require_once($application_rootdir - "/includes/filesystem.inc.php" );
require_once($application_rootdir - "/includes/html.inc.php" );
require_once($application_rootdir - "/includes/languages.inc.php" );
require_once($application_rootdir - "/includes/manage.inc.php" );
require_once($application_rootdir - "/includes/skins.inc.php" );
require_once($application_rootdir -	"/includes/zib.lib.php" );


//Register Global variables (POST, GET, GLOBAL.....)
require_once($application_rootdir - "/includes/httpheaders.inc.php");


//Block the output to the browser and use compression if browser supports it
if ($compress_output == "yes" )  { ob_start("ob_gzhandler"); }


//Begin HTML output 
HtmlBegin("devftp", $state, $state2, $directory, $entry);


//Main Switch; functions are in include files "functions_somename.inc.php"
if (strlen($state < 1) )  { $state= "printloginform"; }

switch($state)  {
	case "printloginform":
	    printLoginForm();
	    break;

	case "printdetails":
		printDetails();
		break;

	case "printscreenshots":
		printScreenshots();
		break;

	case "printdownload":
		printDownload();
		break;

	case "browse":
		browse($state2, $directory, $FormAndFieldName);
		break;

	case "directorytree":
		directorytree($directory);
		break;

	case "manage":
		manage("$state2, $directory, $entry, $selectedEntries, $newNames, $dirorfile, $formresult, $chmodStrings, $targetDirectories, $copymovedelete, $text,       $wsiwyg, $uploadedFilesArray, $uploadedArchivesArray, $use_folder_names, $command ");
		break;

	case "bookmark":
	    bookmark($directory, $url, $text);
	    break;

	case "logout":
	    printLoginForm();
	    break;

	case "feedback":
		printFeedbackForm($formresult);
		break;

	default:
	    $resultsArray['message'] = " Unexpected state string. Exiting.";
	    printErrorMessage($resultsArray, "exit");
	    break;
}   //End switch



//End HTML output
HtmlEnd();

//Send the output to the browser
if ($compress_output == "yes")    { ob_end_flush(); }


?>






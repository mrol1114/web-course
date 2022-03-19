<?php
require_once("./src/common.inc.php");

$request = new RequestSurveyLoader();
$print = new SurveyPrint();
$fileStorage = new SurveyFileStorage();

$survey = $request -> makeSurveyFromParametrs();
$print -> printSurvey($survey);
$fileStorage->saveSurvey($survey);
echo "<br>";
$data = $fileStorage->loadSurvey($survey);
$print -> printSurvey($data);
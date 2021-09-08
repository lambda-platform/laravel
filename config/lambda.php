<?php
$lambdaConfig = json_decode(file_get_contents(base_path().DIRECTORY_SEPARATOR."lambda.json"), true);
$lambdaConfig["app"] = "lambda";
return $lambdaConfig;


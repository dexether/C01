<?php

/* * *************************************************************************************
 * CONFIGURATION FILE
 * Note: Include all site-wide settings here.
 * ************************************************************************************* */
ini_set("max_execution_time", "0");
$SETTINGS_DIR  = "$_SERVER[DOCUMENT_ROOT]/_settings";
$httphost      = $_SERVER['HTTP_HOST'];
if (isset($_SERVER['HTTPS'])) {
    # code...
    $base = "https://".$httphost;
}else{
    $base = "http://".$httphost;
}
// var_dump($base);
$httphost      = strtolower($httphost);
$ipnya_host    = 'mlm';
$mysql['host'] = "localhost";
switch ($httphost) {
    case 'thecabinetsystems.dev':
        // $base = "";
        $mall          = true;
        $mysql['host'] = "10.10.0.103";
        // $mysql['host'] = "localhost";
        $mysql['user']      = "root";
        $mysql['password']  = "mugen1996";
        $mysql['database']  = "imperium_cabinet";
        $mysql['meta']      = "askap_source_mini";
        $mysql['crypt_key'] = "139";
        break;
    case 'cabinet.apexregent.dev':
        $mall          = false;
        $mysql['host'] = "10.10.0.103";
        // $mysql['host'] = "localhost";
        $mysql['user']      = "root";
        $mysql['password']  = "mugen1996";
        $mysql['database']  = "apex";
        $mysql['meta']      = "askap_source";
        $mysql['crypt_key'] = "139";
        break;
    // case 'cabinet.apexregent.dev:90':
        // $mall          = false;
        // $mysql['host'] = "10.10.0.103";
        // // $mysql['host'] = "localhost";
        // $mysql['user']      = "root";
        // $mysql['password']  = "mugen1996";
        // $mysql['database']  = "apex";
        // $mysql['meta']      = "askap_source";
        // $mysql['crypt_key'] = "139";
        // break;
	case 'cabinet.apexregent.dev:90':
        $mall          = false;
        // $mysql['host'] = "10.10.0.103";
        $mysql['host'] = "localhost";
        $mysql['user']      = "root";
        $mysql['password']  = "";
        $mysql['database']  = "apex";
        $mysql['meta']      = "askap_source";
        $mysql['crypt_key'] = "139";
        break;
    case 'agendafx.dev':
        $mysql['host'] = "127.0.0.1";
        $mall          = true;
        // $mysql['host'] = "localhost";
        $mysql['user']      = "root";
        $mysql['password']  = "";
        $mysql['database']  = "imperium_cabinet";
        $mysql['meta']      = "askap_source_mini";
        $mysql['crypt_key'] = "139";
        break;
	case 'agendaf.dev':
        $mysql['host'] = "127.0.0.1";
        $mall          = true;
        // $mysql['host'] = "localhost";
        $mysql['user']      = "root";
        $mysql['password']  = "mugen1996";
        $mysql['database']  = "imperium_cabinet";
        $mysql['meta']      = "askap_source_mini";
        $mysql['crypt_key'] = "139";
        break;
	case 'cabinet.koperasi-mppi.dev':
        $mysql['host'] = "10.10.0.122:1603";
        $mall          = false;
        // $mysql['host'] = "localhost";
        $mysql['user']      = "root";
        $mysql['password']  = "apexcabinet1603";
        $mysql['database']  = "koperasi_mppi_dev";
        $mysql['meta']      = "askap_source_mini";
        $mysql['crypt_key'] = "139";
        break;
	case 'agendafx.dev:90':
        // $mysql['host'] = "10.10.0.103";
        $mall          = true;
        $mysql['host'] = "localhost";
        $mysql['user']      = "root";
        $mysql['password']  = "";
        $mysql['database']  = "imperium_cabinet";
        $mysql['meta']      = "askap_source_mini";
        $mysql['crypt_key'] = "139";
        break;
    default:
        # code...
        break;
}

$mysql_quote['host']     = $mysql['host'];
$mysql_quote['user']     = $mysql['user'];
$mysql_quote['password'] = $mysql['password'];
$mysql_quote['database'] = $mysql['database'];

$mysql_profxecu['host']     = $mysql['host'];
$mysql_profxecu['user']     = $mysql['user'];
$mysql_profxecu['password'] = $mysql['password'];
$mysql_profxecu['database'] = $mysql['database'];

$mysql_reuter['host']     = $mysql['host'];
$mysql_reuter['user']     = $mysql['user'];
$mysql_reuter['password'] = $mysql['password'];
$mysql_reuter['database'] = $mysql['database'];

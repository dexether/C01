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
$mysql['host'] = "10.10.0.122:1603";
switch ($httphost) {
    case 'thecabinetsystems.dev':
        // $base = "";
        $mall          = true;
        $mysql['host'] = "10.10.0.122:1603";
        // $mysql['host'] = "localhost";
        $mysql['user']      = "root";
        $mysql['password']  = "mugen1996";
        $mysql['database']  = "imperium_cabinet";
        $mysql['meta']      = "askap_source_mini";
        $mysql['crypt_key'] = "139";
        break;
    case 'cabinet.apexregent.dev':
        $mall          = false;
        $mysql['host'] = "127.0.0.1";
        // $mysql['host'] = "localhost";
        $mysql['user']      = "root";
        $mysql['password']  = "";
        $mysql['database']  = "apex";
        $mysql['meta']      = "apex_source";
        $mysql['crypt_key'] = "139";
        break;
    case 'cabinet.apexregent.dev:90':
        $mall          = false;
        $mysql['host'] = "10.10.0.122:1603";
        // $mysql['host'] = "localhost";
        $mysql['user']      = "root";
        $mysql['password']  = "mugen1996";
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
	case 'cabinet.cfforex.com':
        $mysql['host'] = "localhost:3306";
        $mall          = false;
        // $mysql['host'] = "localhost";
        $mysql['user']      = "root";
        $mysql['password']  = "P@r4d0x";
        $mysql['database']  = "cabinet_cff";
        $mysql['meta']      = "cff_source";
        $mysql['crypt_key'] = "139";
        break;
	case 'cabinet-alex.lokal':
        $mysql['host'] = "localhost:3306";
        $mall          = false;
        // $mysql['host'] = "localhost";
        $mysql['user']      = "root";
        $mysql['password']  = "";
        $mysql['database']  = "cabinet_mahadana";
        $mysql['meta']      = "mahadana_source";
        $mysql['crypt_key'] = "139";
        break;
	case 'cabinet.mentarionline.com':
        $mysql['host'] = "localhost:3306";
        $mall          = false;
        // $mysql['host'] = "localhost";
        $mysql['user']      = "root";
        $mysql['password']  = "P@r4d0x";
        $mysql['database']  = "cabinet_mentari";
        $mysql['meta']      = "mentari_source";
        $mysql['crypt_key'] = "139";
        break;
	case 'cabinet.royalfx.co.id':
        $mysql['host'] = "localhost:3306";
        $mall          = false;
        // $mysql['host'] = "localhost";
        $mysql['user']      = "root";
        $mysql['password']  = "P@r4d0x";
        $mysql['database']  = "cabinet_royal";
        $mysql['meta']      = "royal_source";
        $mysql['crypt_key'] = "139";
        break;		
	case 'cabinet.mentari.dev':
        $mysql['host'] = "127.0.0.1";
        $mall          = false;
        // $mysql['host'] = "localhost";
        $mysql['user']      = "root";
        $mysql['password']  = "";
        $mysql['database']  = "mentari";
        $mysql['meta']      = "mentari_source";
        $mysql['crypt_key'] = "139";
        break;
	case 'cabinet.mahadana.dev':
        $mysql['host'] = "10.10.0.122:3999";
        $mall          = false;
        // $mysql['host'] = "localhost";
        $mysql['user']      = "mahadana";
        $mysql['password']  = "mahadana3999";
        $mysql['database']  = "mahadana";
        $mysql['meta']      = "mahadana_source";
        $mysql['crypt_key'] = "139";
        break;	
	case 'cabinet.royal.dev':
        $mysql['host'] = "127.0.0.1";
        $mall          = false;
        // $mysql['host'] = "localhost";
        $mysql['user']      = "root";
        $mysql['password']  = "";
        $mysql['database']  = "royal";
        $mysql['meta']      = "royal_source";
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

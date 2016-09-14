<?php

include("$_SERVER[DOCUMENT_ROOT]/_settings/config.php");
/**************************************************************************
 *
 * Title:         Config For Class 'connDB' (conf_db_pdo.inc.php)
 *
 * Version:       1.3
 *
 * Copyright:     (c) 2012 Volker Rubach - All rights reserved
 *
 * Description:   In this configuration file are the credentials for
 *                the database connection managed centrally.
 *
 *************************************************************************/


//-------------------------------------------------------------------------
// MySQL database details
//-------------------------------------------------------------------------

$this->dbHost = $mysql['host'];   // MySQL host name
$this->dbName = $mysql['database'];       // MySQL database name


//-------------------------------------------------------------------------
// MySQL account details
//-------------------------------------------------------------------------

$this->dbUser = $mysql['user'];      // MySQL username
$this->dbPass = $mysql['password'];   // MySQL password


?>
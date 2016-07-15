/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.1.36-community-log : Database - cabinet
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`cabinet` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `cabinet`;

/*Table structure for table `acc_acount_detail` */

DROP TABLE IF EXISTS `acc_acount_detail`;

CREATE TABLE `acc_acount_detail` (
  `NAMA` varchar(100) DEFAULT NULL,
  `GRUP` varchar(50) DEFAULT NULL,
  `IDSET` int(20) NOT NULL AUTO_INCREMENT,
  `CHILD` varchar(50) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`IDSET`)
) ENGINE=MyISAM AUTO_INCREMENT=617 DEFAULT CHARSET=latin1;

/*Data for the table `acc_acount_detail` */

insert  into `acc_acount_detail`(`NAMA`,`GRUP`,`IDSET`,`CHILD`,`status`) values ('SPV1','Parent',610,'18','Old'),('Albert','Parent',616,'42','Old'),('SPV1','Parent',611,'42','Old');

/*Table structure for table `acc_calculasi_detail` */

DROP TABLE IF EXISTS `acc_calculasi_detail`;

CREATE TABLE `acc_calculasi_detail` (
  `DATE` date DEFAULT NULL,
  `GROUPNAME` varchar(150) DEFAULT NULL,
  `AE` varchar(100) DEFAULT NULL,
  `NAME_AE` varchar(100) DEFAULT NULL,
  `Contertype` varchar(100) DEFAULT NULL,
  `Lot` int(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `acc_calculasi_detail` */

/*Table structure for table `acc_calculasi_header` */

DROP TABLE IF EXISTS `acc_calculasi_header`;

CREATE TABLE `acc_calculasi_header` (
  `DATE` date DEFAULT NULL,
  `GROUPNAME` varchar(150) DEFAULT NULL,
  `AE` varchar(100) DEFAULT NULL,
  `Contertype` varchar(100) DEFAULT NULL,
  `Lot` int(5) DEFAULT NULL,
  `TOTALACT` int(5) DEFAULT NULL,
  `COMM` decimal(15,0) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `acc_calculasi_header` */

/*Table structure for table `acc_com` */

DROP TABLE IF EXISTS `acc_com`;

CREATE TABLE `acc_com` (
  `ACTIVE` double DEFAULT NULL,
  `COUNTERID` varchar(30) DEFAULT NULL,
  `MAX` double DEFAULT NULL,
  `COMM` decimal(17,2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `acc_com` */

/*Table structure for table `acc_count` */

DROP TABLE IF EXISTS `acc_count`;

CREATE TABLE `acc_count` (
  `IDUSER` int(10) NOT NULL,
  `CODE` varchar(4) NOT NULL,
  `NAMA` varchar(50) NOT NULL,
  `DESCRIP` varchar(200) NOT NULL,
  `USERNAME` varchar(100) NOT NULL,
  `PASSWORD` varchar(32) NOT NULL,
  PRIMARY KEY (`IDUSER`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `acc_count` */

/*Table structure for table `acc_kota` */

DROP TABLE IF EXISTS `acc_kota`;

CREATE TABLE `acc_kota` (
  `login` int(11) NOT NULL,
  `kliringlogin` varchar(255) DEFAULT NULL,
  `rate` varchar(30) DEFAULT NULL,
  `mt4dt` char(15) NOT NULL,
  `branch` char(30) DEFAULT NULL,
  `group` char(15) DEFAULT NULL,
  `aecode` char(15) DEFAULT NULL,
  `comment` text,
  `regular` varchar(10) DEFAULT 'regular' COMMENT 'regular,mini account',
  PRIMARY KEY (`login`,`mt4dt`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `acc_kota` */


/*Table structure for table `acc_mod` */

DROP TABLE IF EXISTS `acc_mod`;

CREATE TABLE `acc_mod` (
  `IDM` int(5) NOT NULL AUTO_INCREMENT,
  `NAMA` varchar(50) NOT NULL,
  `KET` varchar(100) NOT NULL,
  PRIMARY KEY (`IDM`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `acc_mod` */

/*Table structure for table `acc_mod_acount` */

DROP TABLE IF EXISTS `acc_mod_acount`;

CREATE TABLE `acc_mod_acount` (
  `IDA` int(5) NOT NULL AUTO_INCREMENT,
  `IDM` int(10) NOT NULL,
  `NAMA` varchar(50) NOT NULL,
  `ACCNO` varchar(20) NOT NULL,
  PRIMARY KEY (`IDA`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `acc_mod_acount` */

/*Table structure for table `acc_mod_detail` */

DROP TABLE IF EXISTS `acc_mod_detail`;

CREATE TABLE `acc_mod_detail` (
  `IDM` int(10) NOT NULL,
  `CODE` varchar(5) NOT NULL,
  `DESCRIPTION` varchar(100) NOT NULL,
  `URUTAN` int(5) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`URUTAN`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `acc_mod_detail` */

/*Table structure for table `acc_procom` */

DROP TABLE IF EXISTS `acc_procom`;

CREATE TABLE `acc_procom` (
  `NO` int(10) NOT NULL AUTO_INCREMENT,
  `DATE` date DEFAULT NULL,
  `GROUPNAME` varchar(150) DEFAULT NULL,
  `BRANCHNAME` varchar(150) DEFAULT NULL,
  `AE` char(5) DEFAULT NULL,
  `NAME_AE` varchar(50) DEFAULT NULL,
  `AC` varchar(15) DEFAULT NULL,
  `SETTLE` int(15) DEFAULT NULL,
  `COMM` int(15) DEFAULT NULL,
  `RATE` int(5) DEFAULT NULL,
  `COUNTERID` varchar(50) DEFAULT NULL,
  `COMMISION_RP` decimal(15,4) DEFAULT NULL,
  `COMMISION_USD` decimal(15,2) DEFAULT NULL,
  `ALLOWANCE_RP` decimal(15,4) DEFAULT NULL,
  `ALLOWANCE_USD` decimal(15,2) DEFAULT NULL,
  `OVERIDING_RP` decimal(15,4) DEFAULT NULL,
  `OVERIDING_USD` decimal(15,2) DEFAULT NULL,
  `BOUNTY_RP` decimal(15,4) DEFAULT NULL,
  `ACC_MINUS_RP` decimal(15,4) DEFAULT NULL,
  `ACC_MINUS_USD` decimal(15,2) DEFAULT NULL,
  `INJECT_RP` decimal(15,4) DEFAULT NULL,
  `INJECT_USD` decimal(15,2) DEFAULT NULL,
  `AMOUNT_RP` decimal(15,4) DEFAULT NULL,
  `AMOUNT_USD` decimal(15,2) DEFAULT NULL,
  PRIMARY KEY (`NO`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `acc_procom` */

/*Table structure for table `acc_set_group` */

DROP TABLE IF EXISTS `acc_set_group`;

CREATE TABLE `acc_set_group` (
  `IDGROUP` int(10) NOT NULL,
  `NAMAGROUP` varchar(100) NOT NULL,
  `KET` varchar(200) NOT NULL,
  PRIMARY KEY (`IDGROUP`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `acc_set_group` */

/*Table structure for table `acc_temporari` */

DROP TABLE IF EXISTS `acc_temporari`;

CREATE TABLE `acc_temporari` (
  `IDSESSION` varchar(50) DEFAULT NULL,
  `IDM` int(10) DEFAULT NULL,
  `DESCRIPTION` varchar(100) DEFAULT NULL,
  `UMOD` int(5) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `acc_temporari` */

/*Table structure for table `accbal` */

DROP TABLE IF EXISTS `accbal`;

CREATE TABLE `accbal` (
  `rollover` varchar(8) DEFAULT NULL,
  `account` varchar(10) NOT NULL DEFAULT '',
  `hseacc` varchar(10) DEFAULT NULL,
  `inttable` varchar(10) DEFAULT NULL,
  `pb` double DEFAULT NULL,
  `marginin` double DEFAULT NULL,
  `marginout` double DEFAULT NULL,
  `pl` double DEFAULT NULL,
  `interest` double DEFAULT NULL,
  `commission` double DEFAULT NULL,
  `adjust` double DEFAULT NULL,
  `storage` double DEFAULT NULL,
  `tax` double DEFAULT NULL,
  `nb` double DEFAULT NULL,
  `fl` double DEFAULT NULL,
  `eq` double DEFAULT NULL,
  `rebate` double DEFAULT NULL,
  `settlement` double unsigned DEFAULT NULL,
  `marginreq` double DEFAULT NULL,
  `openunit` double unsigned DEFAULT NULL,
  `crlimit` double DEFAULT NULL,
  PRIMARY KEY (`account`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `accbal` */

/*Table structure for table `acct_settings` */

DROP TABLE IF EXISTS `acct_settings`;

CREATE TABLE `acct_settings` (
  `setting` varchar(30) NOT NULL DEFAULT '',
  `value` longtext NOT NULL,
  `desc` varchar(200) NOT NULL DEFAULT '',
  `level` varchar(10) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`setting`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `acct_settings` */

insert  into `acct_settings`(`setting`,`value`,`desc`,`level`) values ('application_type','No logic codes','Type of application developed on it','system'),('cherlynn_ver','1.00\r\n','Current Cherlynn Version','system'),('licenced_to','PT. Report_Live2','Licence information : Licence to which company','system'),('licenced_type','Online','Licence information : What kind of Licence (Onsite/Online) / Copies','system'),('maxusers','0','Maximum no of concurrent users allowed (0 = unlimited)','system'),('multi_login','1','Allow multiple login for the same account (0 = No, 1 = Yes)','system'),('sampleusersetting','sample','This is a sample setting and can be deleted','user'),('server_msg','(Account-create/close/edit new group,branch,aeCode,accounts))\r\n(Items Settings-create,assign counter\'s symbol,contract size,commision,interest rates.)(Orders-insert/cancel/view day\'s transaction)','Server Message','user'),('support_info','Please Call...','Where to look for support (if any)','system');

/*Table structure for table `aecode` */

DROP TABLE IF EXISTS `aecode`;

CREATE TABLE `aecode` (
  `aeid` varchar(10) NOT NULL DEFAULT '',
  `aegroup` varchar(10) DEFAULT NULL,
  `aebranch` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`aeid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `aecode` */

/*Table structure for table `announcement` */

DROP TABLE IF EXISTS `announcement`;

CREATE TABLE `announcement` (
  `announcementid` tinyint(4) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  PRIMARY KEY (`announcementid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `announcement` */

insert  into `announcement`(`announcementid`,`message`) values (1,'Welcome to Meta Export');

/*Table structure for table `apex_balance` */

DROP TABLE IF EXISTS `apex_balance`;

CREATE TABLE `apex_balance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `from` varchar(30) DEFAULT NULL,
  `amount` decimal(10,4) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `fromuser` varchar(100) DEFAULT NULL,
  `comment` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `apex_balance` */

/*Table structure for table `bafile` */

DROP TABLE IF EXISTS `bafile`;

CREATE TABLE `bafile` (
  `AccNo` varchar(30) NOT NULL DEFAULT '',
  `AeCode` text NOT NULL,
  `Group` text NOT NULL,
  `Branch` text NOT NULL,
  `AePin` text NOT NULL,
  `IntTable` text NOT NULL,
  `Name` text NOT NULL,
  `Address1` text NOT NULL,
  `Address2` text NOT NULL,
  `Address3` text NOT NULL,
  `PrevBal` decimal(20,3) NOT NULL DEFAULT '0.000',
  `MarginIN` decimal(20,3) NOT NULL DEFAULT '0.000',
  `MarginOUT` decimal(20,3) NOT NULL DEFAULT '0.000',
  `PL` decimal(20,3) NOT NULL DEFAULT '0.000',
  `Interest` decimal(20,3) NOT NULL DEFAULT '0.000',
  `IntCum` decimal(20,3) DEFAULT '0.000',
  `IntCumSettled` decimal(20,3) DEFAULT '0.000',
  `Commission` decimal(20,3) NOT NULL DEFAULT '0.000',
  `Adjust` decimal(20,3) NOT NULL DEFAULT '0.000',
  `Bonus` decimal(20,3) NOT NULL DEFAULT '0.000',
  `NewBal` decimal(20,3) NOT NULL DEFAULT '0.000',
  `CumNewBal` decimal(20,3) DEFAULT '0.000',
  `CumPrevBal` decimal(20,3) DEFAULT '0.000',
  `CumEquity` decimal(20,3) DEFAULT '0.000',
  `CumEffective` decimal(20,3) DEFAULT '0.000',
  `Floating` decimal(20,3) NOT NULL DEFAULT '0.000',
  `FLCOMM` decimal(20,3) DEFAULT '0.000',
  `Equity` decimal(20,3) NOT NULL DEFAULT '0.000',
  `Rebate` decimal(20,3) NOT NULL DEFAULT '0.000',
  `Storage` decimal(20,3) NOT NULL DEFAULT '0.000',
  `Settlement` decimal(20,3) NOT NULL DEFAULT '0.000',
  `MarginReq` decimal(20,3) NOT NULL DEFAULT '0.000',
  `MarginReqDay` decimal(20,3) NOT NULL DEFAULT '0.000',
  `MarginReqNight` decimal(20,3) NOT NULL DEFAULT '0.000',
  `OpenUnit` decimal(20,3) NOT NULL DEFAULT '0.000',
  `CrLimit` decimal(20,3) NOT NULL DEFAULT '0.000',
  `status` varchar(30) DEFAULT 'normal',
  `IntCumMeta` decimal(20,3) DEFAULT '0.000',
  `StoCumMeta` decimal(30,3) DEFAULT NULL,
  `StoCum` decimal(30,3) DEFAULT NULL,
  `StoCumSettled` decimal(30,3) DEFAULT NULL,
  PRIMARY KEY (`AccNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bafile` */

/*Table structure for table `bbj_account` */

DROP TABLE IF EXISTS `bbj_account`;

CREATE TABLE `bbj_account` (
  `bbj_account_id` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(50) DEFAULT NULL,
  `broker` varchar(50) DEFAULT NULL,
  `contract` varchar(50) DEFAULT NULL,
  `rate` varchar(50) DEFAULT NULL,
  `branch_cc` varchar(50) DEFAULT NULL,
  `branch_bbjc` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`bbj_account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bbj_account` */

/*Table structure for table `bbj_counter` */

DROP TABLE IF EXISTS `bbj_counter`;

CREATE TABLE `bbj_counter` (
  `bbj_counter_id` int(11) NOT NULL AUTO_INCREMENT,
  `rate` varchar(50) DEFAULT NULL,
  `contract` varchar(50) DEFAULT NULL,
  `counter` varchar(50) DEFAULT NULL,
  `month` varchar(50) DEFAULT NULL,
  `counter_bbj` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`bbj_counter_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bbj_counter` */

/*Table structure for table `bbj_lookup` */

DROP TABLE IF EXISTS `bbj_lookup`;

CREATE TABLE `bbj_lookup` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(11) DEFAULT NULL,
  `value` int(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bbj_lookup` */

/*Table structure for table `bbj_setting` */

DROP TABLE IF EXISTS `bbj_setting`;

CREATE TABLE `bbj_setting` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_kliring_pedagang` varchar(50) DEFAULT NULL,
  `kode_pedagang` varchar(50) DEFAULT NULL,
  `kode_nasabah` varchar(50) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  `host` varchar(50) DEFAULT NULL,
  `port` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bbj_setting` */

/*Table structure for table `bbj_trade` */

DROP TABLE IF EXISTS `bbj_trade`;

CREATE TABLE `bbj_trade` (
  `trade_id` int(11) NOT NULL DEFAULT '0',
  `bbj_status` int(11) DEFAULT NULL,
  `bbj_number` int(11) DEFAULT NULL,
  `bbj_account` varchar(50) DEFAULT NULL,
  `bbj_counter` varchar(50) DEFAULT NULL,
  `bbj_date` varchar(11) DEFAULT NULL,
  `bbj_cancel` int(11) DEFAULT NULL,
  PRIMARY KEY (`trade_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bbj_trade` */

/*Table structure for table `bbjlog` */

DROP TABLE IF EXISTS `bbjlog`;

CREATE TABLE `bbjlog` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `str_hdr` varchar(11) DEFAULT NULL,
  `str_tgl` varchar(11) DEFAULT NULL,
  `str_time` varchar(11) DEFAULT NULL,
  `str_last_counter` varchar(11) DEFAULT NULL,
  `str_type` varchar(11) DEFAULT NULL,
  `str_ack` varchar(11) DEFAULT NULL,
  `str_reason` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `bbjlog` */

/*Table structure for table `bbjtable` */

DROP TABLE IF EXISTS `bbjtable`;

CREATE TABLE `bbjtable` (
  `statusid` tinyint(4) NOT NULL DEFAULT '0',
  `description` varchar(30) NOT NULL DEFAULT '',
  `summary` tinytext,
  `color` varchar(7) NOT NULL DEFAULT '',
  PRIMARY KEY (`statusid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `bbjtable` */

insert  into `bbjtable`(`statusid`,`description`,`summary`,`color`) values (0,'Proceed BBJ',NULL,'yellow'),(1,'Sending...To BBJ','Sent To BBJ','#FF0000'),(2,'Do Not Send To BBJ',NULL,'#40F800'),(3,'Sent Success To BBJ',NULL,'#40F800'),(4,'Sent Fail To BBJ',NULL,'#FF0000'),(5,'Waiting BBJ Respond',NULL,'#FF0000');

/*Table structure for table `branch` */

DROP TABLE IF EXISTS `branch`;

CREATE TABLE `branch` (
  `userid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `branchid` varchar(10) NOT NULL DEFAULT '',
  PRIMARY KEY (`userid`,`branchid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `branch` */

/*Table structure for table `branch_manager` */

DROP TABLE IF EXISTS `branch_manager`;

CREATE TABLE `branch_manager` (
  `account` varchar(20) DEFAULT NULL,
  `mt4dt` varchar(20) DEFAULT NULL,
  `branch` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `branch_manager` */

insert  into `branch_manager`(`account`,`mt4dt`,`branch`,`email`) values ('160219121','agro','Jakarta','bm1@gmail.com'),('160318081','agro','Bali','bm2@gmail.com');

/*Table structure for table `branchgroups` */

DROP TABLE IF EXISTS `branchgroups`;

CREATE TABLE `branchgroups` (
  `userid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `branchgroupsid` varchar(10) NOT NULL DEFAULT '',
  PRIMARY KEY (`userid`,`branchgroupsid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `branchgroups` */

/*Table structure for table `broker_settings` */

DROP TABLE IF EXISTS `broker_settings`;

CREATE TABLE `broker_settings` (
  `settings` varchar(20) NOT NULL DEFAULT '',
  `value` varchar(100) NOT NULL DEFAULT '',
  `description` varchar(255) DEFAULT NULL,
  `urutan` int(11) DEFAULT NULL,
  PRIMARY KEY (`settings`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `broker_settings` */

insert  into `broker_settings`(`settings`,`value`,`description`,`urutan`) values ('current_rolldate','2015-08-28',NULL,NULL),('dayend_time','00:22:30',NULL,NULL),('interestaf','intnow',NULL,NULL),('mailfrom','info@si.co.id',NULL,1),('mailhost','mail.si.co.id',NULL,2),('mailpassword','kx-t7730',NULL,3),('mailport','25',NULL,5),('mailto','albertoscarina@gmail.com',NULL,4),('profx_ver','1.00',NULL,NULL);

/*Table structure for table `car` */

DROP TABLE IF EXISTS `car`;

CREATE TABLE `car` (
  `car_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `enabled` char(3) DEFAULT 'yes',
  `desc` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`car_id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

/*Data for the table `car` */

insert  into `car`(`car_id`,`name`,`enabled`,`desc`) values (1,'Avanza 1','yes','Toyota Avanza hitam (B 1371 PKM)'),(2,'Avanza 2 ','yes','Toyota Avanza Hitam (B 1369 PKM)'),(15,'Avanza 3','yes','Toyota Avanza Hitam (B 1942 PKR)'),(18,'Avanza 4','yes','Toyota Avanza Hitam (B 1943 PKR)'),(19,'Innova 1','yes','Kijang Innova Silver (B 1824 PKX)'),(20,'Avanza 5','yes','Toyota Avanza Hitam (B 1043 POB)'),(21,'Avanza 6','yes','Toyota Avanza Hitam (B 1045 POB)'),(26,'Innova 1','yes','Kijang Innova Hitam (B 1348 PKX)'),(29,'Avanza 7','yes','Toyota Avanza Hitam (B 1712 POL)'),(30,'Avanza 8','yes','Toyota Avanza Hitam ( B 1291 TZC)'),(31,'Avanza 9','yes','Toyota Avanza Hitam (B1258 TZC)'),(32,'Avanza 10','yes','Toyota Avanza Hitam ( B 1700 POL )');

/*Table structure for table `client_accounts` */

DROP TABLE IF EXISTS `client_accounts`;

CREATE TABLE `client_accounts` (
  `aecodeid` int(11) NOT NULL DEFAULT '0',
  `accountid` int(11) NOT NULL AUTO_INCREMENT,
  `accountname` varchar(20) NOT NULL DEFAULT '',
  `name` varchar(100) NOT NULL DEFAULT '',
  `address` text NOT NULL,
  `telephone_home` varchar(40) NOT NULL DEFAULT '',
  `telephone_office` varchar(40) NOT NULL DEFAULT '',
  `telephone_mobile` varchar(40) NOT NULL DEFAULT '',
  `suspend` char(1) NOT NULL DEFAULT '0',
  `email` varchar(150) NOT NULL DEFAULT '',
  `daycall` float NOT NULL DEFAULT '70',
  `nightcall` float NOT NULL DEFAULT '30',
  `float_rate` float NOT NULL DEFAULT '1',
  `telephone_fax` varchar(40) NOT NULL DEFAULT '',
  `sendmethod` varchar(10) NOT NULL DEFAULT 'email',
  `last_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `rolldate` date NOT NULL DEFAULT '0000-00-00',
  `hearfrom` varchar(255) DEFAULT NULL,
  `comments` text,
  `user_decimal` tinyint(2) DEFAULT '2',
  `dayend` varchar(10) DEFAULT '2000-01-01',
  `status` char(6) DEFAULT 'normal',
  `typeaccount` char(10) DEFAULT 'regular',
  PRIMARY KEY (`accountid`),
  UNIQUE KEY `accountname` (`accountname`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=latin1 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `client_accounts` */

insert  into `client_accounts`(`aecodeid`,`accountid`,`accountname`,`name`,`address`,`telephone_home`,`telephone_office`,`telephone_mobile`,`suspend`,`email`,`daycall`,`nightcall`,`float_rate`,`telephone_fax`,`sendmethod`,`last_updated`,`rolldate`,`hearfrom`,`comments`,`user_decimal`,`dayend`,`status`,`typeaccount`) values (1,1,'COMPANY','COMPANY','','','','','1','',70,30,1,'','Email','2015-07-31 10:40:33','2015-05-19',NULL,NULL,2,'2000-01-01','normal','regular'),(1,18,'9999100','9999100','','','','','0','',70,30,1,'','email','2016-04-19 09:47:37','2016-04-30',NULL,NULL,2,'2000-01-01','normal','regular'),(1,24,'9999250','9999250','','','','','0','',70,30,1,'','email','2016-04-19 09:47:37','2016-04-30',NULL,NULL,2,'2000-01-01','normal','regular'),(1,25,'9999500','9999500','','','','','0','',70,30,1,'','email','2016-04-19 09:47:37','2016-04-30',NULL,NULL,2,'2000-01-01','normal','regular'),(1,26,'99991000','99991000','','','','','0','',70,30,1,'','email','2016-04-19 09:47:37','2016-04-30',NULL,NULL,2,'2000-01-01','normal','regular'),(1,27,'99992500','99992500','','','','','0','',70,30,1,'','email','2016-04-19 09:47:37','2016-04-30',NULL,NULL,2,'2000-01-01','normal','regular'),(1,28,'99995000','99995000','','','','','0','',70,30,1,'','email','2016-04-19 09:47:37','2016-04-30',NULL,NULL,2,'2000-01-01','normal','regular'),(1,29,'999910000','999910000','','','','','1','',70,30,1,'','email','2016-04-19 09:47:37','2016-04-30',NULL,NULL,2,'2000-01-01','normal','regular');

/*Table structure for table `client_aecode` */

DROP TABLE IF EXISTS `client_aecode`;

CREATE TABLE `client_aecode` (
  `aecode` varchar(50) NOT NULL DEFAULT '',
  `groupid` int(11) NOT NULL DEFAULT '0',
  `aecodeid` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL DEFAULT '',
  `nametengah` varchar(255) DEFAULT '',
  `nameakhir` varchar(255) DEFAULT '',
  `identity` int(30) DEFAULT NULL,
  `taxid` int(30) DEFAULT NULL,
  `mothername` varchar(100) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `martial` varchar(20) DEFAULT NULL,
  `telephone_home` varchar(30) NOT NULL DEFAULT '',
  `telephone_fax` varchar(30) NOT NULL DEFAULT '',
  `telephone_mobile` varchar(30) NOT NULL DEFAULT '',
  `telephone_office` varchar(30) NOT NULL DEFAULT '',
  `sendmethod` varchar(10) NOT NULL DEFAULT '',
  `email` varchar(150) NOT NULL DEFAULT '',
  `last_updated` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `address` text,
  `banktype` varchar(100) DEFAULT NULL,
  `aeaccountname` varchar(100) DEFAULT NULL,
  `aeaccountnumber` varchar(100) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `no_identitas` varchar(255) DEFAULT NULL,
  `tipe_akun` varchar(255) DEFAULT NULL,
  `afiliasi` varchar(255) DEFAULT NULL,
  `bod` date DEFAULT NULL,
  `suspend` char(1) DEFAULT NULL,
  `status` varchar(6) DEFAULT NULL,
  `description` text,
  `foto` text,
  PRIMARY KEY (`aecodeid`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `client_aecode` */

insert  into `client_aecode`(`aecode`,`groupid`,`aecodeid`,`name`,`nametengah`,`nameakhir`,`identity`,`taxid`,`mothername`,`gender`,`martial`,`telephone_home`,`telephone_fax`,`telephone_mobile`,`telephone_office`,`sendmethod`,`email`,`last_updated`,`address`,`banktype`,`aeaccountname`,`aeaccountnumber`,`nationality`,`no_identitas`,`tipe_akun`,`afiliasi`,`bod`,`suspend`,`status`,`description`,`foto`) values ('AE1',1,1,'COMPANY GROUP','','',123456,12345678,'Ridawati','male','Single','085603051722','12345','085603051721','','Email','admin@apexregent.com','2015-07-31 10:40:20','Sukabumi',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'1',NULL,NULL);

/*Table structure for table `client_aecode_bank` */

DROP TABLE IF EXISTS `client_aecode_bank`;

CREATE TABLE `client_aecode_bank` (
  `aecode` varchar(255) NOT NULL,
  `banktype` varchar(100) DEFAULT NULL,
  `tipe_akun` varchar(255) DEFAULT 'USD',
  `aeaccountname` varchar(100) DEFAULT NULL,
  `aeaccountnumber` varchar(100) DEFAULT NULL,
  `status` varchar(6) DEFAULT NULL COMMENT '0 Not Edit, 1 Waiting Confirmation, 2 Confirmed, 3 Rejeted',
  `last_updated` datetime DEFAULT NULL,
  `keterangan` text,
  `address` text,
  `zipcode` char(15) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `swift` varchar(11) DEFAULT 'DBSSSGSG',
  `chips` varchar(35) DEFAULT NULL,
  `teles` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `client_aecode_bank` */

/*Table structure for table `client_balance` */

DROP TABLE IF EXISTS `client_balance`;

CREATE TABLE `client_balance` (
  `accountid` int(11) NOT NULL DEFAULT '0',
  `rolldate` date NOT NULL DEFAULT '0000-00-00',
  `balance` varchar(30) NOT NULL DEFAULT '0',
  PRIMARY KEY (`accountid`,`rolldate`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `client_balance` */

insert  into `client_balance`(`accountid`,`rolldate`,`balance`) values (1,'2015-07-22','0'),(1,'2015-07-23','0'),(1,'2015-08-14','33700'),(1,'2015-08-16','33700'),(1,'2015-08-25','33700'),(1,'2015-09-13','33700'),(2,'2015-07-20','0'),(2,'2015-07-22','0'),(2,'2015-07-23','970800'),(2,'2015-07-24','970800'),(2,'2015-07-25','970800'),(2,'2015-07-26','970800'),(2,'2015-07-27','868250'),(2,'2015-07-28','857750'),(2,'2015-07-29','1010350'),(2,'2015-07-30','989700'),(2,'2015-07-31','776200'),(2,'2015-08-01','776200'),(2,'2015-08-02','776200'),(2,'2015-08-03','776200'),(2,'2015-08-04','625000'),(2,'2015-08-05','492000'),(2,'2015-08-06','492000'),(2,'2015-08-07','487800'),(2,'2015-08-08','487800'),(2,'2015-08-09','487800'),(2,'2015-08-10','613800'),(2,'2015-08-11','662800'),(2,'2015-08-12','697450'),(2,'2015-08-13','788100'),(2,'2015-08-14','763600'),(2,'2015-08-15','763600'),(2,'2015-08-16','763600'),(2,'2015-08-17','737350'),(2,'2015-08-18','738400'),(2,'2015-08-19','703750'),(2,'2015-08-20','799300'),(2,'2015-08-21','521400'),(2,'2015-08-22','521400'),(2,'2015-08-23','521400'),(2,'2015-08-24','521400'),(2,'2015-08-25','521400'),(2,'2015-08-26','340100'),(2,'2015-08-27','764300'),(2,'2015-08-28','820300'),(2,'2015-08-29','820300'),(2,'2015-08-30','820300'),(2,'2015-08-31','820300'),(2,'2015-09-01','820300'),(2,'2015-09-02','820300'),(2,'2015-09-03','820300'),(2,'2015-09-04','788450'),(2,'2015-09-05','788450'),(2,'2015-09-06','788450'),(2,'2015-09-07','854250'),(2,'2015-09-08','854250'),(2,'2015-09-09','831850'),(2,'2015-09-10','831850'),(2,'2015-09-11','831850'),(2,'2015-09-12','831850'),(2,'2015-09-13','831850'),(2,'2015-09-14','831850'),(2,'2015-09-15','831850'),(2,'2015-09-16','831850'),(2,'2015-09-17','831850'),(2,'2015-09-18','831850'),(2,'2015-09-19','831850'),(2,'2015-09-20','831850'),(2,'2015-09-21','831850'),(2,'2015-09-22','831850'),(2,'2015-09-23','831850'),(2,'2015-09-24','777950'),(2,'2015-09-25','835350'),(2,'2015-09-26','835350'),(2,'2015-09-27','835350'),(2,'2015-09-28','896600'),(2,'2015-09-29','896600'),(2,'2015-09-30','886450'),(2,'2015-10-01','886450'),(2,'2015-10-02','886450'),(2,'2015-10-03','886450'),(2,'2015-10-04','886450'),(2,'2015-10-05','859850'),(2,'2015-10-06','859850'),(2,'2015-10-07','835700'),(2,'2015-10-08','782500'),(2,'2015-10-09','697800'),(2,'2015-10-10','697800'),(2,'2015-10-11','697800'),(2,'2015-10-12','697800'),(2,'2015-10-13','822050'),(2,'2015-10-14','777250'),(2,'2015-10-15','740850'),(2,'2015-10-16','678550'),(2,'2015-10-17','678550'),(2,'2015-10-18','678550'),(2,'2015-10-19','661750'),(2,'2015-10-20','609250'),(2,'2015-10-21','573900'),(2,'2015-10-22','515800'),(2,'2015-10-23','507400'),(2,'2015-10-24','507400'),(2,'2015-10-25','507400'),(2,'2015-10-26','363900'),(2,'2015-10-27','247700'),(2,'2015-10-28','223200'),(3,'2015-07-24','0'),(3,'2015-09-13','0'),(5,'2015-06-26','0'),(5,'2015-06-27','0'),(5,'2015-06-28','0'),(5,'2015-06-29','0'),(5,'2015-06-30','0'),(5,'2015-07-22','0'),(5,'2015-07-23','-36000'),(5,'2015-07-24','-36000'),(5,'2015-07-25','-36000'),(5,'2015-07-26','-36000'),(5,'2015-07-27','-182500'),(5,'2015-07-28','-197500'),(5,'2015-07-29','20500'),(5,'2015-07-30','-9000'),(5,'2015-07-31','-314000'),(5,'2015-08-01','-314000'),(5,'2015-08-02','-314000'),(5,'2015-08-03','-314000'),(5,'2015-08-04','-530000'),(5,'2015-08-05','-720000'),(5,'2015-08-06','-720000'),(5,'2015-08-07','-726000'),(5,'2015-08-08','-726000'),(5,'2015-08-09','-726000'),(5,'2015-08-10','-546000'),(5,'2015-08-11','-476000'),(5,'2015-08-12','-426500'),(5,'2015-08-13','-297000'),(5,'2015-08-14','-332000'),(5,'2015-08-15','-332000'),(5,'2015-08-16','-332000'),(5,'2015-08-17','-369500'),(5,'2015-08-18','-368000'),(5,'2015-08-19','-417500'),(5,'2015-08-20','-281000'),(5,'2015-08-21','-678000'),(5,'2015-08-22','-678000'),(5,'2015-08-23','-678000'),(5,'2015-08-24','-678000'),(5,'2015-08-25','-678000'),(5,'2015-08-26','-937000'),(5,'2015-08-27','-331000'),(5,'2015-08-28','-251000'),(5,'2015-08-29','-251000'),(5,'2015-08-30','-251000'),(5,'2015-08-31','-251000'),(5,'2015-09-01','-251000'),(5,'2015-09-02','-251000'),(5,'2015-09-03','-251000'),(5,'2015-09-04','-296500'),(5,'2015-09-05','-296500'),(5,'2015-09-06','-296500'),(5,'2015-09-07','-202500'),(5,'2015-09-08','-202500'),(5,'2015-09-09','-234500'),(5,'2015-09-10','-234500'),(5,'2015-09-11','-234500'),(5,'2015-09-12','-234500'),(5,'2015-09-13','-234500'),(5,'2015-09-14','-234500'),(5,'2015-09-15','-234500'),(5,'2015-09-16','-234500'),(5,'2015-09-17','-234500'),(5,'2015-09-18','-234500'),(5,'2015-09-19','-234500'),(5,'2015-09-20','-234500'),(5,'2015-09-21','-234500'),(5,'2015-09-22','-234500'),(5,'2015-09-23','-234500'),(5,'2015-09-24','-311500'),(5,'2015-09-25','-229500'),(5,'2015-09-26','-229500'),(5,'2015-09-27','-229500'),(5,'2015-09-28','-142000'),(5,'2015-09-29','-142000'),(5,'2015-09-30','-156500'),(5,'2015-10-01','-156500'),(5,'2015-10-02','-156500'),(5,'2015-10-03','-156500'),(5,'2015-10-04','-156500'),(5,'2015-10-05','-194500'),(5,'2015-10-06','-194500'),(5,'2015-10-07','-229000'),(5,'2015-10-08','-305000'),(5,'2015-10-09','-426000'),(5,'2015-10-10','-426000'),(5,'2015-10-11','-426000'),(5,'2015-10-12','-426000'),(5,'2015-10-13','-480000'),(5,'2015-10-14','-544000'),(5,'2015-10-15','-596000'),(5,'2015-10-16','-685000'),(5,'2015-10-17','-685000'),(5,'2015-10-18','-685000'),(5,'2015-10-19','-709000'),(5,'2015-10-20','-784000'),(5,'2015-10-21','-834500'),(5,'2015-10-22','-917500'),(5,'2015-10-23','-929500'),(5,'2015-10-24','-929500'),(5,'2015-10-25','-929500'),(5,'2015-10-26','-1134500'),(5,'2015-10-27','-1300500'),(5,'2015-10-28','-952500'),(6,'2015-06-20','0'),(6,'2015-06-24','0'),(6,'2015-06-25','0'),(6,'2015-06-26','0'),(6,'2015-06-27','0'),(6,'2015-07-22','0'),(6,'2015-07-23','-10800'),(6,'2015-07-24','-10800'),(6,'2015-07-25','-10800'),(6,'2015-07-26','-10800'),(6,'2015-07-27','-54750'),(6,'2015-07-28','-59250'),(6,'2015-07-29','6150'),(6,'2015-07-30','-2700'),(6,'2015-07-31','-94200'),(6,'2015-08-01','-94200'),(6,'2015-08-02','-94200'),(6,'2015-08-03','-94200'),(6,'2015-08-04','-159000'),(6,'2015-08-05','-216000'),(6,'2015-08-06','-216000'),(6,'2015-08-07','-217800'),(6,'2015-08-08','-217800'),(6,'2015-08-09','-217800'),(6,'2015-08-10','-163800'),(6,'2015-08-11','-142800'),(6,'2015-08-12','-127950'),(6,'2015-08-13','-89100'),(6,'2015-08-14','-99600'),(6,'2015-08-15','-99600'),(6,'2015-08-16','-99600'),(6,'2015-08-17','-110850'),(6,'2015-08-18','-110400'),(6,'2015-08-19','-125250'),(6,'2015-08-20','-84300'),(6,'2015-08-21','-203400'),(6,'2015-08-22','-203400'),(6,'2015-08-23','-203400'),(6,'2015-08-24','-203400'),(6,'2015-08-25','-203400'),(6,'2015-08-26','-281100'),(6,'2015-08-27','-99300'),(6,'2015-08-28','-75300'),(6,'2015-08-29','-75300'),(6,'2015-08-30','-75300'),(6,'2015-08-31','-75300'),(6,'2015-09-01','-75300'),(6,'2015-09-02','-75300'),(6,'2015-09-03','-75300'),(6,'2015-09-04','-88950'),(6,'2015-09-05','-88950'),(6,'2015-09-06','-88950'),(6,'2015-09-07','-60750'),(6,'2015-09-08','-60750'),(6,'2015-09-09','-70350'),(6,'2015-09-10','-70350'),(6,'2015-09-11','-70350'),(6,'2015-09-12','-70350'),(6,'2015-09-13','-70350'),(6,'2015-09-14','-70350'),(6,'2015-09-15','-70350'),(6,'2015-09-16','-70350'),(6,'2015-09-17','-70350'),(6,'2015-09-18','-70350'),(6,'2015-09-19','-70350'),(6,'2015-09-20','-70350'),(6,'2015-09-21','-70350'),(6,'2015-09-22','-70350'),(6,'2015-09-23','-70350'),(6,'2015-09-24','-93450'),(6,'2015-09-25','-68850'),(6,'2015-09-26','-68850'),(6,'2015-09-27','-68850'),(6,'2015-09-28','-42600'),(6,'2015-09-29','-42600'),(6,'2015-09-30','-46950'),(6,'2015-10-01','-46950'),(6,'2015-10-02','-46950'),(6,'2015-10-03','-46950'),(6,'2015-10-04','-46950'),(6,'2015-10-05','-58350'),(6,'2015-10-06','-58350'),(6,'2015-10-07','-68700'),(6,'2015-10-08','-91500'),(6,'2015-10-09','-127800'),(6,'2015-10-10','-127800'),(6,'2015-10-11','-127800'),(6,'2015-10-12','-127800'),(6,'2015-10-14','-147000'),(6,'2015-10-15','-162600'),(6,'2015-10-16','-189300'),(6,'2015-10-17','-189300'),(6,'2015-10-18','-189300'),(6,'2015-10-19','-196500'),(6,'2015-10-20','-219000'),(6,'2015-10-21','-234150'),(6,'2015-10-22','-259050'),(6,'2015-10-23','-262650'),(6,'2015-10-24','-262650'),(6,'2015-10-25','-262650'),(6,'2015-10-26','-324150'),(7,'2015-09-14','0'),(7,'2015-09-21','0'),(7,'2015-09-24','0'),(7,'2015-09-25','0'),(7,'2015-09-26','0'),(7,'2015-09-27','0'),(7,'2015-09-28','0'),(7,'2015-09-29','0'),(7,'2015-09-30','0'),(7,'2015-10-01','0'),(7,'2015-10-02','0'),(7,'2015-10-03','0'),(7,'2015-10-04','0'),(7,'2015-10-05','0'),(7,'2015-10-19','0'),(7,'2015-10-20','0'),(7,'2015-10-21','0'),(7,'2015-10-27','0'),(7,'2015-10-28','0');

/*Table structure for table `client_branch` */

DROP TABLE IF EXISTS `client_branch`;

CREATE TABLE `client_branch` (
  `branch` varchar(50) NOT NULL DEFAULT '',
  `branchid` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) DEFAULT NULL,
  `suspend` char(3) DEFAULT 'no',
  PRIMARY KEY (`branchid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `client_branch` */

insert  into `client_branch`(`branch`,`branchid`,`description`,`suspend`) values ('MY',1,NULL,'no');

/*Table structure for table `client_group` */

DROP TABLE IF EXISTS `client_group`;

CREATE TABLE `client_group` (
  `branchid` int(11) NOT NULL DEFAULT '0',
  `group` varchar(50) NOT NULL DEFAULT '',
  `groupid` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`groupid`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `client_group` */

insert  into `client_group`(`branchid`,`group`,`groupid`) values (1,'MY1',1);

/*Table structure for table `client_logs` */

DROP TABLE IF EXISTS `client_logs`;

CREATE TABLE `client_logs` (
  `logid` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(25) NOT NULL DEFAULT '',
  `rolldate` date NOT NULL DEFAULT '0000-00-00',
  `details` text NOT NULL,
  `logdate` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `logtype` varchar(200) NOT NULL DEFAULT 'undefined',
  PRIMARY KEY (`logid`)
) ENGINE=InnoDB AUTO_INCREMENT=1323 DEFAULT CHARSET=latin1;

/*Data for the table `client_logs` */

insert  into `client_logs`(`logid`,`username`,`rolldate`,`details`,`logdate`,`logtype`) values (1253,'programmer','2015-07-24','programmer has created a new branch : MY','2015-07-31 10:39:51','ACCOUNTS'),(1254,'programmer','2015-07-24','programmer has created a new group : MY1','2015-07-31 10:40:09','ACCOUNTS'),(1255,'programmer','2015-07-24','programmer has created a new account executive : AE1','2015-07-31 10:40:20','ACCOUNTS'),(1256,'programmer','2015-07-24','programmer has created a new account : MM_A','2015-07-31 10:40:33','ACCOUNTS'),(1257,'programmer','2015-07-24','programmer has created a new account : MM_B','2015-07-31 10:40:45','ACCOUNTS'),(1258,'programmer','2015-07-24','programmer has created a new account : MM_C','2015-07-31 10:40:52','ACCOUNTS'),(1259,'programmer','2015-07-24','programmer has created a new account : MM_D','2015-07-31 10:41:02','ACCOUNTS'),(1260,'programmer','2015-07-30','programmer has inserted a deposit of : $10,000.00 for Account MM_A. REF :Array','2015-07-31 10:43:03','DEPOSIT'),(1261,'programmer','2015-07-30','programmer has inserted a deposit of : $10,000.00 for Account MM_B. REF :Array','2015-07-31 10:43:18','DEPOSIT'),(1262,'programmer','2015-07-30','programmer has inserted a deposit of : $10,000.00 for Account MM_C. REF :Array','2015-07-31 10:43:31','DEPOSIT'),(1263,'programmer','2015-07-30','programmer has inserted a deposit of : $10,000.00 for Account MM_D. REF :Array','2015-07-31 10:43:43','DEPOSIT'),(1264,'Cherlynn','2015-07-30','The user (prorgammer) has tried to login to Cherlynn but failed','2015-07-31 10:58:17','LOGIN'),(1265,'Cherlynn','2015-07-30','The user (prorgammer) has tried to login to Cherlynn but failed','2015-07-31 10:58:22','LOGIN'),(1266,'programmer','2015-07-30','programmer has deleted REF :4 of type (MARGIN_IN) of accountid = 4 Amount:($10,000.00)','2015-07-31 10:59:03','MARGINDEL'),(1267,'programmer','2015-07-30','programmer has deleted REF :1 of type (MARGIN_IN) of accountid = 1 Amount:($10,000.00)','2015-07-31 10:59:12','MARGINDEL'),(1268,'programmer','2015-07-30','programmer has deleted REF :2 of type (MARGIN_IN) of accountid = 2 Amount:($10,000.00)','2015-07-31 10:59:20','MARGINDEL'),(1269,'programmer','2015-07-30','programmer has deleted REF :3 of type (MARGIN_IN) of accountid = 3 Amount:($10,000.00)','2015-07-31 10:59:26','MARGINDEL'),(1270,'programmer','2015-07-23','programmer has inserted a deposit of : $10,000.00 for Account MM_B. REF :Array','2015-07-31 11:03:38','DEPOSIT'),(1271,'programmer','2015-07-24','programmer has inserted a withdrawal of : $500.00 for Account MM_B. REF :Array','2015-08-02 13:14:14','WITHDRAWAL'),(1272,'programmer','2015-07-24','programmer has deleted REF :6 of type (MARGIN_OUT) of accountid = 2 Amount:($500.00)','2015-08-02 22:14:31','MARGINDEL'),(1273,'programmer','2015-07-24','programmer has inserted a ADJUSTMENT OUT of : $37.31 for Account MM_B. REF :Array','2015-08-02 22:15:12','ADJUSTMENT OUT'),(1274,'programmer','2015-07-24','programmer has inserted a withdrawal of : $100.00 for Account MM_B. REF :Array','2015-08-02 22:18:31','WITHDRAWAL'),(1275,'programmer','2015-07-24','programmer has inserted a deposit of : $400.00 for Account MM_B. REF :Array','2015-08-02 22:18:51','DEPOSIT'),(1276,'programmer','2015-07-24','programmer has created a new account : MMREG100','2015-08-05 14:32:46','ACCOUNTS'),(1277,'Cherlynn','2015-07-24','The user (programmer) has tried to login to Cherlynn but failed','2015-08-05 14:33:45','LOGIN'),(1278,'programmer','2015-07-23','programmer has inserted a deposit of : $100,000.00 for Account MMREG100. REF :Array','2015-08-05 14:34:32','DEPOSIT'),(1279,'programmer','2015-07-23','programmer has added a new counter setting : LLG for account .MMREG70','2015-08-08 15:21:39','COUNTERS'),(1280,'programmer','2015-07-23','programmer has added a new counter setting : LLG for account .MMREG100','2015-08-08 15:23:31','COUNTERS'),(1281,'programmer','2015-07-23','programmer has created a new account : MMREG30','2015-08-08 15:25:50','ACCOUNTS'),(1282,'programmer','2015-07-23','programmer has inserted a deposit of : $10,000.00 for Account MMREG30. REF :Array','2015-08-08 15:26:20','DEPOSIT'),(1283,'programmer','2015-07-23','programmer has added a new counter setting : LLG for account .MMREG30','2015-08-08 15:26:59','COUNTERS'),(1284,'Cherlynn','2015-07-23','The user (support) has tried to login to Cherlynn but failed','2015-08-24 11:08:33','LOGIN'),(1285,'Cherlynn','2015-07-23','The user (support) has tried to login to Cherlynn but failed','2015-08-24 11:08:39','LOGIN'),(1286,'Cherlynn','2015-07-23','The user (theprogrammer) has tried to login to Cherlynn but failed','2015-08-28 14:27:07','LOGIN'),(1287,'Cherlynn','2015-07-23','The user (adminsibfx) has tried to login to Cherlynn but failed','2015-08-28 14:48:38','LOGIN'),(1288,'Cherlynn','2015-07-23','The user (adminsibfx) has tried to login to Cherlynn but failed','2015-08-28 14:48:51','LOGIN'),(1289,'Cherlynn','2015-07-23','The user (adminsibfx) has tried to login to Cherlynn but failed','2015-08-28 14:49:06','LOGIN'),(1290,'Cherlynn','2015-07-23','The user (adminsibfx) has tried to login to Cherlynn but failed','2015-08-28 14:49:15','LOGIN'),(1291,'adminsibfx','2015-08-11','adminsibfx has inserted a withdrawal of : $10,592.00 for Account MMREG70. REF :Array','2015-08-28 15:04:12','WITHDRAWAL'),(1292,'adminsibfx','2015-08-11','adminsibfx has inserted a deposit of : $9,660.00 for Account MMREG70. REF :Array','2015-08-28 15:11:19','DEPOSIT'),(1293,'Cherlynn','2015-07-23','The user (THEPROGRAMMER) has tried to login to Cherlynn but failed','2015-09-08 19:20:05','LOGIN'),(1294,'Cherlynn','2015-07-23','The user (programmer) has tried to login to Cherlynn but failed','2015-09-08 19:20:12','LOGIN'),(1295,'Cherlynn','2015-07-23','The user (programmer) has tried to login to Cherlynn but failed','2015-09-08 19:20:21','LOGIN'),(1296,'adminsibfx','2015-07-23','adminsibfx has deleted REF :1 of type (MARGIN_IN) of accountid = 2 Amount:($9,954.00)','2015-09-08 19:22:19','MARGINDEL'),(1297,'adminsibfx','2015-07-23','adminsibfx has inserted a deposit of : $9,960.00 for Account MMREG70. REF :Array','2015-09-08 19:23:11','DEPOSIT'),(1298,'adminsibfx','2015-08-14','adminsibfx has deleted REF :10 of type (MARGIN_IN) of accountid = 2 Amount:($4,876.59)','2015-09-08 19:30:46','MARGINDEL'),(1299,'programmer','2015-07-23','programmer has inserted a deposit of : $10.00 for Account MM_A. REF :Array','2015-09-08 19:31:44','DEPOSIT'),(1300,'programmer','2015-07-23','programmer has deleted REF :16 of type (MARGIN_IN) of accountid = 1 Amount:($10.00)','2015-09-08 19:31:48','MARGINDEL'),(1301,'adminsibfx','2015-08-05','adminsibfx has deleted REF :4 of type (MARGIN_IN) of accountid = 2 Amount:($9,958.00)','2015-09-08 20:41:12','MARGINDEL'),(1302,'adminsibfx','2015-08-10','adminsibfx has deleted REF :7 of type (MARGIN_OUT) of accountid = 2 Amount:($4,000.00)','2015-09-08 20:50:37','MARGINDEL'),(1303,'adminsibfx','2015-08-11','adminsibfx has deleted REF :14 of type (MARGIN_IN) of accountid = 2 Amount:($9,660.00)','2015-09-08 20:53:50','MARGINDEL'),(1304,'adminsibfx','2015-08-11','adminsibfx has deleted REF :13 of type (MARGIN_OUT) of accountid = 2 Amount:($10,592.00)','2015-09-08 20:54:07','MARGINDEL'),(1305,'adminsibfx','2015-07-23','adminsibfx has deleted REF :2 of type (MARGIN_IN) of accountid = 5 Amount:($9,954.00)','2015-09-09 13:13:04','MARGINDEL'),(1306,'adminsibfx','2015-07-23','adminsibfx has inserted a deposit of : $9,960.00 for Account MMREG70. REF :Array','2015-09-09 13:22:51','DEPOSIT'),(1307,'adminsibfx','2015-07-23','adminsibfx has inserted a deposit of : $9,960.00 for Account MMREG70. REF :Array','2015-09-09 13:30:43','DEPOSIT'),(1308,'Cherlynn','2015-07-23','The user (support) has tried to login to Cherlynn but failed','2015-09-14 09:27:19','LOGIN'),(1309,'Cherlynn','2015-07-23','The user (support) has tried to login to Cherlynn but failed','2015-09-14 09:27:25','LOGIN'),(1310,'support','2015-07-23','support has created a new account : MMREG70B','2015-09-14 09:28:40','ACCOUNTS'),(1311,'Cherlynn','2015-07-23','The user (support) has tried to login to Cherlynn but failed','2015-09-14 09:31:00','LOGIN'),(1312,'Cherlynn','2015-07-23','The user (support) has tried to login to Cherlynn but failed','2015-09-14 09:31:08','LOGIN'),(1313,'Cherlynn','2015-07-23','The user (support) has tried to login to Cherlynn but failed','2015-09-14 10:08:13','LOGIN'),(1314,'Cherlynn','2015-07-23','The user (support) has tried to login to Cherlynn but failed','2015-09-14 10:08:20','LOGIN'),(1315,'Cherlynn','2015-07-23','The user (support) has tried to login to Cherlynn but failed','2015-09-14 10:08:28','LOGIN'),(1316,'Cherlynn','2015-07-23','The user (support) has tried to login to Cherlynn but failed','2015-09-14 10:08:34','LOGIN'),(1317,'support','2015-07-23','support has updated account : MMREG70B','2015-09-14 10:09:30','ACCOUNTS'),(1318,'Cherlynn','2015-07-23','The user (adminsibfx) has tried to login to Cherlynn but failed','2015-10-14 09:05:19','LOGIN'),(1319,'Cherlynn','2015-07-23','The user (theprogrammer) has tried to login to Cherlynn but failed','2015-11-08 16:10:09','LOGIN'),(1320,'Cherlynn','2015-07-23','The user (programmer) has tried to login to Cherlynn but failed','2015-11-08 16:10:18','LOGIN'),(1321,'Cherlynn','2015-07-23','The user (programmer) has tried to login to Cherlynn but failed','2015-11-08 16:10:57','LOGIN'),(1322,'Cherlynn','2015-07-23','The user (theprogrammer) has tried to login to Cherlynn but failed','2015-11-08 17:57:58','LOGIN');

/*Table structure for table `client_margin` */

DROP TABLE IF EXISTS `client_margin`;

CREATE TABLE `client_margin` (
  `marginid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `accountid` int(10) unsigned NOT NULL DEFAULT '0',
  `margin_type` varchar(15) NOT NULL DEFAULT '-',
  `rolldate` date NOT NULL DEFAULT '0000-00-00',
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `insert_by` varchar(25) NOT NULL DEFAULT '',
  `comment` text NOT NULL,
  `amount` varchar(20) NOT NULL DEFAULT '0',
  `selisih` varchar(20) DEFAULT '0',
  PRIMARY KEY (`marginid`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

/*Data for the table `client_margin` */

insert  into `client_margin`(`marginid`,`accountid`,`margin_type`,`rolldate`,`time`,`insert_by`,`comment`,`amount`,`selisih`) values (18,2,'MARGIN_IN','2015-07-23','2015-09-09 13:30:43','adminsibfx','','996000','0');

/*Table structure for table `client_tradeorders` */

DROP TABLE IF EXISTS `client_tradeorders`;

CREATE TABLE `client_tradeorders` (
  `tradeid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `accountid` int(11) NOT NULL DEFAULT '0',
  `counter` varchar(20) NOT NULL DEFAULT '',
  `units` decimal(11,2) NOT NULL DEFAULT '0.00',
  `position` varchar(10) NOT NULL DEFAULT '',
  `rolldate` date NOT NULL DEFAULT '0000-00-00',
  `time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `execute_price` decimal(20,5) NOT NULL DEFAULT '0.00000',
  `status` varchar(10) NOT NULL DEFAULT 'cancel',
  `open_commission` char(20) NOT NULL DEFAULT '0',
  `online_tradeid` bigint(20) NOT NULL DEFAULT '0',
  `floating_commission` varchar(20) DEFAULT '0',
  PRIMARY KEY (`tradeid`,`online_tradeid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `client_tradeorders` */

/*Table structure for table `client_tradesettlements` */

DROP TABLE IF EXISTS `client_tradesettlements`;

CREATE TABLE `client_tradesettlements` (
  `settlementid` bigint(20) NOT NULL AUTO_INCREMENT,
  `tradeid` bigint(20) NOT NULL DEFAULT '0',
  `settlement_price` decimal(20,5) NOT NULL DEFAULT '0.00000',
  `rolldate` date NOT NULL DEFAULT '0000-00-00',
  `settle_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `units` decimal(11,2) NOT NULL DEFAULT '0.00',
  `status` varchar(20) NOT NULL DEFAULT 'CANCEL',
  `branchid` int(11) NOT NULL DEFAULT '0',
  `settled_commission` varchar(20) NOT NULL DEFAULT '0',
  `p_and_l` varchar(30) NOT NULL DEFAULT '0',
  `online_tradeid` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`settlementid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 PACK_KEYS=0;

/*Data for the table `client_tradesettlements` */

/*Table structure for table `config` */

DROP TABLE IF EXISTS `config`;

CREATE TABLE `config` (
  `configid` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '',
  `value` tinytext NOT NULL,
  PRIMARY KEY (`configid`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `config` */

insert  into `config`(`configid`,`name`,`value`) values (1,'company_name','PT.SI'),(2,'logout_url','http://www.stg9.com'),(3,'timeoffset','7'),(4,'closingmachine','manual');

/*Table structure for table `counter` */

DROP TABLE IF EXISTS `counter`;

CREATE TABLE `counter` (
  `counterid` varchar(20) NOT NULL,
  `name` varchar(20) NOT NULL DEFAULT '',
  `dealingsequence` char(4) DEFAULT '9999',
  `download_alias` varchar(20) DEFAULT NULL,
  `sequence` int(11) DEFAULT '999',
  `symbol` varchar(13) NOT NULL DEFAULT '',
  `tradeupdates` int(1) DEFAULT '0',
  `counter_start` datetime DEFAULT '2006-06-01 00:00:01',
  `counter_end` datetime DEFAULT '2999-06-01 23:59:59',
  `countertype` varchar(50) NOT NULL DEFAULT '',
  `open` tinyint(2) DEFAULT '0',
  `activeorder` char(1) NOT NULL DEFAULT '1',
  `format_num` varchar(11) DEFAULT NULL,
  `active` tinyint(3) NOT NULL DEFAULT '1',
  `name_alias` varchar(17) DEFAULT NULL,
  `lotsize` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `indexid` tinyint(3) NOT NULL DEFAULT '1',
  `spread` float NOT NULL DEFAULT '0',
  `decimal` tinyint(4) NOT NULL DEFAULT '0',
  `interestbuy` float NOT NULL DEFAULT '0',
  `interestsell` float NOT NULL DEFAULT '0',
  `marginday` int(9) unsigned NOT NULL DEFAULT '0',
  `marginnight` int(9) unsigned NOT NULL DEFAULT '0',
  `quotemodeid` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `chartsymbol` varchar(20) NOT NULL DEFAULT '',
  `Show` int(1) DEFAULT '0',
  `topping` int(3) DEFAULT '0',
  `minqty` char(2) DEFAULT '1',
  `liqonly` char(3) NOT NULL DEFAULT 'no',
  PRIMARY KEY (`counterid`),
  KEY `counterid` (`counterid`),
  KEY `indexid` (`indexid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `counter` */

insert  into `counter`(`counterid`,`name`,`dealingsequence`,`download_alias`,`sequence`,`symbol`,`tradeupdates`,`counter_start`,`counter_end`,`countertype`,`open`,`activeorder`,`format_num`,`active`,`name_alias`,`lotsize`,`indexid`,`spread`,`decimal`,`interestbuy`,`interestsell`,`marginday`,`marginnight`,`quotemodeid`,`chartsymbol`,`Show`,`topping`,`minqty`,`liqonly`) values ('AUDUSD','AUDUSD','1','AUDUSD',1,'AUDUSD',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'AUDUSD',100000,1,0.0003,4,0,0,1000,1000,1,'',1,0,'1','no'),('USDCHF','USDCHF','2','USDCHF',2,'USDCHF',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'USDCHF',100000,1,0.0003,4,0,0,1000,1000,1,'',1,0,'1','no'),('GBPUSD','GBPUSD','3','GBPUSD',3,'GBPUSD',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'GBPUSD',100000,1,0.0003,4,0,0,1000,1000,1,'',1,0,'1','no'),('EURUSD','EURUSD','4','EURUSD',4,'EURUSD',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'EURUSD',100000,1,0.0003,4,0,0,1000,1000,1,'',1,0,'1','no'),('USDJPY','USDJPY','5','USDJPY',5,'USDJPY',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'USDJPY',100000,1,0.03,2,0,0,1000,1000,1,'',1,0,'1','no'),('XAUUSD','XAUUSD','6','XAUUSD',6,'XAUUSD',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'XAUUSD',100,1,0.5,2,0,0,1000,1000,1,'',1,0,'1','no'),('JPK50#','JPK50#','7','JPK50#',7,'JPK50#',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'JPK50#',50000,1,5,0,0,0,15000000,15000000,1,'',1,0,'1','no'),('HKK50#','HKK50#','8','HKK50#',8,'HKK50#',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'HKK50#',50000,1,5,0,0,0,15000000,15000000,1,'',1,0,'1','no'),('JPK50.','JPK50.','9','JPK50.',9,'JPK50.',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'JPK50.',50000,1,5,0,0,0,8000000,16000000,1,'',1,0,'1','no'),('HKK50.','HKK50.','10','HKK50.',10,'HKK50.',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'HKK50.',50000,1,5,0,0,0,8000000,16000000,1,'',1,0,'1','no'),('SSIH','SSIH','11','SSIH',11,'SSIH',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'SSIH',30000,1,5,0,0,0,5000000,10000000,1,'',1,0,'1','no'),('SSIM','SSIM','12','SSIM',12,'SSIM',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'SSIM',30000,1,5,0,0,0,5000000,10000000,1,'',1,0,'1','no'),('SSIU','SSIU','13','SSIU',13,'SSIU',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'SSIU',30000,1,5,0,0,0,5000000,10000000,1,'',1,0,'1','no'),('SSIZ','SSIZ','14','SSIZ',14,'SSIZ',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'SSIZ',30000,1,5,0,0,0,5000000,10000000,1,'',1,0,'1','no'),('KSIH','KSIH','15','KSIH',15,'KSIH',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'KSIH',3500000,1,0.05,2,0,0,5000000,15000000,1,'',1,0,'1','no'),('KSIM','KSIM','16','KSIM',16,'KSIM',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'KSIM',3500000,1,0.05,2,0,0,5000000,15000000,1,'',1,0,'1','no'),('KSIU','KSIU','17','KSIU',17,'KSIU',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'KSIU',3500000,1,0.05,2,0,0,5000000,15000000,1,'',1,0,'1','no'),('KSIZ','KSIZ','18','KSIZ',18,'KSIZ',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'KSIZ',3500000,1,0.05,2,0,0,5000000,15000000,1,'',1,0,'1','no'),('HSIF','HSIF','19','HSIF',19,'HSIF',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'HSIF',50000,1,5,0,0,0,5000000,15000000,1,'',1,0,'1','no'),('HSIG','HSIG','20','HSIG',20,'HSIG',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'HSIG',50000,1,5,0,0,0,5000000,15000000,1,'',1,0,'1','no'),('HSIH','HSIH','21','HSIH',21,'HSIH',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'HSIH',50000,1,5,0,0,0,5000000,15000000,1,'',1,0,'1','no'),('HSIJ','HSIJ','22','HSIJ',22,'HSIJ',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'HSIJ',50000,1,5,0,0,0,5000000,15000000,1,'',1,0,'1','no'),('HSIK','HSIK','23','HSIK',23,'HSIK',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'HSIK',50000,1,5,0,0,0,5000000,15000000,1,'',1,0,'1','no'),('HSIM','HSIM','24','HSIM',24,'HSIM',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'HSIM',50000,1,5,0,0,0,5000000,15000000,1,'',1,0,'1','no'),('HSIN','HSIN','25','HSIN',25,'HSIN',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'HSIN',50000,1,5,0,0,0,5000000,15000000,1,'',1,0,'1','no'),('HSIQ','HSIQ','26','HSIQ',26,'HSIQ',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'HSIQ',50000,1,5,0,0,0,5000000,15000000,1,'',1,0,'1','no'),('HSIU','HSIU','27','HSIU',27,'HSIU',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'HSIU',50000,1,5,0,0,0,5000000,15000000,1,'',1,0,'1','no'),('HSIV','HSIV','28','HSIV',28,'HSIV',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'HSIV',50000,1,5,0,0,0,5000000,15000000,1,'',1,0,'1','no'),('HSIX','HSIX','29','HSIX',29,'HSIX',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'HSIX',50000,1,5,0,0,0,5000000,15000000,1,'',1,0,'1','no'),('HSIZ','HSIZ','30','HSIZ',30,'HSIZ',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'HSIZ',50000,1,5,0,0,0,5000000,15000000,1,'',1,0,'1','no'),('HKJ50F3.','HKJ50F3.','31','HKJ50F3.',31,'HKJ50F3.',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'HKJ50F3.',50000,1,5,0,0,0,8000000,16000000,1,'',1,0,'1','no'),('HKJ50G3.','HKJ50G3.','32','HKJ50G3.',32,'HKJ50G3.',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'HKJ50G3.',50000,1,5,0,0,0,10000000,10000000,1,'',1,0,'1','no'),('HKJ50H3.','HKJ50H3.','33','HKJ50H3.',33,'HKJ50H3.',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'HKJ50H3.',50000,1,5,0,0,0,10000000,10000000,1,'',1,0,'1','no'),('HKJ50J3.','HKJ50J3.','34','HKJ50J3.',34,'HKJ50J3.',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'HKJ50J3.',50000,1,5,0,0,0,10000000,10000000,1,'',1,0,'1','no'),('HKJ50K3.','HKJ50K3.','35','HKJ50K3.',35,'HKJ50K3.',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'HKJ50K3.',50000,1,5,0,0,0,8000000,16000000,1,'',1,0,'1','no'),('HKJ50M3.','HKJ50M3.','36','HKJ50M3.',36,'HKJ50M3.',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'HKJ50M3.',50000,1,5,0,0,0,8000000,16000000,1,'',1,0,'1','Fo'),('HKJ50N3.','HKJ50N3.','37','HKJ50N3.',37,'HKJ50N3.',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'HKJ50N3.',50000,1,5,0,0,0,8000000,16000000,1,'',1,0,'1','no'),('HKJ50Q3.','HKJ50Q3.','38','HKJ50Q3.',38,'HKJ50Q3.',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'HKJ50Q3.',50000,1,5,0,0,0,8000000,16000000,1,'',1,0,'1','no'),('HKJ50U3.','HKJ50U3.','39','HKJ50U3.',39,'HKJ50U3.',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'HKJ50U3.',50000,1,5,0,0,0,8000000,16000000,1,'',1,0,'1','no'),('HKJ50V3.','HKJ50V3.','40','HKJ50V3.',40,'HKJ50V3.',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'HKJ50V3.',50000,1,5,0,0,0,8000000,16000000,1,'',1,0,'1','no'),('HKJ50X3.','HKJ50X3.','41','HKJ50X3.',41,'HKJ50X3.',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'HKJ50X3.',50000,1,5,0,0,0,8000000,16000000,1,'',1,0,'1','no'),('HKJ50Z3.','HKJ50Z3.','42','HKJ50Z3.',42,'HKJ50Z3.',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'HKJ50Z3.',50000,1,5,0,0,0,8000000,16000000,1,'',1,0,'1','no'),('JPJ30H3.','JPJ30H3.','43','JPJ30H3.',43,'JPJ30H3.',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'JPJ30H3.',30000,1,5,0,0,0,5000000,10000000,1,'',1,0,'1','no'),('JPJ30M3.','JPJ30M3.','44','JPJ30M3.',44,'JPJ30M3.',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'JPJ30M3.',30000,1,5,0,0,0,5000000,10000000,1,'',1,0,'1','no'),('JPJ30U3.','JPJ30U3.','45','JPJ30U3.',45,'JPJ30U3.',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'JPJ30U3.',30000,1,5,0,0,0,5000000,10000000,1,'',1,0,'1','no'),('JPJ30Z3.','JPJ30Z3.','46','JPJ30Z3.',46,'JPJ30Z3.',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'JPJ30Z3.',30000,1,5,0,0,0,5000000,10000000,1,'',1,0,'1','no'),('KRJ35H3.','KRJ35H3.','47','KRJ35H3.',47,'KRJ35H3.',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'KRJ35H3.',3500000,1,0.05,2,0,0,5000000,11000000,1,'',1,0,'1','no'),('KRJ35M3.','KRJ35M3.','48','KRJ35M3.',48,'KRJ35M3.',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'KRJ35M3.',3500000,1,0.05,2,0,0,5000000,11000000,1,'',1,0,'1','no'),('KRJ35U3.','KRJ35U3.','49','KRJ35U3.',49,'KRJ35U3.',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'KRJ35U3.',3500000,1,0.05,2,0,0,5000000,11000000,1,'',1,0,'1','no'),('KRJ35Z3.','KRJ35Z3.','50','KRJ35Z3.',50,'KRJ35Z3.',1,'2006-06-01 00:00:00','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'KRJ35Z3.',3500000,1,0.05,2,0,0,5000000,11000000,1,'',1,0,'1','no'),('CHFJPY','CHFJPY','63','CHFJPY',63,'CHFJPY',1,'2006-06-01 00:00:01','2999-06-01 00:00:00','Currency',0,'0','####.00',1,'CHFJPY',1000,1,0.04,2,0,0,1000,1000,1,'',1,0,'1','no'),('JPK50_','JPK50_','10','JPK50_',10,'JPK50_',1,'2006-06-01 00:00:01','2999-06-01 23:59:59','Currency',0,'0','####.00',1,'JPK50_',50000,1,5,0,0,0,8000000,8000000,1,'',1,0,'1','no'),('EURJPY','EURJPY','1','EURJPY',1,'EURJPY',2,'2006-06-01 00:00:01','2999-06-01 23:59:59','Currency',0,'0','####.00',1,'EURJPY',100000,1,0.04,2,0,0,1000,1000,1,'',1,0,'1','no'),('XAUUSD.1','XAUUSD.1','7','XAUUSD.1',7,'XAUUSD.1',1,'2006-06-01 00:00:01','2999-06-01 23:59:59','Currency',0,'0','####.00',1,'XAUUSD.1',100,1,0.5,2,0,0,1000,1000,1,'',1,0,'1','no'),('AUDJPY','AUDJPY','8','AUDJPY',8,'AUDJPY',1,'2006-06-01 00:00:01','2999-06-01 23:59:59','Currency',0,'0','####.00',1,'AUDJPY',100000,1,0.04,2,2.5,-5.5,1000,1000,1,'',1,0,'1','no'),('JPJ30H4.','JPJ30H4.','47','JPJ30H4.',47,'JPJ30H4.',1,'2006-06-01 00:00:01','2999-06-01 23:59:59','Currency',0,'0','####.00',1,'JPJ30H4.',30000,1,5,0,0,0,5000000,10000000,1,'',1,0,'1','no'),('KRJ35H4.','KRJ35H4.','51','KRJ35H4.',51,'KRJ35H4.',1,'2006-06-01 00:00:01','2999-06-01 23:59:59','Currency',0,'0','####.00',1,'KRJ35H4.',3500000,1,0.05,2,0,0,5000000,11000000,1,'',1,0,'1','no');

/*Table structure for table `counter_account` */

DROP TABLE IF EXISTS `counter_account`;

CREATE TABLE `counter_account` (
  `accountid` int(11) unsigned NOT NULL DEFAULT '0',
  `counter` varchar(20) NOT NULL DEFAULT '',
  `lotsize` char(10) NOT NULL DEFAULT '0',
  `active` char(1) NOT NULL DEFAULT '1',
  `spread` int(11) NOT NULL DEFAULT '0',
  `hedge` int(11) NOT NULL DEFAULT '0',
  `marginday` int(11) NOT NULL DEFAULT '0',
  `marginnight` int(11) NOT NULL DEFAULT '0',
  `interestbuy` float NOT NULL DEFAULT '0',
  `interestsell` float NOT NULL DEFAULT '0',
  `rolldate` date NOT NULL DEFAULT '0000-00-00',
  `commission` varchar(10) NOT NULL DEFAULT 'open',
  `open_comm` int(11) NOT NULL DEFAULT '0',
  `close_comm` int(11) NOT NULL DEFAULT '0',
  `interest_day_year` varchar(100) DEFAULT NULL,
  `interest_day_tripple` varchar(100) DEFAULT NULL,
  `storagebuy` float(8,2) DEFAULT '0.00',
  `storagesell` float(8,2) DEFAULT '0.00',
  `rolloverbuy` float(10,3) DEFAULT '0.000',
  `rolloversell` float(10,3) DEFAULT '0.000',
  `rolloverdate` date DEFAULT '0000-00-00',
  `rebate_ae` float(4,2) DEFAULT '0.00',
  `market_close` time DEFAULT '00:00:00',
  `market_open` time DEFAULT '00:00:00',
  `full_day` date DEFAULT '2999-12-31',
  `rate` float DEFAULT '1',
  `cross_counter` varchar(20) DEFAULT '0',
  `cross_counter_pl` varchar(20) DEFAULT '0',
  `accountname` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`counter`,`accountid`,`rolldate`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `counter_account` */

insert  into `counter_account`(`accountid`,`counter`,`lotsize`,`active`,`spread`,`hedge`,`marginday`,`marginnight`,`interestbuy`,`interestsell`,`rolldate`,`commission`,`open_comm`,`close_comm`,`interest_day_year`,`interest_day_tripple`,`storagebuy`,`storagesell`,`rolloverbuy`,`rolloversell`,`rolloverdate`,`rebate_ae`,`market_close`,`market_open`,`full_day`,`rate`,`cross_counter`,`cross_counter_pl`,`accountname`) values (2,'LLG','100','1',50,0,0,0,0,0,'2015-07-23','floating',0,0,'365','Wed',5.00,5.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00','2999-12-31',1,'0','0','MMREG70'),(5,'LLG','100','1',50,0,0,0,0,0,'2015-07-23','floating',0,0,'365','Wed',5.00,5.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00','2999-12-31',1,'0','0','MMREG100'),(6,'LLG','100','1',50,0,0,0,0,0,'2015-07-23','floating',0,0,'365','Wed',5.00,5.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00','2999-12-31',1,'0','0','MMREG30'),(2,'XAUUSD','100','1',50,0,0,0,0,0,'2015-07-23','floating',0,0,'365','Wed',5.00,5.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00','2999-12-31',1,'0','0','MMREG70'),(5,'XAUUSD','100','1',50,0,0,0,0,0,'2015-07-23','floating',0,0,'365','Wed',5.00,5.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00','2999-12-31',1,'0','0','MMREG100'),(6,'XAUUSD','100','1',50,0,0,0,0,0,'2015-07-23','floating',0,0,'365','Wed',5.00,5.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00','2999-12-31',1,'0','0','MMREG30');

/*Table structure for table `counter_category` */

DROP TABLE IF EXISTS `counter_category`;

CREATE TABLE `counter_category` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(15) DEFAULT NULL,
  `counter_field` varchar(20) DEFAULT NULL,
  `Description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `counter_category` */

insert  into `counter_category`(`Id`,`category`,`counter_field`,`Description`) values (1,'Spot_Index','IDRHSI','IDR HSI'),(2,'Spot_Index','IDRSSI','IDR SSI'),(3,'Spot_Index','USDHSI','USD HSI'),(4,'Spot_Index','USDSSI','USD SSI');

/*Table structure for table `counter_closing` */

DROP TABLE IF EXISTS `counter_closing`;

CREATE TABLE `counter_closing` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) DEFAULT NULL,
  `closingday` date DEFAULT NULL,
  `closingprice` decimal(10,4) DEFAULT NULL,
  `closingsession` varchar(20) DEFAULT NULL,
  `process` varchar(11) DEFAULT 'No Process',
  `closinglimit` varchar(10) DEFAULT '0.0000',
  `prev_closingprice` decimal(10,4) DEFAULT '0.0000',
  `t_o` int(9) DEFAULT '0',
  `closinglast` decimal(10,4) DEFAULT '0.0000',
  `netchange` decimal(10,4) DEFAULT '0.0000',
  `checkvalue` varchar(7) DEFAULT NULL,
  `datetime` datetime DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `counter_closing` */

/*Table structure for table `counter_com` */

DROP TABLE IF EXISTS `counter_com`;

CREATE TABLE `counter_com` (
  `counter` varchar(20) NOT NULL DEFAULT '',
  `full_day` date DEFAULT '2999-12-31',
  `lotsize` char(10) NOT NULL DEFAULT '0',
  `decimal` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `active` char(1) NOT NULL DEFAULT '1',
  `spread` int(11) NOT NULL DEFAULT '0',
  `hedge` int(11) NOT NULL DEFAULT '0',
  `marginday` int(11) NOT NULL DEFAULT '0',
  `marginnight` int(11) NOT NULL DEFAULT '0',
  `interestbuy` float NOT NULL DEFAULT '0',
  `interestsell` float NOT NULL DEFAULT '0',
  `rolldate` date NOT NULL DEFAULT '0000-00-00',
  `commission` varchar(10) NOT NULL DEFAULT 'both',
  `open_comm` float NOT NULL DEFAULT '0',
  `close_comm` float NOT NULL DEFAULT '0',
  `calc_type` tinyint(1) NOT NULL DEFAULT '0',
  `interest_day_year` varchar(100) DEFAULT NULL,
  `interest_day_tripple` varchar(100) DEFAULT NULL,
  `storagebuy` float(8,2) DEFAULT '0.00',
  `storagesell` float(8,2) DEFAULT '0.00',
  `rolloverbuy` float(10,3) DEFAULT '0.000',
  `rolloversell` float(10,3) DEFAULT '0.000',
  `rolloverdate` date DEFAULT '0000-00-00',
  `rebate_ae` float(4,2) DEFAULT '0.00',
  `market_close` time DEFAULT '00:00:00',
  `market_open` time DEFAULT '00:00:00',
  `rate` float DEFAULT '1',
  `cross_counter` varchar(20) DEFAULT '0',
  `cross_counter_pl` varchar(20) DEFAULT '0',
  PRIMARY KEY (`counter`,`rolldate`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `counter_com` */

insert  into `counter_com`(`counter`,`full_day`,`lotsize`,`decimal`,`active`,`spread`,`hedge`,`marginday`,`marginnight`,`interestbuy`,`interestsell`,`rolldate`,`commission`,`open_comm`,`close_comm`,`calc_type`,`interest_day_year`,`interest_day_tripple`,`storagebuy`,`storagesell`,`rolloverbuy`,`rolloversell`,`rolloverdate`,`rebate_ae`,`market_close`,`market_open`,`rate`,`cross_counter`,`cross_counter_pl`) values ('AUDJPY','2999-12-31','100000',2,'1',4,100,1000,1000,0,0,'2000-06-07','floating',0,5000,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('AUDUSD','2999-12-31','100000',4,'1',3,100,1000,1000,0,0,'2000-06-07','floating',0,5000,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('CHFJPY','2999-12-31','100000',2,'1',4,100,1000,1000,0,0,'2000-06-07','floating',0,5000,3,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('EURJPY','2999-12-31','100000',2,'1',4,100,1000,1000,0,0,'2000-06-07','floating',0,5000,3,'365','Web',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'USDJPY','USDJPY'),('EURUSD','2999-12-31','100000',4,'1',3,100,1000,1000,0,0,'2000-06-07','floating',0,5000,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('GBPUSD','2999-12-31','100000',4,'1',3,100,1000,1000,0,0,'2000-06-07','floating',0,5000,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('HKJ50H3.','2999-12-31','50000',0,'1',5,1000000,10000000,10000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('HKJ50J3.','2999-12-31','50000',0,'1',5,1000000,10000000,10000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('HKJ50K3.','2999-12-31','50000',0,'1',5,1000000,8000000,16000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('HKJ50M3.','2999-12-31','50000',0,'1',5,1000000,8000000,16000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('HKJ50N3.','2999-12-31','50000',0,'1',5,1000000,8000000,16000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('HKJ50Q3.','2999-12-31','50000',0,'1',5,1000000,8000000,16000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('HKJ50U3.','2999-12-31','50000',0,'1',5,1000000,8000000,16000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('HKJ50V3.','2999-12-31','50000',0,'1',5,1000000,8000000,16000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('HKJ50X3.','2999-12-31','50000',0,'1',5,1000000,8000000,16000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('HKJ50Z3.','2999-12-31','50000',0,'1',5,1000000,8000000,16000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('HKK50#','2999-12-31','50000',0,'1',5,1500000,15000000,15000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('HKK50.','2999-12-31','50000',0,'1',5,1500000,8000000,16000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('HSIF','2999-12-31','50000',0,'1',5,500000,5000000,15000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('HSIG','2999-12-31','50000',0,'1',5,500000,5000000,15000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('HSIH','2999-12-31','50000',0,'1',5,500000,5000000,15000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('HSIJ','2999-12-31','50000',0,'1',5,500000,5000000,15000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('HSIK','2999-12-31','50000',0,'1',5,500000,5000000,15000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('HSIM','2999-12-31','50000',0,'1',5,500000,5000000,15000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('HSIN','2999-12-31','50000',0,'1',5,500000,5000000,15000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('HSIQ','2999-12-31','50000',0,'1',5,500000,5000000,15000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('HSIU','2999-12-31','50000',0,'1',5,500000,5000000,15000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('HSIV','2999-12-31','50000',0,'1',5,500000,5000000,15000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('HSIX','2999-12-31','50000',0,'1',5,500000,5000000,15000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('HSIZ','2999-12-31','50000',0,'1',5,500000,5000000,15000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('JPJ30H3.','2999-12-31','30000',0,'1',5,600000,5000000,10000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('JPJ30H4.','2999-12-31','30000',0,'1',5,600000,5000000,10000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('JPJ30M3.','2999-12-31','30000',0,'1',5,600000,5000000,10000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('JPJ30U3.','2999-12-31','30000',0,'1',5,600000,5000000,10000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('JPJ30Z3.','2999-12-31','30000',0,'1',5,600000,5000000,10000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('JPK50#','2999-12-31','50000',0,'1',5,500000,15000000,15000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('JPK50.','2999-12-31','50000',0,'1',5,1500000,8000000,16000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('JPK50_','2999-12-31','50000',2,'1',5,1500000,800000,1600000,0,0,'2000-06-07','floating',0,5e+006,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('KRJ35H3.','2999-12-31','3500000',2,'1',5,600000,5000000,11000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('KRJ35H4.','2999-12-31','3500000',2,'1',5,600000,5000000,11000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('KRJ35M3.','2999-12-31','3500000',2,'1',5,600000,5000000,11000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('KRJ35U3.','2999-12-31','3500000',2,'1',5,600000,5000000,11000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('KRJ35Z3.','2999-12-31','3500000',2,'1',5,600000,5000000,11000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('KSIH','2999-12-31','3500000',2,'1',5,500000,5000000,15000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('KSIM','2999-12-31','3500000',2,'1',5,500000,5000000,15000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('KSIU','2999-12-31','3500000',2,'1',5,500000,5000000,15000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('KSIZ','2999-12-31','3500000',2,'1',5,500000,5000000,15000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('LLG','2999-12-31','100',2,'1',50,0,0,0,0,0,'2000-06-07','floating',5000,5000,2,'365','Wed',5.00,5.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('SSIH','2999-12-31','30000',0,'1',5,500000,5000000,10000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('SSIM','2999-12-31','30000',0,'1',5,500000,5000000,10000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('SSIU','2999-12-31','30000',0,'1',5,500000,5000000,10000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('SSIZ','2999-12-31','30000',0,'1',5,500000,5000000,10000000,0,0,'2000-06-07','floating',0,5e+007,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('USDCHF','2999-12-31','100000',4,'1',3,100,1000,1000,0,0,'2000-06-07','floating',0,5000,1,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('USDJPY','2999-12-31','100000',2,'1',3,100,1000,1000,0,0,'2000-06-07','floating',0,5000,1,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('XAUUSD','2999-12-31','100',2,'1',50,0,0,0,0,0,'2000-06-07','floating',5000,0,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0'),('XAUUSD.1','2999-12-31','100',2,'1',50,500000,1000,1000,0,0,'2000-06-07','floating',0,5700,2,'365','Wed',0.00,0.00,0.000,0.000,'0000-00-00',0.00,'00:00:00','00:00:00',1,'0','0');

/*Table structure for table `counter_duration` */

DROP TABLE IF EXISTS `counter_duration`;

CREATE TABLE `counter_duration` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(15) DEFAULT NULL,
  `duration` varchar(4) DEFAULT NULL,
  `dura_view` varchar(16) DEFAULT NULL,
  `dura_start` time DEFAULT '00:00:00',
  `dura_finish` time DEFAULT '23:59:59',
  `sequence` int(1) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `counter_duration` */

insert  into `counter_duration`(`Id`,`category`,`duration`,`dura_view`,`dura_start`,`dura_finish`,`sequence`,`description`) values (1,'Spot','gtn','GTN','00:00:00','23:59:59',1,'sequence untuk mensort duration pada saat closing process'),(2,'Spot','gtf','GTF','00:00:00','23:59:59',1,NULL),(3,'Spot_Index','gtn','GTD','00:00:00','23:59:59',1,NULL);

/*Table structure for table `counter_market_time` */

DROP TABLE IF EXISTS `counter_market_time`;

CREATE TABLE `counter_market_time` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(15) DEFAULT NULL,
  `duration` varchar(4) DEFAULT NULL,
  `dura_process_start` time DEFAULT NULL,
  `dura_process_end` time DEFAULT NULL,
  `description` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `counter_market_time` */

/*Table structure for table `counter_settings` */

DROP TABLE IF EXISTS `counter_settings`;

CREATE TABLE `counter_settings` (
  `counter` varchar(20) NOT NULL DEFAULT '',
  `lotsize` char(10) NOT NULL DEFAULT '0',
  `branchid` int(10) unsigned NOT NULL DEFAULT '0',
  `branch` varchar(50) DEFAULT '0',
  `active` char(1) NOT NULL DEFAULT '1',
  `spread` int(11) NOT NULL DEFAULT '0',
  `hedge` int(11) NOT NULL DEFAULT '0',
  `marginday` int(11) NOT NULL DEFAULT '0',
  `marginnight` int(11) NOT NULL DEFAULT '0',
  `interestbuy` float NOT NULL DEFAULT '0',
  `interestsell` float NOT NULL DEFAULT '0',
  `rolldate` date NOT NULL DEFAULT '0000-00-00',
  `commission` varchar(10) NOT NULL DEFAULT 'open',
  `open_comm` int(11) NOT NULL DEFAULT '0',
  `close_comm` int(11) NOT NULL DEFAULT '0',
  `interest_day_year` varchar(100) DEFAULT NULL,
  `interest_day_tripple` varchar(100) DEFAULT NULL,
  `storagebuy` float(8,2) DEFAULT '0.00',
  `storagesell` float(8,2) DEFAULT '0.00',
  `rolloverbuy` float(10,3) DEFAULT '0.000',
  `rolloversell` float(10,3) DEFAULT '0.000',
  `rolloverdate` date DEFAULT '0000-00-00',
  `rebate_ae` float(4,2) DEFAULT '0.00',
  `market_open` time DEFAULT '00:00:00',
  `market_close` time DEFAULT '00:00:00',
  `full_day` date DEFAULT '2999-12-31',
  `rate` float DEFAULT '1',
  `cross_counter` varchar(20) DEFAULT '0',
  `cross_counter_pl` varchar(20) DEFAULT '0',
  PRIMARY KEY (`counter`,`branchid`,`rolldate`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `counter_settings` */

/*Table structure for table `counter_type` */

DROP TABLE IF EXISTS `counter_type`;

CREATE TABLE `counter_type` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(15) DEFAULT NULL,
  `ctr_type` varchar(11) DEFAULT NULL,
  `action` varchar(12) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `atnew` char(3) DEFAULT 'yes',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=latin1;

/*Data for the table `counter_type` */

insert  into `counter_type`(`Id`,`category`,`ctr_type`,`action`,`description`,`atnew`) values (1,'Spot','buy','buy','Buy','no'),(2,'Spot','sell','sell','Sell','no'),(3,'Spot_Index','buy','buy','Buy','no'),(4,'Spot_Index','sell','sell','Sell','no'),(75,'Spot','oco_buy','buy','Buy OCO','no'),(76,'Spot','oco_sell','sell','Sell OCO','no'),(97,'Spot_Index','oco_buy','buy','Buy OCO','no'),(98,'Spot_Index','oco_sell','sell','Sell OCO','no');

/*Table structure for table `cutmargin` */

DROP TABLE IF EXISTS `cutmargin`;

CREATE TABLE `cutmargin` (
  `cuttime` datetime NOT NULL COMMENT 'start hitung',
  `accno` varchar(30) NOT NULL,
  `value` decimal(20,3) DEFAULT NULL,
  `stoptime` datetime DEFAULT '2099-12-31 00:00:01' COMMENT 'stop di sini',
  PRIMARY KEY (`cuttime`,`accno`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `cutmargin` */

/*Table structure for table `cutmargin_price` */

DROP TABLE IF EXISTS `cutmargin_price`;

CREATE TABLE `cutmargin_price` (
  `SYMBOL` char(16) NOT NULL,
  `TIME` datetime NOT NULL,
  `BID` double NOT NULL,
  `ASK` double NOT NULL,
  PRIMARY KEY (`SYMBOL`,`TIME`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `cutmargin_price` */

insert  into `cutmargin_price`(`SYMBOL`,`TIME`,`BID`,`ASK`) values ('XAUUSD','2015-07-31 10:00:00',1084.5,1085.5),('LLG','2015-07-30 10:00:00',1084.5,1086),('XAUUSD','2015-07-30 10:00:00',1080,1080.5),('LLG','2015-09-03 15:04:34',1132.95,1133.45);

/*Table structure for table `dafile` */

DROP TABLE IF EXISTS `dafile`;

CREATE TABLE `dafile` (
  `primary_id` varchar(100) NOT NULL DEFAULT '',
  `AccNo` varchar(30) NOT NULL DEFAULT '',
  `ItemCode` text NOT NULL,
  `ItemName` text NOT NULL,
  `Unit` decimal(11,2) NOT NULL DEFAULT '0.00',
  `BuyOrder` int(11) NOT NULL DEFAULT '0',
  `BuyRef` text NOT NULL,
  `BuyDate` text NOT NULL,
  `BuyPrice` decimal(20,5) NOT NULL DEFAULT '0.00000',
  `SellOrder` int(11) NOT NULL DEFAULT '0',
  `SellRef` text NOT NULL,
  `SellDate` text NOT NULL,
  `SellPrice` decimal(20,5) NOT NULL DEFAULT '0.00000',
  `PL` decimal(20,3) NOT NULL DEFAULT '0.000',
  `Interest` decimal(20,3) NOT NULL DEFAULT '0.000',
  `IntCum` decimal(20,3) DEFAULT '0.000',
  `IntCumSettled` decimal(20,3) DEFAULT '0.000',
  `Storage` decimal(20,3) NOT NULL DEFAULT '0.000',
  `Commission` decimal(20,3) NOT NULL DEFAULT '0.000',
  `FLCOMM` decimal(20,3) DEFAULT '0.000',
  `LotSize` int(11) NOT NULL DEFAULT '0',
  `Format` text NOT NULL,
  `LiqStatus` text NOT NULL,
  `online_tradeid` int(11) NOT NULL DEFAULT '0',
  `acct_id` int(11) DEFAULT '0',
  `remark` tinytext,
  `bonus` decimal(20,3) DEFAULT '0.000',
  `selisih` decimal(20,3) DEFAULT '0.000',
  `IntCumMeta` decimal(20,3) DEFAULT '0.000',
  `StoCum` decimal(20,3) DEFAULT NULL,
  `StoCumSettled` decimal(20,3) DEFAULT NULL,
  `StoCumMeta` decimal(20,3) DEFAULT NULL,
  PRIMARY KEY (`online_tradeid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `dafile` */

/*Table structure for table `daily_details` */

DROP TABLE IF EXISTS `daily_details`;

CREATE TABLE `daily_details` (
  `rolldate` date DEFAULT NULL,
  `AccNo` varchar(30) NOT NULL DEFAULT '',
  `ItemCode` text NOT NULL,
  `ItemName` text NOT NULL,
  `Unit` int(11) NOT NULL DEFAULT '0',
  `BuyOrder` int(11) DEFAULT '0',
  `BuyRef` text,
  `BuyDate` text,
  `BuyPrice` decimal(20,4) DEFAULT '0.0000',
  `SellOrder` int(11) DEFAULT '0',
  `SellRef` text,
  `SellDate` text,
  `SellPrice` decimal(20,4) DEFAULT '0.0000',
  `PL` decimal(20,3) DEFAULT '0.000',
  `Interest` decimal(20,3) DEFAULT '0.000',
  `IntCum` decimal(20,3) DEFAULT '0.000',
  `IntCumSettled` decimal(20,3) DEFAULT '0.000',
  `Commission` decimal(20,3) DEFAULT '0.000',
  `FLCOMM` decimal(20,3) DEFAULT '0.000',
  `LotSize` int(11) DEFAULT '0',
  `Format` text,
  `LiqStatus` text,
  `Storage` decimal(20,3) DEFAULT '0.000',
  `Rolloverclosing` decimal(20,3) DEFAULT '0.000',
  `online_tradeid` int(11) NOT NULL,
  `remark` tinytext,
  `bonus` decimal(20,3) DEFAULT '0.000',
  `selisih` decimal(20,3) DEFAULT '0.000',
  `IntCumMeta` decimal(20,3) DEFAULT '0.000',
  `StoCum` decimal(20,3) DEFAULT NULL,
  `StoCumMeta` decimal(20,3) DEFAULT NULL,
  `StoCumPrevBal` decimal(20,3) DEFAULT NULL,
  `StoCumEquity` decimal(20,3) DEFAULT NULL,
  `StoCumEffective` decimal(20,3) DEFAULT NULL,
  `StoCumSettled` decimal(20,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `daily_details` */

/*Table structure for table `daily_header` */

DROP TABLE IF EXISTS `daily_header`;

CREATE TABLE `daily_header` (
  `rolldate` date DEFAULT NULL,
  `AccNo` varchar(30) NOT NULL DEFAULT '',
  `AeCode` text NOT NULL,
  `Group` text NOT NULL,
  `Branch` text NOT NULL,
  `AePin` text NOT NULL,
  `IntTable` text NOT NULL,
  `Name` text NOT NULL,
  `Address1` text NOT NULL,
  `Address2` text NOT NULL,
  `Address3` text NOT NULL,
  `PrevBal` decimal(20,3) NOT NULL DEFAULT '0.000',
  `MarginIN` decimal(20,3) NOT NULL DEFAULT '0.000',
  `MarginOUT` decimal(20,3) NOT NULL DEFAULT '0.000',
  `PL` decimal(20,3) NOT NULL DEFAULT '0.000',
  `Interest` decimal(20,3) NOT NULL DEFAULT '0.000',
  `IntCum` decimal(10,3) DEFAULT '0.000',
  `IntCumSettled` decimal(10,3) DEFAULT '0.000',
  `Commission` decimal(20,3) NOT NULL DEFAULT '0.000',
  `Adjust` decimal(20,3) NOT NULL DEFAULT '0.000',
  `Adjust_add` decimal(20,3) DEFAULT '0.000',
  `Bonus` decimal(20,3) NOT NULL DEFAULT '0.000',
  `NewBal` decimal(20,3) NOT NULL DEFAULT '0.000',
  `CumNewBal` decimal(20,3) DEFAULT '0.000',
  `CumPrevBal` decimal(20,3) DEFAULT '0.000',
  `CumEquity` decimal(20,3) DEFAULT '0.000',
  `CumEffective` decimal(20,3) DEFAULT '0.000',
  `Floating` decimal(20,3) NOT NULL DEFAULT '0.000',
  `FLCOMM` decimal(20,3) DEFAULT '0.000',
  `Equity` decimal(20,3) NOT NULL DEFAULT '0.000',
  `Rebate` decimal(20,3) NOT NULL DEFAULT '0.000',
  `Settlement` decimal(20,3) NOT NULL DEFAULT '0.000',
  `MarginReq` decimal(20,3) NOT NULL DEFAULT '0.000',
  `MarginReqDay` decimal(20,3) NOT NULL DEFAULT '0.000',
  `MarginReqNight` decimal(20,3) NOT NULL DEFAULT '0.000',
  `OpenUnit` decimal(20,3) NOT NULL DEFAULT '0.000',
  `CrLimit` decimal(20,3) NOT NULL DEFAULT '0.000',
  `Storage` decimal(20,3) DEFAULT '0.000',
  `Rolloverclosing` decimal(20,3) DEFAULT '0.000',
  `equity_profit` varchar(50) DEFAULT '0',
  `IntCumMeta` decimal(20,3) DEFAULT '0.000',
  `StoCum` decimal(20,3) DEFAULT NULL,
  `StoCumMeta` decimal(20,3) DEFAULT NULL,
  `StoCumNewBal` decimal(20,3) DEFAULT NULL,
  `StoCumPrevBal` decimal(20,3) DEFAULT NULL,
  `StoCumEquity` decimal(20,3) DEFAULT NULL,
  `StoCumEffective` decimal(20,3) DEFAULT NULL,
  `StoCumSettled` decimal(20,3) DEFAULT NULL,
  `ntr` decimal(20,3) DEFAULT NULL,
  `FloatingInt` decimal(20,3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `daily_header` */

/*Table structure for table `datafeed_accounts` */

DROP TABLE IF EXISTS `datafeed_accounts`;

CREATE TABLE `datafeed_accounts` (
  `username` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(20) NOT NULL DEFAULT '',
  `active` char(3) NOT NULL DEFAULT '',
  `onlinestatus` varchar(10) NOT NULL DEFAULT '',
  `group` varchar(10) NOT NULL DEFAULT '',
  `last_ip` varchar(50) NOT NULL DEFAULT '',
  `last_login` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_activity` varchar(20) NOT NULL DEFAULT '',
  `datestart` datetime DEFAULT NULL,
  `dateend` datetime DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `datafeed_accounts` */

insert  into `datafeed_accounts`(`username`,`password`,`active`,`onlinestatus`,`group`,`last_ip`,`last_login`,`last_activity`,`datestart`,`dateend`,`description`) values ('albert','albert','1','online','client','/127.0.0.1:1104','2009-09-14 21:27:04','2009-09-14 21:31:43','2006-05-01 00:00:00','2016-05-01 00:00:00','for Albert Testing Graphic'),('pushlet4','pushlet4','1','online','client','','2007-10-01 00:00:01','2010-03-08 11:12:49','2006-08-21 00:00:01','2016-05-02 00:00:00','For Pushlet Jboss');

/*Table structure for table `datafeed_accounts_quotes` */

DROP TABLE IF EXISTS `datafeed_accounts_quotes`;

CREATE TABLE `datafeed_accounts_quotes` (
  `username` varchar(20) NOT NULL DEFAULT '',
  `symbol` varchar(20) NOT NULL DEFAULT '',
  `Id` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `datafeed_accounts_quotes` */

insert  into `datafeed_accounts_quotes`(`username`,`symbol`,`Id`) values ('albert','All',NULL),('pushlet4','All',NULL);

/*Table structure for table `day_end_counter` */

DROP TABLE IF EXISTS `day_end_counter`;

CREATE TABLE `day_end_counter` (
  `rolldate` date NOT NULL DEFAULT '0000-00-00',
  `counter` varchar(20) NOT NULL DEFAULT '',
  `interest_multiplier` smallint(2) NOT NULL DEFAULT '0',
  `bid` float DEFAULT '0',
  `ask` float DEFAULT '0',
  PRIMARY KEY (`rolldate`,`counter`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `day_end_counter` */

insert  into `day_end_counter`(`rolldate`,`counter`,`interest_multiplier`,`bid`,`ask`) values ('2015-07-22','LLG ',1,1093.85,1094.35),('2015-07-23','LLG',1,1089.65,1090.15),('2015-07-24','LLG',1,1098.5,1099),('2015-07-25','LLG',1,1098.5,1099),('2015-07-27','LLG',1,1092.35,1092.85),('2015-07-28','LLG',1,1095.35,1095.85),('2015-07-29','LLG',1,1097.3,1096.8),('2015-07-30','LLG',1,1088.05,1088.55),('2015-07-31','LLG',1,1095.2,1095.7),('2015-08-03','LLG',1,1086.25,1086.75),('2015-08-03','XAUUSD',1,1086.25,1086.75),('2015-08-04','LLG',1,1088.15,1088.65),('2015-08-04','XAUUSD',1,1088.15,1088.65),('2015-08-05','LLG',1,1084.9,1085.4),('2015-08-05','XAUUSD',1,1084.9,1085.4),('2015-08-06','LLG',1,1089.3,1089.8),('2015-08-06','XAUUSD',1,1089.3,1089.8),('2015-08-10','LLG',1,1104.1,1104.6),('2015-08-10','XAUUSD',1,1104.1,1104.6),('2015-08-11','LLG',1,1108.25,1108.75),('2015-08-11','XAUUSD',1,1108.25,1108.75),('2015-08-12','LLG',1,1123.65,1124.15),('2015-08-12','XAUUSD',1,1123.65,1124.15),('2015-08-13','LLG',1,1114.9,1115.4),('2015-08-13','XAUUSD',1,1114.9,1115.4),('2015-08-14','LLG',1,1115.05,1115.55),('2015-08-14','XAUUSD',1,1115.05,1115.55),('2015-08-17','LLG',1,1117.15,1117.65),('2015-08-17','XAUUSD',1,1117.15,1115.65),('2015-08-18','LLG',1,1117.5,1118),('2015-08-18','XAUUSD',1,1117.45,1117.95),('2015-08-19','LLG',1,1134.55,1134.05),('2015-08-19','XAUUSD',1,1133.5,1134.5),('2015-08-20','LLG',1,1152.5,1153),('2015-08-20','XAUUSD',1,1151.5,1152),('2015-08-21','LLG',1,1159.35,1159.85),('2015-08-21','XAUUSD',1,1159.35,1159.85),('2015-08-24','LLG',1,1153.75,1154.25),('2015-08-24','XAUUSD',1,1154.65,1155.65),('2015-08-25','LLG',1,1140.05,1140.55),('2015-08-25','XAUUSD',1,1140.35,1140.85),('2015-08-26','LLG',1,1123.6,1124.1),('2015-08-26','XAUUSD',1,1125.05,1125.55),('2015-08-27','LLG',1,1125.85,1126.35),('2015-08-27','XAUUSD',1,1124.4,1125.4),('2015-08-28','LLG',1,1134.05,1134.55),('2015-08-28','XAUUSD',1,1134.05,1134.55),('2015-08-29','LLG',1,1134.05,1134.55),('2015-08-29','XAUUSD',1,1134.05,1134.55),('2015-08-30','LLG',1,1134.05,1134.55),('2015-08-30','XAUUSD',1,1134.05,1134.55),('2015-08-31','LLG',1,1134.95,1135.45),('2015-08-31','XAUUSD',1,1134.7,1135.2),('2015-09-01','LLG',1,1139.9,1140.4),('2015-09-01','XAUUSD',1,1139.8,1140.8),('2015-09-02','LLG',1,1134.15,1134.65),('2015-09-02','XAUUSD',1,1133.8,1134.3),('2015-09-03','LLG',1,1125.35,1125.85),('2015-09-03','XAUUSD',1,1124.9,1125.9),('2015-09-04','LLG',0,1123,1123.5),('2015-09-07','LLG',1,1118.95,1119.45),('2015-09-07','XAUUSD',1,1118.95,1119.45),('2015-09-08','LLG',1,1121.8,1122.3),('2015-09-08','XAUUSD',1,1120.95,1121.95),('2015-09-09','LLG',1,1107.5,1108),('2015-09-09','XAUUSD',1,1107.5,1108),('2015-09-10','LLG',1,1110.4,1110.9),('2015-09-10','XAUUSD',1,1110.3,1111.3),('2015-09-11','LLG',1,1107.55,1108.05),('2015-09-11','XAUUSD',1,1107.55,1108.05),('2015-09-14','LLG',1,1108.75,1109.25),('2015-09-14','XAUUSD',1,1108.6,1109.1),('2015-09-15','LLG',1,1104.85,1105.35),('2015-09-15','XAUUSD',1,1104.8,1105.8),('2015-09-16','LLG',1,1119.35,1119.85),('2015-09-16','XAUUSD',1,1119,1120),('2015-09-17','LLG',1,1131.5,1132),('2015-09-17','XAUUSD',1,1131.05,1132.05),('2015-09-18','LLG',1,1138.8,1139.3),('2015-09-18','XAUUSD',1,1138.8,1139.3),('2015-09-19','LLG',1,1138.8,1139.3),('2015-09-19','XAUUSD',1,1138.8,1139.3),('2015-09-20','LLG',1,1138.8,1139.3),('2015-09-20','XAUUSD',1,1138.8,1139.3),('2015-09-21','LLG',1,1146.85,1147.35),('2015-09-21','XAUUSD',1,1132.9,1133.9),('2015-09-22','LLG',1,1125.25,1125.75),('2015-09-22','XAUUSD',1,1125.25,1125.75),('2015-09-23','LLG',1,1130.3,1130.8),('2015-09-23','XAUUSD',1,1130.3,1130.8),('2015-09-24','LLG',1,1152.85,1153.35),('2015-09-24','XAUUSD',1,1152.85,1153.35),('2015-09-25','LLG',1,1145.95,1146.45),('2015-09-25','XAUUSD',1,1145.95,1146.45),('2015-09-26','LLG',1,1145.95,1146.45),('2015-09-26','XAUUSD',1,1145.95,1146.45),('2015-09-27','LLG',1,1145.95,1146.45),('2015-09-27','XAUUSD',1,1145.95,1146.45),('2015-09-28','LLG',1,1132.2,1132.7),('2015-09-28','XAUUSD',1,1132.2,1132.7),('2015-09-29','LLG',1,1128.1,1128.6),('2015-09-29','XAUUSD',1,1128.1,1128.6),('2015-09-30','LLG',1,1115.25,1115.75),('2015-09-30','XAUUSD',1,1115.25,1115.75),('2015-10-01','LLG',1,1114.2,1114.7),('2015-10-01','XAUUSD',1,1114.2,1114.7),('2015-10-02','LLG',1,1137.8,1138.3),('2015-10-02','XAUUSD',1,1137.8,1138.3),('2015-10-03','LLG',1,1137.8,1138.3),('2015-10-03','XAUUSD',1,1137.8,1138.3),('2015-10-04','LLG',1,1137.8,1138.3),('2015-10-04','XAUUSD',1,1137.8,1138.3),('2015-10-05','LLG',1,1135.4,1135.9),('2015-10-05','XAUUSD',1,1135.4,1135.9),('2015-10-06','LLG',1,1146.85,1147.35),('2015-10-06','XAUUSD',1,1146.9,1147.4),('2015-10-07','LLG',1,1145.45,1145.95),('2015-10-07','XAUUSD',1,1145.45,1145.95),('2015-10-08','LLG',1,1139.1,1139.6),('2015-10-08','XAUUSD',1,1139.1,1139.6),('2015-10-09','LLG',1,1157,1157.5),('2015-10-09','XAUUSD',1,1156.95,1157.45),('2015-10-10','LLG',1,1157,1157.5),('2015-10-10','XAUUSD',1,1157,1157.5),('2015-10-11','LLG',1,1157,1157.5),('2015-10-11','XAUUSD',1,1157,1157.5),('2015-10-12','LLG',1,1163.9,1164.4),('2015-10-12','XAUUSD',1,1163.9,1164.4),('2015-10-13','LLG',1,1167.45,1167.95),('2015-10-13','XAUUSD',1,1167.6,1168.1),('2015-10-14','LLG',1,1187.55,1187.05),('2015-10-14','XAUUSD',1,1186.65,1187.15),('2015-10-15','LLG',1,1182.8,1183.3),('2015-10-15','XAUUSD',1,1182.8,1183.3),('2015-10-16','LLG',1,1175.75,1176.25),('2015-10-16','XAUUSD',1,1175.7,1176.2),('2015-10-17','LLG',1,1175.75,1176.25),('2015-10-17','XAUUSD',1,1175.75,1176.25),('2015-10-18','LLG',1,1175.75,1176.25),('2015-10-18','XAUUSD',1,1175.75,1176.25),('2015-10-19','LLG',1,1170.15,1170.65),('2015-10-19','XAUUSD',1,1170.2,1170.7),('2015-10-20','LLG',1,1177.35,1176.85),('2015-10-20','XAUUSD',1,1176.55,1177.05),('2015-10-21','LLG',1,1166.9,1167.4),('2015-10-21','XAUUSD',1,1166.75,1167.25),('2015-10-22','LLG',1,1165.65,1166.15),('2015-10-22','XAUUSD',1,1165.65,1166.15),('2015-10-23','LLG',1,1164.4,1164.9),('2015-10-23','XAUUSD',1,1164.35,1164.85),('2015-10-24','LLG',1,1164.4,1164.9),('2015-10-24','XAUUSD',1,1164.4,1164.9),('2015-10-25','LLG',1,1164.4,1164.9),('2015-10-25','XAUUSD',1,1164.4,1164.9),('2015-10-26','LLG',1,1163.55,1164.05),('2015-10-26','XAUUSD',1,1163.55,1164.05),('2015-10-27','LLG',1,1166.35,1166.85),('2015-10-27','XAUUSD',1,1166.35,1166.85);

/*Table structure for table `day_end_holidays` */

DROP TABLE IF EXISTS `day_end_holidays`;

CREATE TABLE `day_end_holidays` (
  `rolldate` date NOT NULL DEFAULT '0000-00-00',
  `description` text NOT NULL,
  PRIMARY KEY (`rolldate`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `day_end_holidays` */

/*Table structure for table `day_end_interest` */

DROP TABLE IF EXISTS `day_end_interest`;

CREATE TABLE `day_end_interest` (
  `rolldate` date NOT NULL DEFAULT '0000-00-00',
  `tradeid` bigint(20) NOT NULL DEFAULT '0',
  `interest` bigint(20) NOT NULL DEFAULT '0',
  PRIMARY KEY (`rolldate`,`tradeid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `day_end_interest` */

/*Table structure for table `day_end_reports` */

DROP TABLE IF EXISTS `day_end_reports`;

CREATE TABLE `day_end_reports` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `branchid` int(11) DEFAULT NULL,
  `rolldate` date DEFAULT NULL,
  `margin_in` bigint(20) DEFAULT NULL,
  `margin_out` bigint(20) DEFAULT NULL,
  `commission` bigint(20) DEFAULT NULL,
  `interest` float DEFAULT NULL,
  `balance` bigint(20) DEFAULT NULL,
  `floating` bigint(20) DEFAULT NULL,
  `p_and_l` bigint(20) DEFAULT NULL,
  `equity` bigint(20) DEFAULT NULL,
  `settled_units` bigint(20) DEFAULT NULL,
  `open_units` bigint(20) DEFAULT NULL,
  `equity_profit` bigint(20) DEFAULT NULL,
  `turnover` bigint(20) DEFAULT NULL,
  `adjust_in` bigint(20) DEFAULT NULL,
  `adjust_out` bigint(20) DEFAULT NULL,
  `storage` bigint(20) DEFAULT '0',
  `rolloverclosing` bigint(20) DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `day_end_reports` */

/*Table structure for table `day_end_rollover` */

DROP TABLE IF EXISTS `day_end_rollover`;

CREATE TABLE `day_end_rollover` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `rolldate` date DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `day_end_rollover` */

/*Table structure for table `day_end_status` */

DROP TABLE IF EXISTS `day_end_status`;

CREATE TABLE `day_end_status` (
  `status` char(1) NOT NULL DEFAULT 'y',
  `description` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `day_end_status` */

insert  into `day_end_status`(`status`,`description`) values ('y','Step 2b of 4:Dayend Account -Daily Report-Accountname:71171 at 183 of 1221');

/*Table structure for table `demo_lookup` */

DROP TABLE IF EXISTS `demo_lookup`;

CREATE TABLE `demo_lookup` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `branch` varchar(50) DEFAULT NULL,
  `group` varchar(50) DEFAULT NULL,
  `aecode` varchar(50) DEFAULT NULL,
  `last` int(11) DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `demo_lookup` */

insert  into `demo_lookup`(`Id`,`branch`,`group`,`aecode`,`last`) values (1,'DEM','COM','REG',182);

/*Table structure for table `donerec` */

DROP TABLE IF EXISTS `donerec`;

CREATE TABLE `donerec` (
  `tradeid` int(10) NOT NULL AUTO_INCREMENT,
  `rollover` varchar(8) NOT NULL DEFAULT '',
  `account` varchar(10) NOT NULL DEFAULT '',
  `counterid` varchar(10) NOT NULL DEFAULT '',
  `quantity` double NOT NULL DEFAULT '0',
  `buydate` varchar(8) DEFAULT NULL,
  `buyorder` smallint(5) DEFAULT NULL,
  `buyref` varchar(10) DEFAULT NULL,
  `buyprice` decimal(10,4) DEFAULT NULL,
  `selldate` varchar(8) DEFAULT NULL,
  `sellorder` smallint(5) DEFAULT NULL,
  `sellref` varchar(10) DEFAULT NULL,
  `sellprice` decimal(10,4) DEFAULT NULL,
  `liqstatus` char(1) DEFAULT NULL,
  `pl` double DEFAULT NULL,
  `interest` double DEFAULT NULL,
  `commission` double DEFAULT NULL,
  `storage` double DEFAULT NULL,
  `tax` double DEFAULT NULL,
  PRIMARY KEY (`tradeid`),
  KEY `done_acc` (`account`),
  KEY `border` (`buyorder`),
  KEY `sorder` (`sellorder`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `donerec` */

/*Table structure for table `dummy_bafile` */

DROP TABLE IF EXISTS `dummy_bafile`;

CREATE TABLE `dummy_bafile` (
  `AccNo` varchar(30) NOT NULL DEFAULT '',
  `MarginReq` decimal(20,3) NOT NULL DEFAULT '0.000',
  `Commission` decimal(20,3) DEFAULT '0.000',
  `FLCOMM` decimal(20,3) DEFAULT '0.000',
  `NewBal` decimal(20,3) DEFAULT '0.000',
  `PL` decimal(20,3) DEFAULT '0.000',
  PRIMARY KEY (`AccNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `dummy_bafile` */

/*Table structure for table `dummy_client_tradeorders` */

DROP TABLE IF EXISTS `dummy_client_tradeorders`;

CREATE TABLE `dummy_client_tradeorders` (
  `accountid` int(11) NOT NULL DEFAULT '0',
  `counter` varchar(20) NOT NULL DEFAULT '',
  `units` decimal(11,2) NOT NULL DEFAULT '0.00',
  `position` varchar(10) NOT NULL DEFAULT '',
  `rolldate` date NOT NULL DEFAULT '0000-00-00',
  `execute_price` decimal(20,5) NOT NULL DEFAULT '0.00000',
  `open_commission` int(11) NOT NULL DEFAULT '0',
  `online_tradeid` bigint(20) NOT NULL DEFAULT '0',
  `floating_commission` int(11) DEFAULT '0',
  `accountname` char(12) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `tradeid` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`online_tradeid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `dummy_client_tradeorders` */

/*Table structure for table `dummy_client_tradesettlements` */

DROP TABLE IF EXISTS `dummy_client_tradesettlements`;

CREATE TABLE `dummy_client_tradesettlements` (
  `tradeid` bigint(20) NOT NULL DEFAULT '0',
  `settlement_price` decimal(20,5) NOT NULL DEFAULT '0.00000',
  `rolldate` date NOT NULL DEFAULT '0000-00-00',
  `settle_time` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `units` decimal(11,2) NOT NULL DEFAULT '0.00',
  `status` varchar(20) NOT NULL DEFAULT 'CANCEL',
  `branchid` int(11) NOT NULL DEFAULT '0',
  `settled_commission` int(11) NOT NULL DEFAULT '0',
  `p_and_l` bigint(20) NOT NULL DEFAULT '0',
  `online_tradeid` bigint(20) NOT NULL,
  `accountname` char(12) DEFAULT NULL,
  PRIMARY KEY (`online_tradeid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 PACK_KEYS=0;

/*Data for the table `dummy_client_tradesettlements` */

/*Table structure for table `dummy_dafile` */

DROP TABLE IF EXISTS `dummy_dafile`;

CREATE TABLE `dummy_dafile` (
  `AccNo` varchar(30) NOT NULL DEFAULT '',
  `ItemCode` text NOT NULL,
  `ItemName` text NOT NULL,
  `Unit` int(11) NOT NULL DEFAULT '0',
  `BuyDate` text NOT NULL,
  `BuyPrice` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `SellDate` text NOT NULL,
  `SellPrice` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `PL` decimal(20,3) NOT NULL DEFAULT '0.000',
  `Interest` decimal(20,3) NOT NULL DEFAULT '0.000',
  `Storage` decimal(20,3) NOT NULL DEFAULT '0.000',
  `Commission` decimal(20,3) NOT NULL DEFAULT '0.000',
  `FLCOMM` decimal(20,3) DEFAULT '0.000',
  `LotSize` int(11) NOT NULL DEFAULT '0',
  `Format` text NOT NULL,
  `LiqStatus` text NOT NULL,
  `online_tradeid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`online_tradeid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `dummy_dafile` */

/*Table structure for table `dynamic_menu` */

DROP TABLE IF EXISTS `dynamic_menu`;

CREATE TABLE `dynamic_menu` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL DEFAULT '',
  `url` varchar(100) NOT NULL DEFAULT '',
  `menu_order` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `enable` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Data for the table `dynamic_menu` */

insert  into `dynamic_menu`(`id`,`parent_id`,`title`,`url`,`menu_order`,`enable`) values (1,0,'Home','home',1,1),(2,0,'About','about',2,1),(3,0,'Projects','projects',3,1),(4,3,'PHP','php',1,1),(5,3,'Ajax','ajax',2,1),(6,3,'ASP.Net','aspnet',4,1),(7,3,'Java','java',3,1),(8,0,'Portfolio','portfolio',4,1),(9,8,'Web Design','web-design',1,1),(10,8,'Graphic Design','graphic-design',2,1),(11,0,'Products','products',5,1),(12,11,'Hardware','hardware',1,1),(13,11,'Software','software',2,1),(14,11,'Furniture','furniture',3,1),(15,4,'Table','table',2,1),(16,14,'Chair','chair',1,1),(17,14,'Cabinet','cabinet',3,1),(18,13,'Operating System','operating-system',1,1),(19,13,'Office Application','office-application',2,1),(20,0,'Contact Us','contact-us',6,1);

/*Table structure for table `ekanilai` */

DROP TABLE IF EXISTS `ekanilai`;

CREATE TABLE `ekanilai` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `counterid` varchar(10) DEFAULT NULL,
  `buyqty` mediumint(8) DEFAULT NULL,
  `price` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `sellqty` mediumint(8) DEFAULT NULL,
  `duration` char(3) DEFAULT NULL,
  `timecreated` timestamp NULL DEFAULT NULL,
  `kbeli` mediumint(9) DEFAULT NULL,
  `kjual` mediumint(9) DEFAULT NULL,
  `minimax` mediumint(9) DEFAULT NULL,
  `selisih` mediumint(9) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `ekanilai` */

/*Table structure for table `email` */

DROP TABLE IF EXISTS `email`;

CREATE TABLE `email` (
  `timesend` datetime DEFAULT '1970-01-31 00:00:00',
  `timeupdate` datetime DEFAULT NULL,
  `email_to` varchar(100) DEFAULT NULL,
  `email_subject` varchar(255) DEFAULT NULL,
  `email_body` text,
  `module` varchar(200) DEFAULT NULL COMMENT 'Program Wallet,Education,MLM,Trado'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `email` */

insert  into `email`(`timesend`,`timeupdate`,`email_to`,`email_subject`,`email_body`,`module`) values ('1970-01-31 00:00:00','2016-04-14 17:18:00','tarikh@si.co.id','Thank you for your registration in Apex Regent Program ','Dear Sir / Madam,<br> <br> <br>We have received an application on our Apex Regent Program via this email: tarikh@si.co.id, in order to confirm your application, please click or copy the link <br> <br><a href=http://apexregent.com/web2/openaccount3_approval.php?key=rG12Hh,1OJ03BrIu0123qHIz1QroLd123k123mYfbBVu37IbSvep4jErOETXfEnspOjeIrh7PDOyRXf5pvLlGMH38Ev1LpKWDS6iA>http://apexregent.com/web2/openaccount3_approval.php?key=rG12Hh,1OJ03BrIu0123qHIz1QroLd123k123mYfbBVu37IbSvep4jErOETXfEnspOjeIrh7PDOyRXf5pvLlGMH38Ev1LpKWDS6iA</a> <br> <br>Please ignore this email if you did not apply for it <br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>',NULL),('1970-01-31 00:00:00','2016-04-14 17:37:00','tarikh@si.co.id','New Account 160414171 has been created','Time: 2016-04-14 17:37<br> <br>Dear  Tarikh Agustia  ,<br> <br>Your New Account has been created <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>',NULL),('1970-01-31 00:00:00','2016-04-14 18:50:55','tarikh@si.co.id','Payment Confirmation','Dear Tarikh Agustia,<br> <br>Thank you for submitting payment documents, we will confirm your payment within 1 x 24 hours, if you have any questions please contact us at <strong>finance@apexregent.com</strong> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_payment'),('1970-01-31 00:00:00','2016-04-14 17:57:00','tarikh@si.co.id','Reseting Password at Apex Regent Program ','Time: 2016-04-14 17:57<br><br>Dear Tarikh Agustia ,<br> <br>We have received request to reset your password for Email ID : tarikh@si.co.id <br> <br>Please click this link below to start reseting the password <br> <br>http://cabinet.apexregent.com/web2/forgetpasswordreset.php?key=rG04a123ur8123FxyE1cISoaIaEZsuPlmMhBb4,sYH,pYvmVMZcqzQHrM9eIhU,fIJomrwjjCpTZdO123j3OaQDQ <br> <br>or if you do not ask for the request, Please ignore this email <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>',NULL),('1970-01-31 00:00:00','2016-04-14 17:57:00','tarikh@si.co.id','Reseting Password at Apex Regent Program ','Time: 2016-04-14 17:57<br><br>Dear Tarikh Agustia ,<br> <br>We have received request to reset your password for Email ID : tarikh@si.co.id <br> <br>Please click this link below to start reseting the password <br> <br>http://cabinet.apexregent.com/web2/forgetpasswordreset.php?key=rG04a123ur8123FxyE1cISoaIaEZsuPlmMhBb4,sYH,pYvmVMZcqzQHrM9eIhU,fIJomrwjjCpTZdO123j3OaQDQ <br> <br>or if you do not ask for the request, Please ignore this email <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>',NULL),('1970-01-31 00:00:00','2016-04-14 18:03:00','test01@si.co.id','New Account 160414181 has been created','Time: 2016-04-14 18:03<br> <br>Dear  Test Kosong Satu  ,<br> <br>Your New Account has been created <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>',NULL),('1970-01-31 00:00:00','2016-04-14 19:04:37','test01@si.co.id','Payment Confirmation','Dear Test Kosong Satu,<br> <br>Thank you for submitting payment documents, we will confirm your payment within 1 x 24 hours, if you have any questions please contact us at <strong>finance@apexregent.com</strong> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_payment'),('1970-01-31 00:00:00','2016-04-14 18:05:42','','Congratulations, you have got a bonus','Time: 2016-04-14 18:05:42<br> <br>Dear AE1,<br> <br>Congratulations, you have earned <b>WEALTH REFERRAL BONUS (W.R.B)</b> bonus of USD 90.00 from your Downline : 160414171 <br>This bonus will be split into two type Account (6% goes to E-Wallet / 1% goes to Gold Saving Account) <br> <br>You may login to your APR program account via our website at http://www.apexregent.com <br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_multi'),('1970-01-31 00:00:00','2016-04-14 18:05:42','admin@si.co.id','Congratulations, you have got a bonus','Time: 2016-04-14 18:05:42<br> <br>Dear AE1,<br> <br>Congratulations, you have earned <b>WEALTH REFERRAL BONUS (W.R.B)</b> bonus of USD 90.00 from your Downline : 160414171 <br>This bonus will be split into two type Account (6% goes to E-Wallet / 1% goes to Gold Saving Account) <br> <br>You may login to your APR program account via our website at http://www.apexregent.com <br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_payment_table'),('1970-01-31 00:00:00','2016-04-14 18:05:42','','Your payment has been confirmed','Time: 2016-04-14 18:05<br> <br>Dear  Tarikh Agustia,<br> <br>We have confirmed your payment for Account 160414171 (Club Package) <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_multi'),('1970-01-31 00:00:00','2016-04-14 18:05:00','tarikh@si.co.id','Your payment has been confirmed','Time: 2016-04-14 18:05<br> <br>Dear  Tarikh Agustia,<br> <br>We have confirmed your payment for Account 160414171 (Club Package) <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_payment_table'),('1970-01-31 00:00:00','2016-04-14 18:09:22','test01@si.co.id','Congratulations, you have got a bonus','Time: 2016-04-14 18:09:22<br> <br>Dear Test Kosong Satu,<br> <br>Congratulations, you have earned <b>WEALTH REFERRAL BONUS (W.R.B)</b> bonus of USD 75.00 from your Downline : 160414181 <br>This bonus will be split into two type Account (6% goes to E-Wallet / 1% goes to Gold Saving Account) <br> <br>You may login to your APR program account via our website at http://www.apexregent.com <br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_payment_table'),('1970-01-31 00:00:00','2016-04-14 18:09:00','test01@si.co.id','Your payment has been confirmed','Time: 2016-04-14 18:09<br> <br>Dear  Test Kosong Satu,<br> <br>We have confirmed your payment for Account 160414181 (Club Package) <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_payment_table'),('1970-01-31 00:00:00','2016-04-14 18:10:33','test03@si.co.id','Congratulations, you have got a bonus','Time: 2016-04-14 18:10:33<br> <br>Dear Test Kosong Tiga,<br> <br>Congratulations, you have earned <b>WEALTH CLUB DIVIDEND (W.C.D)</b> bonus of USD 27.50 <br>This bonus will be split into two type Account (70% goes to E-Wallet / 30% goes to Gold Saving Account) <br> <br>You may login to your APR program account via our website at http://www.apexregent.com <br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_wcd'),('1970-01-31 00:00:00','2016-04-14 18:10:53','test03@si.co.id','Congratulations, you have got a bonus','Time: 2016-04-14 18:10:53<br> <br>Dear Test Kosong Tiga,<br> <br>Congratulations, you have earned <b>RANK QUALIFICATION BONUS (R.Q.B)</b> bonus of USD 30.00 <br>This bonus will be split into two type Account (70% goes to E-Wallet / 30% goes to Gold Saving Account) <br> <br>You may login to your APR program account via our website at http://www.apexregent.com <br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_rqb'),('1970-01-31 00:00:00','2016-04-14 18:19:34','test01@si.co.id','Congratulations, you have got a bonus','Time: 2016-04-14 18:19:34<br> <br>Dear Test Kosong Satu,<br> <br>Congratulations, you have earned <b>WEALTH CLUB DIVIDEND (W.C.D)</b> bonus of USD 13.75 <br>This bonus will be split into two type Account (70% goes to E-Wallet / 30% goes to Gold Saving Account) <br> <br>You may login to your APR program account via our website at http://www.apexregent.com <br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_wcd'),('1970-01-31 00:00:00','2016-04-15 13:51:31','test01@si.co.id','Transfer Notification','Time: 2016-04-15 13:51:31<br> <br>Dear Test Kosong Satu,<br> <br>application for transfer from account 160406121 to account 160406121 amounting to USD 330.0000, <b>we have approved.</b><br> <br>You may login to your Apex Regent Program account via our website at http://apexregent.com <br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_transfer_do'),('1970-01-31 00:00:00','2016-04-15 13:51:31','test01@si.co.id','Transfer Notification','Time: 2016-04-15 13:51:31<br> <br>Dear Test Kosong Satu,<br> <br>you have received from 160406121 transfer of USD 330.0000<br> <br>You may login to your Apex Regent Program account via our website at http://apexregent.com <br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_transfer_do'),('1970-01-31 00:00:00','2016-04-15 13:54:52','test02@si.co.id','Transfer Notification','Time: 2016-04-15 13:54:52<br> <br>Dear Test Kosong Dua,<br> <br>application for transfer from account 160406171 to account 160412173 amounting to USD 600.0000, <b>we have approved.</b><br> <br>You may login to your Apex Regent Program account via our website at http://apexregent.com <br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_transfer_do'),('1970-01-31 00:00:00','2016-04-15 13:54:52','test02@si.co.id','Transfer Notification','Time: 2016-04-15 13:54:52<br> <br>Dear Test Kosong Dua,<br> <br>you have received from 160406171 transfer of USD 600.0000<br> <br>You may login to your Apex Regent Program account via our website at http://apexregent.com <br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_transfer_do'),('1970-01-31 00:00:00','2016-04-18 08:28:49','test02@si.co.id','Transfer Notification','Time: 2016-04-18 08:28:49<br> <br>Dear Test Kosong Dua,<br> <br>application for transfer from account 160406171 to account 160412161 amounting to USD 800.0000, <b>we have approved.</b><br> <br>You may login to your Apex Regent Program account via our website at http://apexregent.com <br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_transfer_do'),('1970-01-31 00:00:00','2016-04-18 08:28:49','test02@si.co.id','Transfer Notification','Time: 2016-04-18 08:28:49<br> <br>Dear Test Kosong Dua,<br> <br>you have received from 160406171 transfer of USD 800.0000<br> <br>You may login to your Apex Regent Program account via our website at http://apexregent.com <br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_transfer_do'),('1970-01-31 00:00:00','2016-04-18 08:37:10','test02@si.co.id','Transfer Notification','Time: 2016-04-18 08:37:10<br> <br>Dear Test Kosong Dua,<br> <br>application for transfer from account 160406171 to account 160406171 amounting to USD 1000.0000, <b>we have approved.</b><br> <br>You may login to your Apex Regent Program account via our website at http://apexregent.com <br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_transfer_do'),('1970-01-31 00:00:00','2016-04-18 08:37:11','test02@si.co.id','Transfer Notification','Time: 2016-04-18 08:37:11<br> <br>Dear Test Kosong Dua,<br> <br>you have received from 160406171 transfer of USD 1000.0000<br> <br>You may login to your Apex Regent Program account via our website at http://apexregent.com <br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_transfer_do'),('1970-01-31 00:00:00','2016-04-18 08:55:40','test02@si.co.id','Transfer Notification','Time: 2016-04-18 08:55:40<br> <br>Dear Test Kosong Dua,<br> <br>application for transfer from account 160406171 to account 160412151 amounting to USD 600.0000, <b>we have approved.</b><br> <br>You may login to your Apex Regent Program account via our website at http://apexregent.com <br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_transfer_do'),('1970-01-31 00:00:00','2016-04-18 08:55:40','test02@si.co.id','Transfer Notification','Time: 2016-04-18 08:55:40<br> <br>Dear Test Kosong Dua,<br> <br>you have received from 160406171 transfer of USD 600.0000<br> <br>You may login to your Apex Regent Program account via our website at http://apexregent.com <br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_transfer_do'),('1970-01-31 00:00:00','2016-04-18 08:56:52','test02@si.co.id','Transfer Notification','Time: 2016-04-18 08:56:52<br> <br>Dear Test Kosong Dua,<br> <br>application for transfer from account 160406171 to account 160409111 amounting to USD 687.0000, <b>we have approved.</b><br> <br>You may login to your Apex Regent Program account via our website at http://apexregent.com <br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_transfer_do'),('1970-01-31 00:00:00','2016-04-18 08:56:52','test02@si.co.id','Transfer Notification','Time: 2016-04-18 08:56:52<br> <br>Dear Test Kosong Dua,<br> <br>you have received from 160406171 transfer of USD 687.0000<br> <br>You may login to your Apex Regent Program account via our website at http://apexregent.com <br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_transfer_do'),('1970-01-31 00:00:00','2016-04-18 11:42:50','admin@apexregent.com','Notice of transfer fees','Time: 2016-04-18 11:42:50<br> <br>Dear COMPANY,<br> <br>Companies get income from Transfer fees of Apex Regent Program account. from account 160406121 to account 160414181 amounting to USD 50.0000, COMPANY only get USD 1.00 from this transaction<br> <br>and has been added to the wallet companies<br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_transfer_do'),('1970-01-31 00:00:00','2016-04-18 11:42:51','test01@si.co.id','Transfer Notification','Time: 2016-04-18 11:42:51<br> <br>Dear Test Kosong Satu,<br> <br>application for transfer from account 160406121 to account 160414181 amounting to USD 50.0000, <b>we have approved.</b><br> <br>You may login to your Apex Regent Program account via our website at http://apexregent.com <br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_transfer_do'),('1970-01-31 00:00:00','2016-04-18 11:42:51','test01@si.co.id','Transfer Notification','Time: 2016-04-18 11:42:51<br> <br>Dear Test Kosong Satu,<br> <br>you have received from 160406121 transfer of USD 50.0000<br> <br>You may login to your Apex Regent Program account via our website at http://apexregent.com <br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_transfer_do'),('1970-01-31 00:00:00','2016-04-18 11:47:40','admin@apexregent.com','Notice of transfer fees','Time: 2016-04-18 11:47:40<br> <br>Dear COMPANY,<br> <br>Companies get income from Transfer fees of Apex Regent Program account. from account 160406121 to account 160414181 amounting to USD 50.0000, COMPANY only get USD 1.00 from this transaction<br> <br>and has been added to the wallet companies<br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_transfer_do'),('1970-01-31 00:00:00','2016-04-18 11:47:40','test01@si.co.id','Transfer Notification','Time: 2016-04-18 11:47:40<br> <br>Dear Test Kosong Satu,<br> <br>application for transfer from account 160406121 to account 160414181 amounting to USD 50.0000, <b>we have approved.</b><br> <br>You may login to your Apex Regent Program account via our website at http://apexregent.com <br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_transfer_do'),('1970-01-31 00:00:00','2016-04-18 11:47:40','test01@si.co.id','Transfer Notification','Time: 2016-04-18 11:47:40<br> <br>Dear Test Kosong Satu,<br> <br>you have received from 160406121 transfer of USD 50.0000<br> <br>You may login to your Apex Regent Program account via our website at http://apexregent.com <br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_transfer_do'),('1970-01-31 00:00:00','2016-04-18 13:00:01','test02@si.co.id','Transfer Notification','Time: 2016-04-18 13:00:01<br> <br>Dear Test Kosong Dua,<br> <br>application for transfer from account 160406171 to account 160406171 amounting to USD 200.0000, <b>we have approved.</b><br> <br>You may login to your Apex Regent Program account via our website at http://apexregent.com <br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_transfer_do'),('1970-01-31 00:00:00','2016-04-18 13:00:01','test02@si.co.id','Transfer Notification','Time: 2016-04-18 13:00:01<br> <br>Dear Test Kosong Dua,<br> <br>you have received from 160406171 transfer of USD 200.0000<br> <br>You may login to your Apex Regent Program account via our website at http://apexregent.com <br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_transfer_do'),('1970-01-31 00:00:00','2016-04-18 13:23:00','test02@si.co.id','New Account 160418131 has been created','Time: 2016-04-18 13:23<br> <br>Dear  Test Kosong Dua  ,<br> <br>Your New Account has been created <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>',NULL),('1970-01-31 00:00:00','2016-04-18 14:24:46','test02@si.co.id','Payment Confirmation','Dear Test Kosong Dua,<br> <br>Thank you for submitting payment documents, we will confirm your payment within 1 x 24 hours, if you have any questions please contact us at <strong>finance@apexregent.com</strong> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_payment'),('1970-01-31 00:00:00','2016-04-18 13:25:54','test03@si.co.id','Congratulations, you have got a bonus','Time: 2016-04-18 13:25:54<br> <br>Dear Test Kosong Tiga,<br> <br>Congratulations, you have earned <b>WEALTH REFERRAL BONUS (W.R.B)</b> bonus of USD 45.00 from your Downline : 160412151 <br>This bonus will be split into two type Account (6% goes to E-Wallet / 1% goes to Gold Saving Account) <br> <br>You may login to your APR program account via our website at http://www.apexregent.com <br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_payment_table'),('1970-01-31 00:00:00','2016-04-18 13:25:00','test02@si.co.id','Your payment has been confirmed','Time: 2016-04-18 13:25<br> <br>Dear  Test Kosong Dua,<br> <br>We have confirmed your payment for Account 160412151 (Club Package) <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_payment_table'),('1970-01-31 00:00:00','2016-04-18 13:55:00','test01@si.co.id','New Account 160418132 has been created','Time: 2016-04-18 13:55<br> <br>Dear  Test Kosong Satu  ,<br> <br>Your New Account has been created <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>',NULL),('1970-01-31 00:00:00','2016-04-18 19:25:00','test01@si.co.id','New Account 160418191 has been created','Time: 2016-04-18 19:25<br> <br>Dear  Test Kosong Satu  ,<br> <br>Your New Account has been created <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>',NULL),('1970-01-31 00:00:00','2016-04-18 20:26:09','test01@si.co.id','Payment Confirmation','Dear Test Kosong Satu,<br> <br>Thank you for submitting payment documents, we will confirm your payment within 1 x 24 hours, if you have any questions please contact us at <strong>finance@apexregent.com</strong> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_payment'),('1970-01-31 00:00:00','2016-04-18 20:29:43','test01@si.co.id','Payment Confirmation','Dear Test Kosong Satu,<br> <br>Thank you for submitting payment documents, we will confirm your payment within 1 x 24 hours, if you have any questions please contact us at <strong>finance@apexregent.com</strong> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_payment'),('1970-01-31 00:00:00','2016-04-18 19:31:51','admin@apexregent.com','Company get income from account 160418191','Time: 2016-04-18 19:31:51<br> <br>Dear Apex Regent Investment Limited,<br> <br>Company get income from account : 160418191 For Club Package of USD 500.00<br> <br>You may login to your APR program account via our website at http://www.apexregent.com <br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_payment_table'),('1970-01-31 00:00:00','2016-04-18 19:31:52','admin@apexregent.com','Congratulations, you have got a bonus','Time: 2016-04-18 19:31:52<br> <br>Dear AE1,<br> <br>Congratulations, you have earned <b>WEALTH REFERRAL BONUS (W.R.B)</b> bonus of USD 45.00 from your Downline : 160418191 <br>This bonus will be split into two type Account (6% goes to E-Wallet / 1% goes to Gold Saving Account) <br> <br>You may login to your APR program account via our website at http://www.apexregent.com <br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_payment_table'),('1970-01-31 00:00:00','2016-04-18 19:31:00','test01@si.co.id','Your payment has been confirmed','Time: 2016-04-18 19:31<br> <br>Dear  Test Kosong Satu,<br> <br>We have confirmed your payment for Account 160418191 (Club Package) <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_payment_table'),('1970-01-31 00:00:00','2016-04-18 19:47:00','test01@si.co.id','Reseting Password at Apex Regent Program ','Time: 2016-04-18 19:47<br><br>Dear Test Kosong Satu ,<br> <br>We have received request to reset your password for Email ID : test01@si.co.id <br> <br>Please click this link below to start reseting the password <br> <br>http://cabinet.apexregent.com/web2/forgetpasswordreset.php?key=rG04a123ur8123FxyE1cISoaIaD9Tx3hmMhBb4,sYH,pYvmVMZcqzQHrM9eIhU,fIJomrwjjCpTZdO123j0ryQbw <br> <br>or if you do not ask for the request, Please ignore this email <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>',NULL),('1970-01-31 00:00:00','2016-04-18 20:01:00','test01@si.co.id','Reseting Password at Apex Regent Program ','Time: 2016-04-18 20:01<br><br>Dear Test Kosong Satu ,<br> <br>We have received request to reset your password for Email ID : test01@si.co.id <br> <br>Please click this link below to start reseting the password <br> <br><a href=http://cabinet.apexregent.com/web2/forgetpasswordreset.php?key=rG04a123ur8123FxyE1cISoaIaD9Tx3hmMhBb4,sYH,pYvmVMZcqzQHrM9eIhU,fIJomrwjjCpTZdO123j0ryQbw> <br> <br>or if you do not ask for the request, Please ignore this email <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>',NULL),('1970-01-31 00:00:00','2016-04-18 20:03:00','test01@si.co.id','Reseting Password at Apex Regent Program ','Time: 2016-04-18 20:03<br><br>Dear Test Kosong Satu ,<br> <br>We have received request to reset your password for Email ID : test01@si.co.id <br> <br>Please click this link below to start reseting the password <br> <br><a href=http://cabinet.apexregent.com/web2/forgetpasswordreset.php?key=rG04a123ur8123FxyE1cISoaIaD9Tx3hmMhBb4,sYH,pYvmVMZcqzQHrM9eIhU,fIJomrwjjCpTZdO123j0ryQbw>http://cabinet.apexregent.com/web2/forgetpasswordreset.php?key=rG04a123ur8123FxyE1cISoaIaD9Tx3hmMhBb4,sYH,pYvmVMZcqzQHrM9eIhU,fIJomrwjjCpTZdO123j0ryQbw</a> <br> <br>or if you do not ask for the request, Please ignore this email <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>',NULL),('1970-01-31 00:00:00','2016-04-19 09:51:00','test02@si.co.id','New Account 160419091 has been created','Time: 2016-04-19 09:51<br> <br>Dear  Test Kosong Dua  ,<br> <br>Your New Account has been created <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>',NULL),('1970-01-31 00:00:00','2016-04-19 09:53:00','test02@si.co.id','New Account 160419092 has been created','Time: 2016-04-19 09:53<br> <br>Dear  Test Kosong Dua  ,<br> <br>Your New Account has been created <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>',NULL),('1970-01-31 00:00:00','2016-04-19 10:03:00','test03@si.co.id','New Account 160419101 has been created','Time: 2016-04-19 10:03<br> <br>Dear  Test Kosong Tiga  ,<br> <br>Your New Account has been created <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>',NULL),('1970-01-31 00:00:00','2016-04-19 11:48:00','test05@si.co.id','Thank you for your registration in Apex Regent Program ','Dear Sir / Madam,<br> <br> <br>We have received an application on our Apex Regent Program via this email: test05@si.co.id, in order to confirm your application, please click or copy the link <br> <br><a href=http://cabinet.apexregent.com/web2/openaccount3_approval.php?key=rG12HpXxOJ03A6JKfkJvV8bB0W8RtY123YoMZB1lQgD123JzaQ3O6HEQRiIZUNaGvMJZY084F0IajotDIWmegFQHhpVLlw>http://cabinet.apexregent.com/web2/openaccount3_approval.php?key=rG12HpXxOJ03A6JKfkJvV8bB0W8RtY123YoMZB1lQgD123JzaQ3O6HEQRiIZUNaGvMJZY084F0IajotDIWmegFQHhpVLlw</a> <br> <br>Please ignore this email if you did not apply for it <br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>',NULL),('1970-01-31 00:00:00','2016-04-19 11:51:00','test08@si.co.id','Thank you for your registration in Apex Regent Program ','Dear Sir / Madam,<br> <br> <br>We have received an application on our Apex Regent Program via this email: test08@si.co.id, in order to confirm your application, please click or copy the link <br> <br><a href=http://cabinet.apexregent.com/web2/openaccount3_approval.php?key=rG04a123ur82Byyq4gJ9IaRrxjDgVbZE1b84p3123hhwZh9z0hGuNwVyNrVv5CnbRfgl0123yEbHNc98TpY0iwWdT5CwH123I9I>http://cabinet.apexregent.com/web2/openaccount3_approval.php?key=rG04a123ur82Byyq4gJ9IaRrxjDgVbZE1b84p3123hhwZh9z0hGuNwVyNrVv5CnbRfgl0123yEbHNc98TpY0iwWdT5CwH123I9I</a> <br> <br>Please ignore this email if you did not apply for it <br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>',NULL),('1970-01-31 00:00:00','2016-04-19 12:16:00','test07@si.co.id','Thank you for your registration in Apex Regent Program ','Dear Sir / Madam,<br> <br> <br>We have received an application on our Apex Regent Program via this email: test07@si.co.id, in order to confirm your application, please click or copy the link <br> <br><a href=http://cabinet.apexregent.com/web2/openaccount3_approval.php?key=rG04a123ur82Byyq4gJ9IaRrzjCQVbZE1b84p3123hhwZh9z0hGuNwVyNrVv5CnbRfgl0123yEbHNc98TpY0iwWdT5CwEtI9U>http://cabinet.apexregent.com/web2/openaccount3_approval.php?key=rG04a123ur82Byyq4gJ9IaRrzjCQVbZE1b84p3123hhwZh9z0hGuNwVyNrVv5CnbRfgl0123yEbHNc98TpY0iwWdT5CwEtI9U</a> <br> <br>Please ignore this email if you did not apply for it <br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>',NULL),('1970-01-31 00:00:00','2016-04-20 08:58:46','admin@apexregent.com','A Withdrawal request from 160419092','Time: 2016-04-20 08:58:46<br> <br>Dear Apex Regent Investment Limited,<br> <br>Withdrawal requests from user 1234 of USD 3000 , check the Apex Regent Program to confirm after transfer<br> <br>You may login to your APR program account via our website at http://apexregent.com <br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','Withdrawal_do'),('1970-01-31 00:00:00','2016-04-20 09:04:43','admin@apexregent.com','A Withdrawal request from 160419091','Time: 2016-04-20 09:04:43<br> <br>Dear Apex Regent Investment Limited,<br> <br>Withdrawal requests from user 1234 of USD 200 , check the Apex Regent Program to confirm after transfer<br> <br>You may login to your APR program account via our website at http://apexregent.com <br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','Withdrawal_do'),('1970-01-31 00:00:00','2016-04-20 10:59:52','test02@si.co.id','Withdrawal request','Time: 2016-04-20 10:59:52<br> <br>Dear Test Kosong Dua,<br> <br>Companies has reject your withdrawal request because your balance for account 160419091 is not enought<br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_withdrawal'),('1970-01-31 00:00:00','2016-04-20 11:00:42','test02@si.co.id','Withdrawal request','Time: 2016-04-20 11:00:42<br> <br>Dear Test Kosong Dua,<br> <br>Companies has approved your withdrawal request for account 160419092 of USD 3000.0000<br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_withdrawal'),('1970-01-31 00:00:00','2016-04-20 11:01:46','test02@si.co.id','Withdrawal request','Time: 2016-04-20 11:01:46<br> <br>Dear Test Kosong Dua,<br> <br>Companies has reject your withdrawal request because your balance for account 160419091 is not enought<br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_withdrawal'),('1970-01-31 00:00:00','2016-04-29 08:59:38','test02@si.co.id','Account closing information','Time: 2016-04-29 08:59:38<br> <br>Dear Tarikh,<br> <br>We inform you that your account number 160419091 we have disable, because you have not made any payments as of 5 days after you register your account. <br>thanks you have participated in our program<br> <br> <br>Thank you,<br><br><strong></strong><br> Email :  <br>  <br>','ar_admin_checkaccount'),('1970-01-31 00:00:00','2016-04-29 08:59:39','test02@si.co.id','Account closing information','Time: 2016-04-29 08:59:39<br> <br>Dear Tarikh,<br> <br>We inform you that your account number 160419092 we have disable, because you have not made any payments as of 5 days after you register your account. <br>thanks you have participated in our program<br> <br> <br>Thank you,<br><br><strong></strong><br> Email :  <br>  <br>','ar_admin_checkaccount'),('1970-01-31 00:00:00','2016-04-29 08:59:39','test03@si.co.id','Account closing information','Time: 2016-04-29 08:59:39<br> <br>Dear Tarikh,<br> <br>We inform you that your account number 160419101 we have disable, because you have not made any payments as of 5 days after you register your account. <br>thanks you have participated in our program<br> <br> <br>Thank you,<br><br><strong></strong><br> Email :  <br>  <br>','ar_admin_checkaccount'),('1970-01-31 00:00:00','2016-04-29 09:01:15','test02@si.co.id','Account closing information','Time: 2016-04-29 09:01:15<br> <br>Dear Tarikh,<br> <br>We inform you that your account number 160419091 we have disable, because you have not made any payments as of 5 days after you register your account. <br>thanks you have participated in our program<br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_checkaccount'),('1970-01-31 00:00:00','2016-04-29 09:01:15','test02@si.co.id','Account closing information','Time: 2016-04-29 09:01:15<br> <br>Dear Tarikh,<br> <br>We inform you that your account number 160419092 we have disable, because you have not made any payments as of 5 days after you register your account. <br>thanks you have participated in our program<br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_checkaccount'),('1970-01-31 00:00:00','2016-04-29 09:01:15','test03@si.co.id','Account closing information','Time: 2016-04-29 09:01:15<br> <br>Dear Tarikh,<br> <br>We inform you that your account number 160419101 we have disable, because you have not made any payments as of 5 days after you register your account. <br>thanks you have participated in our program<br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_checkaccount'),('1970-01-31 00:00:00','2016-04-29 09:02:15','test02@si.co.id','Account closing information','Time: 2016-04-29 09:02:15<br> <br>Dear Tarikh,<br> <br>We inform you that your account number 160419091 we have disable, because you have not made any payments as of 5 days after you register your account. <br>thanks you have participated in our program<br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_checkaccount'),('1970-01-31 00:00:00','2016-04-29 09:02:16','test02@si.co.id','Account closing information','Time: 2016-04-29 09:02:16<br> <br>Dear Tarikh,<br> <br>We inform you that your account number 160419092 we have disable, because you have not made any payments as of 5 days after you register your account. <br>thanks you have participated in our program<br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_checkaccount'),('1970-01-31 00:00:00','2016-04-29 09:02:16','test03@si.co.id','Account closing information','Time: 2016-04-29 09:02:16<br> <br>Dear Tarikh,<br> <br>We inform you that your account number 160419101 we have disable, because you have not made any payments as of 5 days after you register your account. <br>thanks you have participated in our program<br> <br> <br>Thank you,<br><br><strong>Apex Regent Investment Limited</strong><br>LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br> Email : cabinet@apexregent.com <br> http://apexregent.com <br>','ar_admin_checkaccount');

/*Table structure for table `executelog` */

DROP TABLE IF EXISTS `executelog`;

CREATE TABLE `executelog` (
  `tradeid` int(10) unsigned NOT NULL DEFAULT '0',
  `symbol` varchar(20) NOT NULL DEFAULT '',
  `orderprice` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `last` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `sell` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `buy` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`tradeid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `executelog` */

/*Table structure for table `group` */

DROP TABLE IF EXISTS `group`;

CREATE TABLE `group` (
  `groupid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `description` varchar(30) NOT NULL DEFAULT '',
  `imageurl` varchar(100) NOT NULL DEFAULT '',
  `isadmin` tinyint(4) NOT NULL DEFAULT '0',
  `issupervisor` tinyint(4) NOT NULL DEFAULT '0',
  `ismanager` tinyint(4) NOT NULL DEFAULT '0',
  `isamanager` tinyint(4) NOT NULL DEFAULT '0',
  `isbranchselect` tinyint(3) DEFAULT '0',
  `tampil` char(3) DEFAULT 'yes',
  PRIMARY KEY (`groupid`),
  KEY `groupid` (`groupid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `group` */

insert  into `group`(`groupid`,`description`,`imageurl`,`isadmin`,`issupervisor`,`ismanager`,`isamanager`,`isbranchselect`,`tampil`) values (1,'Client','images/user_client.gif',0,0,0,0,0,'yes'),(2,'Client View','images/user_client.gif',0,0,0,0,0,'yes'),(3,'AE Select','images/user_ae.gif',0,0,0,0,0,'yes'),(4,'AE View','images/user_ae.gif',0,0,0,0,0,'yes'),(5,'AE Show All','images/user_ae.gif',0,0,0,0,0,'yes'),(6,'Manager','images/user_manager.gif',0,0,1,0,0,'yes'),(7,'Asst. Manager','images/user_amanager.gif',0,0,1,1,0,'yes'),(8,'Supervisor','images/user_supervisor.gif',0,1,0,0,0,'yes'),(9,'Administrator','images/user_admin.gif',1,0,0,0,0,'yes'),(10,'Tester','images/user_admin.gif',0,0,0,0,0,'no'),(11,'Group All','images/user_amanager.gif',0,0,0,0,0,'no'),(12,'Group Select','images/user_amanager.gif',0,0,0,0,1,'yes'),(13,'DQ Trigger','images/user_admin.gif',0,0,0,0,0,'yes'),(15,'APR','images/user_amanager.gif',0,0,0,0,0,'yes');

/*Table structure for table `iafile` */

DROP TABLE IF EXISTS `iafile`;

CREATE TABLE `iafile` (
  `IntTable` varchar(50) NOT NULL DEFAULT '',
  `AUDBUY` float NOT NULL DEFAULT '0',
  `AUDSELL` float NOT NULL DEFAULT '0',
  `AUDSIZE` bigint(20) NOT NULL DEFAULT '0',
  `EURJPYBUY` float NOT NULL DEFAULT '0',
  `EURJPYSELL` float NOT NULL DEFAULT '0',
  `EURJPYSIZE` bigint(20) NOT NULL DEFAULT '0',
  `EURBUY` float NOT NULL DEFAULT '0',
  `EURSELL` float NOT NULL DEFAULT '0',
  `EURSIZE` bigint(20) NOT NULL DEFAULT '0',
  `GBPBUY` float NOT NULL DEFAULT '0',
  `GBPSELL` float NOT NULL DEFAULT '0',
  `GBPSIZE` bigint(20) NOT NULL DEFAULT '0',
  `HKJ50K7BUY` float NOT NULL DEFAULT '0',
  `HKJ50K7SELL` float NOT NULL DEFAULT '0',
  `HKJ50K7SIZE` bigint(20) NOT NULL DEFAULT '0',
  `HKJ5UK7BUY` float NOT NULL DEFAULT '0',
  `HKJ5UK7SELL` float NOT NULL DEFAULT '0',
  `HKJ5UK7SIZE` bigint(20) NOT NULL DEFAULT '0',
  `JPJ30M7BUY` float NOT NULL DEFAULT '0',
  `JPJ30M7SELL` float NOT NULL DEFAULT '0',
  `JPJ30M7SIZE` bigint(20) NOT NULL DEFAULT '0',
  `JPJ5UM7BUY` float NOT NULL DEFAULT '0',
  `JPJ5UM7SELL` float NOT NULL DEFAULT '0',
  `JPJ5UM7SIZE` bigint(20) NOT NULL DEFAULT '0',
  `KRJ35M7BUY` float NOT NULL DEFAULT '0',
  `KRJ35M7SELL` float NOT NULL DEFAULT '0',
  `KRJ35M7SIZE` bigint(20) NOT NULL DEFAULT '0',
  `KRJ5UM7BUY` float NOT NULL DEFAULT '0',
  `KRJ5UM7SELL` float NOT NULL DEFAULT '0',
  `KRJ5UM7SIZE` bigint(20) NOT NULL DEFAULT '0',
  `CHFBUY` float NOT NULL DEFAULT '0',
  `CHFSELL` float NOT NULL DEFAULT '0',
  `CHFSIZE` bigint(20) NOT NULL DEFAULT '0',
  `JPYBUY` float NOT NULL DEFAULT '0',
  `JPYSELL` float NOT NULL DEFAULT '0',
  `JPYSIZE` bigint(20) NOT NULL DEFAULT '0',
  `XAUBUY` float NOT NULL DEFAULT '0',
  `XAUSELL` float NOT NULL DEFAULT '0',
  `XAUSIZE` bigint(20) NOT NULL DEFAULT '0',
  `XAUVBUY` float NOT NULL DEFAULT '0',
  `XAUVSELL` float NOT NULL DEFAULT '0',
  `XAUVSIZE` bigint(20) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `iafile` */

/*Table structure for table `langphrase` */

DROP TABLE IF EXISTS `langphrase`;

CREATE TABLE `langphrase` (
  `phraseid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `phrase` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`phraseid`),
  KEY `phrase` (`phrase`)
) ENGINE=InnoDB AUTO_INCREMENT=110 DEFAULT CHARSET=latin1;

/*Data for the table `langphrase` */

insert  into `langphrase`(`phraseid`,`phrase`) values (7,'account'),(43,'Account Executive'),(107,'Adjustment'),(47,'Administrator'),(45,'Asst. Manager'),(35,'before_proceeding'),(2,'buy'),(26,'Cancel'),(87,'Category'),(3,'change'),(57,'Chart Currency'),(60,'Chart Stock'),(52,'Checking your connection'),(40,'Click_here_to_place_a_stop_or_limit_order'),(41,'Click_here_to_remove_order'),(37,'Click_on_Actions_to_open_a_new_position'),(42,'Client'),(88,'close'),(93,'closinglimit'),(90,'closing_day'),(89,'closing_price'),(81,'code'),(68,'Commission'),(21,'counter'),(96,'counter_duration'),(76,'current'),(82,'daily_statement'),(75,'date'),(94,'day_trade_margin'),(103,'Description'),(24,'Done'),(97,'duration'),(73,'Effective_Margin'),(71,'Equity'),(109,'Equity_Ratio'),(28,'Expired'),(99,'finish'),(70,'Floating'),(108,'Float_COMM.'),(104,'Free_Margin'),(49,'from'),(48,'Good Connection'),(86,'Graph'),(62,'Help'),(13,'high'),(100,'History_Transaction'),(66,'Interest'),(8,'item'),(15,'limitorder'),(55,'Liquidate'),(85,'lock'),(22,'log_in'),(59,'log_out'),(14,'low'),(51,'Low Connection'),(44,'Manager'),(105,'MarginIn'),(65,'MarginInOut'),(106,'MarginOut'),(30,'Margin_Call'),(72,'Margin_Requirement'),(50,'Medium Connection'),(54,'New'),(69,'New_Balance'),(101,'Number'),(95,'open_night_margin'),(19,'open_positions'),(5,'order'),(84,'Payment'),(25,'Pending'),(79,'please'),(53,'Please allow'),(33,'Please_ensure_you_have_sufficient_funds'),(34,'Please_select_an_Account'),(39,'positions_with_OCO_orders'),(38,'positions_with_pending_orders'),(64,'Previous_Balance'),(9,'price'),(83,'print_statement'),(27,'Process'),(67,'Profit_Loss'),(10,'qty'),(23,'refresh'),(11,'remark'),(29,'Removed'),(20,'select_account'),(1,'sell'),(91,'session'),(102,'Settled'),(74,'Settle_Position'),(80,'show_all'),(98,'start'),(12,'status'),(16,'stoporder'),(46,'Supervisor'),(61,'Temp Daily Statement'),(56,'Temp Statement'),(31,'There_are_currently_no_transactions'),(36,'There_are_no_open_positions_for_Account'),(77,'There_are_no_settle_position'),(78,'This_is_not_official_statement'),(4,'time'),(92,'top3'),(17,'tradeid'),(6,'trade_history'),(18,'type'),(63,'Update_Statement'),(58,'utility'),(32,'You_have_clicked_on_an_action_to_open_a_New_position');

/*Table structure for table `langtext` */

DROP TABLE IF EXISTS `langtext`;

CREATE TABLE `langtext` (
  `languageid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `phraseid` int(10) unsigned NOT NULL DEFAULT '0',
  `text` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`languageid`,`phraseid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `langtext` */

insert  into `langtext`(`languageid`,`phraseid`,`text`) values (1,1,'Sell'),(1,2,'Buy'),(1,3,'Change'),(1,4,'Time'),(1,5,'Order'),(1,6,'Transaction History'),(1,7,'Account'),(1,8,'Counter'),(1,9,'Price'),(1,10,'Qty'),(1,11,'Ref.'),(1,12,'Process'),(1,13,'High'),(1,14,'Low'),(1,15,'LO'),(1,16,'SO'),(1,17,'Id'),(1,18,'Type'),(1,19,'Open Positions'),(1,20,'Select Account'),(1,21,'Counter'),(1,22,'Log In'),(1,23,'Refresh'),(1,24,'Done'),(1,25,'Pending'),(1,26,'Cancel'),(1,27,'Process'),(1,28,'Expired'),(1,29,'Removed'),(1,30,'Margin Call'),(1,31,'There are currently no transactions'),(1,32,'You have clicked on an action to open a New position'),(1,33,'Please ensure you have sufficient funds'),(1,34,'Please select an Account'),(1,35,'before proceeding'),(1,36,'There are no open-positions for Account'),(1,37,'Click on Actions to open a new position'),(1,38,'positions with pending orders'),(1,39,'positions with OCO orders'),(1,40,'Click here to place a stop or limit order'),(1,41,'Click here to remove order'),(1,42,'Client'),(1,43,'Account Executive'),(1,44,'Manager'),(1,45,'Asst. Manager'),(1,46,'Supervisor'),(1,47,'Administrator'),(1,48,'Good Connection'),(1,49,'from'),(1,50,'Medium Connection'),(1,51,'Low Connection'),(1,52,'Checking your connection'),(1,53,'Please allow'),(1,54,'New'),(1,55,'Liquidate'),(1,56,'Temp Statement'),(1,57,'Chart Currency'),(1,58,'Utility'),(1,59,'Log Out'),(1,60,'Chart Stock'),(1,61,'Daily Statement'),(1,62,'Help'),(1,63,'Update Statement'),(1,64,'Previouse Balance'),(1,65,'Margin In / Out'),(1,66,'Interest'),(1,67,'Profit / Loss'),(1,68,'Commission'),(1,69,'New Balance'),(1,70,'Floating'),(1,71,'Equity'),(1,72,'Margin Requirement'),(1,73,'Effective Margin'),(1,74,'Settle Position'),(1,75,'Date'),(1,76,'current'),(1,77,'There are no settled position(s)'),(1,78,'This is not Official Temporary Statement'),(1,79,'Please'),(1,80,'Show All'),(1,81,'Code'),(1,82,'Daily Statement'),(1,83,'Print Statement'),(1,84,'Payment'),(1,85,'Lock'),(1,86,'Charts'),(1,87,'Category'),(1,88,'Close'),(1,89,'Closing Price'),(1,90,'Closing Day'),(1,91,'Session'),(1,92,'Top 3'),(1,93,'Closing Limit'),(1,94,'Day Trade Margin'),(1,95,'Open Night Margin'),(1,96,'Counter Duration'),(1,97,'Duration'),(1,98,'Start'),(1,99,'Finish'),(1,100,'History Transaction'),(1,101,'No.'),(1,102,'Setlled'),(1,103,'Description'),(1,104,'Free Margin'),(1,105,'Margin In'),(1,106,'Margin Out'),(1,107,'Adjustment'),(1,108,'Floating Commission'),(1,109,'Equity Ratio'),(2,1,'&#21334;&#20986;'),(2,2,'&#20080;&#36827;'),(2,3,'&#35722;&#21205;'),(2,4,'&#26178;&#38291;'),(2,5,'&#38480;&#20729;'),(2,6,'&#20132;&#26131;&#32000;&#37636;'),(2,7,'&#24115;&#25142;'),(2,8,'&#38917;&#30446;'),(2,9,'&#20729;&#26684;'),(2,10,'&#25163;&#25968;'),(2,11,'&#20633;&#35387;'),(2,12,'&#29376;&#27841;'),(2,13,'&#39640;'),(2,14,'&#20302;'),(2,15,'&#38480;&#21046;&#39034;&#24207;'),(2,16,'&#20572;&#27490;&#35746;&#36141;'),(2,17,'&#35777;&#26126;'),(2,18,'&#22411;'),(2,19,'&#26410;&#24179;&#20179;&#20132;&#26131;'),(2,20,'&#36873;&#25321;&#24080;&#25143;'),(2,21,'&#39033;&#30446;'),(2,22,'&#27880;&#20876;'),(2,23,'&#28040;&#38500;&#30130;&#21171;'),(2,24,'&#20570;'),(2,25,'&#21363;&#23558;&#21457;&#29983;'),(2,26,'&#21462;&#28040;'),(2,27,'&#36807;&#31243;'),(2,28,'&#21040;&#26399;'),(2,29,'&#21435;&#38500;'),(2,30,'&#34917;&#20805;&#20445;&#35777;&#37329;&#36890;&#30693;'),(2,31,'&#26377;&#24403;&#21069;&#27809;&#26377;&#20132;&#26131;'),(2,32,'&#20320;&#28857;&#20987;&#20030;&#21160;&#25171;&#24320;&#19968;&#20010;&#26032;&#20301;&#32622;'),(2,33,'&#35831;&#20445;&#35777;&#20320;&#26377;&#20805;&#36275;&#30340;&#36164;&#37329;'),(2,34,'&#35831;&#36873;&#25321;&#19968;&#20010;&#24080;&#25143;'),(2,35,'&#22312;&#36827;&#34892;&#20043;&#21069;'),(2,36,'&#27809;&#26377;&#25171;&#24320;&#20301;&#32622;&#20026;&#24080;&#25143;'),(2,37,'&#28857;&#20987;&#20030;&#21160;&#25171;&#24320;&#19968;&#20010;&#26032;&#20301;&#32622;'),(2,38,'&#20301;&#32622;&#19982;&#21363;&#23558;&#21457;&#29983;&#21629;&#20196;'),(2,39,'&#20301;&#32622;&#19982;OCO &#21629;&#20196;'),(2,40,'&#28857;&#20987;&#36825;&#37324;&#23433;&#32622;&#20013;&#27490;&#25110;&#38480;&#21046;&#39034;&#24207;'),(2,41,'&#28857;&#20987;&#36825;&#37324;&#21462;&#28040;&#21629;&#20196;'),(2,42,'&#23458;&#25143;'),(2,43,'&#23458;&#25143;&#20027;&#31649;'),(2,44,'&#32463;&#29702;'),(2,45,'&#21103;&#32463;&#29702;'),(2,46,'&#30417;&#30563;&#21592;'),(2,47,'&#31649;&#29702;&#21592;'),(2,48,'&#22909;&#36830;&#25509;'),(2,49,'&#20174;'),(2,50,'&#20013;&#31561;&#36899;&#25509;'),(2,51,'&#37532;&#25509;&#19981;&#33391;'),(2,52,'&#27298;&#26597;&#24744;&#30340;&#36899;&#25509;'),(2,53,'&#35831;&#20801;&#35768;&#20960;&#29255;&#21051;&#20026;&#31995;&#32479;&#26356;&#26032;'),(2,54,'&#26032;'),(2,55,'&#28165;&#31639;'),(2,56,'&#20020;&#26102;&#22768;&#26126;'),(2,57,'&#22270;'),(2,58,'&#20844;&#20849;&#20107;&#19994;'),(2,59,'&#36864;&#20986;'),(2,60,'&#22294;&#32929;&#31080;'),(2,61,'&#33256;&#26178;&#38599;&#21729;&#27599;&#26085;&#32882;&#26126;'),(2,62,'&#24171;&#21161;'),(2,63,'&#26356;&#26032;&#22768;&#26126;'),(2,64,'&#19978;&#26085;&#32467;&#23384;'),(2,65,'&#20986;&#37329; / &#20837;&#37329;'),(2,66,'&#21033;&#24687;'),(2,67,'&#24179;&#20179;&#30408;&#20111;'),(2,68,'&#25163;&#32493;&#36153;'),(2,69,'&#20170;&#26085;&#32467;&#23384;'),(2,70,'&#28014;&#21160;&#30408;&#20111;'),(2,71,'&#23454;&#23384;&#37329;&#39069;'),(2,72,'&#25152;&#38656;&#20445;&#35777;&#37329;'),(2,73,'&#21487;&#29992;&#20445;&#35777;&#37329;'),(2,74,'&#23450;&#23621;&#20301;&#32622;'),(2,75,'&#26085;&#26399;'),(2,76,'&#24403;&#21069;'),(2,77,'&#27809;&#26377;&#34987;&#23433;&#23450;&#30340;&#20301;&#32622;'),(2,78,'&#36825;&#19981;&#26159;&#27491;&#24335;&#20020;&#26102;&#22768;&#26126;'),(2,79,'&#35831;'),(2,80,'&#26174;&#31034;&#25152;&#26377;'),(2,81,'&#20195;&#30721;'),(2,82,'&#27599;&#26085;&#22768;&#26126;'),(2,83,'&#21360;&#21047;&#21697;&#22768;&#26126;'),(2,84,'&#20184;&#27454;'),(2,85,'&#38145;'),(2,86,'&#22270;&#34920;'),(2,87,'&#31867;&#21035;'),(2,88,'&#20851;&#38381;'),(2,89,'&#25910;&#30424;&#20215;&#26684;'),(2,90,'&#20241;&#24687;'),(2,91,'&#20250;&#35758;'),(2,92,'Top 3'),(2,93,'&#32467;&#26463;&#38480;&#21046;'),(2,94,'&#22825;&#21830;&#26989;&#37002;&#38555;'),(2,95,'&#25171;&#38283;&#22812;&#37002;&#38555;'),(2,96,'&#26588;&#21488;&#26399;&#38480;'),(2,97,'&#26399;&#38480;'),(2,98,'&#24320;&#22987;'),(2,99,'&#25972;&#29702;'),(2,100,'&#21382;&#21490;&#20132;&#26131;'),(2,101,'&#25968;&#23383;'),(2,102,'&#23433;&#23450;'),(2,103,'&#25551;&#36848;'),(2,104,'Free Margin'),(2,105,'Margin In'),(2,106,'Margin Out'),(2,107,'Adjustment'),(2,108,'Floating Commission'),(2,109,'Equity Ratio'),(3,1,'BÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡n'),(3,2,'Mua'),(3,3,'&#272;&#7893;i'),(3,4,'Th&#7901;i gian'),(3,5,'&#272;&#7863;t hÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â ng'),(3,6,'QuÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡ kh&#7913;d&#7883;ch'),(3,7,'Tr&#432;&#417;ng m&#7909;c'),(3,8,'MÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â³n hÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â ng'),(3,9,'GiÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡ c&#7843;'),(3,10,'S&#7889; l&#432;&#7907;ng'),(3,11,'&#272;ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡nh giÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡,nh&#7853;n xÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â©t'),(3,12,'Hi&#7879;n tr&#7841;ng'),(3,13,'Cao'),(3,14,'Th&#7845;p'),(3,15,'&#272;&#7863;t hÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â ng gi&#7899;i h&#7841;n'),(3,16,'Ng&#432;ng &#273;&#7863;t hÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â ng'),(3,17,'( Th&#7867;/s&#7889; ) ch&#7913;ng nh&#7853;n giao d&#7883;ch'),(3,18,'Lo&#7841;i'),(3,19,'V&#7883; trÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â­ m&#7903;'),(3,20,'Tr&#432;&#417;ng m&#7909;c ch&#7885;n l&#7885;c'),(3,21,'Qu&#7847;y'),(3,22,'&#272;&#259;ng nh&#7853;p'),(3,23,'LÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â m   m&#7899;i l&#7841;i, n&#7841;p l&#7841;i'),(3,24,'Xong'),(3,25,'&#272;ang &#273;&#7907;i gi&#7843;i quy&#7871;t'),(3,26,'H&#7911;y b&#7887;'),(3,27,'QuÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡ trÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¬nh'),(3,28,'H&#7871;t h&#7841;n'),(3,29,'B&#7883; d&#7905; b&#7887;'),(3,30,'BiÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Âªn &#273;&#7897;/m&#7913;c l&#7901;i khi mua vÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â o'),(3,31,'Hi&#7879;n t&#7841;i khÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â´ng cÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â³ giao d&#7883;ch nÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â o'),(3,32,'B&#7841;n v&#7915;a nh&#7845;n vÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â o ho&#7841;t &#273;&#7897;ng m&#7903; ra m&#7897;t tr&#432;&#417;ng m&#7909;c m&#7899;i'),(3,33,'HÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â£y ch&#7855;c ch&#7855;n r&#7857;ng b&#7841;n cÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â³ &#273;&#7911; ngu&#7891;n qu&#7929;'),(3,34,'HÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â£y ch&#7885;n m&#7897;t Tr&#432;&#417;ng m&#7909;c'),(3,35,'Tr&#432;&#7899;c khi ti&#7871;n hÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â nh'),(3,36,'KhÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â´ng cÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â³ v&#7883; trÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â­ m&#7903; cho Truong m&#7909;c'),(3,37,'Nh&#7845;n vÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â o nÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Âºt Actions &#273;&#7875; m&#7903; v&#7883; trÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â­ m&#7899;i'),(3,38,'V&#7883; trÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â­ v&#7899;i &#273;&#417;n &#273;&#7863;t hÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â ng &#273;ang ch&#7901; &#273;&#432;&#7907;c gi&#7843;i quy&#7871;t'),(3,39,'V&#7883; trÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â­ v&#7899;i &#273;&#417;n &#273;&#7863;t hÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â ng OCO'),(3,40,'Nh&#7845;n vÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â o &#273;ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢y &#273;&#7875; &#273;&#7863;t hÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â ng gi&#7899;i h&#7841;n hay ng&#432;ng &#273;&#7863;t hÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â ng'),(3,41,'Nh&#7845;n vÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â o &#273;ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢y &#273;&#7875; thÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡o d&#7905; &#273;&#417;n hÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â ng'),(3,42,'KhÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡ch hÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â ng (d&#7883;ch v&#7909;)'),(3,43,'CÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡n   b&#7897; qu&#7843;n lÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â½ Tr&#432;&#417;ng  m&#7909;c'),(3,44,'Tr&#432;&#7903;ng phÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â²ng'),(3,45,'Tr&#7907; lÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â½ tr&#432;&#7903;ng  phÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â²ng'),(3,46,'Ng&#432;&#7901;i giÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡m  sÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡t'),(3,47,'NhÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â  qu&#7843;n tr&#7883;'),(3,48,'K&#7871;t n&#7889;i t&#7889;t'),(3,49,'t&#7915;'),(3,50,'K&#7871;t n&#7889;i v&#7915;a'),(3,51,'K&#7871;t n&#7889;i kÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â©m/th&#7845;p'),(3,52,'Ki&#7875;m tra k&#7871;t n&#7889;i c&#7911;a b&#7841;n'),(3,53,'HÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â£y cho phÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â©p'),(3,54,'M&#7899;i'),(3,55,'Thanh lÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â½'),(3,56,'BÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡o cÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡o t&#7841;m th&#7901;i, s&#417; b&#7897;'),(3,57,'Bi&#7875;u &#273;&#7891; ti&#7873;n  t&#7879;'),(3,58,'Ti&#7879;n ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â­ch'),(3,59,'ÃƒÆ’Ã†â€™?ang thoÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡t'),(3,60,'Bi&#7875;u &#273;&#7891; ch&#7913;ng khoÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡n'),(3,61,'BÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡o cÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡o s&#417; b&#7897; hÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â ng  ngÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â y'),(3,62,'&#273;&#7905;'),(3,63,'BÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡o cÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡o c&#7853;p nh&#7853;t'),(3,64,'CÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢n b&#7857;ng lÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Âºc tr&#432;&#7899;c'),(3,65,'BiÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Âªn &#273;&#7897;/m&#7913;c l&#7907;i gi&#7919;a &#273;&#7847;u vÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â o &amp; &#273;&#7847;u ra'),(3,66,'LÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â£i su&#7845;t'),(3,67,'LÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â£i-L&#7895;'),(3,68,'HuÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Âª h&#7891;ng'),(3,69,'CÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢n b&#7857;ng m&#7899;i'),(3,70,'Th&#7843; n&#7893;i'),(3,71,'GiÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡ tr&#7883; tÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â i  s&#7843;n'),(3,72,'BiÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Âªn &#273;&#7897;/m&#7913;c l&#7907;i yÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Âªu c&#7847;u'),(3,73,'BiÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Âªn &#273;&#7897;/m&#7913;c l&#7907;i hi&#7879;u qu&#7843;'),(3,74,'V&#7883; trÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â­ c&#7889; &#273;&#7883;nh'),(3,75,'NgÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â y'),(3,76,'Hi&#7879;n th&#7901;i , hi&#7879;n t&#7841;i'),(3,77,'KhÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â´ng cÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â³ v&#7883; trÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â­ c&#7889; &#273;&#7883;nh'),(3,78,'&#272;ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¢y khÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â´ng ph&#7843;i lÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â  bÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡o cÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡o chÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â­nh th&#7913;c'),(3,79,'HÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â£y/LÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â m on'),(3,80,'TrÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¬nh bÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â y toÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â n b&#7897;'),(3,81,'MÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â£'),(3,82,'BÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡o cÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡o th&#432;&#7901;ng nh&#7853;t'),(3,83,'BÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡o cÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡o in ra'),(3,84,'S&#7889; ti&#7873;n tr&#7843;'),(3,85,'KhÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â³a'),(3,86,'&#272;&#7891; th&#7883;'),(3,87,'Ch&#7911;ng lo&#7841;i'),(3,88,'ÃƒÆ’Ã†â€™?ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â³ng'),(3,89,'GiÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â¡ lÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Âºc &#273;ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â³ng phiÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Âªn giao d&#7883;ch'),(3,90,'NgÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â y &#273;ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â³ng phiÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Âªn giao d&#7883;ch'),(3,91,'PhiÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Âªn (giao d&#7883;ch, v.vÃƒÆ’Ã‚Â¢?Ãƒâ€šÃ‚Â¦)'),(3,92,'3 lo&#7841;i cao nh&#7845;t'),(3,93,'Gi&#7899;i h&#7841;n lÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Âºc  &#273;ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â³ng phiÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Âªn'),(3,94,'BiÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Âªn &#273;&#7897; giao d&#7883;ch trong ngÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Â y'),(3,95,'BiÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Âªn &#273;&#7897; giao d&#7883;ch qua &#273;ÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Âªm'),(3,96,'Th&#7901;i h&#7841;n qua qu&#7847;y'),(3,97,'Th&#7901;i h&#7841;n'),(3,98,'Kh&#7903;i &#273;&#7847;u'),(3,99,'K&#7871;t thÃƒÆ’Ã†â€™Ãƒâ€šÃ‚Âºc');

/*Table structure for table `language` */

DROP TABLE IF EXISTS `language`;

CREATE TABLE `language` (
  `languageid` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `languagecode` varchar(20) NOT NULL DEFAULT '',
  `description` varchar(50) NOT NULL DEFAULT '',
  `charset` varchar(20) NOT NULL DEFAULT '',
  `active` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`languageid`),
  KEY `languagecode` (`languagecode`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `language` */

insert  into `language`(`languageid`,`languagecode`,`description`,`charset`,`active`) values (1,'EN','English','iso123',1),(2,'CN','Chinese','CN',1);

/*Table structure for table `logclient` */

DROP TABLE IF EXISTS `logclient`;

CREATE TABLE `logclient` (
  `TIMESTAMP` datetime DEFAULT NULL,
  `ACCNO` varchar(30) DEFAULT NULL,
  `COMMENT` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `logclient` */

/*Table structure for table `logfile` */

DROP TABLE IF EXISTS `logfile`;

CREATE TABLE `logfile` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(40) DEFAULT NULL,
  `window` varchar(50) DEFAULT NULL,
  `process` varchar(50) DEFAULT NULL,
  `transaction_id` varchar(20) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `transaction_desc` text,
  `from_ip` text,
  `account` varchar(20) DEFAULT NULL,
  `thequery` text,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `logfile` */

/*Table structure for table `loginkey` */

DROP TABLE IF EXISTS `loginkey`;

CREATE TABLE `loginkey` (
  `keyid` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `salt` char(3) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`keyid`)
) ENGINE=MyISAM AUTO_INCREMENT=44837 DEFAULT CHARSET=latin1;

/*Data for the table `loginkey` */

insert  into `loginkey`(`keyid`,`salt`,`datetime`) values (44836,'e27','2005-09-22 23:31:29');

/*Table structure for table `logpending` */

DROP TABLE IF EXISTS `logpending`;

CREATE TABLE `logpending` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `runtime` timestamp NULL DEFAULT NULL,
  `tradeid` int(10) DEFAULT NULL,
  `pendingtype` varchar(15) DEFAULT NULL,
  `runprice` float DEFAULT NULL,
  `pendingprice` float DEFAULT NULL,
  `runsymbol` varchar(15) DEFAULT NULL,
  `lastprice` float(9,4) DEFAULT '0.0000',
  `check_high` float(9,4) DEFAULT '0.0000',
  `check_low` float(9,4) DEFAULT '0.0000',
  `run_high` float DEFAULT NULL,
  `run_low` float DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `logpending` */

/*Table structure for table `logserver` */

DROP TABLE IF EXISTS `logserver`;

CREATE TABLE `logserver` (
  `TIMESTAMP` datetime DEFAULT NULL,
  `ACCNO` varchar(30) DEFAULT NULL,
  `COMMENT` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `logserver` */

insert  into `logserver`(`TIMESTAMP`,`ACCNO`,`COMMENT`) values ('2015-12-14 21:26:23','THEPROGRAMMER','This user try to Update License\nRemote Address=10.10.0.253\nBrowser=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2015-12-14 21:55:24','THEPROGRAMMER','23.You do not have permission to access this page.<br>If you feel this is an error, please contact the Administrator.\nRemote Address=10.10.0.253\nBrowser=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2015-12-14 21:56:16','THEPROGRAMMER','23.You do not have permission to access this page.<br>If you feel this is an error, please contact the Administrator.\nRemote Address=10.10.0.253\nBrowser=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2015-12-14 21:56:29','THEPROGRAMMER','23.You do not have permission to access this page.<br>If you feel this is an error, please contact the Administrator.\nRemote Address=10.10.0.253\nBrowser=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2015-12-14 22:02:32','THEPROGRAMMER','This user try to Update License\nRemote Address=10.10.0.253\nBrowser=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2015-12-14 22:02:34','THEPROGRAMMER','This user try to Update License\nRemote Address=10.10.0.253\nBrowser=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web='),('2015-12-15 05:23:23','THEPROGRAMMER','This user try to Update License\nRemote Address=10.10.0.253\nBrowser=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2015-12-15 05:25:19','THEPROGRAMMER','This user try to Update License\nRemote Address=10.10.0.253\nBrowser=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2015-12-15 05:29:13','THEPROGRAMMER','This user try to Update License\nRemote Address=10.10.0.253\nBrowser=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2015-12-15 05:29:20','THEPROGRAMMER','This user try to Update License\nRemote Address=10.10.0.253\nBrowser=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web='),('2015-12-15 05:29:37','THEPROGRAMMER','This user try to Update License\nRemote Address=10.10.0.253\nBrowser=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2015-12-15 05:29:48','THEPROGRAMMER','This user try to Update License\nRemote Address=10.10.0.253\nBrowser=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2015-12-15 05:29:49','THEPROGRAMMER','This user try to Update License\nRemote Address=10.10.0.253\nBrowser=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2015-12-15 05:29:51','THEPROGRAMMER','This user try to Update License\nRemote Address=10.10.0.253\nBrowser=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web='),('2015-12-15 05:30:00','THEPROGRAMMER','This user try to Update License\nRemote Address=10.10.0.253\nBrowser=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2015-12-15 05:30:41','THEPROGRAMMER','This user try to Update License\nRemote Address=10.10.0.253\nBrowser=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2015-12-15 06:14:20','THEPROGRAMMER','This user try to Update License\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2015-12-15 06:16:37','THEPROGRAMMER','This user try to Update License\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2015-12-15 06:17:09','THEPROGRAMMER','This user try to Update License\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2015-12-15 06:17:33','THEPROGRAMMER','This user try to Update License\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2015-12-15 06:20:05','THEPROGRAMMER','This user try to Update License\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2015-12-15 06:21:14','THEPROGRAMMER','This user try to Update License\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2015-12-15 06:22:32','THEPROGRAMMER','This user try to Update License\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2015-12-15 06:23:25','THEPROGRAMMER','This user try to Update License\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2015-12-15 06:26:19','THEPROGRAMMER','This user try to Update License\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2015-12-15 06:26:25','THEPROGRAMMER','Update License Done\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2015-12-15 06:27:22','THEPROGRAMMER','This user try to Update License\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2015-12-15 06:27:27','THEPROGRAMMER','Update License Done\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2015-12-15 06:28:48','THEPROGRAMMER','This user try to Update License\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2015-12-15 06:28:52','THEPROGRAMMER','Update License Done\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2015-12-15 06:30:59','THEPROGRAMMER','This user try to Update License\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2015-12-15 06:32:18','THEPROGRAMMER','This user try to Update License\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2015-12-15 06:32:35','THEPROGRAMMER','This user try to Update License\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2015-12-15 06:32:39','THEPROGRAMMER','Update License Done\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2015-12-15 06:34:40','THEPROGRAMMER','This user try to Update License\nRemote Address=10.10.0.253\nBrowser=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web='),('2015-12-15 06:34:48','THEPROGRAMMER','This user try to Update License\nRemote Address=10.10.0.253\nBrowser=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2015-12-15 07:58:38','THEPROGRAMMER','This user try to Update License\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2015-12-15 07:58:45','THEPROGRAMMER','This user try to Update License\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2015-12-15 07:58:57','THEPROGRAMMER','Update License Done\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2015-12-16 13:08:10','kent123','Incorrect Login<br>;kent123\nRemote Address=10.10.0.102\nBrowser=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2015-12-16 13:08:34','kent123','Incorrect Login<br>;kent123\nRemote Address=10.10.0.102\nBrowser=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2015-12-26 16:26:52','theprogrammer','Incorrect Password<br>;theprogrammer\nRemote Address=10.10.0.102\nBrowser=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2015-12-26 16:40:33','theprogrammer','Incorrect Password<br>;theprogrammer\nRemote Address=10.10.0.253\nBrowser=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2015-12-26 16:52:06','theprogrammer','Incorrect Password<br>;theprogrammer\nRemote Address=10.10.0.253\nBrowser=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.80 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2015-12-29 18:27:12','info01@si.co.id','CheckLicense-23.You do not have permission to access this page.<br>If you feel this is an error, please contact the Administrator.\nRemote Address=10.10.0.102\nBrowser=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2015-12-29 18:29:53','info01@si.co.id','CheckLicense-23.You do not have permission to access this page.<br>If you feel this is an error, please contact the Administrator.\nRemote Address=10.10.0.102\nBrowser=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2015-12-29 18:58:55','THEPROGRAMMER','This user try to Update License\nRemote Address=10.10.0.102\nBrowser=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2015-12-30 16:38:12','theprogrammer','Incorrect Password<br>;theprogrammer\nRemote Address=10.10.0.102\nBrowser=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2015-12-30 18:16:16','info01@si.co.id','CheckLicense-23.You do not have permission to access this page.<br>If you feel this is an error, please contact the Administrator.\nRemote Address=10.10.0.102\nBrowser=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2016-01-04 19:47:11','THEPROGRAMMER','This user try to Update License\nRemote Address=10.10.0.253\nBrowser=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2016-01-04 19:47:53','THEPROGRAMMER','This user try to Update License\nRemote Address=10.10.0.253\nBrowser=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2016-01-04 19:48:05','THEPROGRAMMER','This user try to Update License\nRemote Address=10.10.0.253\nBrowser=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2016-01-05 20:47:49','kent123','Incorrect Login<br>;kent123\nRemote Address=192.168.0.1\nBrowser=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36\n On web=http://cabinet.sibfx.co.id:85/web2/index.php'),('2016-01-05 20:53:13','maxwell','Incorrect Login<br>;maxwell\nRemote Address=192.168.0.1\nBrowser=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36\n On web=http://cabinet.sibfx.co.id:85/web2/index.php'),('2016-01-06 01:21:32','','Incorrect Login<br>;;\nRemote Address=192.168.0.1\nBrowser=Mozilla/5.0 (Windows NT 6.1; Trident/7.0; rv:11.0) like Gecko\n On web=http://cabinet.sibfx.co.id:85/web2/index.php'),('2016-01-06 07:58:41','support','Incorrect Password<br>;support\nRemote Address=192.168.0.1\nBrowser=Mozilla/5.0 (Windows NT 5.2; rv:43.0) Gecko/20100101 Firefox/43.0\n On web=http://cabinet.sibfx.co.id:85/web2/index.php'),('2016-01-06 07:59:03','support','Incorrect Password<br>;support\nRemote Address=192.168.0.1\nBrowser=Mozilla/5.0 (Windows NT 5.2; rv:43.0) Gecko/20100101 Firefox/43.0\n On web=http://cabinet.sibfx.co.id:85/web2/index.php'),('2016-01-06 07:59:23','support','Incorrect Password<br>;support\nRemote Address=192.168.0.1\nBrowser=Mozilla/5.0 (Windows NT 5.2; rv:43.0) Gecko/20100101 Firefox/43.0\n On web=http://cabinet.sibfx.co.id:85/web2/index.php'),('2016-01-06 07:59:42','support','Incorrect Password<br>;support\nRemote Address=192.168.0.1\nBrowser=Mozilla/5.0 (Windows NT 5.2; rv:43.0) Gecko/20100101 Firefox/43.0\n On web=http://cabinet.sibfx.co.id:85/web2/index.php'),('2016-01-06 08:00:18','support','Incorrect Password<br>;support\nRemote Address=192.168.0.1\nBrowser=Mozilla/5.0 (Windows NT 5.2; rv:43.0) Gecko/20100101 Firefox/43.0\n On web=http://cabinet.sibfx.co.id:85/web2/index.php'),('2016-01-06 08:00:48','support','Incorrect Password<br>;support\nRemote Address=192.168.0.1\nBrowser=Mozilla/5.0 (Windows NT 5.2; rv:43.0) Gecko/20100101 Firefox/43.0\n On web=http://cabinet.sibfx.co.id:85/web2/index.php'),('2016-01-06 08:01:03','my2','Incorrect Login<br>;my2\nRemote Address=192.168.0.1\nBrowser=Mozilla/5.0 (Windows NT 5.2; rv:43.0) Gecko/20100101 Firefox/43.0\n On web=http://cabinet.sibfx.co.id:85/web2/index.php'),('2016-01-06 08:01:59','my2','Incorrect Login<br>;my2\nRemote Address=192.168.0.1\nBrowser=Mozilla/5.0 (Windows NT 5.2; rv:43.0) Gecko/20100101 Firefox/43.0\n On web=http://cabinet.sibfx.co.id:85/web2/index.php'),('2016-01-06 08:03:10','support','Incorrect Password<br>;support\nRemote Address=192.168.0.1\nBrowser=Mozilla/5.0 (Windows NT 5.2; rv:43.0) Gecko/20100101 Firefox/43.0\n On web=http://cabinet.sibfx.co.id:85/web2/index.php'),('2016-01-06 08:03:36','support','Incorrect Password<br>;support\nRemote Address=192.168.0.1\nBrowser=Mozilla/5.0 (Windows NT 5.2; rv:43.0) Gecko/20100101 Firefox/43.0\n On web=http://cabinet.sibfx.co.id:85/web2/index.php'),('2016-01-06 14:37:17','theprogrammer','Incorrect Password<br>;theprogrammer\nRemote Address=192.168.0.1\nBrowser=Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36\n On web=http://cabinet.sibfx.co.id:85/web2/index.php'),('2016-01-07 17:41:44','theprogrammer','Incorrect Password<br>;theprogrammer\nRemote Address=192.168.0.1\nBrowser=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36\n On web=http://cabinet.sibfx.co.id:85/web2/index.php'),('2016-01-13 08:41:08','maxwell','Incorrect Password<br>;maxwell\nRemote Address=10.10.0.102\nBrowser=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2016-01-13 15:03:23','maxwell','Incorrect Password<br>;maxwell\nRemote Address=10.10.0.102\nBrowser=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2016-01-13 17:34:56','maxwellabc123','Incorrect Login<br>;maxwellabc123\nRemote Address=10.10.0.102\nBrowser=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2016-01-18 18:07:51','THEPROGRAMMER','This user try to Update License\nRemote Address=10.10.0.253\nBrowser=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2016-01-18 18:07:58','THEPROGRAMMER','This user try to Update License\nRemote Address=10.10.0.253\nBrowser=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2016-01-19 19:32:30','purnomoboyke@gmail.com','Incorrect Login<br>;purnomoboyke@gmail.com\nRemote Address=139.193.213.210\nBrowser=Mozilla/5.0 (Windows NT 10.0; rv:43.0) Gecko/20100101 Firefox/43.0\n On web=http://cabinet.si.co.id:85/web2/openaccount2.php'),('2016-01-22 08:16:06','support','Incorrect Password<br>;support\nRemote Address=203.211.135.129\nBrowser=Mozilla/5.0 (Windows NT 5.2; rv:43.0) Gecko/20100101 Firefox/43.0\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2016-01-22 08:16:18','theprogramer','Incorrect Login<br>;theprogramer\nRemote Address=10.10.0.79\nBrowser=Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.82 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2016-01-22 08:16:59','theprogramer','Incorrect Login<br>;theprogramer\nRemote Address=10.10.0.79\nBrowser=Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.82 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2016-01-22 08:36:21','theprogramer','Incorrect Login<br>;theprogramer\nRemote Address=10.10.0.79\nBrowser=Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.82 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2016-01-22 11:38:37','Theprogramer','Incorrect Login<br>;Theprogramer\nRemote Address=10.10.0.79\nBrowser=Mozilla/5.0 (Windows NT 6.1; rv:43.0) Gecko/20100101 Firefox/43.0\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2016-01-22 11:39:15','theprogram','Incorrect Login<br>;theprogram\nRemote Address=10.10.0.79\nBrowser=Mozilla/5.0 (Windows NT 6.1; rv:43.0) Gecko/20100101 Firefox/43.0\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2016-01-22 11:39:53','theprogramer','Incorrect Login<br>;theprogramer\nRemote Address=10.10.0.79\nBrowser=Mozilla/5.0 (Windows NT 6.1; rv:43.0) Gecko/20100101 Firefox/43.0\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2016-01-22 11:40:33','theprogrammer','Incorrect Password<br>;theprogrammer\nRemote Address=10.10.0.79\nBrowser=Mozilla/5.0 (Windows NT 6.1; rv:43.0) Gecko/20100101 Firefox/43.0\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2016-01-22 11:42:09','theprogrammer','Incorrect Password<br>;theprogrammer\nRemote Address=10.10.0.79\nBrowser=Mozilla/5.0 (Windows NT 6.1; rv:43.0) Gecko/20100101 Firefox/43.0\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2016-01-27 13:51:15','THEPROGRAMMER','This user try to Update License\nRemote Address=10.10.0.79\nBrowser=Mozilla/5.0 (Windows NT 6.1; rv:43.0) Gecko/20100101 Firefox/43.0\n On web=http://cabinet.si.co.id:85/web2/mainmenu.php'),('2016-01-27 13:51:50','THEPROGRAMMER','This user try to Update License\nRemote Address=10.10.0.79\nBrowser=Mozilla/5.0 (Windows NT 6.1; rv:43.0) Gecko/20100101 Firefox/43.0\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2016-01-30 09:59:48','theprogrammer','Incorrect Password<br>;theprogrammer\nRemote Address=10.10.0.107\nBrowser=Mozilla/5.0 (Windows NT 10.0; WOW64; rv:44.0) Gecko/20100101 Firefox/44.0\n On web=http://10.10.0.110:85/web2/index.php'),('2016-02-02 17:00:41','cabinet01@si.co.id','Incorrect Login<br>;cabinet01@si.co.id\nRemote Address=10.10.0.112\nBrowser=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_7_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.111 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/openaccount2.php'),('2016-02-10 10:12:18','theprogrammer','Incorrect Password<br>;theprogrammer\nRemote Address=10.10.0.102\nBrowser=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.82 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2016-02-10 10:12:23','theprogrammer','Incorrect Password<br>;theprogrammer\nRemote Address=10.10.0.102\nBrowser=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.82 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2016-02-17 13:40:49','theprogrammer','Incorrect Password<br>;theprogrammer\nRemote Address=10.10.0.102\nBrowser=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.109 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2016-02-17 20:42:32','theprogrammer','Incorrect Password<br>;theprogrammer\nRemote Address=10.10.0.253\nBrowser=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2016-02-17 20:42:39','programmer','Incorrect Login<br>;programmer\nRemote Address=10.10.0.253\nBrowser=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2016-02-17 20:42:47','theprogrammer','Incorrect Password<br>;theprogrammer\nRemote Address=10.10.0.253\nBrowser=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2016-02-17 20:43:25','theprogrammer','Incorrect Password<br>;theprogrammer\nRemote Address=10.10.0.253\nBrowser=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2016-02-17 20:43:46','theprogrammer','Incorrect Password<br>;theprogrammer\nRemote Address=10.10.0.253\nBrowser=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2016-02-19 10:18:37','test01','Incorrect Login<br>;test01\nRemote Address=10.10.0.102\nBrowser=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.109 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2016-02-23 16:53:35','theprogrammer','Incorrect Password<br>;theprogrammer\nRemote Address=10.10.0.102\nBrowser=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.109 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2016-02-23 16:54:00','theprogrammer','Incorrect Password<br>;theprogrammer\nRemote Address=10.10.0.102\nBrowser=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.109 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2016-02-23 16:54:06','programmer','Incorrect Login<br>;programmer\nRemote Address=10.10.0.102\nBrowser=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.109 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2016-02-23 16:54:15','theprogrammer','Incorrect Password<br>;theprogrammer\nRemote Address=10.10.0.102\nBrowser=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.109 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2016-02-23 19:25:23','theprogrammer','Incorrect Password<br>;theprogrammer\nRemote Address=10.10.0.253\nBrowser=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2016-02-23 20:19:53','info01@si.co.id','Incorrect Login<br>;info01@si.co.id\nRemote Address=10.10.0.253\nBrowser=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2016-02-24 11:45:00','theprogramer','Incorrect Login<br>;theprogramer\nRemote Address=10.10.0.79\nBrowser=Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2016-02-24 11:47:34','info01@si.co.id','Incorrect Login<br>;info01@si.co.id\nRemote Address=10.10.0.79\nBrowser=Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2016-02-24 17:33:45','theprogrammer','Incorrect Password<br>;theprogrammer\nRemote Address=10.10.0.102\nBrowser=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.109 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2016-02-24 17:33:52','theprogrammer','Incorrect Password<br>;theprogrammer\nRemote Address=10.10.0.102\nBrowser=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.109 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2016-02-24 17:53:44','info01@si.co.id','Incorrect Login<br>;info01@si.co.id\nRemote Address=10.10.0.102\nBrowser=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.109 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2016-02-26 20:30:57','theprogrammer','Incorrect Password<br>;theprogrammer\nRemote Address=10.10.0.253\nBrowser=Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_5) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2016-03-02 17:29:27','test01@si.co.id','Incorrect Password<br>;test01@si.co.id\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 6.2; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2016-03-07 10:48:46','theprogrammer','Incorrect Password<br>;theprogrammer\nRemote Address=10.10.0.102\nBrowser=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2016-03-08 15:15:19','theprogrammer','Incorrect Password<br>;theprogrammer\nRemote Address=10.10.0.102\nBrowser=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2016-03-08 15:29:49','theprogrammer','Incorrect Password<br>;theprogrammer\nRemote Address=10.10.0.102\nBrowser=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2016-03-10 11:27:40','programmer','Incorrect Login<br>;programmer\nRemote Address=10.10.0.102\nBrowser=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2016-03-10 11:28:57','tets01@si.co.id','Incorrect Login<br>;tets01@si.co.id\nRemote Address=10.10.0.102\nBrowser=Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/48.0.2564.116 Safari/537.36\n On web=http://cabinet.si.co.id:85/web2/index.php'),('2016-03-18 10:47:17','test02@si.co.id','Incorrect Password<br>;test02@si.co.id\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36\n On web=http://cabinet.dev/web2/index.php'),('2016-03-29 09:35:48','tes01@si.co.id','Incorrect Login<br>;tes01@si.co.id\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36\n On web=http://cabinet.dev/web2/index.php'),('2016-03-29 09:36:28','tes01@si.co.id','Incorrect Login<br>;tes01@si.co.id\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36\n On web=http://cabinet.dev/web2/index.php'),('2016-03-29 10:08:46','test01@si.co.id','Incorrect Password<br>;test01@si.co.id\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36\n On web=http://cabinet.dev/web2/'),('2016-03-29 11:00:03','test01@si.co.id','Incorrect Password<br>;test01@si.co.id\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.87 Safari/537.36\n On web=http://cabinet.dev/web2/index.php'),('2016-04-01 19:37:37','theprogrammer','Incorrect Password<br>;theprogrammer\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.110 Safari/537.36\n On web=http://cabinet.dev/web2/index.php'),('2016-04-04 16:42:08','test02@si.co.id','Incorrect Login<br>;test02@si.co.id\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.110 Safari/537.36\n On web=http://cabinet.dev/web2/index.php'),('2016-04-04 16:43:07','test02@si.co.id','Incorrect Login<br>;test02@si.co.id\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.110 Safari/537.36\n On web=http://cabinet.dev/web2/index.php'),('2016-04-07 11:08:44','admin@apexregent.com','Incorrect Login<br>;admin@apexregent.com\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.110 Safari/537.36\n On web=http://cabinet.dev/web2/index.php'),('2016-04-09 11:31:53','admin@apexregent.com','Incorrect Login<br>;admin@apexregent.com\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.110 Safari/537.36\n On web=http://cabinet.dev/web2/index.php'),('2016-04-18 14:53:40','admin@apexregent.com','Incorrect Login<br>;admin@apexregent.com\nRemote Address=10.10.0.35\nBrowser=Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36\n On web=http://10.10.0.35/web2/index.php'),('2016-04-18 20:55:16','test01@si.co.id','Incorrect Password<br>;test01@si.co.id\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36\n On web=http://cabinet.dev/web2/index.php'),('2016-04-19 10:51:13','test01@si.co.id','Incorrect Password<br>;test01@si.co.id\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36\n On web=http://cabinet.dev/web2/index.php'),('2016-04-19 11:02:35','test01@si.co.id','Incorrect Password<br>;test01@si.co.id\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36\n On web=http://cabinet.dev/web2/index.php'),('2016-04-19 11:02:45','test02@si.co.id','Incorrect Password<br>;test02@si.co.id\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36\n On web=http://cabinet.dev/web2/index.php'),('2016-04-19 11:02:55','test01@si.co.id','Incorrect Password<br>;test01@si.co.id\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36\n On web=http://cabinet.dev/web2/index.php'),('2016-04-19 16:29:49','test01@si.co.id','Incorrect Password<br>;test01@si.co.id\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36\n On web=http://cabinet.dev/web2/index.php'),('2016-04-19 19:01:12','APR','Incorrect Login<br>;APR\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36\n On web=http://cabinet.dev/web2/index.php'),('2016-04-19 19:01:42','APR','Incorrect Login<br>;APR\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36\n On web=http://cabinet.dev/web2/index.php'),('2016-04-19 19:06:39','APR','Incorrect Login<br>;APR\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36\n On web=http://cabinet.dev/web2/index.php'),('2016-04-19 19:17:28','GSP','Incorrect Login<br>;GSP\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36\n On web=http://cabinet.dev/web2/index.php'),('2016-04-19 19:17:53','APRP-3B','Incorrect Login<br>;APRP-3B\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36\n On web=http://cabinet.dev/web2/index.php'),('2016-04-19 19:19:45','APR','Incorrect Login<br>;APR\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36\n On web=http://cabinet.dev/web2/index.php'),('2016-04-19 19:31:34','APR','Incorrect Login<br>;APR\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36\n On web=http://cabinet.dev/web2/index.php'),('2016-04-19 20:30:06','test01@si.co.id','Incorrect Password<br>;test01@si.co.id\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36\n On web=http://cabinet.dev/web2/index.php'),('2016-04-20 09:57:45','test01@si.co.id','Incorrect Password<br>;test01@si.co.id\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36\n On web=http://cabinet.dev/web2/index.php'),('2016-04-20 15:10:51','test01@si.co.id','Incorrect Password<br>;test01@si.co.id\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36\n On web=http://cabinet.dev/web2/index.php'),('2016-04-20 17:55:49','theprogrammer','Incorrect Password<br>;theprogrammer\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36\n On web=http://cabinet.dev/web2/index.php'),('2016-04-21 11:19:05','test01@si.co.id','Incorrect Password<br>;test01@si.co.id\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36\n On web=http://cabinet.dev/web2/index.php'),('2016-04-21 13:09:21','test01@si.co.id','Incorrect Password<br>;test01@si.co.id\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36\n On web=http://cabinet.dev/web2/index.php'),('2016-04-22 09:31:24','test01@si.co.id','Incorrect Password<br>;test01@si.co.id\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36\n On web=http://cabinet.dev/web2/index.php'),('2016-04-22 20:00:34','test01@si.co.id','Incorrect Password<br>;test01@si.co.id\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36\n On web=http://cabinet.dev/web2/index.php'),('2016-04-22 20:00:38','test01@si.co.id','Incorrect Password<br>;test01@si.co.id\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36\n On web=http://cabinet.dev/web2/index.php'),('2016-04-26 09:07:20','test01@si.co.id','Incorrect Password<br>;test01@si.co.id\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36\n On web=http://cabinet.dev/web2/index.php'),('2016-04-28 10:47:47','THEPROGRAMMER','This user try to Update License\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36\n On web=http://cabinet.dev/web2/mainmenu.php'),('2016-04-28 13:14:54','test01@si.co.id','Incorrect Password<br>;test01@si.co.id\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36\n On web=http://cabinet.dev/web2/index.php'),('2016-04-29 10:07:28','test01@si.co.id','Incorrect Password<br>;test01@si.co.id\nRemote Address=127.0.0.1\nBrowser=Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/49.0.2623.112 Safari/537.36\n On web=http://cabinet.dev/web2/index.php');

/*Table structure for table `lookup` */

DROP TABLE IF EXISTS `lookup`;

CREATE TABLE `lookup` (
  `MarginCall` tinyint(4) NOT NULL DEFAULT '0',
  `AutoLock` tinyint(4) NOT NULL DEFAULT '0',
  `LotsMax` tinyint(4) NOT NULL DEFAULT '0',
  `SpreadForex` tinyint(4) NOT NULL DEFAULT '0',
  `SpreadIndex` tinyint(4) NOT NULL DEFAULT '0',
  `bbj` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `lookup` */

insert  into `lookup`(`MarginCall`,`AutoLock`,`LotsMax`,`SpreadForex`,`SpreadIndex`,`bbj`) values (99,30,20,15,50,51);

/*Table structure for table `mar_ac` */

DROP TABLE IF EXISTS `mar_ac`;

CREATE TABLE `mar_ac` (
  `datetime` datetime DEFAULT NULL,
  `account` varchar(50) DEFAULT NULL,
  `pros_date` date DEFAULT NULL,
  `pros_name` varchar(50) DEFAULT NULL,
  `pros_address` varchar(100) DEFAULT NULL,
  `pros_email` varchar(50) DEFAULT NULL,
  `pros_telp` varchar(15) DEFAULT NULL,
  `pros_Summary` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mar_ac` */

insert  into `mar_ac`(`datetime`,`account`,`pros_date`,`pros_name`,`pros_address`,`pros_email`,`pros_telp`,`pros_Summary`) values ('2016-04-13 06:19:45','160413011','2016-04-13','syafiq','gondrong','gonrong@gmail.com','123456','as'),('2016-04-13 06:56:56','160412092','2016-04-14','Syafri','Kali Deres','Syafri@gmail.com','085699995172','OK'),('2016-04-13 06:59:24','160412091','2016-04-14','Fadli','Kp.Gondrong','Fadli@Ymail.com','08997996724','ok sangat');

/*Table structure for table `margin` */

DROP TABLE IF EXISTS `margin`;

CREATE TABLE `margin` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(11) NOT NULL DEFAULT '',
  `tradedbyname` varchar(30) DEFAULT NULL,
  `datetime` varchar(30) DEFAULT NULL,
  `type` varchar(14) DEFAULT 'adjustment_out',
  `price` double(20,3) DEFAULT '0.000',
  `description` varchar(255) DEFAULT NULL,
  `status` varchar(6) DEFAULT 'done',
  `rollover` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `margin` */

/*Table structure for table `marketindex` */

DROP TABLE IF EXISTS `marketindex`;

CREATE TABLE `marketindex` (
  `indexid` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL DEFAULT '',
  `type_future` varchar(14) DEFAULT NULL,
  `open` tinyint(4) NOT NULL DEFAULT '0',
  `exchangecode` varchar(20) NOT NULL,
  `checkhighlow` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `multiplier` decimal(10,2) unsigned NOT NULL DEFAULT '0.00',
  `limitmultiplier` decimal(8,2) unsigned NOT NULL DEFAULT '0.00',
  `limitceiling` decimal(8,2) unsigned NOT NULL DEFAULT '0.00',
  `marginratio` float NOT NULL DEFAULT '0',
  `hedgeratio` float NOT NULL DEFAULT '0',
  `buypips` tinyint(4) NOT NULL DEFAULT '0',
  `sellpips` tinyint(4) NOT NULL DEFAULT '0',
  `quotebuypips` tinyint(4) NOT NULL DEFAULT '0',
  `quotesellpips` tinyint(4) NOT NULL DEFAULT '0',
  `spreadvalue` int(11) DEFAULT NULL,
  `description` text,
  `removeorder` varchar(5) DEFAULT '0',
  PRIMARY KEY (`indexid`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `marketindex` */

insert  into `marketindex`(`indexid`,`name`,`type_future`,`open`,`exchangecode`,`checkhighlow`,`multiplier`,`limitmultiplier`,`limitceiling`,`marginratio`,`hedgeratio`,`buypips`,`sellpips`,`quotebuypips`,`quotesellpips`,`spreadvalue`,`description`,`removeorder`) values (1,'Currency','Spot',1,'Currency',0,4.00,6.60,333.00,1,0.5,0,0,0,0,10,'exchange code for ProStick','3.4'),(2,'IDRHANGSENG','Spot_Index',0,'IDRHANGSENG',0,4.00,6.00,200.00,1,0.5,0,0,0,0,15,'0','3'),(3,'USDHANGSENG','Spot_Index',1,'USDHANGSENG',0,4.00,6.00,200.00,1,0.5,0,0,0,0,15,'0	','3'),(4,'IDRNIKKEI','Spot_Index',0,'IDRNIKKEI',0,0.00,0.00,0.00,1,0.5,0,0,0,0,15,NULL,'0'),(5,'USDNIKKEI','Spot_Index',0,'USDNIKKEI',0,0.00,0.00,0.00,0,0,0,0,0,0,15,NULL,'0'),(6,'IDRKOSPI','Spot_Index',0,'IDRKOSPI',0,0.00,0.00,0.00,1,5,0,0,0,0,15,NULL,'0');

/*Table structure for table `marketing` */

DROP TABLE IF EXISTS `marketing`;

CREATE TABLE `marketing` (
  `datetime` datetime DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `telp` varchar(50) DEFAULT NULL,
  `creat_account` varchar(3) DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `marketing` */

insert  into `marketing`(`datetime`,`email`,`name`,`city`,`telp`,`creat_account`) values ('2016-04-12 00:59:26','car01@gmail.com','car satu','Jakarta','085697795178','no'),('2016-04-12 00:59:26','car02@gmail.com','car satu','bali','085697795178','no'),('2016-04-12 10:10:52','fadliyunus@ymail.com','fadli yunus','Jakarta','0909090909','no'),('2016-04-12 10:22:18','fadliyunus@ymail.com','fadli yunus','Jakarta','1234','no'),('2016-04-12 10:23:12','fadliyunus@ymail.com','fadli yunus','Jakarta','1234','no');

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `img` varchar(100) DEFAULT NULL,
  `title` varchar(100) NOT NULL DEFAULT '',
  `span_img` varchar(100) DEFAULT NULL,
  `url` varchar(100) NOT NULL DEFAULT '',
  `id_url` varchar(50) DEFAULT NULL,
  `class` varchar(20) DEFAULT NULL,
  `menu_order` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `access` varchar(30) NOT NULL DEFAULT '3,9',
  `enable` tinyint(1) NOT NULL DEFAULT '1',
  `special_access` varchar(200) NOT NULL DEFAULT 'all' COMMENT 'theprogrammer,test01@si.co.id',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=77 DEFAULT CHARSET=latin1;

/*Data for the table `menu` */

insert  into `menu`(`id`,`parent_id`,`img`,`title`,`span_img`,`url`,`id_url`,`class`,`menu_order`,`access`,`enable`,`special_access`) values (1,0,'glyphicon glyphicon-list','Home','<span class=\"pull-right\"><i class=\"fa fa-angle-down\"></i></span>','javascript:void(0);','0',NULL,2,'3,9',1,'all'),(2,0,'fa fa-money','Program Wallet','<span class=\"pull-right\"><i class=\"fa fa-angle-down\"></i></span>','javascript:void(0);','0',NULL,3,'3,9',1,'all'),(3,0,'glyphicon glyphicon-bullhorn','Program Education','<span class=\"pull-right\"><i class=\"fa fa-angle-down\"></i></span>','javascript:void(0);','0',NULL,4,'3,9',1,'all'),(4,3,NULL,'Investigation Education',NULL,'investigation_education.php','investigation_education','mm_menuitem',1,'3,9',1,'all'),(5,3,NULL,'Edu Member List',NULL,'edu_member_list.php','edu_member_list','mm_menuitem',2,'3,9',1,'all'),(6,3,NULL,'Edu Robot Trading',NULL,'edu_robot_trading.php','edu_robot_trading','mm_menuitem',4,'3,9',1,'all'),(7,3,NULL,'Edu Registration',NULL,'edu_registration.php','edu_registration','mm_menuitem',3,'3,9',1,'all'),(8,0,'fa  fa-ticket','Program MLM','<span class=\"pull-right\"><i class=\"fa fa-angle-down\"></i></span>','javascript:void(0);','0',NULL,5,'3,9',1,'all'),(9,8,NULL,'MLM Registration',NULL,'mlm_registration.php','mlm_registration','mm_menuitem',1,'3,9',1,'all'),(10,8,NULL,'MLM Tree View',NULL,'treview.php','treview','mm_menuitem',2,'3,9',1,'all'),(11,0,'fa fa-desktop','BackOffice','<span class=\"pull-right\"><i class=\"fa fa-angle-down\"></i></span>','javascript:void(0);','0',NULL,7,'3,9',1,'all'),(13,11,NULL,'Admin','<span class=\"pull-right\"><i class=\"fa fa-angle-down\"></i></span>','javascript:void(0);','0',NULL,2,'3,9',1,'all'),(14,23,NULL,'Admin Apex','<span class=\"pull-right\"><i class=\"fa fa-angle-down\"></i></span>','javascript:void(0);','0',NULL,1,'9',1,'all'),(15,23,NULL,'Gold Saving','<span class=\"pull-right\"><i class=\"fa fa-angle-down\"></i></span>','javascript:void(0);','0',NULL,2,'3,9',1,'all'),(18,13,NULL,'Groups Account',NULL,'group_account.php','group_account','mm_menuitem',1,'3,9',1,'all'),(20,0,'fa fa-usd','Program Trado','<span class=\"pull-right\"><i class=\"fa fa-angle-down\"></i></span>','javascript:void(0);','0',NULL,6,'3,9',1,'all'),(21,0,'fa fa-money','Copy Trade','<span class=\"pull-right\"><i class=\"fa fa-angle-down\"></i></span>','javascript:void(0);','0',NULL,9,'3,9',0,'all'),(22,21,NULL,'Copy Trade',NULL,'copy_trade.php','copy_trade.php','mm_menuitem',1,'3,9',1,'all'),(23,0,'glyphicon glyphicon-asterisk','Apex Regent','<span class=\"pull-right\"><i class=\"fa fa-angle-down\"></i></span>','javascript:void(0);','0',NULL,8,'3,9',1,'all'),(25,1,NULL,'Dashboard','','dashboard1.php','dashboard1','mm_menuitem',1,'3,9',1,'all'),(26,1,NULL,'Trade Investigation Form','','trade_investigationform.php','trade_investigationform','mm_menuitem',2,'3,9',1,'all'),(27,2,NULL,'Deposit Fund',NULL,'deposit.php','deposit','mm_menuitem',1,'3,9',0,'all'),(28,2,NULL,'Withdrawal Fund',NULL,'withdrawal.php','withdrawal','mm_menuitem',2,'3,9',1,'all'),(29,2,NULL,'Transfer Fund',NULL,'transfer_funds.php','transfer_funds','mm_menuitem',3,'3,9',1,'all'),(30,2,NULL,'Withdrawal Details',NULL,'withdrawal_detail.php','withdrawal_detail','mm_menuitem',4,'3,9',0,'all'),(31,2,NULL,'Transaction History',NULL,'transaction_histori.php','transaction_histori','mm_menuitem',5,'3,9',0,'all'),(32,2,NULL,'Investigation Wallet',NULL,'investigation_wallet.php','investigation_wallet','mm_menuitem',6,'3,9',1,'all'),(33,3,NULL,'Education',NULL,'education.php','education','mm_menuitem',5,'3,9',1,'all'),(34,3,NULL,'Download',NULL,'download.php','download','mm_menuitem',6,'3,9',1,'all'),(35,3,NULL,'Request a VPS',NULL,'requestvps.php','requestvps','mm_menuitem',7,'3,9',1,'all'),(36,8,NULL,'Investigation MLM',NULL,'investigation_mlm.php','investigation_mlm','mm_menuitem',3,'3,9',1,'all'),(37,20,NULL,'Marketing Plan',NULL,'marketing_plan.php','marketing_plan','mm_menuitem',1,'3,9',1,'all'),(38,20,NULL,'Registration',NULL,'registration.php','registration','mm_menuitem',2,'3,9',1,'all'),(39,20,NULL,'Account List',NULL,'account_list.php','account_list','mm_menuitem',3,'3,9',1,'all'),(40,20,NULL,'Order Report',NULL,'underconstruct.php','underconstruct','mm_menuitem',4,'3,9',1,'all'),(41,20,NULL,'Open A new Live Account',NULL,'live_account.php','live_account','mm_menuitem',5,'3,9',1,'all'),(42,20,NULL,'Open A new Demo Account',NULL,'demo_account.php','demo_account','mm_menuitem',6,'3,9',1,'all'),(43,20,NULL,'Platform Credentials',NULL,'platform_credentials.php','platform_credentials','mm_menuitem',7,'3,9',1,'all'),(44,20,NULL,'Change Leverage',NULL,'change_leverage.php','change_leverage','mm_menuitem',8,'3,9',1,'all'),(45,20,NULL,'Change Account Password',NULL,'change_account_password.php','change_account_password','mm_menuitem',9,'3,9',1,'all'),(46,20,NULL,'Investigation Trado',NULL,'investigation_trado.php','investigation_trado.php','mm_menuitem',10,'3,9',1,'all'),(47,0,'icon-address-book','Admin','<span class=\"pull-right\"><i class=\"fa fa-angle-down\"></i></span>','',NULL,NULL,1,'9',1,'all'),(48,47,NULL,'Log IP Maxwell Demo',NULL,'logip2.php','logip2','mm_menuitem',1,'9',1,'all'),(49,47,NULL,'Log IP Maxwell Real',NULL,'logip1.php','logip1','mm_menuitem',2,'9',1,'all'),(50,47,NULL,'Log IP Trado Demo',NULL,'logip4.php','logip4','mm_menuitem',3,'9',1,'all'),(51,47,NULL,'Log IP Trado Real',NULL,'logip3.php','logip3','mm_menuitem',4,'9',1,'all'),(52,47,NULL,'Log IP Cabinet',NULL,'logip.php','logip','mm_menuitem',5,'9',1,'all'),(53,47,NULL,'Acc Kota',NULL,'acckota.php','acckota','mm_menuitem',6,'9',1,'all'),(54,47,NULL,'Today Summary',NULL,'report_summary_client.php','report_summary_client','mm_menuitem',7,'9',1,'all'),(55,47,NULL,'Daily Summary',NULL,'report_summary_client_daily.php','report_summary_client_daily','mm_menuitem',8,'9',1,'all'),(56,47,NULL,'Report Turnover Equity',NULL,'report_turnover_running.php','report_turnover_running','mm_menuitem',9,'9',1,'all'),(57,47,NULL,'Report NTR Summary',NULL,'report_equity.php','report_equity','mm_menuitem',10,'9',1,'all'),(58,47,NULL,'NTR Update',NULL,'ntr_update.php','ntr_update','mm_menuitem',11,'9',1,'all'),(59,47,NULL,'MT4 Weekly Initial',NULL,'mt4_weekly_initial.php','mt4_weekly_initial','mm_menuitem',12,'9',1,'all'),(60,23,NULL,'Apex Registration',NULL,'ar_registration.php','ar_registration','mm_menuitem',2,'3,9',1,'test02@si.co.id,theprogrammer'),(61,14,'glyphicon glyphicon-asterisk','Account Management',NULL,'ar_account_mm.php','ar_account_mm','mm_menuitem',1,'9',1,'all'),(62,14,'glyphicon glyphicon-asterisk','Payment',NULL,'ar_admin_payment.php','ar_admin_payment','mm_menuitem',2,'9',1,'all'),(63,14,'glyphicon glyphicon-asterisk','Cron Job Management',NULL,'ar_admin_cron.php','ar_admin_cron','mm_menuitem',3,'9',1,'all'),(64,14,'glyphicon glyphicon-asterisk','Document Confirmation',NULL,'ar_admin_document.php','ar_admin_document','mm_menuitem',4,'9',1,'all'),(65,14,'glyphicon glyphicon-asterisk','Transfer Confirmation',NULL,'ar_admin_transfer.php','ar_admin_transfer','mm_menuitem',5,'9',1,'all'),(66,14,'glyphicon glyphicon-asterisk','Withdrawal Confirmation',NULL,'ar_admin_withdrawal.php','ar_admin_withdrawal','mm_menuitem',6,'9',1,'all'),(67,14,'glyphicon glyphicon-asterisk','Bonus Settings',NULL,'ar_bonus_settings.php','ar_bonus_settings','mm_menuitem',7,'9',1,'all'),(68,14,'glyphicon glyphicon-asterisk','APR Account generator',NULL,'apr_account.php','apr_account','mm_menuitem',8,'9',1,'all'),(69,23,NULL,'Apex Treeview',NULL,'treview.php','treview','mm_menuitem',3,'3,9',1,'all'),(70,23,NULL,'Marketing Plan',NULL,'ar_marketing_plan.php','ar_marketing_plan','mm_menuitem',4,'3,9',1,'all'),(71,23,NULL,'Exchange Rate',NULL,'ar_exchange_rate.php','ar_exchange_rate','mm_menuitem',5,'3,9',1,'all'),(72,2,NULL,'Information',NULL,'ar_ewallet_information.php','ar_ewallet_information','mm_menuitem',2,'3,9',1,'all'),(73,15,NULL,'Transfer Fund',NULL,'ar_transfer_goldsaving.php','ar_transfer_goldsaving','mm_menuitem',1,'3,9',1,'all'),(74,15,NULL,'Information',NULL,'ar_goldsaving_information.php','ar_goldsaving_information','mm_menuitem',2,'3,9',1,'all'),(75,23,NULL,'Payment Center','<span class=\"pull-right\"><i class=\"fa fa-angle-down\"></i></span>','javascript:void(0);','0',NULL,2,'3,9',1,'all'),(76,75,NULL,'Payment Confirmation',NULL,'ar_payment.php','ar_payment','mm_menuitem',2,'3,9',1,'all');

/*Table structure for table `mlm` */

DROP TABLE IF EXISTS `mlm`;

CREATE TABLE `mlm` (
  `mt4dt` varchar(100) DEFAULT NULL,
  `ACCNO` varchar(30) DEFAULT NULL,
  `Upline` varchar(30) DEFAULT NULL,
  `datetime` datetime DEFAULT NULL,
  `updateby` varchar(255) DEFAULT NULL,
  `companyconfirm` char(1) DEFAULT '0' COMMENT '0 belum transfer,1 sudah transfer,2 sudah confirm, 3 sudah fullfill, 4 sudah wd, 5 remove',
  `payment` varchar(10) DEFAULT '0' COMMENT 'jumlahuang',
  `group_play` varchar(255) DEFAULT NULL,
  `mt4login` int(11) DEFAULT NULL,
  `is_real` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `mlm` */

insert  into `mlm`(`mt4dt`,`ACCNO`,`Upline`,`datetime`,`updateby`,`companyconfirm`,`payment`,`group_play`,`mt4login`,`is_real`) values ('nometa','COMPANY','COMPANY','2015-04-03 10:59:11','theprogrammer','0','0','no_plan',NULL,0),('nometa','9999100','COMPANY','2016-04-19 09:47:37','theprogrammer','2','2','ClubSilver100',NULL,0),('nometa','9999250','COMPANY','2016-04-19 09:47:37','theprogrammer','2','2','ClubSilver250',NULL,0),('nometa','9999500','COMPANY','2016-04-19 09:47:37','theprogrammer','2','2','ClubSilver500',NULL,0),('nometa','99991000','COMPANY','2016-04-19 09:47:37','theprogrammer','2','2','ExeSilverClub1000',NULL,0),('nometa','99992500','COMPANY','2016-04-19 09:47:37','theprogrammer','2','2','ExeSilverClub2500',NULL,0),('nometa','99995000','COMPANY','2016-04-19 09:47:37','theprogrammer','2','2','VipGoldClub5000',NULL,0),('nometa','999910000','COMPANY','2016-04-19 09:47:37','theprogrammer','2','2','VvipGoldClub10000',NULL,0);

/*Table structure for table `mlm_bonus_logs` */

DROP TABLE IF EXISTS `mlm_bonus_logs`;

CREATE TABLE `mlm_bonus_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(20) NOT NULL,
  `bonus_type` varchar(100) NOT NULL,
  `amount` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `comment` text,
  `date_receipt` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `wcb_comment` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

/*Data for the table `mlm_bonus_logs` */

/*Table structure for table `mlm_bonus_settings` */

DROP TABLE IF EXISTS `mlm_bonus_settings`;

CREATE TABLE `mlm_bonus_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_play` varchar(50) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `amount` double(10,4) DEFAULT NULL,
  `wcd` varchar(50) DEFAULT NULL,
  `wrb` varchar(10) DEFAULT NULL,
  `wcb` int(10) DEFAULT NULL,
  `lv` int(2) DEFAULT NULL,
  `mlmaccount` varchar(100) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `mlm_bonus_settings` */

insert  into `mlm_bonus_settings`(`id`,`group_play`,`description`,`amount`,`wcd`,`wrb`,`wcb`,`lv`,`mlmaccount`) values (1,'ClubSilver100','Club Silver USD 100',100.0000,'1','6-1',5,1,'9999100'),(2,'ClubSilver250','Club Silver USD 250',250.0000,'2','6-1',5,2,'9999250'),(3,'ClubSilver500','Club Silver USD 500',500.0000,'3','6-1',5,3,'9999500'),(4,'ExeSilverClub1000','Executive Silver Club USD 1000',1000.0000,'4','7-2',5,4,'99991000'),(5,'ExeSilverClub2500','Executive Silver Club USD 2500',2500.0000,'5','8-3',5,4,'99992500'),(6,'VipGoldClub5000','VIP Gold Club USD 5000',5000.0000,'6','9-4',5,5,'99995000'),(7,'VvipGoldClub10000','VVIP Gold Club USD 10000',10000.0000,'7','10-5',5,6,'999910000'),(8,'no_plan','This Plan For Company Only',0.0000,'8','7-2',5,NULL,'COMPANY');

/*Table structure for table `mlm_cron` */

DROP TABLE IF EXISTS `mlm_cron`;

CREATE TABLE `mlm_cron` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `module` varchar(100) DEFAULT NULL,
  `full` varchar(100) DEFAULT NULL,
  `last_run` datetime DEFAULT NULL,
  `file` varchar(200) DEFAULT NULL,
  `comment` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `mlm_cron` */

insert  into `mlm_cron`(`id`,`module`,`full`,`last_run`,`file`,`comment`) values (1,'wcd','WEALTH CLUB DIVIDEND','2016-04-28 10:47:00','ar_admin_wcd.php','This process running once a day at 23:59 PM.'),(2,'pv','MONTHLY PV','2016-04-14 19:10:27','ar_admin_pv.php','This process should be run once a month'),(3,'rqb','RANK QUALIFICATION BONUS','2016-04-14 19:10:53','ar_admin_rqb.php','This program should be run every end of month'),(4,'wcb','WEALTH CLUB BONUS','2016-04-14 19:10:46','ar_admin_wcb.php','This process running once a day at 23:59 PM.'),(5,'multi','MULTI LINE ROI CLUB BONUS','2016-04-14 19:10:20','ar_admin_multi.php','This program should be run every end of month');

/*Table structure for table `mlm_ewallet` */

DROP TABLE IF EXISTS `mlm_ewallet`;

CREATE TABLE `mlm_ewallet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aecode` int(11) DEFAULT NULL,
  `account` varchar(20) DEFAULT NULL,
  `balance` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `balance_prev` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `lastupdate` datetime DEFAULT NULL,
  `lastupdate_prev` datetime DEFAULT NULL,
  `comment` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=latin1;

/*Data for the table `mlm_ewallet` */

insert  into `mlm_ewallet`(`id`,`aecode`,`account`,`balance`,`balance_prev`,`lastupdate`,`lastupdate_prev`,`comment`) values (2,1,'COMPANY',0.0000,0.0000,'2016-04-19 10:50:15','2016-04-19 09:50:37',NULL),(15,2,'160420141',0.0000,0.0000,'2016-04-20 15:09:26','2016-04-20 15:09:26',''),(16,23,'160421101',1175.0000,175.0000,'2016-04-29 14:41:56','2016-04-28 01:00:00',''),(17,24,'160421111',1230.0000,1220.0000,'2016-04-30 13:11:06','2016-04-30 13:11:06',''),(18,26,'160421141',0.0000,0.0000,'2016-04-21 15:11:13','2016-04-21 15:11:13',''),(19,27,'160421142',0.0000,0.0000,'2016-04-21 15:14:24','2016-04-21 15:14:24',''),(20,28,'160421143',78.7500,70.0000,'2016-05-02 01:00:00','2016-05-01 01:00:00',''),(21,29,'160421144',0.0000,0.0000,'2016-04-21 15:23:47','2016-04-21 15:23:47',''),(22,25,'160421145',100.0000,0.0000,'2016-04-29 14:57:50','2016-04-21 15:29:23',''),(23,30,'160421151',0.0000,0.0000,'2016-04-21 16:43:41','2016-04-21 16:43:41',''),(24,29,'160421201',0.0000,0.0000,'2016-04-21 21:24:50','2016-04-21 21:24:50',''),(25,29,'160421202',0.0000,0.0000,'2016-04-21 21:26:28','2016-04-21 21:26:28',''),(26,28,'160421203',0.0000,0.0000,'2016-04-21 21:35:16','2016-04-21 21:35:16',''),(27,31,'160422141',0.0000,0.0000,'2016-04-22 15:18:58','2016-04-22 15:18:58',''),(28,27,'160422191',0.0000,0.0000,'2016-04-22 20:08:33','2016-04-22 20:08:33',''),(29,33,'160422192',0.0000,0.0000,'2016-04-22 20:28:47','2016-04-22 20:28:47',''),(30,34,'160424111',0.0000,0.0000,'2016-04-24 12:28:04','2016-04-24 12:28:04',''),(31,11,'160426231',0.0000,0.0000,'2016-04-27 00:27:54','2016-04-27 00:27:54',''),(32,35,'160426232',0.0000,0.0000,'2016-04-27 00:34:06','2016-04-27 00:34:06',''),(33,28,'160427151',0.0000,0.0000,'2016-04-27 16:53:38','2016-04-27 16:53:38',''),(34,28,'160427181',0.0000,0.0000,'2016-04-27 19:04:20','2016-04-27 19:04:20',''),(35,37,'160428191',0.0000,0.0000,'2016-04-28 20:02:53','2016-04-28 20:02:53',''),(36,1,'9999100',0.0000,0.0000,'2016-04-28 20:02:53','2016-04-28 20:02:53',NULL),(37,1,'9999250',0.0000,0.0000,'2016-04-28 20:02:53','2016-04-28 20:02:53',NULL),(38,1,'9999500',0.0000,0.0000,'2016-04-28 20:02:53','2016-04-28 20:02:53',NULL),(39,1,'99991000',0.0000,0.0000,'2016-04-28 20:02:53','2016-04-28 20:02:53',NULL),(40,1,'99992500',0.0000,0.0000,'2016-04-28 20:02:53','2016-04-28 20:02:53',NULL),(41,1,'99995000',0.0000,0.0000,'2016-04-28 20:02:53','2016-04-28 20:02:53',NULL),(42,1,'999910000',0.0000,0.0000,'2016-04-28 20:02:53','2016-04-28 20:02:53',NULL),(43,38,'160430121',0.0000,0.0000,'2016-04-30 13:02:20','2016-04-30 13:02:20','');

/*Table structure for table `mlm_goldsaving` */

DROP TABLE IF EXISTS `mlm_goldsaving`;

CREATE TABLE `mlm_goldsaving` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `aecode` int(11) DEFAULT NULL,
  `account` varchar(20) DEFAULT NULL,
  `balance` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `balance_prev` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `lastupdate` datetime DEFAULT NULL,
  `lastupdate_prev` datetime DEFAULT NULL,
  `comment` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

/*Data for the table `mlm_goldsaving` */

insert  into `mlm_goldsaving`(`id`,`aecode`,`account`,`balance`,`balance_prev`,`lastupdate`,`lastupdate_prev`,`comment`) values (4,1,'COMPANY',0.0000,0.0000,'2016-04-19 10:50:15','2016-04-19 09:50:37',''),(37,1,'9999100',0.0000,0.0000,'2016-04-28 20:02:53','2016-04-28 20:02:53',NULL),(38,1,'9999250',0.0000,0.0000,'2016-04-28 20:02:53','2016-04-28 20:02:53',NULL),(39,1,'9999500',0.0000,0.0000,'2016-04-28 20:02:53','2016-04-28 20:02:53',NULL),(40,1,'99991000',0.0000,0.0000,'2016-04-28 20:02:53','2016-04-28 20:02:53',NULL),(41,1,'99992500',0.0000,0.0000,'2016-04-28 20:02:53','2016-04-28 20:02:53',NULL),(42,1,'99995000',0.0000,0.0000,'2016-04-28 20:02:53','2016-04-28 20:02:53',NULL),(43,1,'999910000',0.0000,0.0000,'2016-04-28 20:02:53','2016-04-28 20:02:53',NULL);

/*Table structure for table `mlm_payment` */

DROP TABLE IF EXISTS `mlm_payment`;

CREATE TABLE `mlm_payment` (
  `IDPay` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `aecode` varchar(40) NOT NULL DEFAULT '',
  `MerchantID` varchar(40) NOT NULL DEFAULT '',
  `Account` varchar(15) NOT NULL DEFAULT '',
  `Amount` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `TxnStatus` varchar(11) DEFAULT NULL,
  `TxnDate` varchar(11) DEFAULT NULL,
  `TxnTime` varchar(11) DEFAULT NULL,
  `date_confirm` datetime NOT NULL,
  `PayType` varchar(50) NOT NULL DEFAULT '',
  `PayMethod` varchar(11) DEFAULT NULL,
  `ErrorCode` varchar(11) DEFAULT NULL,
  `Status` varchar(11) DEFAULT NULL,
  `PayDoc` text,
  `keterangan` text,
  `PayFor` varchar(100) NOT NULL DEFAULT 'no_pay',
  PRIMARY KEY (`IDPay`)
) ENGINE=InnoDB AUTO_INCREMENT=71 DEFAULT CHARSET=latin1;

/*Data for the table `mlm_payment` */

/*Table structure for table `mlm_rqb_settings` */

DROP TABLE IF EXISTS `mlm_rqb_settings`;

CREATE TABLE `mlm_rqb_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name_rank` varchar(50) DEFAULT NULL,
  `amount` double(10,4) DEFAULT NULL,
  `ql` int(3) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `mlm_rqb_settings` */

insert  into `mlm_rqb_settings`(`id`,`name_rank`,`amount`,`ql`) values (1,'USD 1K',1000.0000,3),(2,'USD 5K',5000.0000,3),(3,'USD 10K',10000.0000,3),(4,'USD 20K',20000.0000,3),(5,'USD 50K',50000.0000,3),(6,'USD 100K',100000.0000,3),(7,'USD 500K',500000.0000,3),(8,'USD 750K',750000.0000,3),(10,'USD 1.0M',999999.9999,3);

/*Table structure for table `mlm_transaction` */

DROP TABLE IF EXISTS `mlm_transaction`;

CREATE TABLE `mlm_transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_transaction` varchar(100) DEFAULT NULL,
  `date_transaction` datetime DEFAULT NULL,
  `account_from` varchar(25) DEFAULT NULL,
  `account_destination` varchar(25) DEFAULT NULL,
  `method_transaction` varchar(100) DEFAULT NULL,
  `amount` decimal(10,4) DEFAULT NULL,
  `comment` text,
  `status` int(2) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `mlm_transaction` */

/*Table structure for table `mlm_wcb` */

DROP TABLE IF EXISTS `mlm_wcb`;

CREATE TABLE `mlm_wcb` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` varchar(30) DEFAULT NULL,
  `registered` varchar(200) NOT NULL DEFAULT '0',
  `amount` decimal(10,4) DEFAULT NULL,
  `payment` int(2) NOT NULL DEFAULT '0',
  `PayDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `mlm_wcb` */

/*Table structure for table `mlm_wcd` */

DROP TABLE IF EXISTS `mlm_wcd`;

CREATE TABLE `mlm_wcd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account` int(30) DEFAULT NULL,
  `last_pay` date NOT NULL DEFAULT '0000-00-00',
  `next_pay` date NOT NULL DEFAULT '0000-00-00',
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=latin1;

/*Data for the table `mlm_wcd` */

/*Table structure for table `mt4_utility` */

DROP TABLE IF EXISTS `mt4_utility`;

CREATE TABLE `mt4_utility` (
  `description` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `lastregdate` datetime DEFAULT '1976-07-11 00:34:04',
  `balanceticket` datetime DEFAULT '1976-07-11 00:34:04',
  `liquidticket` datetime DEFAULT '1976-07-11 00:34:04',
  `opendate` datetime DEFAULT '1976-07-11 00:34:04',
  `machine` varchar(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mt4_utility` */

insert  into `mt4_utility`(`description`,`status`,`lastregdate`,`balanceticket`,`liquidticket`,`opendate`,`machine`) values ('Export Meta Check','check Trade:Insert Liq Done','2015-05-28 14:54:33','2015-07-23 22:46:33','2015-07-24 16:05:31','2015-07-24 20:56:31','1');

/*Table structure for table `mt_database` */

DROP TABLE IF EXISTS `mt_database`;

CREATE TABLE `mt_database` (
  `alias` varchar(100) DEFAULT NULL,
  `mt4dt` varchar(100) DEFAULT NULL,
  `enabled` char(3) DEFAULT 'yes',
  `logo` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mt_database` */

insert  into `mt_database`(`alias`,`mt4dt`,`enabled`,`logo`) values ('CCF Real','ccf_source','yes','images/logo/ccf/logo.png'),('SIB Real','sibfx_source','yes','images/logo/sibfx/logo.png'),('Indosukses Real','isf_source','yes','images/logo/isf/logo.png'),('Premiere Real','premiere_source','yes','images/logo/premiere/logo.png');

/*Table structure for table `mt_filter` */

DROP TABLE IF EXISTS `mt_filter`;

CREATE TABLE `mt_filter` (
  `value` varchar(20) DEFAULT NULL,
  `description` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mt_filter` */

insert  into `mt_filter`(`value`,`description`) values ('1=1','All'),('cpu','CPU'),('data feed','Data Feed'),('login','Login'),('groupcontext','Group Context'),('memory','Memory'),('password','Password'),('service','Servie'),('watch dog','Sync Backup');

/*Table structure for table `mt_log` */

DROP TABLE IF EXISTS `mt_log`;

CREATE TABLE `mt_log` (
  `alias` varchar(100) DEFAULT NULL,
  `mt4dt` varchar(100) DEFAULT NULL,
  `namafile` varchar(100) DEFAULT 'logip.php',
  `enabled` char(3) DEFAULT 'no'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `mt_log` */

insert  into `mt_log`(`alias`,`mt4dt`,`namafile`,`enabled`) values ('Log IP Maxwell Real','maxwell_real_logs','logip1.php','yes'),('Log IP Maxwell Demo','maxwell_demo_log','logip2.php','yes'),('Log IP Trado Real','trado_real_logs','logip3.php','yes'),('Log IP Trado Demo','trado_demo_log','logip4.php','yes');

/*Table structure for table `nodetables` */

DROP TABLE IF EXISTS `nodetables`;

CREATE TABLE `nodetables` (
  `NodeID` int(10) NOT NULL AUTO_INCREMENT,
  `NodeName` varchar(50) NOT NULL DEFAULT '',
  `IsFolder` int(4) NOT NULL DEFAULT '0',
  `ParentID` int(4) NOT NULL DEFAULT '0',
  `Link` varchar(255) NOT NULL DEFAULT '',
  `issupervisor` int(4) NOT NULL DEFAULT '0',
  `ismanager` int(4) NOT NULL DEFAULT '0',
  `isassistant` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`NodeID`)
) ENGINE=InnoDB AUTO_INCREMENT=176 DEFAULT CHARSET=latin1;

/*Data for the table `nodetables` */

insert  into `nodetables`(`NodeID`,`NodeName`,`IsFolder`,`ParentID`,`Link`,`issupervisor`,`ismanager`,`isassistant`) values (1,'Root',0,-1,'',0,0,0),(2,'Trade History',1,96,'admin_main.php',0,1,0),(3,'Group Statement Running',1,46,'branch_statement.php',0,1,0),(8,'Temp Statements',1,46,'tempstatement.php',0,1,0),(12,'Accounts Reports Settled',1,46,'accountsreport2.php',0,1,0),(13,'Manage Accounts',1,130,'accounts.php',0,0,0),(14,'Manage Groups',1,45,'groups.php',0,0,0),(15,'Account Suspension',1,45,'suspension.php',0,0,0),(20,'Announcement',1,49,'announcement.php',0,0,0),(23,'Log History',1,46,'log_history.php',0,0,0),(26,'Configure Interest',1,105,'setting_interest.php?postmode=settings',0,0,0),(38,'Accounts Reports Open',1,46,'accountsreport.php',0,1,0),(45,'MANAGE',0,1,'',0,0,0),(46,'REPORT DRAFT',0,1,'',0,0,0),(47,'Profit and loss',1,46,'pricemaker_statement.php',0,0,0),(49,'Belum Selesai',0,1,'',0,0,0),(51,'Daily Statement',1,46,'daily_statement.php',0,1,0),(54,'Manage Accounts Search',1,45,'accounts2.php',0,0,0),(69,'Manage Counters',1,67,'m_counters.php',0,1,0),(84,'User Option',1,1,'user.php?mode=changepassword',1,1,1),(93,'Counter Open',1,46,'markettime.php',0,0,0),(95,'Trade Pending',1,100,'admin_main_pending.php',0,0,0),(103,'Open Order',1,45,'liquid_position.php',0,1,0),(105,'Super Admin',0,1,'',0,0,0),(106,'Manage Admin Menu',1,105,'manage_admin.php',0,0,0),(107,'Manage Admin Accounts',1,105,'accounts_admin.php',0,0,0),(108,'Configure Category',1,105,'setting_menu_responsibility.php',0,0,0),(109,'Equity Ratio',1,46,'autowatch.php',0,1,0),(112,'Group Statement Daily',1,46,'group_statement_daily.php',0,1,0),(113,'History Statement',1,46,'history_statement.php',0,1,0),(114,'Group Statement Daily Open',1,46,'group_statement_daily_details.php',0,1,0),(115,'Daily Statement Admin',1,46,'daily_statement_admin.php',0,0,0),(116,'Control Marking Report',1,46,'control_mr.php',0,0,0),(117,'DOR Daily',1,46,'report_dor_daily_tradeid.php',0,0,0),(118,'DOR Running',1,46,'report_dor_running_tradeid.php',0,0,0),(120,'Trade Hist. Multi',1,96,'admin_main_multi.php',0,0,0),(124,'Trade_Dealing',1,96,'admin_semim_dealing.php',0,0,0),(126,'MM Manual',1,46,'mmmanual.php',0,0,1),(127,'Bank',0,1,'',0,0,0),(128,'Serah Terima Barang',1,146,'penerimaan.php',1,0,0),(129,'Serah Terima Daily',1,146,'penerimaan_daily.php',1,0,0),(130,'Broker Admin',0,1,'',0,0,0),(131,'Create Broker',1,105,'an_brokeraccounts_search.php?postmode=view_searchuser',0,0,0),(132,'Broker Admin Accounts',1,130,'broker_admin.php',0,0,0),(133,'Broker Admin Menu',1,130,'manage_brokeradmin.php',0,0,0),(134,'Broker Groups AE Account',1,130,'brokergroupaeaccount.php?postmode=view_searchuser     ',0,0,0),(135,'Broker Margin Rp',1,130,'broker_margin.php?postmode=searchuser',0,0,0),(136,'Day End',1,137,'broker_day_end.php?postmode=start',0,0,0),(137,'JFX',0,1,'',0,0,0),(138,'Laporan Rekening Per Account',1,46,'laporanrekeningperaccount.php',0,0,0),(139,'Broker Dealing',0,1,'',0,0,0),(140,'Laporan Rekening Per Branch',1,139,'laporanrekeningperbranch.php',0,0,0),(141,'Counter Common',1,137,'counters_common.php?postmode=viewcounters',0,0,0),(142,'Counters Broker',1,130,'counters_broker.php?postmode=viewbranchsettings',0,0,0),(143,'Counters Account',1,130,'counters_account.php?postmode=viewaccountsettings',0,0,0),(144,'MM Report',1,46,'mm_report.php',0,0,0),(145,'TradeFeed KBI',1,146,'report_jfx_trades.php',0,0,0),(146,'KBI',0,1,'',0,0,0),(147,'Broker Margin Gold',1,168,'broker_margin_gold.php?postmode=searchuser',0,0,0),(148,'Trades Form',1,137,'report_jfx_trades.php',0,0,0),(149,'Price Quotation',1,137,'antam_feeder.php',0,0,0),(150,'Delivery',0,1,'',0,0,0),(151,'Serah Terima Barang',1,150,'penerimaan.php',1,0,0),(152,'Serah Terima Daily',1,150,'penerimaan_daily.php',0,0,0),(153,'Admin',0,1,'',0,0,0),(154,'Manage Admin Accounts',1,153,'accounts_admin.php',0,0,0),(155,'Manage Admin Menu',1,153,'manage_admin.php',0,0,0),(156,'Create Broker',1,153,'an_brokeraccounts_search.php?postmode=view_searchuser',0,0,0),(157,'USER GUIDE BROKER',0,1,'',0,0,0),(158,'Download User Guide',1,157,'../usermanual/PETUNJUK PENGGUNAAN BROKER.pdf',0,0,0),(159,'USER GUIDE KBI',0,1,'',0,0,0),(160,'USER GUIDE BBJ',0,1,'',0,0,0),(161,'Download User Guide',1,159,'../usermanual/User Manual KBI.pdf',0,0,0),(162,'Download User Guide',1,160,'../usermanual/User Manual USER BBJ.pdf',0,0,0),(164,'Laporan Rekening in Excell',1,137,'laporanrekeningkbi.php',0,0,0),(165,'History Transaksi All',1,137,'historytransaksijfx.php',0,0,0),(166,'History Transaksi All KBI',1,146,'historytransaksijfx.php',0,0,0),(167,'Laporan Rekening in Excell',1,146,'laporanrekeningkbi.php',0,0,0),(168,'Broker MM',0,1,'',0,0,0),(169,'Laporan KBI3',1,146,'laporan_kbi3.php',0,0,0),(170,'Rekapitulasi',1,146,'report_kbi_rekap.php',0,0,0),(171,'Update Accounts',1,105,'updateaccounts.php?mulai=1',0,0,0),(172,'MM Sistem Log',1,137,'mm_time.php',0,0,0),(173,'KBI Interest',1,146,'laporankbi_interest.php',0,0,0),(174,'Laporan Summary 1',1,105,'laporansummary1.php',0,0,0),(175,'Laporan Summary 2',1,105,'laporansummary2.php',0,0,0);

/*Table structure for table `payment` */

DROP TABLE IF EXISTS `payment`;

CREATE TABLE `payment` (
  `IDPay` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `MerchantID` varchar(40) NOT NULL DEFAULT '',
  `Account` varchar(15) NOT NULL DEFAULT '',
  `Amount` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `TxnStatus` varchar(11) DEFAULT NULL,
  `TxnDate` varchar(11) DEFAULT NULL,
  `TxnTime` varchar(11) DEFAULT NULL,
  `PayMethod` varchar(11) DEFAULT NULL,
  `ErrorCode` varchar(11) DEFAULT NULL,
  `Status` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`IDPay`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `payment` */

/*Table structure for table `paypal` */

DROP TABLE IF EXISTS `paypal`;

CREATE TABLE `paypal` (
  `ACCNO` varchar(30) DEFAULT NULL,
  `timeupdate` datetime DEFAULT NULL,
  `trans_dec` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `paypal` */

/*Table structure for table `pioneer` */

DROP TABLE IF EXISTS `pioneer`;

CREATE TABLE `pioneer` (
  `version` int(11) NOT NULL,
  `status` varchar(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `pioneer` */

insert  into `pioneer`(`version`,`status`) values (206,'must');

/*Table structure for table `quote` */

DROP TABLE IF EXISTS `quote`;

CREATE TABLE `quote` (
  `symbolmt` varchar(50) DEFAULT NULL,
  `SYMBOL` varchar(50) NOT NULL DEFAULT '',
  `timereject` char(4) DEFAULT '30',
  `jumper` float(7,4) DEFAULT '1.0000',
  `category` varchar(16) DEFAULT '0',
  `Acemach_Code` varchar(50) DEFAULT NULL,
  `Alias` varchar(11) DEFAULT NULL,
  `DESCRIPTION` varchar(100) DEFAULT NULL,
  `SYMBOLREUTERS` varchar(50) DEFAULT NULL,
  `STATUSREUTERS` varchar(9) DEFAULT 'active',
  `sequence` int(2) DEFAULT NULL,
  `StatusTq` varchar(9) DEFAULT 'active',
  `bid` varchar(50) DEFAULT '0',
  `ask` varchar(50) DEFAULT '0',
  `Last` varchar(50) DEFAULT '0',
  `high` varchar(50) DEFAULT '0',
  `low` varchar(50) DEFAULT '0',
  `open` varchar(50) DEFAULT '0',
  `prev_close` varchar(15) DEFAULT '0',
  `change` varchar(50) DEFAULT '0',
  `volume` varchar(50) DEFAULT '0',
  `Time` varchar(20) DEFAULT NULL,
  `lasttobid` varchar(50) DEFAULT '0',
  `lasttoask` varchar(50) DEFAULT '0',
  `round_mask` int(2) DEFAULT '0',
  `FORMAT_MASK` varchar(50) DEFAULT NULL,
  `timeupdate` varchar(255) DEFAULT '0000-00-00 00:00:00',
  `STATUS` varchar(9) DEFAULT 'active',
  `packettype` char(3) DEFAULT NULL,
  `autohighlow` char(3) DEFAULT 'no',
  `prev_price` varchar(50) DEFAULT '0',
  `bidexg` char(3) DEFAULT NULL,
  PRIMARY KEY (`SYMBOL`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `quote` */

insert  into `quote`(`symbolmt`,`SYMBOL`,`timereject`,`jumper`,`category`,`Acemach_Code`,`Alias`,`DESCRIPTION`,`SYMBOLREUTERS`,`STATUSREUTERS`,`sequence`,`StatusTq`,`bid`,`ask`,`Last`,`high`,`low`,`open`,`prev_close`,`change`,`volume`,`Time`,`lasttobid`,`lasttoask`,`round_mask`,`FORMAT_MASK`,`timeupdate`,`STATUS`,`packettype`,`autohighlow`,`prev_price`,`bidexg`) values ('AUDJPY','AUDJPY','30',0.9000,'currency','AUDJPY','AUDJPY','AUDJPY','AUDJPY','active',2,'active','0','0','0','0','0','0','0','0','0','2011-08-11 20:46:00','0','0',2,'#####','0','active',NULL,'no','0',NULL),('AUDUSD','AUDUSD','30',0.9000,'currency','AUDUSD','AUDUSD','AUDUSD','AUDUSD','active',1,'active','0','0','0','0','0','0','0','0','0','2011-08-11 20:46:00','0','0',4,'#####','0','active',NULL,'no','0',NULL),('CHFJPY','CHFJPY','30',0.9000,'currency','CHFJPY','CHFJPY','CHFJPY','CHFJPY','active',6,'nonactive','0','0','0','0','0','0','0','0','0','2011-08-16 20:00:00','0','0',0,'#####','0','active',NULL,'no','0',NULL),('EURJPY','EURJPY','30',0.9000,'currency','EURJPY','EURJPY','EURJPY','EURJPY','active',5,'active','0','0','0','0','0','0','0','0','0','2013-04-04 00:00:00','0','0',0,'#####','0','active',NULL,'no','0',NULL),('EURUSD','EURUSD','30',0.9000,'currency','EURUSD','EURUSD','EURUSD','EURUSD','active',4,'nonactive','0','0','0','0','0','0','0','0','0','2011-08-14 20:46:00','0','0',4,'#####','0','active',NULL,'no','0',NULL),('GBPUSD','GBPUSD','30',0.9000,'currency','GBPUSD','GBPUSD','GBPUSD','GBPUSD','active',3,'nonactive','0','0','0','0','0','0','0','0','0','2011-08-13 20:46:00','0','0',4,'#####','0','active',NULL,'no','0',NULL),('HKJ50F3.','HKJ50F3.','30',0.9000,'currency','HKJ50F3.','HKJ50F3.','HKJ50F3.','HKJ50F3.','active',31,'nonactive','0','0','0','0','0','0','0','0','0','2011-09-10 20:46:00','0','0',0,'#####','0','active',NULL,'no','0',NULL),('HKJ50G3.','HKJ50G3.','30',0.9000,'currency','HKJ50G3.','HKJ50G3.','HKJ50G3.','HKJ50G3.','active',32,'nonactive','0','0','0','0','0','0','0','0','0','2011-09-11 20:46:00','0','0',0,'#####','0','active',NULL,'no','0',NULL),('HKJ50H3.','HKJ50H3.','30',0.9000,'currency','HKJ50H3.','HKJ50H3.','HKJ50H3.','HKJ50H3.','active',33,'nonactive','0','0','0','0','0','0','0','0','0','2011-09-12 20:46:00','0','0',0,'#####','0','active',NULL,'no','0',NULL),('HKJ50J3.','HKJ50J3.','30',0.9000,'currency','HKJ50J3.','HKJ50J3.','HKJ50J3.','HKJ50J3.','active',34,'nonactive','0','0','0','0','0','0','0','0','0','2011-09-13 20:46:00','0','0',0,'#####','0','active',NULL,'no','0',NULL),('HKJ50K3.','HKJ50K3.','30',0.9000,'currency','HKJ50K3.','HKJ50K3.','HKJ50K3.','HKJ50K3.','active',35,'nonactive','0','0','0','0','0','0','0','0','0','2011-09-14 20:46:00','0','0',0,'#####','0','active',NULL,'no','0',NULL),('HKJ50M3.','HKJ50M3.','30',0.9000,'currency','HKJ50M3.','HKJ50M3.','HKJ50M3.','HKJ50M3.','active',36,'nonactive','0','0','0','0','0','0','0','0','0','2011-09-15 20:46:00','0','0',0,'#####','0','active',NULL,'no','0',NULL),('HKJ50N3.','HKJ50N3.','30',0.9000,'currency','HKJ50N3.','HKJ50N3.','HKJ50N3.','HKJ50N3.','active',37,'nonactive','0','0','0','0','0','0','0','0','0','2011-09-16 20:46:00','0','0',0,'#####','0','active',NULL,'no','0',NULL),('HKJ50Q3.','HKJ50Q3.','30',0.9000,'currency','HKJ50Q3.','HKJ50Q3.','HKJ50Q3.','HKJ50Q3.','active',38,'nonactive','0','0','0','0','0','0','0','0','0','2011-09-17 20:46:00','0','0',0,'#####','0','active',NULL,'no','0',NULL),('HKJ50U3.','HKJ50U3.','30',0.9000,'currency','HKJ50U3.','HKJ50U3.','HKJ50U3.','HKJ50U3.','active',39,'nonactive','0','0','0','0','0','0','0','0','0','2011-09-18 20:46:00','0','0',0,'#####','0','active',NULL,'no','0',NULL),('HKJ50V3.','HKJ50V3.','30',0.9000,'currency','HKJ50V3.','HKJ50V3.','HKJ50V3.','HKJ50V3.','active',40,'nonactive','0','0','0','0','0','0','0','0','0','2011-09-19 20:46:00','0','0',0,'#####','0','active',NULL,'no','0',NULL),('HKJ50X3.','HKJ50X3.','30',0.9000,'currency','HKJ50X3.','HKJ50X3.','HKJ50X3.','HKJ50X3.','active',41,'nonactive','0','0','0','0','0','0','0','0','0','2011-09-20 20:46:00','0','0',0,'#####','0','active',NULL,'no','0',NULL),('HKJ50Z3.','HKJ50Z3.','30',0.9000,'currency','HKJ50Z3.','HKJ50Z3.','HKJ50Z3.','HKJ50Z3.','active',42,'nonactive','0','0','0','0','0','0','0','0','0','2011-09-21 20:46:00','0','0',0,'#####','0','active',NULL,'no','0',NULL),('HKK50#','HKK50#','30',0.9000,'currency','HKK50#','HKK50#','HKK50#','HKK50#','active',8,'nonactive','0','0','0','0','0','0','0','0','0','2011-08-18 20:46:00','0','0',0,'#####','0','active',NULL,'no','0',NULL),('HKK50.','HKK50.','30',0.9000,'currency','HKK50.','HKK50.','HKK50.','HKK50.','active',10,'nonactive','0','0','0','0','0','0','0','0','0','2011-08-20 20:46:00','0','0',0,'#####','0','active',NULL,'no','0',NULL),('HSIF','HSIF','30',0.9000,'currency','HSIF','HSIF','HSIF','HSIF','active',19,'nonactive','0','0','0','0','0','0','0','0','0','2011-08-29 20:46:00','0','0',0,'#####','0','active',NULL,'no','0',NULL),('HSIG','HSIG','30',0.9000,'currency','HSIG','HSIG','HSIG','HSIG','active',20,'nonactive','0','0','0','0','0','0','0','0','0','2011-08-30 20:46:00','0','0',0,'#####','0','active',NULL,'no','0',NULL),('HSIH','HSIH','30',0.9000,'currency','HSIH','HSIH','HSIH','HSIH','active',21,'nonactive','0','0','0','0','0','0','0','0','0','2011-08-31 20:46:00','0','0',0,'#####','0','active',NULL,'no','0',NULL),('HSIJ','HSIJ','30',0.9000,'currency','HSIJ','HSIJ','HSIJ','HSIJ','active',22,'nonactive','0','0','0','0','0','0','0','0','0','2011-09-01 20:46:00','0','0',0,'#####','0','active',NULL,'no','0',NULL),('HSIK','HSIK','30',0.9000,'currency','HSIK','HSIK','HSIK','HSIK','active',23,'nonactive','0','0','0','0','0','0','0','0','0','2011-09-02 20:46:00','0','0',0,'#####','0','active',NULL,'no','0',NULL),('HSIM','HSIM','30',0.9000,'currency','HSIM','HSIM','HSIM','HSIM','active',24,'nonactive','0','0','0','0','0','0','0','0','0','2011-09-03 20:46:00','0','0',0,'#####','0','active',NULL,'no','0',NULL),('HSIN','HSIN','30',0.9000,'currency','HSIN','HSIN','HSIN','HSIN','active',25,'nonactive','0','0','0','0','0','0','0','0','0','2011-09-04 20:46:00','0','0',0,'#####','0','active',NULL,'no','0',NULL),('HSIQ','HSIQ','30',0.9000,'currency','HSIQ','HSIQ','HSIQ','HSIQ','active',26,'nonactive','0','0','0','0','0','0','0','0','0','2011-09-05 20:46:00','0','0',0,'#####','0','active',NULL,'no','0',NULL),('HSIU','HSIU','30',0.9000,'currency','HSIU','HSIU','HSIU','HSIU','active',27,'nonactive','0','0','0','0','0','0','0','0','0','2011-09-06 20:46:00','0','0',0,'#####','0','active',NULL,'no','0',NULL),('HSIV','HSIV','30',0.9000,'currency','HSIV','HSIV','HSIV','HSIV','active',28,'nonactive','0','0','0','0','0','0','0','0','0','2011-09-07 20:46:00','0','0',0,'#####','0','active',NULL,'no','0',NULL),('HSIX','HSIX','30',0.9000,'currency','HSIX','HSIX','HSIX','HSIX','active',29,'nonactive','0','0','0','0','0','0','0','0','0','2011-09-08 20:46:00','0','0',0,'#####','0','active',NULL,'no','0',NULL),('HSIZ','HSIZ','30',0.9000,'currency','HSIZ','HSIZ','HSIZ','HSIZ','active',30,'nonactive','0','0','0','0','0','0','0','0','0','2011-09-09 20:46:00','0','0',0,'#####','0','active',NULL,'no','0',NULL),('JPJ30H3.','JPJ30H3.','30',0.9000,'currency','JPJ30H3.','JPJ30H3.','JPJ30H3.','JPJ30H3.','active',43,'nonactive','0','0','0','0','0','0','0','0','0','2011-09-22 20:46:00','0','0',0,'#####','0','active',NULL,'no','0',NULL),('JPJ30H4.','JPJ30H4.','30',0.9000,'currency','JPJ30H4.','JPJ30H4.','JPJ30H4.','JPJ30H4.','active',47,'nonactive','0','0','0','0','0','0','0','0','0','2011-09-22 20:46:00','0','0',0,'#####','0','active',NULL,'no','0',NULL),('JPJ30M3.','JPJ30M3.','30',0.9000,'currency','JPJ30M3.','JPJ30M3.','JPJ30M3.','JPJ30M3.','active',44,'nonactive','0','0','0','0','0','0','0','0','0','2011-09-23 20:46:00','0','0',0,'#####','0','active',NULL,'no','0',NULL),('JPJ30U3.','JPJ30U3.','30',0.9000,'currency','JPJ30U3.','JPJ30U3.','JPJ30U3.','JPJ30U3.','active',45,'nonactive','0','0','0','0','0','0','0','0','0','2011-09-24 20:46:00','0','0',0,'#####','0','active',NULL,'no','0',NULL),('JPJ30Z3.','JPJ30Z3.','30',0.9000,'currency','JPJ30Z3.','JPJ30Z3.','JPJ30Z3.','JPJ30Z3.','active',46,'nonactive','0','0','0','0','0','0','0','0','0','2011-09-25 20:46:00','0','0',0,'#####','0','active',NULL,'no','0',NULL),('JPK50#','JPK50#','30',0.9000,'currency','JPK50#','JPK50#','JPK50#','JPK50#','active',7,'nonactive','0','0','0','0','0','0','0','0','0','2011-08-17 20:46:00','0','0',0,'#####','0','active',NULL,'no','0',NULL),('JPK50.','JPK50.','30',0.9000,'currency','JPK50.','JPK50.','JPK50.','JPK50.','active',9,'nonactive','0','0','0','0','0','0','0','0','0','2011-08-19 20:46:00','0','0',0,'#####','0','active',NULL,'no','0',NULL),('JPK50_','JPK50_','30',0.9000,'currency','JPK50_','JPK50_','JPK50_','JPK50_','active',9,'nonactive','0','0','0','0','0','0','0','0','0','2011-08-16 20:00:00','0','0',0,'#####','0','active',NULL,'no','0',NULL),('KRJ35H3.','KRJ35H3.','30',0.9000,'currency','KRJ35H3.','KRJ35H3.','KRJ35H3.','KRJ35H3.','active',47,'nonactive','0','0','0','0','0','0','0','0','0','2011-09-26 20:46:00','0','0',2,'#####','0','active',NULL,'no','0',NULL),('KRJ35H4.','KRJ35H4.','30',0.9000,'currency','KRJ35H4.','KRJ35H4.','KRJ35H4.','KRJ35H4.','active',51,'nonactive','0','0','0','0','0','0','0','0','0','2011-09-26 20:46:00','0','0',2,'#####','0','active',NULL,'no','0',NULL),('KRJ35M3.','KRJ35M3.','30',0.9000,'currency','KRJ35M3.','KRJ35M3.','KRJ35M3.','KRJ35M3.','active',48,'nonactive','0','0','0','0','0','0','0','0','0','2011-09-27 20:46:00','0','0',2,'#####','0','active',NULL,'no','0',NULL),('KRJ35U3.','KRJ35U3.','30',0.9000,'currency','KRJ35U3.','KRJ35U3.','KRJ35U3.','KRJ35U3.','active',49,'nonactive','0','0','0','0','0','0','0','0','0','2011-09-28 20:46:00','0','0',2,'#####','0','active',NULL,'no','0',NULL),('KRJ35Z3.','KRJ35Z3.','30',0.9000,'currency','KRJ35Z3.','KRJ35Z3.','KRJ35Z3.','KRJ35Z3.','active',50,'nonactive','0','0','0','0','0','0','0','0','0','2011-09-29 20:46:00','0','0',2,'#####','0','active',NULL,'no','0',NULL),('KSIH','KSIH','30',0.9000,'currency','KSIH','KSIH','KSIH','KSIH','active',15,'nonactive','0','0','0','0','0','0','0','0','0','2011-08-25 20:46:00','0','0',2,'#####','0','active',NULL,'no','0',NULL),('KSIM','KSIM','30',0.9000,'currency','KSIM','KSIM','KSIM','KSIM','active',16,'nonactive','0','0','0','0','0','0','0','0','0','2011-08-26 20:46:00','0','0',2,'#####','0','active',NULL,'no','0',NULL),('KSIU','KSIU','30',0.9000,'currency','KSIU','KSIU','KSIU','KSIU','active',17,'nonactive','0','0','0','0','0','0','0','0','0','2011-08-27 20:46:00','0','0',2,'#####','0','active',NULL,'no','0',NULL),('KSIZ','KSIZ','30',0.9000,'currency','KSIZ','KSIZ','KSIZ','KSIZ','active',18,'nonactive','0','0','0','0','0','0','0','0','0','2011-08-28 20:46:00','0','0',2,'#####','0','active',NULL,'no','0',NULL),('SSIH','SSIH','30',0.9000,'currency','SSIH','SSIH','SSIH','SSIH','active',11,'nonactive','0','0','0','0','0','0','0','0','0','2011-08-21 20:46:00','0','0',0,'#####','0','active',NULL,'no','0',NULL),('SSIM','SSIM','30',0.9000,'currency','SSIM','SSIM','SSIM','SSIM','active',12,'nonactive','0','0','0','0','0','0','0','0','0','2011-08-22 20:46:00','0','0',0,'#####','0','active',NULL,'no','0',NULL),('SSIU','SSIU','30',0.9000,'currency','SSIU','SSIU','SSIU','SSIU','active',13,'nonactive','0','0','0','0','0','0','0','0','0','2011-08-23 20:46:00','0','0',0,'#####','0','active',NULL,'no','0',NULL),('SSIZ','SSIZ','30',0.9000,'currency','SSIZ','SSIZ','SSIZ','SSIZ','active',14,'nonactive','0','0','0','0','0','0','0','0','0','2011-08-24 20:46:00','0','0',0,'#####','0','active',NULL,'no','0',NULL),('USDCHF','USDCHF','30',0.9000,'currency','USDCHF','USDCHF','USDCHF','USDCHF','active',2,'nonactive','0','0','0','0','0','0','0','0','0','2011-08-12 20:46:00','0','0',4,'#####','0','active',NULL,'no','0',NULL),('USDJPY','USDJPY','30',0.9000,'currency','USDJPY','USDJPY','USDJPY','USDJPY','active',5,'nonactive','0','0','0','0','0','0','0','0','0','2011-08-15 20:46:00','0','0',2,'#####','0','active',NULL,'no','0',NULL),('XAUUSD','XAUUSD','30',0.9000,'currency','XAUUSD','XAUUSD','XAUUSD','XAUUSD','active',6,'nonactive','0','0','0','0','0','0','0','0','0','2011-08-16 20:46:00','0','0',2,'#####','0','active',NULL,'no','0',NULL),('XAUUSD.1','XAUUSD.1','30',0.9000,'Currency','XAUUSD.1','XAUUSD.1','XAUUSD.1','XAUUSD.1','active',7,'nonactive','0','0','0','0','0','0','0','0','0','2011-08-16 20:00:00','0','0',0,'#####','0','active',NULL,'no','0',NULL);

/*Table structure for table `quote_alt_symbol` */

DROP TABLE IF EXISTS `quote_alt_symbol`;

CREATE TABLE `quote_alt_symbol` (
  `symbol` varchar(20) NOT NULL DEFAULT '',
  `broker_symbol` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`symbol`,`broker_symbol`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `quote_alt_symbol` */

/*Table structure for table `quotelog` */

DROP TABLE IF EXISTS `quotelog`;

CREATE TABLE `quotelog` (
  `symbol` varchar(10) NOT NULL DEFAULT '',
  `bid` float NOT NULL DEFAULT '0',
  `last` float NOT NULL DEFAULT '0',
  `ask` float NOT NULL DEFAULT '0',
  `change` float NOT NULL DEFAULT '0',
  `high` float NOT NULL DEFAULT '0',
  `low` float NOT NULL DEFAULT '0',
  `open` float NOT NULL DEFAULT '0',
  `prev_close` float NOT NULL DEFAULT '0',
  `time` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `quotelog` */

/*Table structure for table `quotemode` */

DROP TABLE IF EXISTS `quotemode`;

CREATE TABLE `quotemode` (
  `quotemodeid` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `description` varchar(20) NOT NULL DEFAULT '',
  `functionname` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`quotemodeid`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `quotemode` */

insert  into `quotemode`(`quotemodeid`,`description`,`functionname`) values (1,'LOW','quote_low'),(2,'MID','quote_mid'),(3,'HIGH','quote_high');

/*Table structure for table `report_ntr_summary` */

DROP TABLE IF EXISTS `report_ntr_summary`;

CREATE TABLE `report_ntr_summary` (
  `username` varchar(15) DEFAULT NULL,
  `percentage` varchar(19) DEFAULT NULL,
  `rangeto` varchar(19) DEFAULT NULL,
  `statements_filter` varchar(19) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `report_ntr_summary` */

insert  into `report_ntr_summary`(`username`,`percentage`,`rangeto`,`statements_filter`) values ('THEPROGRAMMER','30','2015-12-25','ccf_source');

/*Table structure for table `report_turnover_equity` */

DROP TABLE IF EXISTS `report_turnover_equity`;

CREATE TABLE `report_turnover_equity` (
  `username` varchar(15) DEFAULT NULL,
  `forexfixmargin` char(5) DEFAULT '1000',
  `forexfixturnover` char(2) DEFAULT '3',
  `indexfixmargin` char(10) DEFAULT '8000000',
  `indexfixturnover` char(2) DEFAULT '3',
  `floatingmargin` char(5) DEFAULT '1000',
  `floatingturnover` char(2) DEFAULT '3',
  `rangefrom` varchar(19) DEFAULT 'all',
  `rangeto` varchar(19) DEFAULT 'all',
  `email` varchar(40) DEFAULT '0',
  `subscribe` varchar(3) DEFAULT 'yes',
  KEY `INDEX_SUBSCRIBE` (`subscribe`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `report_turnover_equity` */

insert  into `report_turnover_equity`(`username`,`forexfixmargin`,`forexfixturnover`,`indexfixmargin`,`indexfixturnover`,`floatingmargin`,`floatingturnover`,`rangefrom`,`rangeto`,`email`,`subscribe`) values ('MAXWELL','1000','6','5500000','6','800','6','2015-10-13 08:55:31','2016-01-13 08:55:31','fyunus70@gmail.com','yes'),('THEPROGRAMMER','1000','3','8000000','3','800','3','2014-12-01 00:00:00','2016-01-13 08:55:31','agustia.tarikh150@gmail.com','yes');

/*Table structure for table `reset` */

DROP TABLE IF EXISTS `reset`;

CREATE TABLE `reset` (
  `resetid` int(10) unsigned NOT NULL DEFAULT '0',
  `active` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`resetid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `reset` */

insert  into `reset`(`resetid`,`active`) values (1,1);

/*Table structure for table `resetuser` */

DROP TABLE IF EXISTS `resetuser`;

CREATE TABLE `resetuser` (
  `userid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `resetid` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`userid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `resetuser` */

insert  into `resetuser`(`userid`,`resetid`) values (2954,1),(2956,1),(2971,1),(2978,1),(2982,1),(2997,1),(2981,1),(3010,1),(3011,1),(3018,1),(3064,1),(3042,1),(3043,1),(3007,1),(4,1),(827,1);

/*Table structure for table `resp_admin` */

DROP TABLE IF EXISTS `resp_admin`;

CREATE TABLE `resp_admin` (
  `userid` int(10) NOT NULL AUTO_INCREMENT,
  `NodeName` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`userid`,`NodeName`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `resp_admin` */

insert  into `resp_admin`(`userid`,`NodeName`) values (1,'Deposit & Withdrawal'),(1,'Forex Transaction'),(1,'MANAGE'),(1,'MANAGE ADMIN'),(1,'META REPORT'),(1,'REPORT'),(1,'Utility'),(6,'Close Trade'),(6,'DCER'),(6,'Deposit & Withdrawal'),(6,'Forex Transaction'),(6,'MANAGE'),(6,'MANAGE ADMIN'),(6,'META REPORT'),(6,'REPORT'),(6,'Segregated'),(6,'Utility');

/*Table structure for table `schedule` */

DROP TABLE IF EXISTS `schedule`;

CREATE TABLE `schedule` (
  `datetime` datetime DEFAULT NULL,
  `schedule_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `car_id` varchar(20) NOT NULL DEFAULT 'no car',
  `team_id` varchar(20) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `destination` varchar(50) DEFAULT NULL,
  `meet_with` varchar(50) DEFAULT NULL,
  `date_meeting` date DEFAULT NULL,
  `time_meeting` time DEFAULT NULL,
  `offer` varchar(100) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`schedule_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8050 DEFAULT CHARSET=latin1;

/*Data for the table `schedule` */

insert  into `schedule`(`datetime`,`schedule_id`,`car_id`,`team_id`,`name`,`email`,`destination`,`meet_with`,`date_meeting`,`time_meeting`,`offer`,`status`) values ('2016-04-12 11:19:24',8044,'no car','160413013','160412092','fadliyunus@ymail.com','kali deres','datuk','2016-04-12','10:00:00',NULL,NULL),('2016-04-06 11:42:37',8042,'no car','160309121','160412091','car01@gmail.com','karawang','diki','2016-09-09','09:00:00',NULL,NULL),('2016-04-06 11:41:02',8041,'no car','160309121','160412091','car01@gmail.com','bandung','Jupri','2016-09-09','10:00:00',NULL,NULL),('2016-04-12 12:11:23',8045,'no car','160413013','160412092','fadliyunus@ymail.com','Roxy','datuk','2016-04-12','10:00:00',NULL,NULL),('2016-04-12 12:13:27',8046,'Avanza 3','160413013','160412092','fadliyunus@ymail.com','jembatan baru','datuk','2016-10-10','10:00:00','delapan8','Approv '),('2016-04-12 12:34:31',8047,'Avanza 6','160413013','160412092','fadliyunus@ymail.com','Tanggerang','Datuk','2016-04-12','10:00:00','Tujuh7','Cancel '),('2016-04-12 12:34:42',8048,'Avanza 5','160413013','160412092','fadliyunus@ymail.com','Tanggerang','Datuk','2016-04-12','10:00:00','Lima5','Approv '),('2016-04-12 12:35:37',8049,'Avanza 3','160413013','160412092','fadliyunus@ymail.com','tangerang','datuk','2016-04-12','10:00:00','0000-00-00 00:00:00',NULL);

/*Table structure for table `secretaris` */

DROP TABLE IF EXISTS `secretaris`;

CREATE TABLE `secretaris` (
  `account` varchar(20) DEFAULT NULL,
  `mt4dt` varchar(20) DEFAULT NULL,
  `branch` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `secretaris` */

insert  into `secretaris`(`account`,`mt4dt`,`branch`,`email`) values ('160409131','agro','Jakarta','sec1@gmail.com'),('160409132','agro','Bali','sec2@gmail.com'),('160409133','agro','Bandung','sec3@gmail.com'),('160409134','agro','Semarang','sec4@gmail.com'),('160409135','agro','Surabaya','sec5@gmail.com');

/*Table structure for table `suspension` */

DROP TABLE IF EXISTS `suspension`;

CREATE TABLE `suspension` (
  `account` varchar(10) NOT NULL DEFAULT '',
  `suspend` char(15) NOT NULL,
  `message` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`account`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `suspension` */

/*Table structure for table `symbol` */

DROP TABLE IF EXISTS `symbol`;

CREATE TABLE `symbol` (
  `SYMBOL_ID` smallint(6) NOT NULL AUTO_INCREMENT,
  `SYMBOL` varchar(30) NOT NULL DEFAULT '',
  `ALIAS` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`SYMBOL_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

/*Data for the table `symbol` */

insert  into `symbol`(`SYMBOL_ID`,`SYMBOL`,`ALIAS`) values (17,'SNIU6','N225Z5'),(22,'JPY A0-FX','USD/JPY'),(23,'IDR A0-FX','USD/IDR'),(25,'HSIM6','HKZ'),(28,'GBP A0-FX','GBP/USD'),(31,'EUR A0-FX','EUR/USD'),(38,'AUD A0-FX','AUD/USD');

/*Table structure for table `system` */

DROP TABLE IF EXISTS `system`;

CREATE TABLE `system` (
  `systemid` varchar(100) NOT NULL DEFAULT '',
  `openfortrade` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `system` */

/*Table structure for table `temp_counter` */

DROP TABLE IF EXISTS `temp_counter`;

CREATE TABLE `temp_counter` (
  `counter` varchar(20) NOT NULL DEFAULT '',
  `bid` float DEFAULT NULL,
  `ask` float DEFAULT NULL,
  PRIMARY KEY (`counter`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `temp_counter` */

/*Table structure for table `tempcredit` */

DROP TABLE IF EXISTS `tempcredit`;

CREATE TABLE `tempcredit` (
  `account` varchar(10) NOT NULL DEFAULT '',
  `credit` bigint(20) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`account`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tempcredit` */

/*Table structure for table `themes` */

DROP TABLE IF EXISTS `themes`;

CREATE TABLE `themes` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `themesid` varchar(50) DEFAULT NULL,
  `themesname` varchar(40) DEFAULT NULL,
  `value` varchar(60) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=125 DEFAULT CHARSET=latin1;

/*Data for the table `themes` */

insert  into `themes`(`Id`,`themesid`,`themesname`,`value`,`description`) values (1,'acemach','header','#0E3E54',''),(2,'classicmonochromatic','header','#003D73','#003365'),(3,'acemach','subheader1','#145A7C',NULL),(4,'classicmonochromatic','subheader1','#003365','#003365 -> Awal\r\n'),(5,'acemach','body','#3385B3',NULL),(6,'classicmonochromatic','body','#0B1B4B',NULL),(7,'acemach','bodyhdr','#145A7C',NULL),(8,'classicmonochromatic','bodyhdr','#003D73','#003D73 -> Awal\r\n'),(9,'acemach','bodycycle1','#3697ab',NULL),(10,'classicmonochromatic','bodycycle1','#1B75BC',NULL),(11,'acemach','bodycycle2','#145A7C',NULL),(12,'classicmonochromatic','bodycycle2','#00508F',NULL),(13,'acemach','bodycounter','#3697ab',NULL),(14,'classicmonochromatic','bodycounter','#00508F',NULL),(15,'acemach','bodyctrbutton','#0E3E54','awalnya green\r\n'),(16,'classicmonochromatic','bodyctrbutton','#0E3E54','#006D6F -> Awalnya\r\nkemudian #CCBE00\r\nkemudian #C06616\r\nkemudian #985006\r\n'),(17,'acemach','bodyHistDtl','#3697ab',NULL),(18,'classicmonochromatic','bodyHistDtl','#00508F',NULL),(19,'acemach','bodysubhdr1','#0E3E54',NULL),(20,'classicmonochromatic','bodysubhdr1','#0E3E54',NULL),(21,'acemach','scrollbar_track_color','#3697ab',NULL),(22,'classicmonochromatic','scrollbar_track_color','#003D73',NULL),(23,'acemach','bodyframe','#0E3E54',NULL),(24,'classicmonochromatic','bodyframe','#B1B3B6','#363247- ini yg transaction history\r\n#363247 ini yg kedua\r\nini pilihan Joe #B1B3B6\r\n'),(25,'acemach','bodysubhdr2','#3385B3','#78709C -> Awalnya yg coklatnya Russley\r\n\r\n'),(26,'classicmonochromatic','bodysubhdr2','#00508F',NULL),(27,'acemach','bodysubhdr3','#7DA7D9',NULL),(28,'classicmonochromatic','bodysubhdr3','#7DA7D9',NULL),(29,'acemach','bodyctrpanahdown','background:red',NULL),(30,'classicmonochromatic','bodyctrpanahdown','background:#B4141A',NULL),(31,'acemach','bodyctrpanahup','background:green',NULL),(32,'classicmonochromatic','bodyctrpanahup','background:#00864B',NULL),(33,'nostalgicmonochromatic','body','#585075',NULL),(34,'nostalgicmonochromatic','bodycounter','#8F87AD',NULL),(35,'nostalgicmonochromatic','bodyctrbutton','#363247','awalnya -> #363247\r\n'),(36,'nostalgicmonochromatic','bodyctrpanahdown','background:#B4141A',NULL),(37,'nostalgicmonochromatic','bodyctrpanahup','background:#00864B',NULL),(38,'nostalgicmonochromatic','bodycycle1','#8F87AD',NULL),(39,'nostalgicmonochromatic','bodycycle2','#363247',NULL),(40,'nostalgicmonochromatic','bodyframe','#78709C','awalnya -> #CECCDB\r\ndicoba #363247\r\n'),(41,'nostalgicmonochromatic','bodyhdr','#363247',NULL),(42,'nostalgicmonochromatic','bodyHistDtl','#8F87AD',NULL),(43,'nostalgicmonochromatic','bodysubhdr1','#585075',NULL),(44,'nostalgicmonochromatic','bodysubhdr2','#8F87AD','awalnya -> #78709C\r\n'),(45,'nostalgicmonochromatic','bodysubhdr3','#423D58','awalnya -> #423D58\r\n'),(46,'nostalgicmonochromatic','header','#423D58',NULL),(47,'nostalgicmonochromatic','scrollbar_track_color','#78709C',NULL),(48,'nostalgicmonochromatic','subheader1','#8F87AD',NULL),(49,'acemach','scrollbar_face_color','#0E3E54',NULL),(50,'acemach','scrollbar_arrow_color','#004C6C',NULL),(51,'acemach','scrollbar_shadow_color','#004C6C',NULL),(52,'acemach','scrollbar_highlight_color','#535F82',NULL),(53,'acemach','scrollbar_3dlight_color','#45537C',NULL),(54,'acemach','scrollbar_darkshadow_Color','#363247',NULL),(55,'classicmonochromatic','scrollbar_face_color','#0E3E54',NULL),(56,'classicmonochromatic','scrollbar_arrow_color','#004C6C',NULL),(57,'classicmonochromatic','scrollbar_shadow_color','#004C6C',NULL),(58,'classicmonochromatic','scrollbar_highlight_color','#535F82',NULL),(59,'classicmonochromatic','scrollbar_3dlight_color','#45537C',NULL),(60,'classicmonochromatic','scrollbar_darkshadow_Color','#363247',NULL),(61,'nostalgicmonochromatic','scrollbar_face_color','#423D58',NULL),(62,'nostalgicmonochromatic','scrollbar_arrow_color','#78709C',NULL),(63,'nostalgicmonochromatic','scrollbar_3dlight_color','#585075',NULL),(64,'nostalgicmonochromatic','scrollbar_highlight_color','#585075',NULL),(65,'nostalgicmonochromatic','scrollbar_shadow_color','#423D58',NULL),(66,'nostalgicmonochromatic','scrollbar_darkshadow_Color','#423D58',NULL),(67,'acemach','menu_hover_background_color','#0099FF',NULL),(68,'classicmonochromatic','menu_hover_background_color','#0099FF',NULL),(69,'nostalgicmonochromatic','menu_hover_background_color','#585075',NULL),(70,'classicmonochromatic','menu_hover_button_hdr_bck_image','background-image:  url(images/animbg.gif)',NULL),(71,'classicmonochromatic','menu_normal_button_hdr_bck_image','background-image:  url(images/tabletitleshort.gif)',NULL),(72,'acemach','menu_normal_button_hdr_bck_image','background: #3385B3',NULL),(73,'acemach','menu_hover_button_hdr_bck_image','background: #145A7C',NULL),(74,'nostalgicmonochromatic','menu_hover_button_hdr_bck_image','background:  #363247',NULL),(75,'nostalgicmonochromatic','menu_normal_button_hdr_bck_image','background:  #585075',NULL),(76,'acemach','header_image','background=\'images/logo-Profx_live.gif\'','070502 background=\'images/Header_Acemach.gif\''),(77,'classicmonochromatic','header_image','background=\'images/logo-Profx_live.gif\'','060728 is bgcolor=\'#003D73\'\r\n060729 is background=\'images/header_classic_monochromatic.jpg\'\r\n070501  is background=\'images/header_val.gif\'\r\n'),(78,'nostalgicmonochromatic','header_image','background=\'images/logo-Profx_live.gif\'','070502 is bgcolor=\'#423D58\''),(79,'classicmonochromatic','bodypanahupgreen','src=\'../img/arrowgreen.gif\' width=\'20\' height=\'20\'',NULL),(80,'classicmonochromatic','bodypanahdownred','src=\'../img/arrowred.gif\' width=\'20\' height=\'20\'',NULL),(81,'classicmonochromatic','bodypanahupwhite','src=\'../img/green0001a.gif\' width=\'15\' height=\'15\'',NULL),(82,'classicmonochromatic','bodypanahdownwhite','src=\'../img/red0001a.gif\' width=\'15\' height=\'15\'',NULL),(83,'acemach','bodypanahupgreen','src=\'../img/green0001.gif\' width=\'15\' height=\'15\'',NULL),(84,'nostalgicmonochromatic','bodypanahupgreen','src=\'../img/green0001.gif\' width=\'15\' height=\'15\'',NULL),(85,'acemach','bodypanahdownred','src=\'../img/red0001.gif\' width=\'15\' height=\'15\'',NULL),(86,'nostalgicmonochromatic','bodypanahdownred','src=\'../img/red0001.gif\' width=\'15\' height=\'15\'',NULL),(87,'acemach','bodypanahupwhite','src=\'../img/green0001a.gif\' width=\'15\' height=\'15\'',NULL),(88,'nostalgicmonochromatic','bodypanahupwhite','src=\'../img/green0001a.gif\' width=\'15\' height=\'15\'',NULL),(89,'acemach','bodypanahdownwhite','src=\'../img/red0001a.gif\' width=\'15\' height=\'15\'',NULL),(90,'nostalgicmonochromatic','bodypanahdownwhite','src=\'../img/red0001a.gif\' width=\'15\' height=\'15\'',NULL),(91,'stg_wht','bodypanahdownwhite','src=\'../img/red0001a.gif\' width=\'15\' height=\'15\'',NULL),(92,'stg_wht','bodypanahupwhite','src=\'../img/green0001a.gif\' width=\'15\' height=\'15\'',NULL),(93,'stg_wht','bodypanahdownred','src=\'../img/red0001.gif\' width=\'15\' height=\'15\'',NULL),(94,'stg_wht','bodypanahupgreen','src=\'../img/green0001.gif\' width=\'15\' height=\'15\'',NULL),(95,'stg_wht','header_image','background=\'images/logo-Profx_live.gif\'',NULL),(96,'stg_wht','menu_hover_button_hdr_bck_image','background: #6f6f6f',NULL),(97,'stg_wht','menu_normal_button_hdr_bck_image','background=\'images/stg_bg_menu.gif\'','background=\'images/stg_bg_menu.gif\''),(98,'stg_wht','menu_hover_background_color','#B1B1B1',NULL),(99,'stg_wht','scrollbar_darkshadow_Color','#363247',NULL),(100,'stg_wht','scrollbar_3dlight_color','#45537C',NULL),(101,'stg_wht','scrollbar_highlight_color','#535F82',NULL),(102,'stg_wht','scrollbar_shadow_color','#6f6f6f',NULL),(103,'stg_wht','scrollbar_arrow_color','#e0e0e2',NULL),(104,'stg_wht','scrollbar_face_color','#6f6f6f',NULL),(105,'stg_wht','bodyctrpanahup','background:green',NULL),(106,'stg_wht','bodyctrpanahdown','background:red',NULL),(107,'stg_wht','bodysubhdr3','#7DA7D9',NULL),(108,'stg_wht','bodysubhdr2','#D4D0C8',NULL),(109,'stg_wht','bodyframe','#ffffff',NULL),(110,'stg_wht','scrollbar_track_color','#FFFFFF',NULL),(111,'stg_wht','bodysubhdr1','#6f6f6f',NULL),(112,'stg_wht','bodyHistDtl','#FFFFFF',NULL),(113,'stg_wht','bodyctrbutton','#6f6f6f',NULL),(114,'stg_wht','bodycounter','#FFFFFF',NULL),(115,'stg_wht','bodycycle2','#6f6f6f',NULL),(116,'stg_wht','bodycycle1','#E4E4E4',NULL),(117,'stg_wht','bodyhdr','#555555',NULL),(118,'stg_wht','body','#D4D0C8',NULL),(119,'stg_wht','subheader1','#000000',NULL),(120,'stg_wht','header','#6f6f6f',NULL),(121,'acemach','fontcollor','color:#FFFFFF',NULL),(122,'classicmonochromatic','fontcollor','color:#FFFFFF',NULL),(123,'nostalgicmonochromatic','fontcollor','color:#FFFFFF',NULL),(124,'stg_wht','fontcollor','color:#000000',NULL);

/*Table structure for table `topics` */

DROP TABLE IF EXISTS `topics`;

CREATE TABLE `topics` (
  `TOPICS_ID` int(11) NOT NULL DEFAULT '0',
  `NAME` varchar(50) DEFAULT NULL,
  `TYPE` varchar(50) DEFAULT NULL,
  `STATUS` varchar(9) DEFAULT NULL,
  PRIMARY KEY (`TOPICS_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `topics` */

insert  into `topics`(`TOPICS_ID`,`NAME`,`TYPE`,`STATUS`) values (1,'ASK','Decimal','active'),(2,'BID','Decimal','active'),(3,'CHANGE','Decimal','active'),(4,'HIGH','Decimal','active'),(5,'LAST','Decimal','active'),(6,'LOW','Decimal','active'),(7,'OPEN','Decimal','active'),(8,'OPENINT','Decimal','active'),(9,'TIMEREALTIME','Time','active'),(10,'TIMEUPDATE','Time','active'),(11,'TOTALVOL','Decimal','active'),(12,'DATEREALTIME','Date','active'),(13,'DATEUPDATE','Date','active');

/*Table structure for table `trade` */

DROP TABLE IF EXISTS `trade`;

CREATE TABLE `trade` (
  `tradeid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `statusid` tinyint(3) unsigned NOT NULL DEFAULT '2',
  `rollover` varchar(8) DEFAULT NULL,
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `account` varchar(11) NOT NULL DEFAULT '',
  `action` varchar(10) NOT NULL DEFAULT '',
  `counterid` varchar(20) NOT NULL,
  `price` decimal(20,5) NOT NULL DEFAULT '0.00000',
  `price_from` decimal(20,5) DEFAULT '0.00000',
  `price_to` decimal(20,5) DEFAULT '0.00000',
  `quantity` decimal(8,2) unsigned NOT NULL DEFAULT '0.00',
  `type` varchar(10) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `liquidate_price` decimal(20,5) NOT NULL DEFAULT '0.00000',
  `liquidate_ref` varchar(20) DEFAULT NULL,
  `duration` char(3) DEFAULT NULL,
  `durationfrom` char(3) DEFAULT NULL,
  `durationto` char(3) DEFAULT NULL,
  `remark` tinytext,
  `isorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `check_price` decimal(20,5) NOT NULL DEFAULT '0.00000',
  `check_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `done_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tradedby` varchar(30) NOT NULL DEFAULT '',
  `tradedbyname` varchar(30) NOT NULL DEFAULT '',
  `importref` varchar(100) NOT NULL DEFAULT '',
  `bbjstatus` varchar(11) DEFAULT '0',
  `bbj_trade_number` varchar(11) DEFAULT NULL,
  `RefOCO` int(11) DEFAULT NULL,
  `typeorder` varchar(11) DEFAULT 'limit',
  `isbbj` tinyint(1) DEFAULT '0',
  `counter_closing` int(11) DEFAULT '0',
  `check_high` decimal(20,5) DEFAULT '0.00000',
  `check_low` decimal(20,5) DEFAULT '0.00000',
  `checkvalue` char(3) DEFAULT 'no',
  PRIMARY KEY (`tradeid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 PACK_KEYS=0;

/*Data for the table `trade` */

/*Table structure for table `trade_multi` */

DROP TABLE IF EXISTS `trade_multi`;

CREATE TABLE `trade_multi` (
  `hdr_id` varchar(100) DEFAULT NULL,
  `tradeid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `statusid` tinyint(3) unsigned NOT NULL DEFAULT '2',
  `rollover` varchar(8) DEFAULT NULL,
  `userid` smallint(5) unsigned NOT NULL DEFAULT '0',
  `account` varchar(10) NOT NULL DEFAULT '',
  `action` varchar(10) NOT NULL DEFAULT '',
  `counterid` varchar(10) NOT NULL DEFAULT '',
  `price` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `quantity` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `type` varchar(10) NOT NULL DEFAULT '',
  `datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `liquidate_price` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `liquidate_ref` varchar(20) DEFAULT NULL,
  `duration` char(3) DEFAULT NULL,
  `remark` tinytext,
  `isorder` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `check_price` decimal(10,4) NOT NULL DEFAULT '0.0000',
  `check_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `done_datetime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tradedby` varchar(30) NOT NULL DEFAULT '',
  `tradedbyname` varchar(30) NOT NULL DEFAULT '',
  `importref` varchar(100) NOT NULL DEFAULT '',
  `bbjstatus` varchar(11) DEFAULT '0',
  `bbj_trade_number` varchar(11) DEFAULT NULL,
  `RefOCO` int(11) DEFAULT NULL,
  `typeorder` varchar(11) DEFAULT 'limit',
  `isbbj` tinyint(1) DEFAULT '0',
  `quantity_order` mediumint(8) NOT NULL DEFAULT '0',
  `duration_order` char(3) DEFAULT NULL,
  `partnerid` int(10) DEFAULT '0',
  `matchwith` varchar(6) DEFAULT '0',
  `check_high` decimal(10,4) DEFAULT '0.0000',
  `check_low` decimal(10,4) DEFAULT '0.0000',
  PRIMARY KEY (`tradeid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 PACK_KEYS=0;

/*Data for the table `trade_multi` */

/*Table structure for table `tradestatus` */

DROP TABLE IF EXISTS `tradestatus`;

CREATE TABLE `tradestatus` (
  `statusid` tinyint(4) NOT NULL DEFAULT '0',
  `description` varchar(30) NOT NULL DEFAULT '',
  `summary` tinytext,
  `color` varchar(7) NOT NULL DEFAULT '',
  PRIMARY KEY (`statusid`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `tradestatus` */

insert  into `tradestatus`(`statusid`,`description`,`summary`,`color`) values (0,'Cancel','Your trade order is busted.','#FF0000'),(1,'Done','Your order has executed successfully.','#113703'),(2,'Pending','Your trade order is pending.','#576d09'),(3,'Process','Your trade order is being processed.','#FFFFFF'),(4,'Expired','Your trade order has expired.','#979797'),(5,'Removed','Removed by Client','#FF0000'),(6,'Margin Call','Margin Call','#FF0000'),(7,'Pending...','Trigerred by the Pending','#40F800'),(8,'Updating','Updating','#40F800'),(9,'Price Changed','Price already Changed','#FF0000'),(10,'Requote','Price Requote','#FF0000'),(11,'Any Price','Any Price on Process','#576d09');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `userid` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `countertype` varchar(150) NOT NULL DEFAULT 'Currency',
  `countertype_user` varchar(150) DEFAULT NULL,
  `lockingid` smallint(3) DEFAULT '2',
  `username` varchar(15) NOT NULL DEFAULT '',
  `passwordold` varchar(32) DEFAULT NULL,
  `password` varchar(32) NOT NULL DEFAULT '',
  `branch` varchar(8) DEFAULT NULL,
  `groupid` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `lastseen` int(10) unsigned NOT NULL DEFAULT '0',
  `lastlogin` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastactivity` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `languageid` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `intset` varchar(10) NOT NULL DEFAULT 'COMMON',
  `hseacca` varchar(10) DEFAULT NULL,
  `hseaccb` varchar(10) DEFAULT NULL,
  `themesid` varchar(50) DEFAULT 'classicmonochromatic',
  `companygroup` varchar(11) DEFAULT 'stg9',
  `viewtype` varchar(20) DEFAULT 'stg9_summary',
  `directdone` char(3) DEFAULT '30',
  `validation` char(3) DEFAULT 'no',
  `disclosure` char(3) DEFAULT 'yes',
  `fromip` text,
  `frommachine` varchar(255) DEFAULT NULL,
  `login_created` datetime DEFAULT NULL,
  `login_end` datetime DEFAULT NULL,
  `lastseenhist` char(10) DEFAULT '0',
  `lastseenpend` char(10) DEFAULT '0',
  `lastseenopen` char(10) DEFAULT '0',
  `accountclientselect` text,
  `mmselect` text,
  PRIMARY KEY (`userid`),
  KEY `userid` (`userid`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1 PACK_KEYS=0 CHECKSUM=1 DELAY_KEY_WRITE=1 ROW_FORMAT=DYNAMIC;

/*Data for the table `user` */

insert  into `user`(`userid`,`countertype`,`countertype_user`,`lockingid`,`username`,`passwordold`,`password`,`branch`,`groupid`,`lastseen`,`lastlogin`,`lastactivity`,`languageid`,`intset`,`hseacca`,`hseaccb`,`themesid`,`companygroup`,`viewtype`,`directdone`,`validation`,`disclosure`,`fromip`,`frommachine`,`login_created`,`login_end`,`lastseenhist`,`lastseenpend`,`lastseenopen`,`accountclientselect`,`mmselect`) values (3,'Currency,XAU,IDRHSI,IDRSSI,IDRKSI,SILVER','Currency,XAU,IDRHSI,IDRSSI,IDRKSI',1,'THEPROGRAMMER','61326117ed4a9ddf3f754e71e119e5b3','81dc9bdb52d04dc20036dbd8313ed055','',9,793565,'2016-04-28 15:03:11','2015-12-27 10:57:30',1,'COMMON','','','classicmonochromatic','stg9','','30','no','yes','127.0.0.1','http://cabinet.dev/web2/index.php','0000-00-00 00:00:00','2999-12-31 00:00:01','0','0','0',NULL,NULL);

/*Table structure for table `user_group_access` */

DROP TABLE IF EXISTS `user_group_access`;

CREATE TABLE `user_group_access` (
  `accessid` int(11) NOT NULL AUTO_INCREMENT,
  `group` varchar(20) NOT NULL DEFAULT '',
  `action` varchar(30) NOT NULL DEFAULT '',
  `description` varchar(100) NOT NULL DEFAULT '',
  PRIMARY KEY (`accessid`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

/*Data for the table `user_group_access` */

insert  into `user_group_access`(`accessid`,`group`,`action`,`description`) values (21,'dealing','basic',''),(30,'supervisor','basic',''),(32,'IT Development','basic',''),(33,'Administrator','basic',''),(34,'none','',''),(35,'accounting','basic',''),(37,'Administrator','actionpermits.php','Action Editor'),(38,'programmer','actionpermits.php','Action Editor'),(40,'Administrator','useraccount.php','Add Account'),(41,'programmer','useraccount.php','Add Account'),(43,'Administrator','menuedit.php','Menu Edit'),(44,'programmer','menuedit.php','Menu Edit'),(45,'director','basic',''),(46,'CHIEF','basic','');

/*Table structure for table `user_group_main` */

DROP TABLE IF EXISTS `user_group_main`;

CREATE TABLE `user_group_main` (
  `userid` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL DEFAULT '',
  `passwordold` varchar(32) DEFAULT NULL,
  `password` varchar(32) NOT NULL DEFAULT '',
  `session` varchar(30) NOT NULL DEFAULT '',
  `cookie` varchar(32) NOT NULL DEFAULT '',
  `ip` varchar(30) NOT NULL DEFAULT '',
  `group` varchar(30) NOT NULL DEFAULT '',
  `active` varchar(5) NOT NULL DEFAULT 'yes',
  `lastlogin` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `lastactivity` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `user_group_main` */

insert  into `user_group_main`(`userid`,`username`,`passwordold`,`password`,`session`,`cookie`,`ip`,`group`,`active`,`lastlogin`,`lastactivity`) values (1,'programmer','8d84f21e1fc5e361315d1e9d8e8e4ce2','8d84f21e1fc5e361315d1e9d8e8e4ce2','login','0de912a24545e4286158994560bd5e45','10.10.0.253','programmer','yes','2015-11-08 16:11:03','2015-11-08 16:11:09'),(8,'faisal','ec6a6536ca304edf844d1d248a4f08dc','ec6a6536ca304edf844d1d248a4f08dc','logout','','127.0.0.1','programmer','yes','2013-03-08 14:17:07','2013-03-08 14:17:14'),(10,'support',NULL,'16d35fb226fea731c47087784bba89de','logout','','203.173.92.102','programmer','yes','2015-09-14 10:08:42','2015-09-14 10:10:08'),(11,'ADMiNIS',NULL,'45e85e9bec4d32bb94f24b4e2acfc864','login','','127.0.0.1','programmer','yes','2013-01-04 05:25:40','2013-01-04 05:32:43'),(12,'administrator',NULL,'314a83af865fe4dce89d24780f35f6a3','logout','','202.6.235.132','programmer','yes','2012-10-11 23:17:02','2012-10-11 23:21:17'),(13,'AGUS',NULL,'28c8edde3d61a0411511d3b1866f0636','login','','202.6.235.132','programmer','yes','2013-01-15 12:22:14','2013-01-15 12:23:53'),(14,'indexis',NULL,'14e1b600b1fd579f47433b88e8d85291','logout','','202.158.42.174','programmer','yes','2012-10-08 15:23:41','2012-10-08 15:25:35'),(15,'SUPPORT2',NULL,'a89b42b65953d89f115338372e1fa51a','logout','','222.165.255.114','programmer','yes','2013-01-25 09:15:09','2013-01-25 09:57:01'),(16,'dealing',NULL,'310b0332d6ed3f72ad5137dc5082893a','login','','127.0.0.1','programmer','yes','2014-12-09 10:30:24','2014-12-09 10:34:23'),(17,'ADMINSIBFX',NULL,'57f231b1ec41dc6641270cb09a56f897','login','','192.168.0.1','programmer','yes','2015-10-14 09:07:58','2015-10-14 09:07:58');

/*Table structure for table `user_group_menu` */

DROP TABLE IF EXISTS `user_group_menu`;

CREATE TABLE `user_group_menu` (
  `menuid` int(10) NOT NULL AUTO_INCREMENT,
  `group` varchar(30) NOT NULL DEFAULT '',
  `menu_desc` varchar(50) NOT NULL DEFAULT '',
  `page` varchar(100) NOT NULL DEFAULT '',
  `menu_order` int(10) NOT NULL DEFAULT '0',
  `menu_active` varchar(5) NOT NULL DEFAULT 'no',
  PRIMARY KEY (`menuid`)
) ENGINE=InnoDB AUTO_INCREMENT=246 DEFAULT CHARSET=latin1;

/*Data for the table `user_group_menu` */

insert  into `user_group_menu`(`menuid`,`group`,`menu_desc`,`page`,`menu_order`,`menu_active`) values (1,'programmer','API Overview','info/api.htm',6100,'yes'),(34,'programmer','User Accounts','administrator/useraccount.php?postmode=view',5100,'yes'),(35,'programmer','Action Permissions','sentinel/actionpermits.php',6400,'yes'),(36,'programmer','PHP Info','info/phpinfo.php',6300,'yes'),(37,'programmer','----------COLUMN A ----------','main.php',1000,'yes'),(38,'programmer','Menu Editor','sentinel/menuedit.php',6500,'yes'),(41,'programmer','ACC-FX Settings','sentinel/settings.php?postmode=view',6700,'yes'),(43,'programmer','AN Broker Accounts','clientviewer.php',1300,'yes'),(46,'programmer','CC Counters','broker_counters.php?postmode=viewcounters',3300,'yes'),(47,'programmer','BD Margin Deposit/Withdrawal','broker_margin.php?postmode=searchuser',2200,'yes'),(48,'programmer','Entry Logs','broker_logs.php?postmode=view',5800,'yes'),(50,'programmer','CS Day End Cur,Idx,Date','broker_day_end.php?postmode=start',3800,'yes'),(61,'programmer','+- CS Master Reports','broker_reports.php?postmode=default',3840,'yes'),(62,'programmer','CI9 UPDATE ECU','tradeupdates_ecuprofx.php',3590,'yes'),(73,'programmer','AT Today Margin','broker_margin.php?postmode=todaymargin',1500,'yes'),(75,'programmer','F7 Todays Orders','broker_trade_orders.php?postmode=viewopenorders',4700,'yes'),(76,'programmer','AF Statement','broker_trade_orders.php?postmode=viewopenorders_searchuser',1100,'yes'),(77,'programmer','+- CS Open Order 1','broker_trade_orders.php?postmode=view_only_open_orders',3850,'no'),(79,'programmer','BI Interest Rate','broker_counters.php?postmode=viewbranchsettings',2300,'yes'),(85,'programmer','Cancel Previous Dayend','broker_day_end.php?postmode=cancel_day_end',5200,'yes'),(86,'programmer','CI Settings','broker_day_end.php?postmode=settings',3510,'yes'),(88,'programmer','BX Update Broker','ecu_db.php?postmode=view',2500,'no'),(92,'programmer','----------COLUMN B ----------','main.php',2000,'yes'),(93,'programmer','----------COLUMN C ----------','main.php',3000,'yes'),(94,'programmer','----------COLUMN E ----------','main.php',5000,'yes'),(95,'programmer','----------COLUMN D ----------','main.php',4000,'yes'),(96,'programmer','----------COLUMN F ----------','main.php',6000,'yes'),(97,'programmer','+- CS Client Summary Report','report_account_summary.php?postmode=default',3820,'yes'),(100,'programmer','Info Kill','info/infokill.php',6800,'yes'),(101,'programmer','+- CS Open Order 2','report_daily_open.php?postmode=default',3851,'yes'),(102,'programmer','BI Interest Rate Account','broker_counters.php?postmode=viewaccountsettings',2310,'yes'),(119,'programmer','F1 Deposit','broker_trade_orders.php?postmode=searchuser',4100,'no'),(120,'programmer','AF Statement Update','broker_trade_orders_update.php?postmode=viewopenorders_searchuser',1099,'yes'),(121,'programmer','AN Broker Accounts Search','an_brokeraccounts_search.php?postmode=view_searchuser',1310,'yes'),(122,'programmer','AY Today Margin Edit','broker_margin.php?postmode=todaymargin_edit',1510,'yes'),(123,'programmer','+- CS Marking','report_account_summary_adv.php?postmode=default',3830,'yes'),(124,'programmer','+- Trade History','report_counter_summary_adv.php?postmode=default',3831,'yes'),(125,'programmer','+- CS Margin Reports Monthly','broker_reports.php?postmode=margin',3870,'yes'),(126,'programmer','+- CS Margin Reports Day','margin_reports.php?postmode=margin_day',3880,'yes'),(127,'programmer','CS Day End Forex','broker_day_end_forex.php?postmode=start',3806,'yes'),(128,'programmer','CS Day End Index','broker_day_end_index.php?postmode=start',3805,'yes'),(129,'programmer','CS Day End JCM ','broker_day_end_tge.php?postmode=start',3807,'no'),(130,'programmer','CS Day End Info','broker_day_end_info.php?postmode=start',3815,'yes'),(131,'programmer','CS Day End Date Only','broker_day_end_dateonly.php?postmode=start',3808,'yes'),(132,'programmer','Update All Account','broker_trade_orders_update_all.php?postmode=viewopenorders_searchuser',4800,'no'),(133,'programmer','Change Rolldate','changerolldate.php?postmode=view_searchuser',5300,'yes'),(134,'programmer','+- CS Closing History','broker_day_end_closinghistory.php',3810,'yes'),(146,'programmer','Export Data','export/index_export.php',5810,'yes'),(148,'programmer','AF Cut Point Price','cutpoint_dayend.php?postmode=start',1130,'yes'),(149,'dealing','AF Statement','broker_trade_orders.php?postmode=viewopenorders_searchuser',1100,'yes'),(150,'dealing','AF Cut Point Price','cutpoint_dayend.php?postmode=start',1130,'yes'),(151,'dealing','AT Today Margin','broker_margin.php?postmode=todaymargin',1500,'yes'),(152,'dealing','CC Counters','broker_counters.php?postmode=viewcounters',3300,'yes'),(153,'dealing','+-CS Day End Forex','broker_day_end_forex.php?postmode=start',3806,'yes'),(154,'dealing','+-CS Day End Idx','broker_day_end_index.php?postmode=start',3805,'yes'),(155,'dealing','+-CS Day End JCM ','broker_day_end_tge.php?postmode=start',3807,'no'),(156,'dealing','+-CS Day End Date Only','broker_day_end_dateonly.php?postmode=start',3808,'yes'),(157,'dealing','+-CS Closing History','broker_day_end_closinghistory.php',3810,'yes'),(158,'dealing','CS Day End Info','broker_day_end_info.php?postmode=start',3815,'yes'),(159,'dealing','+-CS Client Summary Report','report_account_summary.php?postmode=default',3820,'yes'),(160,'dealing','+-CS Marking','report_account_summary_adv.php?postmode=default',3830,'yes'),(161,'dealing','Trade History','report_counter_summary_adv.php?postmode=default',3831,'yes'),(162,'chief','AF Statement','broker_trade_orders.php?postmode=viewopenorders_searchuser',1100,'yes'),(163,'chief','AF Cut Point Price','cutpoint_dayend.php?postmode=start',1130,'yes'),(164,'chief','AT Today Margin','broker_margin.php?postmode=todaymargin',1500,'yes'),(165,'chief','CC Counters','broker_counters.php?postmode=viewcounters',3300,'yes'),(166,'chief','+-CS Day End Forex','broker_day_end_forex.php?postmode=start',3806,'yes'),(167,'chief','+-CS Day End Idx','broker_day_end_index.php?postmode=start',3805,'yes'),(168,'chief','+-CS Day End JCM ','broker_day_end_tge.php?postmode=start',3807,'no'),(169,'chief','+-CS Day End Date Only','broker_day_end_dateonly.php?postmode=start',3808,'yes'),(170,'chief','+-CS Closing History','broker_day_end_closinghistory.php',3810,'yes'),(171,'chief','+-CS Day End Info','broker_day_end_info.php?postmode=start',3815,'yes'),(172,'chief','+-CS Client Summary Report','report_account_summary.php?postmode=default',3820,'yes'),(173,'chief','+-CS Marking','report_account_summary_adv.php?postmode=default',3830,'yes'),(174,'chief','Trade History','report_counter_summary_adv.php?postmode=default',3831,'yes'),(175,'chief','+-CS Master Report','broker_reports.php?postmode=default',3840,'yes'),(176,'chief','+-CS Open Order','report_daily_open.php?postmode=default',3851,'yes'),(177,'chief','+-CS Margin Reports Monthly','broker_reports.php?postmode=margin',3870,'yes'),(178,'chief','+-CS Margin Reports Day','margin_reports.php?postmode=margin_day',3880,'yes'),(179,'chief','F7 Todays Orders','broker_trade_orders.php?postmode=viewopenorders',4700,'yes'),(180,'accounting','AF Statement Update','broker_trade_orders_update.php?postmode=viewopenorders_searchuser',1099,'yes'),(181,'accounting','AF Cut Point Price','cutpoint_dayend.php?postmode=start',1130,'yes'),(182,'dealing','AN Broker Accounts','clientviewer.php',1300,'yes'),(183,'dealing','AN Broker Accounts Search','an_brokeraccounts_search.php?postmode=view_searchuser',1310,'yes'),(184,'dealing','AY Today Margin Edit','broker_margin.php?postmode=todaymargin_edit',1510,'yes'),(185,'dealing','BD Margin Deposit/Withdrawal','broker_margin.php?postmode=searchuser',2200,'yes'),(186,'accounting','+-CS Client Summary Report','report_account_summary.php?postmode=default',3820,'yes'),(187,'dealing','+-CS Marking','report_account_summary_adv.php?postmode=default',3830,'yes'),(188,'dealing','+-CS Master Report','broker_reports.php?postmode=default',3840,'yes'),(189,'dealing','+-CS Margin Reports Monthly','broker_reports.php?postmode=margin',3870,'yes'),(190,'dealing','+-CS Margin Reports Day','margin_reports.php?postmode=margin_day',3880,'yes'),(191,'supervisor','AF Statement','broker_trade_orders.php?postmode=viewopenorders_searchuser',1100,'yes'),(192,'supervisor','AT Today Margin','broker_margin.php?postmode=todaymargin',1500,'yes'),(193,'supervisor','+-CS Closing History','broker_day_end_closinghistory.php',3810,'yes'),(194,'supervisor','+-CS Client Summary Report','report_account_summary.php?postmode=default',3820,'yes'),(195,'supervisor','+-CS Marking','report_account_summary_adv.php?postmode=default',3830,'yes'),(196,'supervisor','Trade History','report_counter_summary_adv.php?postmode=default',3831,'yes'),(197,'supervisor','+-CS Master Reports','broker_reports.php?postmode=default',3840,'yes'),(198,'supervisor','+-CS Open Order','report_daily_open.php?postmode=default',3851,'yes'),(199,'supervisor','+-CS Margin Reports Monthly','broker_reports.php?postmode=margin',3870,'yes'),(200,'supervisor','+-CS Margin Reports Day','margin_reports.php?postmode=margin_day',3880,'yes'),(201,'supervisor','F7 Todays Orders','broker_trade_orders.php?postmode=viewopenorders',4700,'yes'),(202,'supervisor','Export Data','export/index_export.php',5810,'yes'),(203,'supervisor','Entry Logs','broker_logs.php?postmode=view',5800,'yes'),(204,'director','AT Today Margin','broker_margin.php?postmode=todaymargin',1500,'yes'),(205,'director','+-CS Closing History','broker_day_end_closinghistory.php',3810,'yes'),(206,'director','+-CS Marking','report_account_summary_adv.php?postmode=default',3830,'yes'),(207,'director','Trade History','report_counter_summary_adv.php?postmode=default',3831,'yes'),(208,'director','+-CS Master Reports','broker_reports.php?postmode=default',3840,'yes'),(209,'director','+-CS Open Order','report_daily_open.php?postmode=default',3851,'yes'),(210,'director','+-CS Margin Reports Monthly','broker_reports.php?postmode=margin',3870,'yes'),(211,'director','+-CS Margin Reports Day','margin_reports.php?postmode=margin_day',3880,'yes'),(212,'IT Development','API Overview','info/api.htm',6100,'yes'),(213,'IT Development','PHP Info','info/phpinfo.php',6300,'yes'),(214,'IT Development','ACC-FX Settings','sentinel/settings.php?postmode=view',6700,'yes'),(215,'IT Development','Info Kill','info/infokill.php',6800,'yes'),(216,'Administrator','CS Day End Cur,Idx,Date','broker_day_end.php?postmode=start',3800,'yes'),(217,'Administrator','CI Settings','broker_day_end.php?postmode=settings',3510,'yes'),(218,'Administrator','User Accounts','administrator/useraccount.php?postmode=view',5100,'yes'),(219,'Administrator','Cancel Previous Dayend','broker_day_end.php?postmode=cancel_day_end',5200,'yes'),(220,'Administrator','Change Rolldate','changerolldate.php?postmode=view_searchuser',5300,'yes'),(221,'Administrator','Entry Logs','broker_logs.php?postmode=view',5800,'yes'),(222,'Administrator','Export Data','export/index_export.php',5810,'yes'),(223,'Administrator','Action Permissions','sentinel/actionpermits.php',6400,'yes'),(224,'Administrator','Menu Editor','sentinel/menuedit.php',6500,'yes'),(225,'dealing','Change Password',' myaccount.php ',5110,'yes'),(226,'chief','Change Password',' myaccount.php ',5110,'yes'),(227,'accounting','Change Password',' myaccount.php ',5110,'yes'),(228,'supervisor','Change Password',' myaccount.php ',5110,'yes'),(229,'Director','Change Password',' myaccount.php ',5110,'yes'),(230,'IT Development','Change Password',' myaccount.php ',5110,'yes'),(231,'Administrator','Change Password',' myaccount.php ',5110,'yes'),(232,'programmer','Change Password',' myaccount.php ',5110,'yes'),(233,'programmer','Client PNL','report_account_pnl.php',3882,'yes'),(234,'director','Report Client PNL','report_account_pnl.php',3881,'yes'),(235,'programmer','Group PNL','report_group_pnl.php',3883,'yes'),(236,'director','Report Group PNL','report_group_pnl.php',3882,'yes'),(237,'supervisor','Client PNL','report_account_pnl.php',3881,'yes'),(238,'supervisor','Group PNL','report_group_pnl.php',3882,'yes'),(239,'accounting','Trade History','report_counter_summary_adv.php?postmode=default',2201,'yes'),(240,'dealing','CS Day End Cur,Idx,Date','broker_day_end.php?postmode=start',3800,'yes'),(241,'programmer','+- CS Commission Monthly Reports','report_commission.php?postmode=default',3881,'yes'),(242,'programmer','------META REPORT -----','main.php',100,'yes'),(243,'programmer','Client Summary Meta Report','meta_report_account_summary.php?postmode=default',101,'yes'),(244,'programmer','Meta Rolldate','metarolldate.php?postmode=view',102,'yes'),(245,'programmer','ACC KOTA','editok.php?postmode=view',103,'yes');

/*Table structure for table `usercompany` */

DROP TABLE IF EXISTS `usercompany`;

CREATE TABLE `usercompany` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `companygroup` varchar(15) DEFAULT 'eforex',
  `companyname` varchar(36) DEFAULT NULL,
  `companyurl` varchar(100) DEFAULT NULL,
  `active` char(3) DEFAULT 'yes',
  `appurl` varchar(200) DEFAULT NULL,
  `programname` varchar(200) DEFAULT NULL,
  `version` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `admin_email` varchar(100) DEFAULT NULL,
  `long_address` text,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `usercompany` */

insert  into `usercompany`(`Id`,`companygroup`,`companyname`,`companyurl`,`active`,`appurl`,`programname`,`version`,`email`,`admin_email`,`long_address`) values (2,'Trado Market','Apex Regent Investment Limited','http://apexregent.com','yes','http://cabinet.apexregent.com','Apex Regent Program','web2','cabinet@apexregent.com','admin@apexregent.com','LEVEL 19 Two International Finance Center, 8 Finance street <br> Central Hongkong China <br> Telephone : +2251887 <br>');

/*Table structure for table `userfield` */

DROP TABLE IF EXISTS `userfield`;

CREATE TABLE `userfield` (
  `userid` int(11) unsigned NOT NULL DEFAULT '0',
  `fieldname` varchar(30) NOT NULL DEFAULT '',
  `fieldvalue` varchar(30) NOT NULL DEFAULT '',
  `rollover` varchar(8) NOT NULL DEFAULT '',
  `branchbbjcode` varchar(11) DEFAULT NULL,
  `branchclearingcode` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`userid`,`fieldname`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

/*Data for the table `userfield` */

/*Table structure for table `userview` */

DROP TABLE IF EXISTS `userview`;

CREATE TABLE `userview` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `viewtype` varchar(20) DEFAULT NULL,
  `Alias` varchar(20) DEFAULT NULL,
  `hdr` varchar(25) DEFAULT NULL,
  `detail` varchar(30) DEFAULT NULL,
  `active` char(1) DEFAULT 'Y',
  `logo` varchar(75) DEFAULT NULL,
  `description` text,
  `samecompany` varchar(11) DEFAULT 'stg9',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `userview` */

insert  into `userview`(`Id`,`viewtype`,`Alias`,`hdr`,`detail`,`active`,`logo`,`description`,`samecompany`) values (5,'stg9_summary','Summary','menu_profx.htm','login_main_1_Future.htm','Y','src=\"images/stg9.jpg\" width=\"0\" height=\"53\" align=\"right\"',NULL,'stg9'),(6,'stg9_square','Square','menu_profx.htm','login_main_2_square.htm','Y','src=\"images/stg9.jpg\" width=\"0\" height=\"53\" align=\"right\"',NULL,'stg9'),(7,'stg9_usa_summary','USA','menu_profx.htm','login_main_1_stg.htm','Y','src=\"images/stg9.jpg\" width=\"0\" height=\"53\" align=\"right\"',NULL,'stg9'),(8,'stg9_mt_summary','MT','menu_profx_mt.htm','login_main_1_mt.htm','Y','src=\"images/stg9.jpg\" width=\"0\" height=\"53\" align=\"right\"',NULL,'stg9'),(9,'stg9_simple','Simple','menu_profx_s.htm','login_main_1_Future_s.htm','Y','src=\"images/stg9.jpg\" width=\"0\" height=\"53\" align=\"right\"',NULL,'stg9');

/*Table structure for table `zbafile` */

DROP TABLE IF EXISTS `zbafile`;

CREATE TABLE `zbafile` (
  `AccNo` varchar(30) NOT NULL DEFAULT '',
  `AeCode` text NOT NULL,
  `Group` text NOT NULL,
  `Branch` text NOT NULL,
  `AePin` text NOT NULL,
  `IntTable` text NOT NULL,
  `Name` text NOT NULL,
  `Address1` text NOT NULL,
  `Address2` text NOT NULL,
  `Address3` text NOT NULL,
  `PrevBal` decimal(20,3) NOT NULL DEFAULT '0.000',
  `MarginIN` decimal(20,3) NOT NULL DEFAULT '0.000',
  `MarginOUT` decimal(20,3) NOT NULL DEFAULT '0.000',
  `PL` decimal(20,3) NOT NULL DEFAULT '0.000',
  `Interest` decimal(20,3) NOT NULL DEFAULT '0.000',
  `Commission` decimal(20,3) NOT NULL DEFAULT '0.000',
  `Adjust` decimal(20,3) NOT NULL DEFAULT '0.000',
  `Bonus` decimal(20,3) NOT NULL DEFAULT '0.000',
  `NewBal` decimal(20,3) NOT NULL DEFAULT '0.000',
  `Floating` decimal(20,3) NOT NULL DEFAULT '0.000',
  `FLCOMM` decimal(20,3) DEFAULT '0.000',
  `Equity` decimal(20,3) NOT NULL DEFAULT '0.000',
  `Rebate` decimal(20,3) NOT NULL DEFAULT '0.000',
  `Storage` decimal(20,3) NOT NULL DEFAULT '0.000',
  `Settlement` decimal(20,3) NOT NULL DEFAULT '0.000',
  `MarginReq` decimal(20,3) NOT NULL DEFAULT '0.000',
  `MarginReqDay` decimal(20,3) NOT NULL DEFAULT '0.000',
  `MarginReqNight` decimal(20,3) NOT NULL DEFAULT '0.000',
  `OpenUnit` decimal(20,3) NOT NULL DEFAULT '0.000',
  `CrLimit` decimal(20,3) NOT NULL DEFAULT '0.000',
  `status` varchar(30) DEFAULT 'normal',
  PRIMARY KEY (`AccNo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `zbafile` */

/*Table structure for table `zdafile` */

DROP TABLE IF EXISTS `zdafile`;

CREATE TABLE `zdafile` (
  `primary_id` varchar(100) NOT NULL DEFAULT '',
  `AccNo` varchar(30) NOT NULL DEFAULT '',
  `ItemCode` text NOT NULL,
  `ItemName` text NOT NULL,
  `Unit` int(11) NOT NULL DEFAULT '0',
  `BuyOrder` int(11) NOT NULL DEFAULT '0',
  `BuyRef` text NOT NULL,
  `BuyDate` text NOT NULL,
  `BuyPrice` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `SellOrder` int(11) NOT NULL DEFAULT '0',
  `SellRef` text NOT NULL,
  `SellDate` text NOT NULL,
  `SellPrice` decimal(20,4) NOT NULL DEFAULT '0.0000',
  `PL` decimal(20,3) NOT NULL DEFAULT '0.000',
  `Interest` decimal(20,3) NOT NULL DEFAULT '0.000',
  `Storage` decimal(20,3) NOT NULL DEFAULT '0.000',
  `Commission` decimal(20,3) NOT NULL DEFAULT '0.000',
  `FLCOMM` decimal(20,3) DEFAULT '0.000',
  `LotSize` int(11) NOT NULL DEFAULT '0',
  `Format` text NOT NULL,
  `LiqStatus` text NOT NULL,
  `online_tradeid` int(11) NOT NULL DEFAULT '0',
  `acct_id` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `zdafile` */

/*Table structure for table `zmargin` */

DROP TABLE IF EXISTS `zmargin`;

CREATE TABLE `zmargin` (
  `counter` varchar(15) DEFAULT NULL,
  `tradeid` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `zmargin` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
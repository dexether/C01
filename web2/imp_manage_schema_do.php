<?php
include_once "$_SERVER[DOCUMENT_ROOT]/includes/functions.php";
$var_to_pass = null;
global $product;
global $template;
global $themonth;
global $mysql;
global $DB;

$postmode = @$_GET['postmode'];
/*==============================
=            coding            =
==============================*/

if ($postmode == 'get_data') {
    $mt4dt = $_POST['mt4dt'];
    $query = "SELECT
  imp_manage_schema.`id`,
  imp_manage_schema.`amount`,
  imp_manage_schema.`bonus_for` ,
  imp_manage_schema.`level`,
  mt_database.`alias`
FROM
  imp_manage_schema,
  mt_database
WHERE imp_manage_schema.`mt4dt` = mt_database.`mt4dt`
AND imp_manage_schema.mt4dt = '$mt4dt'";
    $result = $DB->execresultset($query);
    foreach ($result as $key => $value) {
        if ($value['bonus_for'] == 'ae') {
            $data_ae[] = $value;
        } else {
            $data_nasabah[] = $value;
        }
        $alias[] = $value['alias'];
    }
    $alias2             = array_unique($alias);
    $alldata['nasabah'] = $data_nasabah;
    $alldata['ae']      = $data_ae;
    for ($i = 0; $i < count($data_nasabah); $i++) {
        $datasemua[$i]['nasabah_name']  = $data_nasabah[$i]['bonus_for'];
        $datasemua[$i]['nasabah_value'] = ceil($data_nasabah[$i]['amount']);
        $datasemua[$i]['nasabah_level'] = $data_nasabah[$i]['level'];
        $datasemua[$i]['nasabah_id']    = $data_nasabah[$i]['id'];
        // -----------------------------------------------------------
        $datasemua[$i]['ae_name']  = $data_ae[$i]['bonus_for'];
        $datasemua[$i]['ae_value'] = ceil($data_ae[$i]['amount']);
        $datasemua[$i]['ae_level'] = $data_ae[$i]['level'];
        $datasemua[$i]['ae_id']    = $data_ae[$i]['id'];
    }
    echo json_encode(array('data' => $datasemua, 'alias' => $alias2));
} elseif ($postmode == 'save_db') {

    $data = @$_POST['data'];
    foreach ($data as $key => $value) {
        $query = "UPDATE imp_manage_schema SET amount = '$value[value]' WHERE id = '$value[name]'";
        $DB->execonly($query);
    }
}

/*=====  End of coding  ======*/

function tradeLogProfile($msg)
{
    $fp      = fopen("trader.log", "a");
    $logdate = date("Y-m-d H:i:s => ");
    $msg     = preg_replace("/\s+/", " ", $msg);
    fwrite($fp, $logdate . $msg . "\n");
    fclose($fp);
    return;
}

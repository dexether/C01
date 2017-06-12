<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class AccountTreeViewController extends AuthController
{
  public function __construct()
  {
    parent::__construct();
  }
  public function index()
  {
    $data['contentDashboard'] = 'account/TreeView';
    $data['treeviews'] = $this->_getDownline();
    $data['du_menu'] = "du_tree";
    $this->template->get_user_dashboard($data);
  }
  public function _getDownline()
  {
    $usernya = $this->session->groupid;
    if ($usernya==9) {
        $condiional = "AND mlm.Upline = 'COMPANY' AND mlm.ACCNO <> 'COMPANY'";
        $condiional_header = "<ul><li>COMPANY<ul>";
        $condiional_footer = "</ul></li></ul>";
    }else{
        $condiional = "AND client_aecode.aecode = '" . $this->session->userdata('username') . "'";
        $condiional_header = "<ul>";
        $condiional_footer = "</ul>";
    }

    $query = "SELECT client_aecode.name, client_aecode.email, client_accounts.`accountname`,mlm.*
            FROM client_aecode,client_accounts,mlm
            WHERE client_aecode.`aecodeid` = client_accounts.`aecodeid`
            AND client_accounts.`suspend` = '0'
            AND client_accounts.`accountname` = mlm.`ACCNO`
            AND mlm.group_play = 'askap'
              $condiional
            ";
    $datatress = array();
    $rows = $this->db->query($query)->result_array();
    foreach ($rows as $row) {
        //TradeLogTreView("TreView-83:".$row['ACCNO']);
        $datatress[$row['ACCNO']] = $row;
    }
    $longtree = $condiional_header;
    if (count($datatress) > 0) {
        foreach ($datatress AS $ACCNO1 => $datatres) {
            //TradeLogTreView("TreView-87:" . $ACCNO1);
            $longtree = $longtree . "<li>" . $ACCNO1  . " - ". $datatres['name'];
            $longtree = $this->updatechild($longtree, $ACCNO1);
            $longtree = $longtree . "</li>";
        }
        //foreach ($datatress AS $ACCNO => $datatres) {
    }//if(count($datatress)>0){
    $longtree = $longtree . $condiional_footer;
    return $longtree;
  }
  public function updatechild($longtree, $ACCNO2) {
      $longtree = $longtree . "<ul class='treeviewul'>";
      global $DB;
      $datatress = array();
      $query = "SELECT client_aecode.name, client_aecode.email, client_accounts.`accountname`,mlm.*
      FROM client_aecode,client_accounts,mlm
      WHERE client_aecode.`aecodeid` = client_accounts.`aecodeid`
      AND client_accounts.`suspend` = '0'
      AND client_accounts.`accountname` = mlm.`ACCNO`
      AND mlm.Upline = '$ACCNO2'
      AND mlm.group_play = 'askap'

      ";

      //TradeLogTreView("TreView-111:" . $query);
      $rows = $this->db->query($query)->result_array();
      foreach ($rows as $row) {
          //TradeLogTreView("TreView-104:".$row['ACCNO']);
          $datatress[$row['ACCNO']] = $row;
      }
      if (count($datatress) > 0) {
          foreach ($datatress AS $ACCNO1 => $datatres) {
              //TradeLogTreView("TreView-112:" . $ACCNO1);
              $longtree = $longtree . "<li>" . $ACCNO1 . " - ". $datatres['name'];
              $longtree = $this->updatechild($longtree, $ACCNO1);
              $longtree = $longtree . "</li>";
          }//foreach ($datatress AS $ACCNO => $datatres) {
      }//if(count($datatress)>0){
      $longtree = $longtree . "</ul>";
      //TradeLogTreView("TreView-126:" . $longtree);
      return $longtree;
  }
}

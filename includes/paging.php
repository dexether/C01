<?
class paging {

	// available option for $tipe are session, mssql, mysql, odbc
	var $tipe;
	// count all data
	var $count_data;
	// limit row / baris yang ditampilkan dalam satu halaman
	var $limit_row;
	// jumlah group page
	var $num_group_page;
	// current active page
	var $current_page;
	// stylesheet for hyperlink
	var $class_link;
	// current link page
	var $link_page_off;
	// active link page
	var $link_page_on;
	// active link previous page
	var $link_previous_page_on;
	// active link next page
	var $link_next_page_on;
	// active link First page
	var $link_first_page_on;
	// active link Last page
	var $link_last_page_on;
	// reset index to zero (0) or follow default index
	var $reset_index;

	function paging($tipe) {
		$this->tipe = $tipe;
		$this->count_data = $this->count_all_data();
		$this->limit_row = 20;
		$this->num_group_page = 10;
		$this->current_page = isset($_GET['page']) ? $_GET['page'] : 1;
		$this->class_link = "paging_href";
		$this->link_page_off = "<b>[value]</b>&nbsp;";
		$this->link_page_on = "<a class=".$this->class_link." href=\"javascript:goto_page(value)\">[value]</a>&nbsp;";
		$this->link_previous_page_on = "<a class=".$this->class_link." href=\"javascript:goto_page(value)\">&lt;&lt;</a>&nbsp;";
		$this->link_next_page_on = "<a class=".$this->class_link." href=\"javascript:goto_page(value)\">&gt;&gt;</a>&nbsp;";
		$this->link_first_page_on = "<a class=".$this->class_link." href=\"javascript:goto_page(value)\">First</a>&nbsp;";
		$this->link_last_page_on = "<a class=".$this->class_link." href=\"javascript:goto_page(value)\">Last</a>&nbsp;";
		$this->reset_index = false;
	}

	function count_all_data() {

		
		
		if ($this->tipe == "mysql") {
			$result = mysql_query($GLOBALS['sql_page_count']);
			$data = mysql_fetch_row($result);
			return $data[0];
		}

		

		return 0;
	}

	function default_index($idx) {

		return (($this->get_current_page() - 1) * $this->limit_row) + $idx;

	}

	function arr_current_row() {

		if ($this->count_data == 0) {
			return array();
		}

		if ($this->tipe == "mysql") {
			$offset = ($this->get_current_page() - 1) * $this->limit_row;
			$search = array("{start}", "{limit}");
			$replace = array($offset, $this->limit_row);
			$sql = str_replace($search, $replace, $GLOBALS['sql_page']);
			$result = mysql_query($sql);
			$counter = 1;
			while ($data = mysql_fetch_assoc($result)) {
				if ($this->reset_index) {
					$arr[] = $data;
				} else {
					$i = $this->default_index($counter - 1);
					$arr[$i] = $data;
				$counter++;
				}
			}
			return $arr;
		}

}
	function link_page() {

		static $style_paging;

		if (!isset($style_paging)) {
			$style_paging = "<style> .paging_href:link, .paging_href:visited, .paging_href:hover{	text-decoration: none; color: black; }</style>";
			echo $style_paging;
		}

		$current_page = $this->get_current_page() - 1;
		$first_page = 0;
      $last_page = $this->get_last_page() - 1;
		$start_group_page = $current_page - ($current_page % $this->num_group_page);
		$end_group_page = $start_group_page + $this->num_group_page - 1;
		if ($end_group_page > $last_page) {
			$end_group_page = $last_page;
		}
		if ($start_group_page >= $this->num_group_page) {
			$j = $start_group_page;
			echo str_replace("value", 1, $this->link_first_page_on);
			echo str_replace("value", $j, $this->link_previous_page_on);
		}
		for ($i=$start_group_page; $i<=$end_group_page; $i++) {
	
			$j = $i + 1;
			if ($j == $this->get_current_page()) {
				echo str_replace("value",$j,$this->link_page_off);
			} else {
				echo str_replace("value",$j,$this->link_page_on);
			}
		}
		if ($end_group_page < $last_page) {
			$j = $end_group_page + 2;
			echo str_replace("value", $j, $this->link_next_page_on);
			echo str_replace("value", $last_page+1, $this->link_last_page_on);
		}

	}

	function get_last_page() {

		return (ceil($this->count_data / $this->limit_row));

	}


	function get_current_page() {

		if (!is_numeric($this->current_page) or ($this->current_page < 1) or ($this->current_page > $this->get_last_page())) {
			$this->current_page = 1;
		}
		return $this->current_page;

	}

}

?>

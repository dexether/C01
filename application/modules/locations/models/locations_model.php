<?php

    class Locations_model extends CI_Model
    {
        public function __construct()
        {
            parent::__construct();
        }

        public function getAllCountries()
        {
            $sql = 'SELECT code,country FROM cscart_country_descriptions';
            $result = $this->db->query($sql);

            return json_encode($result->result_array());
        }
    }

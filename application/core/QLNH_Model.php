<?php



date_default_timezone_set('Asia/Ho_Chi_Minh');


class QLNH_Model extends CI_Model {

    private $_currentUser;
    function __construct() {
        parent::__construct();
        //load cái gì đó
        $this->_currentUser = $this->session->userdata('username');

        
    }

    

    /*
    * @param array $data
    * @return  TRUE or FALSE
    */

    public function addNew($data)
    {
        $this->db->insert($this->database, $data);
        return $this->db->insert_id();
    }
 
    /*
    * @param array $data 
    * @param array $where 
    * @return  TRUE or FALSE
    */


    public function update($data, $where){      
        $this->db->where($where);
        $this->db->update($this->database, $data);
        return TRUE;
    }

    /*
    * @function get all data with any option
    * @param array $where
    * @param array $order
    * @param array $field
    * @return array or FALSE
    */

    public function getAll($where = null , $order = null, $field = null){
        if (empty($where) && empty($order) && empty($field)) {
            $rs = $this->db->get($this->database);
        }else if ( !empty($where) && empty($order) && empty($field)) {
            $this->db->where($where);
            $rs = $this->db->get($this->database);
        }else if (empty($where) && !empty($order) && empty($field)) {
            $this->db->order_by($order);
            $rs = $this->db->get($this->database);
        }else if (empty($where) && empty($order) && !empty($field)) {
            $this->db->select($field);
            $rs = $this->db->get($this->database);
        }else if (!empty($where) && !empty($order) && empty($field)) {
            $this->db->where($where);
            $this->db->order_by($order);
            $rs = $this->db->get($this->database);
        }else if (empty($where) && !empty($order) && !empty($field)) {
            $this->db->order_by($order);
            $this->db->select($field);
            $rs = $this->db->get($this->database);
        }else if (!empty($where) && empty($order) && !empty($field)) {
            $this->db->where($where);
            $this->db->select($field);
            $rs = $this->db->get($this->database);
        }else{
            $this->db->select($field);
            $this->db->where($where);
            $this->db->order_by($order);
            $rs = $this->db->get($this->database);
        }
        
        if ($rs->num_rows() > 0) {
            return (array) $rs->result();
        }else{
            return array();
        }
    }


    /*
    * @function getAllWhereIn
    * @param string $field 
    * @param array $Arr 
    * @return array or FALSE
    */

    public function getAllWhereIn($field,$Arr){
        $this->db->where_in($field, $Arr);
        $rs = $this->db->get($this->database);
        if ($rs->num_rows() > 0) {
            return (array) $rs->result();
        }else{
            return FALSE;
        }
    }

    /*
    * @function getAllWhereNotIn
    * @param string $field 
    * @param array $Arr 
    * @return array or FALSE
    */

    public function getAllWhereNotIn($field,$Arr){
        $this->db->where_not_in($field, $Arr);
        $rs = $this->db->get($this->database);
        if ($rs->num_rows() > 0) {
            return (array) $rs->result();
        }else{
            return FALSE;
        }
    }

     /*
    * @function getAllLike
    * @param array $Arr 
    * @return array or FALSE
    */
    public function getAllLike($Arr){
        $this->db->like($Arr);
        $rs = $this->db->get($this->database);
        if ($rs->num_rows() > 0) {
            return (array) $rs->result();
        }else{
            return FALSE;
        }
    }


    /*
    * @function getOne
    * @param array $where 
    * @return array or FALSE
    */

    public function getOne($where){
        $this->db->where($where);
        $rs = $this->db->get($this->database, 1);
        if ($rs->num_rows() > 0) {
            $rsTmp = $rs->result();
            return (array) $rsTmp[0];
        }else{
            return FALSE;
        }
    }
    public function getOneName($name,$where){
        $this->db->where($where);
        $rs = $this->db->get($name, 1);
        if ($rs->num_rows() > 0) {
            $rsTmp = $rs->result();
            return (array) $rsTmp[0];
        }else{
            return FALSE; 
        }
    }
    public function getNametable($name,$where){
        $this->db->where($where);
        $rs = $this->db->get($name);
        if ($rs->num_rows() > 0) {
            $rsTmp = $rs->result();
            return (array) $rsTmp;
        }else{
            return FALSE;
        }
    }
    /*
    * @function checkData exists in db
    * @param array $where 
    * @return TRUE or FALSE
    */
    public function count($where)
    {
        $this->db->where($where);
        $rs = $this->db->get($this->database);
        return $rs->num_rows();
    }

    public function checkExists($where){
        $this->db->where($where);
        $rs = $this->db->get($this->database, 1);
        if ($rs->num_rows() > 0) {
            return TRUE;
        }else{
            return FALSE;
        }
    }

    /*
    * @function delete data from table
    * @param array $where
    * @return TRUE or FALSE
    */
    public function delete($where = null){
        if (empty($where)) {
            return $this->db->empty_table($this->database);
        }else{
            $this->db->where($where);
            return $this->db->delete($this->database);
        }
    }

}

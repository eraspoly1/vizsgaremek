<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kereso_Model extends CI_Model {

	public function __construct() {
        parent::__construct();
        $this->load->database();
    }

	function getAll($limit,$offset)
	{
		$keyword = $this->input->get('keyword');
		if($keyword){
			$this->db->like(array('nev'=>$keyword));
			$this->db->or_like(array('irsz'=>$keyword));
			$this->db->or_like(array('telepules'=>$keyword));
			$this->db->or_like(array('email'=>$keyword));
		}
		$this->db->limit($limit);
		$this->db->offset($offset);
		$this->db->order_by('id ASC');
		return $this->db->get('rendelok')->result();
	}
	function countAll()
	{
		$keyword = $this->input->get('keyword');
		if($keyword){
			$this->db->like(array('nev'=>$keyword));
			$this->db->or_like(array('irsz'=>$keyword));
			$this->db->or_like(array('telepules'=>$keyword));
		}
		return $this->db->get('rendelok')->num_rows();
	}


//getting rendelo per page

public function getRendeloPagintaion($limit, $start) {
        
	$this->db->select('*');
	$this->db->from('rendelok');
	$this->db->limit($limit, $start);
	$this->db->order_by('id');
	$query = $this->db->get();
    return $result = $query->result();       
}

//validálás
function validate($email,$jelszo)
{
    $this->db->where('email',$email);
    $this->db->where('jelszo',$jelszo);
    $result = $this->db->get('felhasznalok',1);
    return $result;
}
//getting rendelo count

public function getRendeloCount() {

	$this->db->select('COUNT(*) as num_row');
	$this->db->from('rendelok');
	$this->db->order_by('id');
	$query = $this->db->get();
    $result = $query->result();
    return $result[0]->num_row;

}

public function getById($id)
{
	$this->db->where('id', $id);
    return $this->db->get('rendelok')->row();
}

public function getByIdNyitvatartas($id)
{
	$this->db->select('ny.id, ny.nap as nap, ny.nyitas as nyitas, ny.zaras as zaras, r.nev as nev, r.irsz as irsz, r.telepules as telepules, r.utca as utca, r.telefon as telefon, r.email as email', FALSE);
	$this->db->select('CASE nap  WHEN 0 THEN \'Vasárnap\' 
									WHEN 1 THEN \'Hétfő\' 
									WHEN 2 THEN \'Kedd\' 
									WHEN 3 THEN \'Szerda\' 
									WHEN 4 THEN \'Csütörtök\' 
									WHEN 5 THEN \'Péntek\' 
									WHEN 6 THEN \'Szombat\' 
									END nap');
		$this->db->from('nyitvatartasok as ny');
		$this->db->join('rendelok as r', 'ny.rendelo_id = r.id');
		$this->db->order_by('nap ASC');
		$this->db->where('r.id', $id);
		return $this->db->get()->result();
}

public function getByIdArak($id)
{
	$this->db->select('a.id, a.ar as ar, al.fajta as fajta, al.id as alid, r.nev as rnev, sz.nev as sznev, sz.leiras as leiras', FALSE);
		$this->db->from('arak as a');
		$this->db->join('rendelok as r', 'a.rendelo_id = r.id');
		$this->db->join('allatok as al', 'a.id = al.id');
		$this->db->join('szolgaltatasok as sz', 'a.szolgaltatas_id = sz.id');

		$this->db->where('r.id', $id);
		return $this->db->get()->result();
}

public function getByIdVelemenyek($id)
{
	$this->db->select('v.id, f.felhasznalonev as fnev, v.velemeny as velemeny', FALSE);
		$this->db->from('velemenyek as v');
		$this->db->join('rendelok as r', 'v.rendelo_id = r.id');
		$this->db->join('felhasznalok as f', 'v.felhasznalo_id = f.id');

		$this->db->where('r.id', $id);
		return $this->db->get()->result();
}

public function searchRecord()
{
	$keyword = $this->input->get('keyword');
		if($keyword){
			$this->db->like(array('nev'=>$keyword));
			$this->db->or_like(array('irsz'=>$keyword));
			$this->db->or_like(array('telepules'=>$keyword));
			$this->db->or_like(array('email'=>$keyword));
		}
		return $this->db->get('rendelok')->result();
	/*$this->db->select('*');
	$this->db->from('rendelok');
	$this->db->like('nev',$key);
	$this->db->or_like('irsz',$key);
	$this->db->or_like('telepules',$key);
	$this->db->or_like('utca',$key);
	$this->db->or_like('telefon',$key);
	$this->db->or_like('email',$key);
	$this->db->or_like('id',$key);
	$query = $this->db->get();

        if($query->num_rows()>0){
          return $query->result();
	}*/
}
/*
public function search_by_rendelonev($nev)
    {
        $this->db->where('nev', $nev);
        return $this->db->get('rendelok')->result_array();
    }

	public function search_by_rendeloirsz($irsz)
    {
        $this->db->where('irsz', $irsz);
        return $this->db->get('rendelok')->row_array();
    }

	public function search_by_rendelotelepules($telepules)
    {
        $this->db->where('telepules', $telepules);
        return $this->db->get('rendelok')->row_array();
    }


	public function search_by_rendeloutca($utca)
    {
        $this->db->where('utca', $utca);
        return $this->db->get('rendelok')->row_array();
    }

	public function list_by_nev()
	{   
	$keyword = $this->input->post('keyword');
    $this->db->like(array('nev'=>$keyword));
	return $this->db->get('rendelok')->result();
    /*$list = array();
    foreach ($results as $result) 
    {
        $list[] = $result->nev;                
    }
    #return $query;
	}

	public function list_by_telepules()
	{   
    $this->db->select('telepules');
	$this->db->from('rendelok');
    $query = $this->db->get()->result_array();
    /*$list = array();
    foreach ($results as $result) 
    {
        $list[] = $result->nev;                
    }
    return $query;
	}
	public function list_by_irsz()
	{   
    $this->db->select('irsz');
	$this->db->from('rendelok');
    $query = $this->db->get()->result_array();
    /*$list = array();
    foreach ($results as $result) 
    {
        $list[] = $result->nev;                
    }
    return $query;
	}

	public function lista(){
		$query = $this->db->query('SELECT nev FROM rendelok');
/*
			foreach ($query->result_array() as $row)
			{
        		echo $row['id'];
				echo $row['nev'];
				echo $row['irsz'];
				echo $row['telepules'];
			} 
			$row = $query->row_array();

				if (isset($row))
					{
        				echo $row['nev'];
					}
	}
*/
}
?>
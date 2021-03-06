<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Tbl_arsip_model extends CI_Model
{
    public $table = 'tbl_arsip';
    public $id = 'id';
    public $order = 'DESC';

    public function __construct()
    {
        parent::__construct();
    }

    // datatables
    public function json()
    {
        $this->datatables->select('tbl_arsip.id,judul,file,user_id,tanggal,nama_kategori,full_name');
        $this->datatables->from('tbl_arsip');
        $this->datatables->join('tbl_user', 'tbl_arsip.user_id=tbl_user.id_users');
        $this->datatables->join('tbl_bidang', 'tbl_bidang.id=tbl_user.id_bidang');
        $this->datatables->join('tbl_kategori_arsip', 'tbl_kategori_arsip.id=tbl_arsip.kategori_id');
        $this->datatables->add_column('files', '$1', 'rename_string_is_aktif2(file)');
        //$this->datatables->add_column('judul', '$1', 'gabung_judul_dan_status(id)');
              

        if ($this->session->userdata('id_user_level')==5) {
            $this->datatables->add_column('action', anchor(site_url('arsip/read/$1'), '<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
            ".anchor(site_url('arsip/update/$1'), '<i class="fa fa-pencil-square-o" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm'))." 
                ".anchor(site_url('arsip/delete/$1'), '<i class="fa fa-trash-o" aria-hidden="true"></i>', 'class="btn btn-danger btn-sm" onclick="javasciprt: return confirm(\'Are You Sure ?\')"'), 'id');
        } else {
            $this->datatables->add_column('action', anchor(site_url('arsip/read/$1'), '<i class="fa fa-eye" aria-hidden="true"></i>', array('class' => 'btn btn-danger btn-sm')), 'id');
        }
        if ($this->session->userdata('id_user_level')==5) {
            $this->datatables->where('tbl_arsip.user_id', $this->session->userdata('id_users'));
        }

        if ($this->session->userdata('id_user_level')==4) {
            $this->datatables->where('tbl_arsip.status', 'Menunggu Review Dari Level 2');
            $this->datatables->where('tbl_user.id_perdes', $this->session->userdata('id_users'));
        }

        if ($this->session->userdata('id_user_level')==3) {
            $this->datatables->where('tbl_arsip.status', 'Menunggu Review Dari Level 3');
            $this->datatables->where('tbl_user.id_bidang', $this->session->userdata('id_bidang'));
        }
        if ($this->session->userdata('id_user_level')==2) {
            $this->datatables->where('tbl_arsip.status', 'Menunggu Review Dari Admin');
            $this->datatables->or_where('tbl_arsip.status', 'Sudah Diterima Oleh Admin');
        }
        return $this->datatables->generate();
    }

    public function unserializefile($object)
    {
        $data = unserialize($object);
        $string="";
        foreach ($data as $row) {
            $string .="<a href='".base_url()."/uploads/$row'>File</a>";
        }

        return "sasa";
    }


    // get all
    public function get_all()
    {
        $this->db->order_by($this->id, $this->order);
        return $this->db->get($this->table)->result();
    }

    // get data by id
    public function get_by_id($id)
    {
        $this->db->select('tbl_arsip.tanggal,tbl_arsip.judul,tbl_arsip.status,tbl_arsip.id,tbl_arsip.file,tbl_kategori_arsip.nama_kategori,tbl_user.full_name,tbl_arsip.user_id,tbl_arsip.kategori_id');
        $this->db->where('tbl_arsip.id', $id);
        $this->db->from('tbl_arsip');
        $this->db->join('tbl_user', 'tbl_user.id_users=tbl_arsip.user_id');
        $this->db->join('tbl_kategori_arsip', 'tbl_kategori_arsip.id=tbl_arsip.kategori_id');
        return $this->db->get()->row();
    }
    
    // get total rows
    public function total_rows($q = null)
    {
        $this->db->like('id', $q);
        $this->db->or_like('judul', $q);
        $this->db->or_like('file', $q);
        $this->db->or_like('user_id', $q);
        $this->db->or_like('tanggal', $q);
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }

    // get data with limit and search
    public function get_limit_data($limit, $start = 0, $q = null)
    {
        $this->db->order_by($this->id, $this->order);
        $this->db->like('id', $q);
        $this->db->or_like('judul', $q);
        $this->db->or_like('file', $q);
        $this->db->or_like('user_id', $q);
        $this->db->or_like('tanggal', $q);
        $this->db->limit($limit, $start);
        return $this->db->get($this->table)->result();
    }

    // insert data
    public function insert($data)
    {
        $this->db->insert($this->table, $data);
    }

    // update data
    public function update($id, $data)
    {
        $this->db->where($this->id, $id);
        $this->db->update($this->table, $data);
    }

    // delete data
    public function delete($id)
    {
        $this->db->where($this->id, $id);
        $this->db->delete($this->table);
    }
}

/* End of file Tbl_arsip_model.php */
/* Location: ./application/models/Tbl_arsip_model.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-08-17 09:51:24 */
/* http://harviacode.com */

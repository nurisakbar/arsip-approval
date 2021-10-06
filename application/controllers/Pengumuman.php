<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Pengumuman extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //is_login();
        $this->load->model('Tbl_pengumuman_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template', 'pengumuman/tbl_pengumuman_list');
    }
    
    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Tbl_pengumuman_model->json();
    }

    public function read($id)
    {
        $row = $this->Tbl_pengumuman_model->get_by_id($id);
        if ($row) {
            $data = array(
        'id' => $row->id,
        'judul' => $row->judul,
        'keterangan' => $row->keterangan,
        'tanggal' => $row->tanggal,
        );
            $this->template->load('template', 'pengumuman/tbl_pengumuman_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengumuman'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('pengumuman/create_action'),
        'id' => set_value('id'),
        'judul' => set_value('judul'),
        'keterangan' => set_value('keterangan'),
        'tanggal' => set_value('tanggal'),
    );
        $this->template->load('template', 'pengumuman/tbl_pengumuman_form', $data);
    }
    
    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->create();
        } else {
            $data = array(
        'judul' => $this->input->post('judul', true),
        'keterangan' => $this->input->post('keterangan', true),
        'tanggal' => $this->input->post('tanggal', true),
        );

            $this->Tbl_pengumuman_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('pengumuman'));
        }
    }
    
    public function update($id)
    {
        $row = $this->Tbl_pengumuman_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('pengumuman/update_action'),
        'id' => set_value('id', $row->id),
        'judul' => set_value('judul', $row->judul),
        'keterangan' => set_value('keterangan', $row->keterangan),
        'tanggal' => set_value('tanggal', $row->tanggal),
        );
            $this->template->load('template', 'pengumuman/tbl_pengumuman_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengumuman'));
        }
    }
    
    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->update($this->input->post('id', true));
        } else {
            $data = array(
        'judul' => $this->input->post('judul', true),
        'keterangan' => $this->input->post('keterangan', true),
        'tanggal' => $this->input->post('tanggal', true),
        );

            $this->Tbl_pengumuman_model->update($this->input->post('id', true), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('pengumuman'));
        }
    }
    
    public function delete($id)
    {
        $row = $this->Tbl_pengumuman_model->get_by_id($id);

        if ($row) {
            $this->Tbl_pengumuman_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('pengumuman'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('pengumuman'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('judul', 'judul', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');
        $this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_pengumuman.xls";
        $judul = "tbl_pengumuman";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "Judul");
        xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");
        xlsWriteLabel($tablehead, $kolomhead++, "Tanggal");

        foreach ($this->Tbl_pengumuman_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteNumber($tablebody, $kolombody++, $data->judul);
            xlsWriteNumber($tablebody, $kolombody++, $data->keterangan);
            xlsWriteLabel($tablebody, $kolombody++, $data->tanggal);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function word()
    {
        header("Content-type: application/vnd.ms-word");
        header("Content-Disposition: attachment;Filename=tbl_pengumuman.doc");

        $data = array(
            'tbl_pengumuman_data' => $this->Tbl_pengumuman_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('pengumuman/tbl_pengumuman_doc', $data);
    }
}

/* End of file Pengumuman.php */
/* Location: ./application/controllers/Pengumuman.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-08-17 10:06:50 */
/* http://harviacode.com */

<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Arsip extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        is_login();
        $this->load->model('Tbl_arsip_model');
        $this->load->library('form_validation');
        $this->load->library('datatables');
    }

    public function index()
    {
        $this->template->load('template', 'arsip/tbl_arsip_list');
    }
    
    public function json()
    {
        header('Content-Type: application/json');
        echo $this->Tbl_arsip_model->json();
    }

    public function read($id)
    {
        $row = $this->Tbl_arsip_model->get_by_id($id);
        if ($row) {
            $data = array(
        'id' => $row->id,
        'judul' => $row->judul,
        'file' => $row->file,
        'user_id' => $row->user_id,
        'tanggal' => $row->tanggal,
        );
            $this->template->load('template', 'arsip/tbl_arsip_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('arsip'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('arsip/create_action'),
        'id' => set_value('id'),
        'judul' => set_value('judul'),
        'file' => set_value('file'),
        'user_id' => set_value('user_id'),
        'tanggal' => set_value('tanggal'),
    );
        $this->template->load('template', 'arsip/tbl_arsip_form', $data);
    }
    
    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == false) {
            $this->create();
        } else {
            $config['upload_path'] = './uploads/';
            $config['allowed_types'] = 'gif|jpg|png';
            $this->load->library('upload', $config);
            $this->upload->do_upload('gambar');
            $result1 = $this->upload->data();
            $this->upload->do_upload('gambar2');
            $result2 = $this->upload->data();
            $this->upload->do_upload('gambar3');
            $result3 = $this->upload->data();
            $this->upload->do_upload('gambar4');
            $result4 = $this->upload->data();
            $this->upload->do_upload('gambar5');
            $result5 = $this->upload->data();
            $this->upload->do_upload('gambar6');
            $result6 = $this->upload->data();
            $result = array('gambar1'=>$result1,'gambar2'=>$result2,'gambar3'=>$result3,'gambar4'=>$result4,'gambar5'=>$result5,'gambar6'=>$result6);
            // menampilkan hasil upload
            // echo "<pre>";
            // print_r($result);
            // echo "</pre>";
            // cara akses file name dari gambar 1

            $file = [];
            $file[] = $result['gambar1']['file_name'];
            $file[] =  $result['gambar2']['file_name'];
            $file[] =  $result['gambar3']['file_name'];
            $file[] = $result['gambar4']['file_name'];
            $file[] =  $result['gambar5']['file_name'];
            $file[] =  $result['gambar6']['file_name'];

        
            $data = array(
        'judul' => $this->input->post('judul', true),
        'file' => serialize($file),
        'user_id' => $this->input->post('user_id', true),
        'tanggal' => $this->input->post('tanggal', true),
        );

            $this->Tbl_arsip_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success 2');
            redirect(site_url('arsip'));
        }
    }
    
    public function update($id)
    {
        $row = $this->Tbl_arsip_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('arsip/update_action'),
        'id' => set_value('id', $row->id),
        'judul' => set_value('judul', $row->judul),
        'file' => set_value('file', $row->file),
        'user_id' => set_value('user_id', $row->user_id),
        'tanggal' => set_value('tanggal', $row->tanggal),
        );
            $this->template->load('template', 'arsip/tbl_arsip_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('arsip'));
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
        'file' => $this->input->post('file', true),
        'user_id' => $this->input->post('user_id', true),
        'tanggal' => $this->input->post('tanggal', true),
        );

            $this->Tbl_arsip_model->update($this->input->post('id', true), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('arsip'));
        }
    }
    
    public function delete($id)
    {
        $row = $this->Tbl_arsip_model->get_by_id($id);

        if ($row) {
            $this->Tbl_arsip_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('arsip'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('arsip'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('judul', 'judul', 'trim|required');
        // $this->form_validation->set_rules('file', 'file', 'trim|required');
        $this->form_validation->set_rules('user_id', 'user id', 'trim|required');
        $this->form_validation->set_rules('tanggal', 'tanggal', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tbl_arsip.xls";
        $judul = "tbl_arsip";
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
        xlsWriteLabel($tablehead, $kolomhead++, "File");
        xlsWriteLabel($tablehead, $kolomhead++, "User Id");
        xlsWriteLabel($tablehead, $kolomhead++, "Tanggal");

        foreach ($this->Tbl_arsip_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->judul);
            xlsWriteLabel($tablebody, $kolombody++, $data->file);
            xlsWriteNumber($tablebody, $kolombody++, $data->user_id);
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
        header("Content-Disposition: attachment;Filename=tbl_arsip.doc");

        $data = array(
            'tbl_arsip_data' => $this->Tbl_arsip_model->get_all(),
            'start' => 0
        );
        
        $this->load->view('arsip/tbl_arsip_doc', $data);
    }
}

/* End of file Arsip.php */
/* Location: ./application/controllers/Arsip.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2021-08-17 09:51:24 */
/* http://harviacode.com */

<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Produk extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
            
    }

    public function index()
    {
       // $data["produk"] = $this->Model_Produk->getAll();
        $this->load->view('produk/produk');
        //$this->load->view("produk/view", $data);
    }

    

    public function add()
    {
        $produk = $this->Model_Produk;
        $validation = $this->form_validation;
        $validation->set_rules($produk->rules());

        if ($validation->run()) {
            $produk->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view("produk/new_form");
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('produk');
       
        $produk = $this->Model_Produk;
        $validation = $this->form_validation;
        $validation->set_rules($produk->rules());

        if ($validation->run()) {
            $produk->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["produk"] = $produk->getById($id);
        if (!$data["produk"]) show_404();
        
        $this->load->view("produk/edit_form", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->Model_Produk->delete($id)) {
            redirect(site_url('produk'));
        }
    }
}

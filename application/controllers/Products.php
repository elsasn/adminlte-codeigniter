<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model("Model_Product");
        $this->load->library('form_validation');
    }

    public function index()
    {
        $data["products"] = $this->Model_Product->getAll();
        $this->load->view("product/view", $data);
    }

    public function add()
    {
        $product = $this->Model_Product;
        $validation = $this->form_validation;
        $validation->set_rules($product->rules());

        if ($validation->run()) {
            $product->save();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $this->load->view("product/new_form");
    }

    public function edit($id = null)
    {
        if (!isset($id)) redirect('products');
       
        $product = $this->Model_Product;
        $validation = $this->form_validation;
        $validation->set_rules($product->rules());

        if ($validation->run()) {
            $product->update();
            $this->session->set_flashdata('success', 'Berhasil disimpan');
        }

        $data["product"] = $product->getById($id);
        if (!$data["product"]) show_404();
        
        $this->load->view("product/edit_form", $data);
    }

    public function delete($id=null)
    {
        if (!isset($id)) show_404();
        
        if ($this->Model_Product->delete($id)) {
            redirect(site_url('products'));
        }
    }
}

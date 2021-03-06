<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cliente extends CI_Controller {
    
    function __construct() {
        parent::__construct();
        $this->load->model('Sga_dao');
    }

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    
    
    public function index($indice = null) {

        $this->db->select('*');
        $dados['clientes'] = $this->db->get("cliente")->result();
        $this->load->view('includes/html_header');
        $this->load->view('includes/menu');
        if ($indice == 1) {
            $data['msg'] = "Cliente cadastrado com sucesso!";
            $this->load->view('includes/msg_sucesso', $data);
        } else if ($indice == 2) {
            $data['msg'] = "Não foi possível cadastrar o cliente!";
            $this->load->viem('includes/msg_erro', $data);
        }else if ($indice == 3) {
            $data['msg'] = "Cliente excluído com sucesso!";
            $this->load->view('includes/msg_sucesso', $data);
        } else if ($indice == 4) {
            $data['msg'] = "Não foi possível excluir o cliente!";
            $this->load->viem('includes/msg_erro', $data);
        }else if ($indice ==5) {
            $data['msg'] = "Cliente atualizado com sucesso!";
            $this->load->view('includes/msg_sucesso', $data);
        } else if ($indice ==6) {
            $data['msg'] = "Não foi possível atualizar o cliente!";
            $this->load->viem('includes/msg_erro', $data);
        }

        $this->load->view('listar_cliente', $dados);
        $this->load->view('includes/html_footer');
    }

    public function cadastro() {

        $this->load->view('includes/html_header');
        $this->load->view('includes/menu');
        $this->load->view('cadastro_cliente');
        $this->load->view('includes/html_footer');
    }

    public function cadastrar() {


        $data['nome'] = $this->input->post('nome');
        $data['cpf'] = $this->input->post('cpf');
        $data['rg'] = $this->input->post('rg');
        $data['dataNascimento'] = $this->input->post('dataNascimento');
        $data['sexo'] = $this->input->post('sexo');
        $data['cep'] = $this->input->post('cep');
        $data['endereco'] = $this->input->post('endereco');
        $data['numero'] = $this->input->post('numero');
        $data['bairro'] = $this->input->post('bairro');
        $data['cidade'] = $this->input->post('cidade');
        $data['uf'] = $this->input->post('uf');
        $data['telefoneRes'] = $this->input->post('telefoneRes');
        $data['telefoneCel'] = $this->input->post('telefoneCel');
        $data['telComercial'] = $this->input->post('telComercial');
       

        $this->Sga_dao->insere('cliente', $data);
        $id_cliente = $this->db->insert_id();
        redirect('cliente/cadastro_aluno/'.$id_cliente); 
    }
    
    public function cadastro_aluno(){
        $this->load->view('includes/html_header');
        $this->load->view('includes/menu');
        $this->load->view('cadastro_aluno');
        $this->load->view('includes/html_footer');
    }

    public function excluir($id = null) {

        $this->db->where('idCliente', $id);
        if ($this->db->delete('cliente')) {
            redirect('cliente/3');
        } else {
            redirect('cliente/4');
        }
    }

    public function atualizar($id = null, $indice = null) {

        $this->db->where('idCliente', $id);
        $data['cliente'] = $this->db->get('cliente')->result();

        $this->load->view('includes/html_header');
        $this->load->view('includes/menu');
        $this->load->view('editar_cliente', $data);
        $this->load->view('includes/html_footer');
    }

    public function salvar_atualizacao() {

        $id = $this->input->post('idCliente');

        $data['nome'] = $this->input->post('nome');
        $data['cpf'] = $this->input->post('cpf');
        $data['rg'] = $this->input->post('rg');
        $data['dataNascimento'] = $this->input->post('dataNascimento');
        $data['sexo'] = $this->input->post('sexo');
        $data['cep'] = $this->input->post('cep');
        $data['endereco'] = $this->input->post('endereco');
        $data['numero'] = $this->input->post('numero');
        $data['bairro'] = $this->input->post('bairro');
        $data['cidade'] = $this->input->post('cidade');
        $data['uf'] = $this->input->post('uf');
        $data['telefoneRes'] = $this->input->post('telefoneRes');
        $data['telefoneCel'] = $this->input->post('telefoneCel');
        $data['telComercial'] = $this->input->post('telComercial');
        
        $this->db->where('idCliente', $id);
        if ($this->db->update('cliente', $data)) {
            redirect('cliente/5');
        } else {
            redirect('cliente/6');
        }
    }
    
   

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
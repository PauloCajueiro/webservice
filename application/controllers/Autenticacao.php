<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autenticacao extends CI_Controller {

	public function login()
	{
		$this->load->model('autenticacao_model', 'autenticacao');
		
		//Codigo do sistema
		$codSistema = $this->uri->segment(2);

		//Login do aluno 
		$login = $this->uri->segment(3);

		//Senha do aluno 
		$senha = $this->uri->segment(4);

		if($codSistema =='2701902'){
			$sql = $this->autenticacao->verificaUsuario($login);

			if($sql){
				$loginAluno = $sql->LOGIN_ALUNO;
				$idAluno = $sql->ID_ALUNO;
				$hash = $sql->SENHA_ALUNO;

				if(password_verify($senha, $hash)){
					$sql = $this->autenticacao->dadosAluno($idAluno);
					echo json_encode($sql, 128);
				}else{
					$erro = array('Erro' => 3, 'Mensagem' => 'Senha não confere');
					echo json_encode($erro, 128);
				}

			}else{
				$erro = array('Erro' => 2, 'Mensagem' => 'Login não confere');
				echo json_encode($erro, 128);
			}    

		}else{
			$erro = array('Erro' => 1, 'Mensagem' => 'Chave de autenticação não confere');
			echo json_encode($erro, 128);
		}


	}

}

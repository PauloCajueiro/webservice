<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Autenticacao_model extends CI_Model {

    public function verificaUsuario($login){
       
		  $this->db
		  ->select('ID_ALUNO, LOGIN_ALUNO, SENHA_ALUNO')
		  ->from('LOGIN_ALUNO')
		  ->where('LOGIN_ALUNO like binary', $login)
		  ->where('STATUS', 1);
		
		   $sql = $this->db->get();
          
		   if($sql->num_rows()>0){
		   	 return $sql->row();
		   }else{
		   	 return NULL;
		   }
         
	}
	
	//lista dados do aluno
    public function dadosAluno($idAluno){

		$this->db->select('TURMA.ID_TURMA, TURMA.DS_TURMA, ANO_LETIVO.DS_ANO_LETIVO, ALUNO_60.ID_ALUNO, ALUNO_60.NOME_ALUNO');
		$this->db->from('MATRICULA_COMUM');
		$this->db->join('TURMA', 'TURMA.ID_TURMA = MATRICULA_COMUM.ID_TURMA');
		$this->db->join('ANO_LETIVO', 'ANO_LETIVO.ID_ANO_LETIVO = MATRICULA_COMUM.ID_ANO_LETIVO');
		$this->db->join('ALUNO_60', 'ALUNO_60.ID_ALUNO = MATRICULA_COMUM.ID_ALUNO');
		$this->db->where('MATRICULA_COMUM.ID_ALUNO', $idAluno);
		$query = $this->db->get();
		#return $query->result();
		return $query->row();

	}
 

}

<?php
namespace App\Models;

/**
* CONTRIBUA PARA O PROJETO em https://github.com/paulohsilvestre/generatorforlaravel
* Created by GeneratorForLaravel - Paulo Henrique Silvestre.
* Email: paulohsilvestre@gmail.com
* Phone: (46) 99106-1331/(46) 99141-0012
* Date: 08/11/2022
* Time: 17:09:45
*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Log;

class Evento extends Model
{

		protected $table = 'eventos';
		protected $fillable;

		protected $appends = 
		[
			'funcionario',
			'profissional',
			'localatendimento',
			'especialidade',
			'tipoevento',
			'dependente',
			'cidCodigo'
		];

		public function __construct()
		{
			$fields = include('field/fields_evento.php');
			$this->fillable = $fields;
		}

		public function getFuncionarioAttribute(){
			$funcionario = Funcionario::find($this->funcionarios_id);
			// if ($funcionario === null) {
			// 	Log::warning("Funcionário não encontrado para ID: {$this->funcionarios_id}");				
			// 	return 'Funcionário não encontrado';
			// }
			return $funcionario->nome;
		}

		public function getProfissionalAttribute(){
			$profissional = Profissionais::find($this->profissionais_id);
			return $profissional->nome;
		}

		public function getLocalAtendimentoAttribute(){
			$localatendimento = Locaisatendimento::find($this->locaisatendimento_id);
			return $localatendimento->descricao;
		}

		public function getEspecialidadeAttribute(){
			$especialidade = Especialidade::find($this->especialidades_id);
			return $especialidade->profissao;
		}

		public function getTipoEventoAttribute(){
			$tipoevento = Tipoevento::find($this->tipoeventos_id);
			return $tipoevento->descricao;
		}

		public function getDependenteAttribute(){
			$dependente = Dependente::find($this->dependentes_id);
    
			if ($dependente) {
				return $dependente->nome;
			} else {
				return 'Sem dependente';
			}
		}

		public function getCidCodigoAttribute(){
			$cid = Cid::find($this->cid_id);
			return $cid->codigo;
		}

		public function especialidades()
		{
			return $this->hasOne('App\Models\Especialidade','id','especialidades_id');
		}

		public function cid()
		{
			return $this->hasOne('App\Models\Cid','id','cid_id');
		}

		public function tipoeventos()
		{
			return $this->hasOne('App\Models\Tipoevento','id','tipoeventos_id');
		}

		public function funcionarios()
		{
			return $this->hasOne('App\Models\Funcionario','id','funcionarios_id');
		}

		public function locaisatendimento()
		{
			return $this->hasOne('App\Models\Funcionario','id','locaisatendimento_id');
		}

		public function profissionais()
		{
			return $this->hasOne('App\Models\Funcionario','id','profissionais_id');
		}

		public function dependentes()
		{
			return $this->hasOne('App\Models\Dependente','id','dependentes_id');
		}

}

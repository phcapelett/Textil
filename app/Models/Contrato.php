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

class Contrato extends Model
{

		protected $table = 'contratos';
		protected $fillable;

		protected $appends = 
		[
			'empresa',
			'funcionario',
			'tiposcontratos',
			'tiposcontratosexperiencia',
			'funcao',
			'jornadas'
		];

		public function __construct()
		{
			$fields = include('field/fields_contrato.php');
			$this->fillable = $fields;
		}

		public function getEmpresaAttribute(){
			$empresa = Empresa::find($this->empresas_id);
			return $empresa->razao_social;
		}

		public function getFuncionarioAttribute(){
			$funcionario = Funcionario::find($this->funcionarios_id);
			return $funcionario->nome;
		}

		public function getTiposContratosAttribute(){
			$tiposcontratos = Tiposcontrato::find($this->tiposcontratos_id);
			return $tiposcontratos->descricao;
		}

		public function getTiposContratosExperienciaAttribute(){
			$tiposcontratosexperiencia = Tiposcontratosexperiencia::find($this->tiposcontratosexperiencia_id);
			return $tiposcontratosexperiencia->descricao;
		}

		public function getFuncaoAttribute(){
			$funcao = Funcao::find($this->funcao_id);
			return $funcao->descricao;
		}

		public function getJornadasAttribute(){
			$jornadas = Jornada::find($this->jornadas_id);
			return $jornadas->nome;
		}

		public function funcionarioempresa()
		{
			return $this->hasOne('App\Models\Funcionarioempresa','id','funcionarioempresa_id');
		}

		public function tiposcontratos()
		{
			return $this->hasOne('App\Models\Tiposcontrato','id','tiposcontratos_id');
		}

		public function tiposcontratosexperiencia()
		{
			return $this->hasOne('App\Models\Tiposcontratosexperiencia','id','tiposcontratosexperiencia_id');
		}

		public function funcao()
		{
			return $this->hasOne('App\Models\Funcao','id','funcao_id');
		}

		public function jornadas()
		{
			return $this->hasOne('App\Models\Jornada','id','jornadas_id');
		}

		public function contratos()
		{
			return $this->hasOne('App\Models\Contrato','id','contratos_id');
		}

		public function empresa()
		{
			return $this->hasOne('App\Models\Empresa','id','empresas_id');
		}

		public function funcionario()
		{
			return $this->hasOne('App\Models\Funcionario','id','funcionarios_id');
		}

}

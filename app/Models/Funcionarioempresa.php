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

class Funcionarioempresa extends Model
{

		protected $table = 'funcionarioempresa';
		protected $fillable;

		protected $appends = ['descricao'];

		public function __construct()
		{
			$fields = include('field/fields_funcionarioempresa.php');
			$this->fillable = $fields;
		}

		public function getDescricaoAttribute()
		{
			$empresa = Empresa::find($this->empresas_id);
			$func = Funcionario::find($this->funcionarios_id);
			return $func->nome.'/'.$empresa->fantasia;
		}

		public function empresas()
		{
			return $this->hasOne('App\Models\Empresa','id','empresas_id');
		}

		public function funcionarios()
		{
			return $this->hasOne('App\Models\Funcionario','id','funcionarios_id');
		}

}

<?php
namespace App\Models;

/**
* CONTRIBUA PARA O PROJETO em https://github.com/paulohsilvestre/generatorforlaravel
* Created by GeneratorForLaravel - Paulo Henrique Silvestre.
* Email: paulohsilvestre@gmail.com
* Phone: (46) 99106-1331/(46) 99141-0012
* Date: 25/01/2023
* Time: 16:41:31
*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Financeira extends Model
{

		protected $table = 'financeira';
		protected $fillable;

		public function __construct()
		{
			$fields = include('field/fields_financeira.php');
			$this->fillable = $fields;
		}

		public function empresas()
		{
			return $this->hasOne('App\Models\Empresa','id','empresas_id');
		}

		public function funcionarios()
		{
			return $this->hasOne('App\Models\Funcionario','id','funcionarios_id');
		}

		public function usuarios()
		{
			return $this->hasOne('App\Models\Usuario','id','usuarios_id');
		}

		public function centrocusto()
		{
			return $this->hasOne('App\Models\Centrocusto','id','centrocusto_id');
		}

		public function setor()
		{
			return $this->hasOne('App\Models\Setor','id','setor_id');
		}

}

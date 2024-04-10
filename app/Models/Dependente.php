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

class Dependente extends Model
{

		protected $table = 'dependentes';
		protected $fillable;

		public function __construct()
		{
			$fields = include('field/fields_dependente.php');
			$this->fillable = $fields;
		}

		public function funcionarios()
		{
			return $this->hasOne('App\Models\Funcionario','id','funcionarios_id');
		}

		public function pcd()
		{
			return $this->hasOne('App\Models\Pcd','id','pcd_id');
		}

		public function generos()
		{
			return $this->hasOne('App\Models\Genero','id','generos_id');
		}

		public function tipodependentes()
		{
			return $this->hasOne('App\Models\Tipodependente','id','tipodependentes_id');
		}

}

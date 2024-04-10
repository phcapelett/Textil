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

class Regimetributario extends Model
{

		protected $table = 'regimetributario';
		protected $fillable;

		public function __construct()
		{
			$fields = include('field/fields_regimetributario.php');
			$this->fillable = $fields;
		}

		public function empresas()
		{
			return $this->hasOne('App\Models\Empresa','id','empresas_id');
		}

}

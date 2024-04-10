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

class Contratobeneficio extends Model
{

		protected $table = 'contratobeneficios';
		protected $fillable;

		public function __construct()
		{
			$fields = include('field/fields_contratobeneficio.php');
			$this->fillable = $fields;
		}

		public function contratos()
		{
			return $this->hasOne('App\Models\Contrato','id','contratos_id');
		}

		public function beneficios()
		{
			return $this->hasOne('App\Models\Beneficio','id','beneficios_id');
		}

}

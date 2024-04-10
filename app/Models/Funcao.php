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

class Funcao extends Model
{

		protected $table = 'funcao';
		protected $fillable;

		public function __construct()
		{
			$fields = include('field/fields_funcao.php');
			$this->fillable = $fields;
		}

		public function setor()
		{
			return $this->hasOne('App\Models\Setor','id','setor_id');
		}

		public function centrocusto()
		{
			return $this->hasOne('App\Models\Centrocusto','id','centrocusto_id');
		}

		public function cbo()
		{
			return $this->hasOne('App\Models\Cbo','id','cbo_id');
		}

}

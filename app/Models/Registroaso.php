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

class Registroaso extends Model
{

		protected $table = 'registroaso';
		protected $fillable;

		public function __construct()
		{
			$fields = include('field/fields_registroaso.php');
			$this->fillable = $fields;
		}

		public function funcionarioempresa()
		{
			return $this->hasOne('App\Models\Funcionarioempresa','id','funcionarioempresa_id');
		}

		public function aso()
		{
			return $this->hasOne('App\Models\Aso','id','aso_id');
		}

		public function funcaoexames()
		{
			return $this->hasOne('App\Models\Funcaoexame','id','funcaoexames_id');
		}

		public function usuarios()
		{
			return $this->hasOne('App\Models\Usuario','id','usuarios_id');
		}

}

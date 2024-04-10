<?php
namespace App\Models;

/**
* CONTRIBUA PARA O PROJETO em https://github.com/paulohsilvestre/generatorforlaravel
* Created by GeneratorForLaravel - Paulo Henrique Silvestre.
* Email: paulohsilvestre@gmail.com
* Phone: (46) 99106-1331/(46) 99141-0012
* Date: 03/04/2023
* Time: 15:55:59
*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Defeitosinspecao extends Model
{

		protected $table = 'defeitosinspecao';
		protected $fillable;

		public function __construct()
		{
			$fields = include('field/fields_defeitosinspecao.php');
			$this->fillable = $fields;
		}

		public function inspecaopuma()
		{
			return $this->hasOne('App\Models\Inspecaopuma','id','inspecaopuma_id');
		}

		public function inspecaodefeito()
		{
			return $this->hasOne('App\Models\Inspecaodefeito','id , grupodefeito_id','inspecaodefeito_id , inspecaodefeito_grupodefeito_id');
		}

}

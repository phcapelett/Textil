<?php
namespace App\Models;

/**
* CONTRIBUA PARA O PROJETO em https://github.com/paulohsilvestre/generatorforlaravel
* Created by GeneratorForLaravel - Paulo Henrique Silvestre.
* Email: paulohsilvestre@gmail.com
* Phone: (46) 99106-1331/(46) 99141-0012
* Date: 13/03/2023
* Time: 15:10:17
*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inspecaodefeito extends Model
{

		protected $table = 'inspecaodefeito';
		protected $fillable = [
			'descricaoinspecao',
			'grupodefeito_id',
			'id',
		];

		public function __construct()
		{
			$fields = include('field/fields_inspecaodefeito.php');
			$this->fillable = $fields;
		}

		public function grupodefeito()
		{
			return $this->hasOne('App\Models\Grupodefeito','id','grupodefeito_id');
		}

}

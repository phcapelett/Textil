<?php
namespace App\Models;

/**
* CONTRIBUA PARA O PROJETO em https://github.com/paulohsilvestre/generatorforlaravel
* Created by GeneratorForLaravel - Paulo Henrique Silvestre.
* Email: paulohsilvestre@gmail.com
* Phone: (46) 99106-1331/(46) 99141-0012
* Date: 17/07/2023
* Time: 09:38:49
*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Locaisatendimento extends Model
{

		protected $table = 'locaisatendimento';
		protected $fillable;

		public function __construct()
		{
			$fields = include('field/fields_locaisatendimento.php');
			$this->fillable = $fields;
		}

}

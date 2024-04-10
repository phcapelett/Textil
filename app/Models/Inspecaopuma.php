<?php
namespace App\Models;

/**
* CONTRIBUA PARA O PROJETO em https://github.com/paulohsilvestre/generatorforlaravel
* Created by GeneratorForLaravel - Paulo Henrique Silvestre.
* Email: paulohsilvestre@gmail.com
* Phone: (46) 99106-1331/(46) 99141-0012
* Date: 03/04/2023
* Time: 14:16:57
*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inspecaopuma extends Model
{

		protected $table = 'inspecaopuma';
		protected $fillable;

		public function __construct()
		{
			$fields = include('field/fields_inspecaopuma.php');
			$this->fillable = $fields;
		}

}

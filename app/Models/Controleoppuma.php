<?php
namespace App\Models;

/**
* CONTRIBUA PARA O PROJETO em https://github.com/paulohsilvestre/generatorforlaravel
* Created by GeneratorForLaravel - Paulo Henrique Silvestre.
* Email: paulohsilvestre@gmail.com
* Phone: (46) 99106-1331/(46) 99141-0012
* Date: 14/04/2023
* Time: 11:57:31
*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Controleoppuma extends Model
{

		protected $table = 'controleoppuma';
		protected $fillable;

		public function __construct()
		{
			$fields = include('field/fields_controleoppuma.php');
			$this->fillable = $fields;
		}

}

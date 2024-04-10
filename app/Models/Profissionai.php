<?php
namespace App\Models;

/**
* CONTRIBUA PARA O PROJETO em https://github.com/paulohsilvestre/generatorforlaravel
* Created by GeneratorForLaravel - Paulo Henrique Silvestre.
* Email: paulohsilvestre@gmail.com
* Phone: (46) 99106-1331/(46) 99141-0012
* Date: 18/09/2023
* Time: 10:27:33
*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profissionai extends Model
{

		protected $table = 'profissionais';
		protected $fillable;

		public function __construct()
		{
			$fields = include('field/fields_profissionai.php');
			$this->fillable = $fields;
		}

}

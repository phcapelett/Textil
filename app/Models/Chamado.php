<?php
namespace App\Models;

/**
* CONTRIBUA PARA O PROJETO em https://github.com/paulohsilvestre/generatorforlaravel
* Created by GeneratorForLaravel - Paulo Henrique Silvestre.
* Email: paulohsilvestre@gmail.com
* Phone: (46) 99106-1331/(46) 99141-0012
* Date: 24/10/2023
* Time: 15:58:17
*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Chamado extends Model
{

		protected $table = 'chamados';
		protected $fillable;

		public function __construct()
		{
			$fields = include('field/fields_chamado.php');
			$this->fillable = $fields;
		}

}

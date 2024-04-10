<?php
namespace App\Models;

/**
* CONTRIBUA PARA O PROJETO em https://github.com/paulohsilvestre/generatorforlaravel
* Created by GeneratorForLaravel - Paulo Henrique Silvestre.
* Email: paulohsilvestre@gmail.com
* Phone: (46) 99106-1331/(46) 99141-0012
* Date: 12/02/2024
* Time: 10:08:44
*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Solicitanteservico extends Model
{

		protected $table = 'solicitanteservico';
		protected $fillable;

		public function __construct()
		{
			$fields = include('field/fields_solicitanteservico.php');
			$this->fillable = $fields;
		}

}

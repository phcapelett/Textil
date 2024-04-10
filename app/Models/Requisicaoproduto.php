<?php
namespace App\Models;

/**
* CONTRIBUA PARA O PROJETO em https://github.com/paulohsilvestre/generatorforlaravel
* Created by GeneratorForLaravel - Paulo Henrique Silvestre.
* Email: paulohsilvestre@gmail.com
* Phone: (46) 99106-1331/(46) 99141-0012
* Date: 06/11/2023
* Time: 09:45:51
*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Requisicaoproduto extends Model
{

		protected $table = 'requisicaoproduto';
		protected $fillable;

		public function __construct()
		{
			$fields = include('field/fields_requisicaoproduto.php');
			$this->fillable = $fields;
		}

}

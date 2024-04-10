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

class Grupodefeito extends Model
{

		protected $table = 'grupodefeito';
		protected $fillable = ['descricaogrupo', 'codigodefeito'];

		public function __construct()
		{
			$fields = include('field/fields_grupodefeito.php');
			$this->fillable = $fields;
		}

		public function inspecaodefeito()
    	{
        	return $this->hasMany('App\Models\InspecaoDefeito', 'grupodefeito_id', 'id');
		}

}

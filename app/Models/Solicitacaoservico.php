<?php
namespace App\Models;

/**
* CONTRIBUA PARA O PROJETO em https://github.com/paulohsilvestre/generatorforlaravel
* Created by GeneratorForLaravel - Paulo Henrique Silvestre.
* Email: paulohsilvestre@gmail.com
* Phone: (46) 99106-1331/(46) 99141-0012
* Date: 30/01/2024
* Time: 15:54:27
*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Solicitacaoservico extends Model
{

		protected $table = 'solicitacaoservico';
		protected $fillable;

		public function __construct()
		{
			$fields = include('field/fields_solicitacaoservico.php');
			$this->fillable = $fields;
		}

		public function maquinasproducao()
		{
			return $this->hasOne('App\Models\Maquinasproducao','id','maquinasproducao_id');
		}

}

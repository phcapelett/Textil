<?php
namespace App\Models;

/**
* CONTRIBUA PARA O PROJETO em https://github.com/paulohsilvestre/generatorforlaravel
* Created by GeneratorForLaravel - Paulo Henrique Silvestre.
* Email: paulohsilvestre@gmail.com
* Phone: (46) 99106-1331/(46) 99141-0012
* Date: 08/11/2022
* Time: 17:09:45
*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Participantegrupo extends Model
{

		protected $table = 'participantegrupos';
		protected $fillable;

		public function __construct()
		{
			$fields = include('field/fields_participantegrupo.php');
			$this->fillable = $fields;
		}

		public function grupoproducao()
		{
			return $this->hasOne('App\Models\Grupoproducao','id','grupoproducao_id');
		}

		public function funcionarioempresa()
		{
			return $this->hasOne('App\Models\Funcionarioempresa','id','funcionarioempresa_id');
		}

}

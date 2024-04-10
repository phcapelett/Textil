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

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Funcionario extends Model
{

		protected $table = 'funcionarios';
		protected $fillable;

		public function __construct()
		{
			$fields = include('field/fields_funcionario.php');
			$this->fillable = $fields;
		}

		public function escolaridades()
		{
			return $this->hasOne('App\Models\Escolaridade','id','escolaridades_id');
		}

		public function estadocivil()
		{
			return $this->hasOne('App\Models\Estadocivil','id','estadocivil_id');
		}

		public function racas()
		{
			return $this->hasOne('App\Models\Raca','id','racas_id');
		}

		public function pcd()
		{
			return $this->hasOne('App\Models\Pcd','id','pcd_id');
		}

		public function dependentes()
		{
			return $this->hasMany('App\Models\Dependentes','id', 'dependentes_id');
		}

}

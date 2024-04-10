<?php
namespace App\Models;

/**
* CONTRIBUA PARA O PROJETO em https://github.com/paulohsilvestre/generatorforlaravel
* Created by GeneratorForLaravel - Paulo Henrique Silvestre.
* Email: paulohsilvestre@gmail.com
* Phone: (46) 99106-1331/(46) 99141-0012
* Date: 17/07/2023
* Time: 09:38:49
*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Profespec extends Model
{

		protected $table = 'profespec';
		protected $fillable;

		protected $appends = ['especialidade','profissional'];

		public function __construct()
		{
			$fields = include('field/fields_profespec.php');
			$this->fillable = $fields;
		}

		public function getEspecialidadeAttribute(){
			$espc = \App\Models\Especialidade::find($this->especialidades_id);
			return $espc;
		}

		public function getProfissionalAttribute(){
			$espc = \App\Models\Profissionais::find($this->profissionais_id);
			return $espc;
		}


		public function especialidades()
		{
			return $this->hasOne('App\Models\Especialidade','id','especialidades_id');
		}

		public function profissionais()
		{
			return $this->hasOne('App\Models\Profissionais','id','profissionais_id');
		}

}

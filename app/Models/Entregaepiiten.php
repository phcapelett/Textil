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

class Entregaepiiten extends Model
{

	protected $table = 'entregaepiitens';
	protected $fillable;

	public function __construct()
	{
		$fields = include('field/fields_entregaepiiten.php');
		$this->fillable = $fields;
	}

	public function epi()
	{
		return $this->hasOne('App\Models\Epi','id','epi_id');
	}

	public function entregaepicabecalho()
	{
		return $this->hasOne('App\Models\Entregaepicabecalho','id','entregaepicabecalho_id');
	}

}
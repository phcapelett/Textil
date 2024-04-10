<?php
namespace App\Models;

/**
* CONTRIBUA PARA O PROJETO em https://github.com/paulohsilvestre/generatorforlaravel
* Created by GeneratorForLaravel - Paulo Henrique Silvestre.
* Email: paulohsilvestre@gmail.com
* Phone: (46) 99106-1331/(46) 99141-0012
* Date: 09/05/2023
* Time: 16:35:16
*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Roleusuario extends Model
{

		protected $table = 'roleusuarios';
		protected $fillable;

		public function __construct()
		{
			$fields = include('field/fields_roleusuario.php');
			$this->fillable = $fields;
		}

		public function roles()
		{
			return $this->hasOne('App\Models\Role','id','roles_id');
		}

		public function usuarios()
		{
			return $this->hasOne('App\Models\Usuario','id','usuarios_id');
		}

}

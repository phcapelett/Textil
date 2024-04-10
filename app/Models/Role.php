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

class Role extends Model
{

		protected $table = 'roles';
		protected $fillable;
		protected $appends = ['total','usuarios'];

		public function __construct()
		{
			$fields = include('field/fields_role.php');
			$this->fillable = $fields;
		}

		public function getTotalAttribute(){
			$cont = \DB::select('select count(usuarios_id) as total from roleusuarios r where roles_id  = ?',[$this->id]);
			if ($cont) {
				return $cont[0]->total;
			} else {
				return 0;
			}
		}

		public function getUsuariosAttribute(){
			$cont = \DB::select('select nome from usuarios where id in (select usuarios_id from roleusuarios r where roles_id  = ? group by usuarios_id)',[$this->id]);
			if ($cont) {
				return $cont;
			} else {
				return 0;
			}
		}


}

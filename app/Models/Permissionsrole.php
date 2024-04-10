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

class Permissionsrole extends Model
{

		protected $table = 'permissionsrole';
		protected $fillable;

		protected $primaryKey = null;
    	public $incrementing = false;

		public function __construct()
		{
			$fields = include('field/fields_permissionsrole.php');
			$this->fillable = $fields;
		}

		public function permissions()
		{
			return $this->hasOne('App\Models\Permission','id','permissions_id');
		}

		public function roles()
		{
			return $this->hasOne('App\Models\Role','id','roles_id');
		}

		public function permissionstype()
		{
			return $this->hasOne('App\Models\Permissionstype','id','permissionstype_id');
		}

}

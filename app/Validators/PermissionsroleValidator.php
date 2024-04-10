<?php
/**
* CONTRIBUA PARA O PROJETO em https://github.com/paulohsilvestre/generatorforlaravel
* Created by GeneratorForLaravel - Paulo Henrique Silvestre.
* Email: paulohsilvestre@gmail.com
* Phone: (46) 99106-1331/(46) 99141-0012
* Date: 09/05/2023
* Time: 16:35:16
*/
 namespace App\Validators;

use Prettus\Validator\LaravelValidator;

class PermissionsroleValidator extends LaravelValidator
{
		protected $rules = [
			'permissions_id' => 'required',
			'permissionstype_id' => 'required',
			'roles_id' => 'required',
		];
}

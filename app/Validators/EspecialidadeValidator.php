<?php
/**
* CONTRIBUA PARA O PROJETO em https://github.com/paulohsilvestre/generatorforlaravel
* Created by GeneratorForLaravel - Paulo Henrique Silvestre.
* Email: paulohsilvestre@gmail.com
* Phone: (46) 99106-1331/(46) 99141-0012
* Date: 08/11/2022
* Time: 14:37:58
*/
 namespace App\Validators;

use Prettus\Validator\LaravelValidator;

class EspecialidadeValidator extends LaravelValidator
{
		protected $rules = [
			'codigo' => 'max:3',
			'profissao' => 'max:150',
			'orgao' => 'max:30',
			'nregistro' => 'max:45',
			'status' => 'max:1',
		];
}

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

class TelaValidator extends LaravelValidator
{
		protected $rules = [
			'descricao' => 'max:100',
			'url' => '',
			'status' => 'max:1',
			'modulos_id' => 'required',
		];
}

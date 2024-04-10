<?php
/**
* CONTRIBUA PARA O PROJETO em https://github.com/paulohsilvestre/generatorforlaravel
* Created by GeneratorForLaravel - Paulo Henrique Silvestre.
* Email: paulohsilvestre@gmail.com
* Phone: (46) 99106-1331/(46) 99141-0012
* Date: 17/07/2023
* Time: 09:38:49
*/
 namespace App\Validators;

use Prettus\Validator\LaravelValidator;

class ProfissionaisValidator extends LaravelValidator
{
		protected $rules = [
			'nome' => 'required|max:45',
			'registro' => 'required|max:10',
			'status' => 'max:1',
			'orgaoprof' => 'required|max:8',
			'telefone' => 'max:45',
			'email' => 'max:55',
		];
}
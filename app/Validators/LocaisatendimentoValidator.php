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

class LocaisatendimentoValidator extends LaravelValidator
{
		protected $rules = [
			'descricao' => 'required|max:55',
			'cidade' => 'required|max:15',
			'uf' => 'required|max:2',
			'endereco' => 'max:55',
			'telefone' => 'max:20',
			'email' => 'max:55',
			'status' => 'max:1',
		];
}

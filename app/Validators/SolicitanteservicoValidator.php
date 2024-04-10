<?php
/**
* CONTRIBUA PARA O PROJETO em https://github.com/paulohsilvestre/generatorforlaravel
* Created by GeneratorForLaravel - Paulo Henrique Silvestre.
* Email: paulohsilvestre@gmail.com
* Phone: (46) 99106-1331/(46) 99141-0012
* Date: 12/02/2024
* Time: 10:08:44
*/
 namespace App\Validators;

use Prettus\Validator\LaravelValidator;

class SolicitanteservicoValidator extends LaravelValidator
{
		protected $rules = [
			'responsavel' => 'required|max:45',
			'local' => 'required|max:45',
		];
}

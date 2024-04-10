<?php
/**
* CONTRIBUA PARA O PROJETO em https://github.com/paulohsilvestre/generatorforlaravel
* Created by GeneratorForLaravel - Paulo Henrique Silvestre.
* Email: paulohsilvestre@gmail.com
* Phone: (46) 99106-1331/(46) 99141-0012
* Date: 30/01/2024
* Time: 15:54:27
*/
 namespace App\Validators;

use Prettus\Validator\LaravelValidator;

class MaquinasproducaoValidator extends LaravelValidator
{
		protected $rules = [
			'codigomaquina' => 'required|max:5',
			'descricaomaquina' => 'required|max:155',
			'marca' => 'max:55',
			'modelo' => 'max:25',
			'numeroserie' => 'max:155',
		];
}

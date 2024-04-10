<?php
/**
* CONTRIBUA PARA O PROJETO em https://github.com/paulohsilvestre/generatorforlaravel
* Created by GeneratorForLaravel - Paulo Henrique Silvestre.
* Email: paulohsilvestre@gmail.com
* Phone: (46) 99106-1331/(46) 99141-0012
* Date: 13/03/2023
* Time: 15:10:18
*/
 namespace App\Validators;

use Prettus\Validator\LaravelValidator;

class GrupodefeitoValidator extends LaravelValidator
{
		protected $rules = [
			'codigodefeito' => 'max:45',
			'descricaogrupo' => 'max:45',
		];
}

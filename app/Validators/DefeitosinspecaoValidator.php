<?php
/**
* CONTRIBUA PARA O PROJETO em https://github.com/paulohsilvestre/generatorforlaravel
* Created by GeneratorForLaravel - Paulo Henrique Silvestre.
* Email: paulohsilvestre@gmail.com
* Phone: (46) 99106-1331/(46) 99141-0012
* Date: 03/04/2023
* Time: 15:56:00
*/
 namespace App\Validators;

use Prettus\Validator\LaravelValidator;

class DefeitosinspecaoValidator extends LaravelValidator
{
		protected $rules = [
			'inspecaopuma_id' => 'required',
			'inspecaodefeito_id' => 'required',
			'inspecaodefeito_grupodefeito_id' => 'required',
		];
}

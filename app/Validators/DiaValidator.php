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

class DiaValidator extends LaravelValidator
{
		protected $rules = [
			'horarios_id' => 'required',
			'dia' => 'max:40',
			'manha' => 'max:20',
			'tarde' => 'max:20',
			'noite' => 'max:20',
			'almoco' => 'max:20',
			'descanso' => 'max:20',
			'horas' => 'max:20',
			'minutos' => 'max:20',
			'compensado' => 'max:1',
			'folga' => 'max:1',
		];
}

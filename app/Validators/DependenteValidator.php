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

class DependenteValidator extends LaravelValidator
{
		protected $rules = [
			'funcionarios_id' => 'required',
			'nome' => 'max:150',
			'cpf' => 'max:14',
			'nascimento' => '',
			'deduzir' => 'max:1',
			'pcd_id' => 'required',
			'generos_id' => 'required',
			'tipodependentes_id' => 'required',
		];
}

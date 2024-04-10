<?php
/**
* CONTRIBUA PARA O PROJETO em https://github.com/paulohsilvestre/generatorforlaravel
* Created by GeneratorForLaravel - Paulo Henrique Silvestre.
* Email: paulohsilvestre@gmail.com
* Phone: (46) 99106-1331/(46) 99141-0012
* Date: 09/05/2023
* Time: 16:35:16
*/
 namespace App\Validators;

use Prettus\Validator\LaravelValidator;

class PermissionValidator extends LaravelValidator
{
		protected $rules = [
			'nome' => 'max:191',
			'tela' => 'max:191',
			'descricao' => 'max:191',
			'modulos_id' => '',
			'permissao' => '',
		];
}

<?php
/**
* CONTRIBUA PARA O PROJETO em https://github.com/paulohsilvestre/generatorforlaravel
* Created by GeneratorForLaravel - Paulo Henrique Silvestre.
* Email: paulohsilvestre@gmail.com
* Phone: (46) 99106-1331/(46) 99141-0012
* Date: 24/10/2023
* Time: 15:58:17
*/
 namespace App\Validators;

use Prettus\Validator\LaravelValidator;

class ChamadoValidator extends LaravelValidator
{
		protected $rules = [
			'codigo' => 'required',
			'datachamado' => 'required',
			'dataencerramento' => '',
			'usuario' => 'required|max:45',
			'usuarioencerramento' => 'max:45',
			'rotina' => 'required|max:155',
			'tipo' => 'required|max:45',
			'descricao' => 'required|max:155',
			'encerramento' => 'max:155',
			'status' => 'required|max:1',
		];
}

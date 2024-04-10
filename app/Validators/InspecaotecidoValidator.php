<?php
/**
* CONTRIBUA PARA O PROJETO em https://github.com/paulohsilvestre/generatorforlaravel
* Created by GeneratorForLaravel - Paulo Henrique Silvestre.
* Email: paulohsilvestre@gmail.com
* Phone: (46) 99106-1331/(46) 99141-0012
* Date: 18/09/2023
* Time: 10:27:33
*/
 namespace App\Validators;

use Prettus\Validator\LaravelValidator;

class InspecaotecidoValidator extends LaravelValidator
{
		protected $rules = [
			'codigo' => 'max:5',
			'datainspecao' => '',
			'tecido' => 'required|max:100',
			'cor' => 'required|max:45',
			'fornecedor' => 'required|max:25',
			'numerolote' => 'required|max:20',
			'larguracortavel' => 'required',
			'qtdfornecedor' => 'required',
			'qtdreal' => 'required',
			'qtdvariavel' => '',
			'mediapontos' => 'required',
			'maximopontos' => 'required',
			'status' => 'required|max:2',
			'descricaodefeito' => 'max:100',
			'pesoliquido' => 'required',
			'rendimento' => 'required',
		];
}

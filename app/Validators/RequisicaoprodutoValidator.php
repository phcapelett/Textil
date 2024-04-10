<?php
/**
* CONTRIBUA PARA O PROJETO em https://github.com/paulohsilvestre/generatorforlaravel
* Created by GeneratorForLaravel - Paulo Henrique Silvestre.
* Email: paulohsilvestre@gmail.com
* Phone: (46) 99106-1331/(46) 99141-0012
* Date: 06/11/2023
* Time: 09:45:51
*/
 namespace App\Validators;

use Prettus\Validator\LaravelValidator;

class RequisicaoprodutoValidator extends LaravelValidator
{
		protected $rules = [
			'codigo' => 'required|max:5',
			'doc' => 'required|max:6',
			'datarequisicao' => 'required',
			'responsavel' => 'required|max:25',
			'requisitante' => 'required|max:25',
			'setor' => 'max:15',
			'produto' => 'required|max:45',
			'cor' => 'required|max:45',
			'xs' => '',
			's' => '',
			'm' => '',
			'l' => '',
			'xl' => '',
			'xxl' => '',
			'quantidadeproduto' => '',
			'quantidadeitens' => '',
			'caminhofoto' => 'max:155',
		];
}

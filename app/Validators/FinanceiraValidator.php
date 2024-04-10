<?php
/**
* CONTRIBUA PARA O PROJETO em https://github.com/paulohsilvestre/generatorforlaravel
* Created by GeneratorForLaravel - Paulo Henrique Silvestre.
* Email: paulohsilvestre@gmail.com
* Phone: (46) 99106-1331/(46) 99141-0012
* Date: 25/01/2023
* Time: 16:41:31
*/
 namespace App\Validators;

use Prettus\Validator\LaravelValidator;

class FinanceiraValidator extends LaravelValidator
{
		protected $rules = [
			'transacao' => 'max:155',
			'empresas_id' => 'required',
			'funcionarios_id' => '',
			'usuarios_id' => 'required',
			'centrocusto_id' => 'required',
			'valor' => 'max:12,3',
			'dbcr' => 'max:1',
			'parcela' => 'max:45',
			'totalparcela' => 'max:45',
			'vencimento' => '',
			'datarecebimento' => '',
			'baixada' => 'max:1',
			'descricao' => 'max:255',
			'setor_id' => '',
		];
}

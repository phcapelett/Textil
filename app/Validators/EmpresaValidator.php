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

class EmpresaValidator extends LaravelValidator
{
		protected $rules = [
			'razao_social' => 'max:255',
			'fantasia' => 'max:255',
			'cnpj' => 'max:18',
			'inscricao' => 'max:20',
			'inss' => 'max:13,2',
			'fgts' => 'max:13,2',
			'cep' => 'max:9',
			'uf' => 'max:2',
			'bairro' => 'max:100',
			'tipo_logradouro' => 'max:20',
			'endereco' => 'max:173',
			'numero' => 'max:10',
			'telefone' => 'max:15',
			'email' => 'max:255',
			'status' => 'max:1',
			'regimetributario_id'=>'required'
		];
}

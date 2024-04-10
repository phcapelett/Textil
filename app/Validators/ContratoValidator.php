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

class ContratoValidator extends LaravelValidator
{
		protected $rules = [
			'funcionarioempresa_id' => '',
			'tiposcontratos_id' => '',
			'tiposcontratosexperiencia_id' => '',
			'inicio' => '',
			'fim' => '',
			'encerrado' => 'max:1',
			'cargahoraria' => '',
			'funcao_id' => 'required',
			'jornadas_id' => 'required',
			'salario' => 'max:12,2',
			'empresas_id' => 'required',
			'funcionarios_id' => 'required',
		];
}

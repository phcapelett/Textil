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

class FuncionarioValidator extends LaravelValidator
{
		protected $rules = [
			'nome' => 'max:155',
			'codigo' => 'max:10',
			'nascimento' => '',
			'nomesocial' => 'max:155',
			'cpf' => 'max:14',
			'pis' => 'max:45',
			'rg' => 'max:20',
			'emissaorg' => '',
			'cnh' => 'max:45',
			'categoriacnh' => 'max:45',
			'emissaocnh' => '',
			'validadecnh' => '',
			'mae' => 'max:155',
			'pai' => 'max:155',
			'ctps' => 'max:18',
			'escolaridades_id' => 'required',
			'estadocivil_id' => 'required',
			'racas_id' => 'required',
			'pcd_id' => 'required',
			'dd' => 'required',
			'fonewhats' => 'required'
		];
}

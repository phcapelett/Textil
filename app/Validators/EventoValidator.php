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

class EventoValidator extends LaravelValidator
{
		protected $rules = [
			'codigo' => 'max:5',
			'descricao' => 'max:100',
			'status' => 'max:1',
			'especialidades_id' => 'required',
			'cid_id' => '',
			'tipoeventos_id' => 'required',
			'funcionarios_id' => 'required',
			'locaisatendimento_id' => 'required',
			'profissionais_id' => 'required',
			'dataemissao' => '',
			'dataentregue' => '',
			'datainicio' => '',
			'datafim' => '',
			'usuariolanc' => 'max:100',
			'usuariobaixa' => 'max:100',
			'databaixa' => ''
		];
}

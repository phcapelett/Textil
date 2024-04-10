<?php
/**
* CONTRIBUA PARA O PROJETO em https://github.com/paulohsilvestre/generatorforlaravel
* Created by GeneratorForLaravel - Paulo Henrique Silvestre.
* Email: paulohsilvestre@gmail.com
* Phone: (46) 99106-1331/(46) 99141-0012
* Date: 30/01/2024
* Time: 15:54:27
*/
 namespace App\Validators;

use Prettus\Validator\LaravelValidator;

class SolicitacaoservicoValidator extends LaravelValidator
{
		protected $rules = [
			'ordemservico' => 'required|max:5',
			'motivo' => 'required|max:55',
			'tiposervico' => 'required|max:30',
			'descricaoservico' => 'max:155',
			'localsolicitante' => 'required|max:55',
			'solicitanteservico_id' => 'required|max:55',
			'mecanico' => 'max:55',
			'maquinaparada' => 'required|max:2',
			'datahorasolicitante' => 'required',
			'datahorainicio' => '',
			'datahorafim' => '',
			'maquinasproducao_id' => 'required',
			'maquinadescricao' => 'required|max:100',
		];
}

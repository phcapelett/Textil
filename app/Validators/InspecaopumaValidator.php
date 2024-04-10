<?php
/**
* CONTRIBUA PARA O PROJETO em https://github.com/paulohsilvestre/generatorforlaravel
* Created by GeneratorForLaravel - Paulo Henrique Silvestre.
* Email: paulohsilvestre@gmail.com
* Phone: (46) 99106-1331/(46) 99141-0012
* Date: 03/04/2023
* Time: 14:16:57
*/
 namespace App\Validators;

use Prettus\Validator\LaravelValidator;

class InspecaopumaValidator extends LaravelValidator
{
		protected $rules = [
			'acaotomada' => 'max:155',
			'amostraetiquetas' => '',
			'amostratamanhos' => 'max:155',
			'aprovado' => 'max:10',
			'colecao' => 'max:20',
			'cor' => 'max:55',
			'datainspecao' => '',
			'descricaoestilo' => 'max:20',
			'estilo' => 'max:45',
			'gruposdefeitos' => 'max:255',
			'inspetor' => 'max:45',
			'numeropedido' => 'max:15',
			'obsinspecao' => 'max:155',
			'ordemproducao' => 'max:15',
			'passou' => 'max:3',
			'pedidooriginal' => '',
			'tam1' => '',
			'tam2' => '',
			'tam3' => '',
			'tam4' => '',
			'tam5' => '',
			'tam6' => '',
			'tam7' => '',
			'totaldefeitos' => '',
			'totalinspecao' => '',
		];
}

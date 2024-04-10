<?php
/**
* CONTRIBUA PARA O PROJETO em https://github.com/paulohsilvestre/generatorforlaravel
* Created by GeneratorForLaravel - Paulo Henrique Silvestre.
* Email: paulohsilvestre@gmail.com
* Phone: (46) 99106-1331/(46) 99141-0012
* Date: 14/04/2023
* Time: 11:57:31
*/
namespace App\Validators;

use Prettus\Validator\LaravelValidator;

class ControleoppumaValidator extends LaravelValidator
{
		protected $rules = [
			'ordemproducao' => 'max:15',
			'pedidocliente' => 'max:15',
			'referenciaproduto' => 'max:20',
			'datacontrole' => '',
			'pcxs' => '',
			'pcs' => '',
			'pcl' => '',
			'pcm' => '',
			'pcxl' => '',
			'pcxxl' => '',
			'pc3xl' => '',
			'pctotal' => '',
			'clxs' => '',
			'cls' => '',
			'cll' => '',
			'clm' => '',
			'clxl' => '',
			'clxxl' => '',
			'cl3xl' => '',
			'cltotal' => '',
			'dmxs' => '',
			'dms' => '',
			'dml' => '',
			'dmm' => '',
			'dmxl' => '',
			'dmxxl' => '',
			'dm3xl' => '',
			'dmtotal' => '',
			'fatxs' => '',
			'fats' => '',
			'fatl' => '',
			'fatm' => '',
			'fatxl' => '',
			'fatxxl' => '',
			'fat3xl' => '',
			'fattotal' => '',
			'bgxs' => '',
			'bgs' => '',
			'bgl' => '',
			'bgm' => '',
			'bgxl' => '',
			'bgxxl' => '',
			'bg3xl' => '',
			'bgtotal' => '',
		];
}

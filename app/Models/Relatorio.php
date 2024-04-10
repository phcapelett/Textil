<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relatorio extends Model
{
    protected $table = 'relatorio';

    public function __construct()
		{
			$fields = include('field/fields_relatorio.php');
			$this->fillable = $fields;
		}
}

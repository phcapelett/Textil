<?php
namespace App\Models;

/**
* CONTRIBUA PARA O PROJETO em https://github.com/paulohsilvestre/generatorforlaravel
* Created by GeneratorForLaravel - Paulo Henrique Silvestre.
* Email: paulohsilvestre@gmail.com
* Phone: (46) 99106-1331/(46) 99141-0012
* Date: 08/11/2022
* Time: 17:09:45
*/
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Usuario extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

	protected $table = 'usuarios';
	protected $fillable;

    protected $appends = ['perfis'];

	public function __construct()
	{
		$fields = include('field/fields_usuario.php');
		$this->fillable = $fields;
	}

	/**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    public function getPerfisAttribute(){
        $roles = \App\Models\Roleusuario::where(array('usuarios_id' => $this->id))->get();
        $roles_id = array();
        if ($roles){
            foreach($roles as $r){
                $roles_id[] = $r->roles_id;
                unset($r);
            }

            return $perfis = \App\Models\Role::whereIn('id',$roles_id)->get();

        }
        return array();
    }

}

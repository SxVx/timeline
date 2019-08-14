<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
	protected $table = 'usuarios';   

	protected $fillable = [
		'USR_Nombre','USR_Correo','USR_Contrasena'
	];
}

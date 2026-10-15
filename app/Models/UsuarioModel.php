<?php
namespace App\Models;
use CodeIgniter\Model;
class UsuarioModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'nombre',
        'correo',
        'clave',
        'activo',
        'admin',

    ];
    public function buscarPorCorreo ($correo)
    {
        return $this->where('correo', $correo)->first();
        
    }
}
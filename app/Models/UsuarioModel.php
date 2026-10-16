<?php
namespace App\Models;
use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id';
    protected $allowedFields = ['nombre', 'correo', 'contrasena', 'rol', 'activo', 'foto'];
    protected $useTimestamps = true;
}
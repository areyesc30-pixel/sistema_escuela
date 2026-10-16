<?php
namespace App\Models;
use CodeIgniter\Model;

class TareaModel extends Model
{
    protected $table = 'tareas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['usuario_id', 'titulo', 'descripcion', 'estado'];
    protected $useTimestamps = true;
}
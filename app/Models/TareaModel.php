<?php
namespace App\Model;
use CodeIgniter extends Model
{
    protected $table = 'tareas';
    protected $primaryKey = 'id';
    protected $allowedFields = ['descripcion', 'usuario_id'];
    public function listarDe($idusuario)
    {
       return $this ->where ('usuario_id', $idUsuario)->findAll();
    }
}
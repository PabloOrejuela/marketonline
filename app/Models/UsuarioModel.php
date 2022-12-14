<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model{
    protected $DBGroup          = 'default';
    protected $table            = 'usuarios';
    protected $primaryKey       = 'idusuario';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nombre', 'cedula', 'password', 'email', 'direccion', 
        'descripcion', 'image','telefono', 'logged', 'idciudades', 'idrol',
        'pais', 'ciudad','status'
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    function _verifica($usuario){
        $result = 0;
        $builder = $this->db->table('usuarios');
        $builder->select('idusuario')->where('cedula', $usuario['user'])->where('password', $usuario['password']);
        $query = $builder->get();
        if ($query->getResult() != null && $query->getNumRows() == 1) {
            foreach ($query->getResult() as $row) {
                $result = $row->idusuario;
            }
        }
        //echo $this->db->getLastQuery();
        return $result;
    }

    function _getUsuario($usuario){
        $result = NULL;
        $builder = $this->db->table('usuarios');
        $builder->select('*')->where('cedula', $usuario['user'])->where('password', md5($usuario['password']));
        $builder->join('roles', 'roles.idrol=usuarios.idrol');
        $query = $builder->get();
        if ($query->getResult() != null) {
            foreach ($query->getResult() as $row) {
                $result = $row;
            }
        }
        //echo $this->db->getLastQuery();
        return $result;
    }

    function _getUsuarioId($cedula){
        $idusuario = 0;
        $builder = $this->db->table('usuarios');
        $builder->select('idusuario');
        $builder->where('cedula', $cedula);
        $query = $builder->get();
        //echo $this->db->getLastQuery();
        if ($query->getResult() != null) {
            foreach ($query->getResult() as $row) {
                $idusuario = $row->idusuario;
            }
            
        }
        return $idusuario;
    }
}

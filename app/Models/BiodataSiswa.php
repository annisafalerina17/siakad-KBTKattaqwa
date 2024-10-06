<?php

namespace App\Models;

use CodeIgniter\Model;

class BiodataSiswa extends Model
{
    protected $table            = 'biodatasiswas';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['student_id', 'nisn', 'name', 'call', 'gender', 'birthday', 'address', 'nth_child', 'siblings', 'religion', 'avatar', 'fathers_name', 'mothers_name', 'fathers_phone', 'mothers_phone', 'fathers_birthday', 'mothers_birthday', 'fathers_nik', 'mothers_nik', 'fathers_edu', 'mothers_edu', 'fathers_occupation', 'mothers_occupation', 'fathers_income', 'mothers_income'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
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
}

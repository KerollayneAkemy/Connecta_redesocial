<?php

namespace App\Models;

use CodeIgniter\Model;

class SeguidorModel extends Model
{
    protected $table = 'seguidores';
    protected $allowedFields = ['seguidor_id', 'seguido_id'];
}
<?php

namespace App\Models;

use CodeIgniter\Model;

class EditorialModel extends Model
{
    protected $table = 'editorial_board';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'category',
        'name',
        'designation',
        'institution',
        'email',
        'profile_pdf',
    ];
}

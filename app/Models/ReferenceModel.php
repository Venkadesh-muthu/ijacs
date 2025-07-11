<?php

namespace App\Models;

use CodeIgniter\Model;

class ReferenceModel extends Model
{
    protected $table = 'references';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'article_id',
        'ref_no',
        'authors',
        'title',
        'source',
        'publisher',
        'publisher_loc',
        'year',
        'volume',
        'issue',
        'pages',
        'doi',
        'type',
        'created_at'
    ];
    protected $useTimestamps = false;
}

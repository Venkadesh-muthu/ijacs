<?php
namespace App\Models;

use CodeIgniter\Model;

class ArticleModel extends Model
{
    protected $table = 'articles';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'issue_id',
        'title',
        'subtitle',
        'authors',
        'doi',
        'pages',
        'abstract',
        'keywords',
        'pdf_file',
        'image',
        'created_at'
    ];
    protected $useTimestamps = false;
}

<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsModel extends Model
{
    protected $table = 'news_events';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'message', 'volume', 'issue', 'year', 'deadline'
    ];
}

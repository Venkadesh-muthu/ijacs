<?php

namespace App\Models;

use CodeIgniter\Model;

class NewsModel extends Model
{
    protected $table = 'news_events';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'type',        // news | event
        'title',       // title of news/event
        'message',     // description
        'link',        // external link (optional)
        'attachment',  // uploaded file name
        'deadline',    // event date / deadline
        'created_at',
        'updated_at'
    ];

    protected $useTimestamps = true;
}

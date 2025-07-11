<?php
namespace App\Models;

use CodeIgniter\Model;

class IssueModel extends Model
{
    protected $table = 'issues';
    protected $primaryKey = 'id';
    protected $allowedFields = ['volume_id', 'issue_no', 'published_date', 'issue_type', 'issue_image', 'created_at'];
    protected $useTimestamps = false;
}

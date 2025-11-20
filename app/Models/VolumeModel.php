<?php
namespace App\Models;

use CodeIgniter\Model;

class VolumeModel extends Model
{
    protected $table = 'volumes';
    protected $primaryKey = 'id';
    protected $allowedFields = ['year', 'volume_no', 'created_at'];
    protected $useTimestamps = false;
}

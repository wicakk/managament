<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project_Detail extends Model
{   
    protected $table = 'project_detail';
    protected $primaryKey = 'id';
    protected $fillable = ['project_id', 'uat_test_case', 'uat_test_desc','uat_test_detail','steps_for_uat_test','expected_result','actual_result','result','comments','created_by'];
    use HasFactory;
}

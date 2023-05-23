<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project_Detail extends Model
{   
    protected $table = 'project_detail';
    protected $primaryKey = 'id';
    protected $fillable = ['project_id', 'task_name', 'assigned_to','due_dates','category','description','checklist','created_by'];
    use HasFactory;
}

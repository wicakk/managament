<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{   
    
    protected $table = 'projects';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_project', 'waktu_mulai', 'waktu_selesai','penanggung_jawab','created_by','deadline_plan','deadline_design','deadline_implementasi','deadline_evolution'];
    use HasFactory;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{   
    
    protected $table = 'projects';
    protected $primaryKey = 'id';
    protected $fillable = ['nama_project', 'waktu_mulai', 'waktu_selesai','penanggung_jawab','created_by'];
    use HasFactory;
}

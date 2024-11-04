<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class ProjectModel extends Model
{
    //

    use HasFactory;
    protected $table = 'project_master';

    
    // protected $primaryKey = 'id';
    // public $incrementing = true; 

    protected $fillable = [
        'name',
        'start_date',
        'duration',
        'end_date',
        'created_by',
        'updated_by',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

}

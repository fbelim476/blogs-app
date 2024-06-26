<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Datatable extends Model
{
    use HasFactory;
    protected $table = 'datatable';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id','name','email','number','gender','dob'];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }
    public function datatable_detail()
    {
        return $this->belongsTo(datatable::class, 'user_id');
    }
}


<?php

namespace App\Models;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddBlogs extends Model
{
    use HasFactory,Notifiable;
    protected $fillable = ['title', 'descriptions', 'image', 'tag', 'link', 'name'];
    protected $table="addblogs";
}

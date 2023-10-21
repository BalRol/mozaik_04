<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;
    protected $table='user';
    protected $fillable = [
        'username',
        'email',
        'password',
        'image',
    ];
    public  $timestamps = false;


    public function events()
    {
        return $this->hasMany(Event::class, 'user_id', 'id');
    }
}

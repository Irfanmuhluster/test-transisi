<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employe extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'email', 'id_company'];
    protected $with = ['company'];


    public function company()
    {
        return $this->belongsTo(Company::class, 'id_company');
    }
}

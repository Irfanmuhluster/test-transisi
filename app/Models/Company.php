<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    public function scopeSearch($query)
    {
        $filter = request()->query();
        // $illegalChar = array(".", ",", "?", "!", ":", ";", "-", "+", "<", ">", "%", "~", "€", "$", "[", "]", "{", "}", "@", "&", "#", "*", "„","/","\/");
        // $charString = str_replace($illegalChar, "", $filter['search']);
        return $query
            ->when(@$filter['q'], function ($query, $keyword) {
                return $query->where('nama', 'like', "%{$keyword}%");
            });
    }

    public function employee() 
    {
        return $this->hasMany(Employe::class, 'id_company');
    }
}

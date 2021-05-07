<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'product';

    protected $fillable = [
        'name', 'ur_image', 'price','discount','category',
    ];

    //esto tiene el nombre de la tabla que voy a relacionar, todo con miniscula
    //tambien el category es para asignar category como " llave foranea"
    public function category(){
        return $this->belongsTo(Category::class,'category');
    }
}



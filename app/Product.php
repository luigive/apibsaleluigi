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

    //esta funcion es para buscar por nombre.
    public function scopeSearchNameProducts($query,$argument){
        if(empty($argument)){
            return;
        }
        $query->where('name','like',"%{$argument}%");
    }


        //esta funcion es para buscar por categorias.
        public function scopeSearchCategory($query,$argument){
            if(empty($argument)){
                return;
            }
    
            $query->where('category','=',"$argument");
        }

        //esta funcion es para ordenar productos
        public function scopeOrderProduct($query,$orderby){
            if(!in_array($orderby,['ASC','DESC'])){
                return;
            }
    
            $query->orderBy('price',$orderby);
        }


        
}



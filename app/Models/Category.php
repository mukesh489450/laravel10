<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use Sluggable;
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate'=>true
            ]
        ];
    }

    public static function rules($rquestData =[],$row=[])
    {
        $rules = [
            'name'              => 'required|max:255|string|unique:categories',
        ];
        if(!empty($row)){
            $rules['name'] = 'required|unique:categories,name,' . $row['id'];
            
        }
        return $rules;
    }

    public static function messages($rquestData =[],$row=[])
    {
        return [
            
        ];
    }

    public function getProducts(){
        return $this->hasMany(\App\Models\Product::class);

    }

    
}

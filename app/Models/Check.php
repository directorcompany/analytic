<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    use HasFactory;
    protected $fillable = ['url','http','number'];
    public function store(array $data) 
    {
        $verify = Check::create([
            'url'=>$data['url'],
            'number'=> $data['attempt'],
            'http'=>$data['status']
        ]);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Channel;


class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail',
        'img_path',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function channels()
    {
        return $this->belongsToMany(Channel::class, 'contact_channel')->withTimestamps();
    }
}

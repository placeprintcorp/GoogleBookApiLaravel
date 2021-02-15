<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Userbooklist extends Model
{
    use HasFactory;

        protected $fillable = [
        'user_id',
        'book_id',
		'sort',
		'book_data',
        
    ];
    protected $table = 'user_book_list';
}

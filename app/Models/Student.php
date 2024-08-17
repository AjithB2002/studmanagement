<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Student extends Eloquent
{
    use HasFactory;

    // Specify the MongoDB connection
    protected $connection = 'mongodb';

    // Specify the MongoDB collection
    protected $collection = 'students';

    // Define the fillable fields
    protected $fillable = [
        'name', 'email', 'course', 'age'
    ];
}

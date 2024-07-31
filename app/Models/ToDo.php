<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ToDo extends Model
{
    use HasFactory;

    protected $table = 'todo';
    protected $primaryKey = 'id';

    protected $fillable = ['title', 'description', 'status', 'priority', 'due_date'];
}

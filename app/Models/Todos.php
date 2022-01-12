<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;
use App\Models\User;

class Todos extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'description', 'user_id', 'status'];

    public function users(){
        return $this->belongsTo(User::class);
    }
}

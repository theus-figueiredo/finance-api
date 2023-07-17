<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExpenseCategory extends Model
{
    use HasFactory;
    
    protected $fillable = ['category'];


    public function expenses() {
        return $this->belongsToMany(Expenses::class);
    }
}

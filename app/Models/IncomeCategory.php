<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeCategory extends Model
{
    use HasFactory;

    protected $fillable = ['category'];

    public function incomes() {
        return $this->belongsToMany(Incomes::class);
    }
}

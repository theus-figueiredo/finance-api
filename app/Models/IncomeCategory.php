<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeCategory extends Model
{
    use HasFactory;

    protected $fillable = ['category', 'user_id'];
    protected $table = 'income_category';

    public function incomes() {
        return $this->belongsToMany(Incomes::class, 'income_category');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}

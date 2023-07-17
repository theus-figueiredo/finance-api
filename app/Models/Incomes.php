<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incomes extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'date',
        'description',
        'income_category_id',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function incomeCategory() {
        return $this->belongsToMany(IncomeCategory::class);
    }
}

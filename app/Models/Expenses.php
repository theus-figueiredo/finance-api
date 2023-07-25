<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    use HasFactory;

    protected $fillable = [
        'value',
        'date',
        'description',
        'expense_category_id',
        'user_id',
    ];

    public function expenseCategory()
    {
        return $this->belongsToMany(ExpenseCategory::class, 'expense_category');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

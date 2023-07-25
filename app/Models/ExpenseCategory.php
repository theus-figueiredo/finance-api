<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExpenseCategory extends Model
{
    use HasFactory;
    
    protected $table= 'expense_category';
    protected $fillable = ['category', 'user_id'];


    public function expenses() {
        return $this->belongsToMany(Expenses::class, 'expense_category');
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}

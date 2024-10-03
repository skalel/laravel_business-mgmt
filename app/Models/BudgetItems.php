<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BudgetItems extends Model
{
    use HasFactory;

    protected $table = 'budget_items';

    protected $fillable = [
      'id_budget',
      'seq_product',
      'id_product',
      'quantity',
      'product_value',
      'created_by',
      'updated_by',
  ];

  // Relacionamento com Orcamento
  public function budgets()
  {
      return $this->belongsTo(Budgets::class, 'id');
  }

  // Relacionamento com Estoque
  public function stocks()
  {
      return $this->belongsTo(Stocks::class, 'id_product');
  }
}

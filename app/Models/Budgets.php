<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Budgets extends Model
{
    use HasFactory;

    protected $table = 'budgets';

    protected $fillable = [
      'client_name',
      'client_number',
      'client_email',
      'budget_expiration_date',
      'budget_value',
      'budget_with_discount',
  ];

  // Relacionamento com Financeiro
  public function sales()
  {
      return $this->hasOne(Sales::class, 'id_budget');
  }

  // Relacionamento com ItensOrcamento
  public function budgetItems()
  {
      return $this->hasMany(budgetItems::class, 'id_budget');
  }
}

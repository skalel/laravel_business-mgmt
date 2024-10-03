<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedUpdatedBy;
use Kyslik\ColumnSortable\Sortable;

class Stocks extends Model
{
    use HasFactory, CreatedUpdatedBy, Sortable;

    protected $table = 'stocks';

    protected $fillable = [
      'prod_name',
      'prod_description',
      'prod_reference',
      'prod_batch',
      'prod_quantity',
      'prod_purchase_value',
      'prod_selling_value',
      'prod_width',
      'prod_length',
      'prod_height',
      'created_by',
      'updated_by',
    ];

    protected $sortables = [
      'id',
      'prod_name',
      'prod_quantity',
      'prod_batch',
    ];

  // Relacionamento com ItensVenda
  public function saleItems()
  {
      return $this->hasMany(SaleItems::class, 'id_product');
  }

  // Relacionamento com ItensOrcamento
  public function budgetItems()
  {
      return $this->hasMany(BudgetItems::class, 'id_product');
  }
}

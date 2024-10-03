<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItems extends Model
{
    use HasFactory;

    protected $table = 'sale_items';

    protected $fillable = [
      'id_sale',
      'seq_product',
      'id_product',
      'quantity',
      'product_value',
      'created_by',
      'updated_by',
  ];

  // Relacionamento com Venda
  public function sales()
  {
      return $this->belongsTo(Sales::class, 'id_sale');
  }

  // Relacionamento com Estoque
  public function stocks()
  {
      return $this->belongsTo(Stocks::class, 'id_product');
  }
}

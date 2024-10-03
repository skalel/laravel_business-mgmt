<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedUpdatedBy;
use Kyslik\ColumnSortable\Sortable;

class Sales extends Model
{
    use HasFactory, CreatedUpdatedBy, Sortable;

    protected $table = 'sales';

    protected $fillable = [
      'value',
      'status',
      'id_client',
      'details',
      'created_by',
      'updated_by',
  ];

  protected $sortable = [
    'id',
    'id_client',
    'status',
    'created_at',
  ];

  // Relacionamento com Financeiro
  public function finance()
  {
      return $this->hasOne(Finances::class, 'id_selling');
  }

  public function partner()
  {
    return $this->belongsTo(Partners::class, 'id_client');
  }

  // Relacionamento com ItensVenda
  public function saleItems()
  {
      return $this->hasMany(SaleItems::class, 'id_sale');
  }
}

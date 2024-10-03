<?php

namespace App\Models;

use App\Traits\CreatedUpdatedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Finances extends Model
{
    use HasFactory, CreatedUpdatedBy, Sortable;

    protected $table = 'finances';

    protected $fillable = [
      'type',
      'info',
      'entry_value',
      'id_seller',
      'id_selling',
      'id_purchase',
      'created_by',
      'updated_by',
    ];

    protected $sortable = [
      'id',
      'type',
      'entry_value',
      'created_at',
    ];

  // Relacionamento com Venda
  public function sales()
  {
      return $this->belongsTo(Sales::class, 'id_selling');
  }

  // Relacionamento com Compra
  public function purchases()
  {
   return $this->belongsTo(Purchases::class, 'id_purchase');
  }
}

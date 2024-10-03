<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedUpdatedBy;
use Kyslik\ColumnSortable\Sortable;

class Purchases extends Model
{
  use HasFactory, CreatedUpdatedBy, Sortable;

  protected $table = 'purchases';

  protected $fillable = [
    'id_supplier',
    'purchase_value',
    'invoice_ref',
  ];

  protected $sortable = [
    'id',
    'id_supplier',
    'purchase_value',
    'invoice_ref',
    'created_at',
  ];

  public function partner()
  {
    return $this->belongsTo(Partners::class, 'id_supplier');
  }

  public function purchaseItems()
  {
    return $this->hasMany(PurchaseItems::class, 'id_purchase');
  }
}

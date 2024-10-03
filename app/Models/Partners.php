<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedUpdatedBy;
use Kyslik\ColumnSortable\Sortable;

class Partners extends Model
{
    use HasFactory, CreatedUpdatedBy, Sortable;

    protected $table = 'partners';

    protected $fillable = [
      'name',
      'email',
      'telephone',
      'cgccpf',
      'opening_date',
      'birth_date',
      'address',
      'client_supplier',
    ];

    protected $sortable = [
      'id',
      'name',
      'email',
      'client_supplier',
      'created_at',
    ];
}

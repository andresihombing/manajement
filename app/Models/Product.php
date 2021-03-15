<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Model;
 
class Product extends Model
{
    protected $fillable = [
        'name', 'stok', 'capital_price', 'selling_price', 'merk', 'unit', 'quality'
    ];
}
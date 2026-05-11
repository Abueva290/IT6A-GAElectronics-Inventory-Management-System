<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StockIn extends Model
{
    use HasFactory;

    protected $table = 'stock_in';
    protected $fillable = [
        'supplier_id',
        'employee_id',
        'date_received',
        'delivery_receipt_no',
        'remarks'
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function stockInDetails()
    {
        return $this->hasMany(StockInDetail::class);
    }
}
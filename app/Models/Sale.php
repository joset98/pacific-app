<?php

namespace App\Models;

use App\Events\SaleSaved;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    
    public function machine()
    {
        return $this->belongsTo(Machine::class);
    }

    public function sellState()
    {
        return $this->belongsTo(SellState::class, 'state_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function documents()
    {
        return $this->hasMany(SaleDocument::class);
    }

    protected $with = ['client', 'machine', 'sellState', 'user', 'provider'];

    protected $fillable = [
        'price',
        'num_order',
        'machine_detail',
        'desc',
        'adition',
        'document',
        'user_id',
        'state_id',
        'machine_id',
        'provider_id',
        'client_id'
    ];

}

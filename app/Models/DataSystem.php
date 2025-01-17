<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSystem extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    public function client(){
        return $this->hasOne(Client::class, 'id', 'client_id');
    }
    
    public function tenant(){
        return $this->hasOne(Tenants::class, 'id', 'tenant_id');
    }
}

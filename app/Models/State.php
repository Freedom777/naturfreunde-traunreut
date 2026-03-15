<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $primaryKey = 'code';
    public $incrementing = false;
    public $timestamps = false;
    protected $keyType = 'string';

    protected $fillable = ['emoji', 'code', 'name'];

    public function cities()
    {
        return $this->hasMany(City::class, 'state_code', 'code');
    }
}

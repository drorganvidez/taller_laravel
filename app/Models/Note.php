<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $table = 'notes';

    protected $fillable = [
      'title',
      'body',
      'coordinator_id'
    ];

    public function coordinator()
    {
        return $this->belongsTo('App\Models\Coordinator');
    }

}

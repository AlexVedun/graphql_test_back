<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $guarded = ['id'];

    public function test()
    {
        return $this->belongsTo(Test::class, 'test_id', 'id');
    }

    public function answers()
    {
        return $this->hasMany(Answer::class);
    }
}

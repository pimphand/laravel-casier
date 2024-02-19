<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Sku extends Model
{
    use HasFactory, SoftDeletes, HasUuids;

    protected $guarded = ['id'];
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            $model->store_id = auth()->user()->store_id;
            $model->slug = Str::slug($model->name);
        });
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

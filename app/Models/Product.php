<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Product extends Model
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

    public function ScopeIsStore($query)
    {
        return $query->where('store_id', auth()->user()->store_id);
    }

    public function scopeWhereLike($query, $columns, $value)
    {
        return $query->where(function ($query) use ($columns, $value) {
            foreach ($columns as $column) {
                $query->orWhere($column, 'LIKE', '%' . $value . '%');
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function skus()
    {
        return $this->hasMany(Sku::class);
    }
}

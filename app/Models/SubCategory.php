<?php

namespace App\Modules\Lawyer\Models;

use App\Modules\Lawyer\Services\Config\Admin\SubCategoryConfig;
use App\Traits\QueryCacheable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SubCategory extends Model
{
    use QueryCacheable;

    protected $table = 'lawd_sub_categories';

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'description',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function getConfigClass(): string
    {
        return SubCategoryConfig::class;
    }
}

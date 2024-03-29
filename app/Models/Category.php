<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int    $id
 * @property string $name
 * @property string $image
 * @property string $created_at
 * @property string $updated_at
 */

class Category extends Model
{
    use HasFactory;
    public function Categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }
    public function ChildrenCategories()
    {
        return $this->hasMany(Category::class)->with('categories');
    }
}

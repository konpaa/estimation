<?php

namespace App\Models;

use App\Models\Concerns\UsesUuid;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Models\Product
 *
 * @property-read Price|null $price
 * @property-read User $user
 * @method static Builder|Product newModelQuery()
 * @method static Builder|Product newQuery()
 * @method static Builder|Product query()
 * @mixin Eloquent
 * @property string $id
 * @property string $user_id
 * @property string $name
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Product whereCreatedAt($value)
 * @method static Builder|Product whereDescription($value)
 * @method static Builder|Product whereId($value)
 * @method static Builder|Product whereName($value)
 * @method static Builder|Product whereUpdatedAt($value)
 * @method static Builder|Product whereUserId($value)
 */
class Product extends Model
{
    use UsesUuid;
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = ['name', 'description', 'user_id', 'price_currency', 'price'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getPriceAttribute()
    {
        return new Price($this->attributes['price'], $this->price_currency ?? 'USD');
    }
}

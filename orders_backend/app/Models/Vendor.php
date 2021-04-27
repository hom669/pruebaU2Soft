<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id_vendor
 * @property string $name_vendor
 * @property string $created_at
 * @property string $updated_at
 * @property Product[] $products
 */
class Vendor extends Model
{
    use HasFactory;
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_vendor';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['name_vendor', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Product', 'id_vendor', 'id_vendor');
    }
}

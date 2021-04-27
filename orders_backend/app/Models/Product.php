<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id_product
 * @property integer $id_vendor
 * @property string $name_product
 * @property string $description_product
 * @property string $codbar_product
 * @property string $created_at
 * @property string $updated_at
 * @property Vendor $vendor
 * @property Inventory[] $inventorys
 * @property OrdersProduct[] $ordersProducts
 */
class Product extends Model
{
    use HasFactory;
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_product';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['id_vendor', 'name_product', 'description_product', 'codbar_product', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vendor()
    {
        return $this->belongsTo('App\Vendor', 'id_vendor', 'id_vendor');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inventorys()
    {
        return $this->hasMany('App\Inventory', 'id_product', 'id_product');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ordersProducts()
    {
        return $this->hasMany('App\OrdersProduct', 'id_product', 'id_product');
    }
}

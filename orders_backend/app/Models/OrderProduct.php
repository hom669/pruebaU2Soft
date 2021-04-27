<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id_order_product
 * @property integer $id_order
 * @property integer $id_product
 * @property string $created_at
 * @property string $updated_at
 * @property Product $product
 * @property Order $order
 */
class OrderProduct extends Model
{
    use HasFactory;
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $table = 'orders_products';

    protected $primaryKey = 'id_order_product';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['id_order', 'id_product', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Product', 'id_product', 'id_product');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo('App\Order', 'id_order', 'id_order');
    }
}

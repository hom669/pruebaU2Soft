<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id_order
 * @property string $applicant
 * @property string $date_order
 * @property string $date_delivery
 * @property string $state
 * @property string $created_at
 * @property string $updated_at
 * @property OrdersProduct[] $ordersProducts
 */
class Order extends Model
{
    use HasFactory;
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'id_order';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['applicant', 'date_order', 'date_delivery', 'state', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function ordersProducts()
    {
        return $this->hasMany('App\OrdersProduct', 'id_order', 'id_order');
    }
}

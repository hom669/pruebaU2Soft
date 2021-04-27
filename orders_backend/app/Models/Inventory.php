<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id_inventary
 * @property integer $id_product
 * @property int $quantity
 * @property string $created_at
 * @property string $updated_at
 * @property Product $product
 */
class Inventory extends Model
{
    use HasFactory;
    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $table = 'inventorys';
    protected $primaryKey = 'id_inventary';

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'integer';

    /**
     * @var array
     */
    protected $fillable = ['id_product', 'quantity', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Product', 'id_product', 'id_product');
    }
}

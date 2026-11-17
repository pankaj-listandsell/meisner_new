<?php
namespace Modules\BookingProduct\Models;

use App;
use App\BaseModel;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;


class BookingProduct extends BaseModel
{
    use SoftDeletes;
    protected $table = 'core_booking_products';

    protected $fillable = [
        'booking_id',
        'address',
        'building',
        'flour',
        'city',
        'zipcode',
        'full_name',
        'email',
        'date',
        'time',
        'note',
        'total_pieces',
        'net_amount',
        'vat',
        'additional_cost',
        'grand_amount',
        'status',
        'create_user',
        'created_at',
        'updated_at',
    ];

    /**
     * Was the stored net amount raised to the minimum net price?
     *
     * Every request costs at least min_net_price() net, so for a small order the net amount is
     * the minimum rather than the sum of the lines. Where that happened the single item prices
     * do not add up to the total, so the views leave them out instead of printing figures that
     * contradict it.
     *
     * Derived from the stored figures rather than from the current setting, so an old booking
     * is still read correctly after the minimum is changed. Pass the detail rows when they are
     * already loaded; otherwise they are fetched.
     *
     * @param  iterable|null  $detail
     * @return bool
     */
    public function minimumApplied($detail = null)
    {
        if ($detail === null) {
            $detail = BookingProductDetail::where('core_booking_product_id', $this->id)->get();
        }

        $items_net_sum = 0;
        foreach ($detail as $item) {
            $items_net_sum += $item->total_price;
        }

        // Tolerance of a cent: the lines are stored rounded.
        return $items_net_sum < (float) $this->net_amount - 0.01;
    }
}

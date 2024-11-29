<?php
namespace Modules\RequestQuote\Models;

use App;
use App\BaseModel;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;


class RequestQuote extends BaseModel
{
    use SoftDeletes;
    protected $table = 'bravo_request_quote';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'service',

    ];

}

<?php
namespace Modules\Contact\Models;

use App;
use App\BaseModel;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;


class Contact extends BaseModel
{
    use SoftDeletes;
    protected $table = 'bravo_contact';
    protected $fillable = [
        'first_name',
        'email',
        'phone',
        'message',
        'status'
    ];

    /**
     * Get the user's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

//    protected $cleanFields = ['message'];
}

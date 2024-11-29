<?php
namespace Modules\Form\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Form extends Model
{
    //use SoftDeletes;

    protected $table = 'core_forms';

    protected $fillable = [
        'type',
        'lang',
        'read',
    ];


    /**
     * Relation with Form Entries
     *
     * @return HasMany
     */
    public function entries(): HasMany
    {
        return $this->hasMany(FormEntry::class, 'form_id');
    }


}

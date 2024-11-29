<?php
namespace Modules\Form\Models;


use Iksaku\Laravel\MassUpdate\MassUpdatable;
use Illuminate\Database\Eloquent\Model;


class FormEntry extends Model
{
    use MassUpdatable;


    protected $table = 'core_form_entries';

    protected $fillable = [
        'form_id',
        'group',
        'type',
        'label',
        'key',
        'value',
    ];

    public $timestamps = false;

}

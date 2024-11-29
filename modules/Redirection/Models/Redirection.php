<?php

namespace Modules\Redirection\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class Redirection extends Model
{
    protected $table = 'core_redirections';

    protected $fillable = [
        'from_url',
        'to_url',
        'lang',
        'status',
    ];

    public $timestamps = true;


    public static function getModelName()
    {
        return __("core_");
    }

    public static function getAll(){
        return Cache::rememberForever('bc_redirection', function (){
            return parent::query()->where('status','publish')->orderByDesc('id')->get();
        });
    }

    public static function reset(){
        Cache::forget('bc_redirection');
        return self::getAll();
    }
}

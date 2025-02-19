<?php


namespace Modules\User\Models;



use App\BaseModel;
use Illuminate\Support\Facades\Cache;
use Modules\User\Helpers\PermissionHelper;

class Role extends BaseModel
{

    protected $table = 'core_roles';

    protected $fillable = [
        'code',
        'name'
    ];

    /**
     * Check Role has Permission
     *
     * @param $permission
     * @return int
     */
    public function hasPermission($permission){

        $value = Cache::rememberForever('role_'.$this->id.'_' . $permission, function () use ($permission) {
            return RolePermission::query()->where([
                'role_id'=>$this->id,
                'permission'=>$permission
            ])->count(['id']);
        });
        return $value;
    }


    public function getDisplayName()
    {
        return $this->name;
    }


    /**
     * Find Role by code or id
     * @param $role_id
     * @return self
     */
    public static function find($role_id){
        if(is_integer($role_id)){
            return parent::query()->where('id',$role_id)->first();
        }
        if(is_string($role_id)){
            return parent::query()->where('code',$role_id)->first();
        }
    }

    /**
     * Give permissions to Role
     *
     * @param string|array $permissions
     */
    public function givePermission($permissions = []){
        if(is_string($permissions)) $permissions = [$permissions];

        foreach ($permissions as $item){
            RolePermission::firstOrCreate([
                'role_id'=>$this->id,
                'permission'=>$item
            ]);
        }
    }

    public function syncPermissions($permissions = []){
        if(is_string($permissions)) $permissions = [$permissions];

        $ids = [];
        foreach ($permissions as $item){
            $rp = RolePermission::firstOrCreate([
                'role_id'=>$this->id,
                'permission'=>$item
            ]);

            $ids[] = $rp->id;
        }

        RolePermission::query()->where('role_id',$this->id)->whereNotIn('id',$ids)->delete();

        $this->clearCachePermissions();
    }

    public function clearCachePermissions(){
        foreach (PermissionHelper::all() as $p){
            Cache::forget('role_'.$this->id.'_'.$p);
        }
    }

    public function permissions(){
        return $this->hasMany(RolePermission::class,'role_id');
    }

    public function plans(){
        return $this->hasMany(Plan::class,'role_id');
    }
}

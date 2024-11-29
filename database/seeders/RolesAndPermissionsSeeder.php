<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET FOREIGN_KEY_CHECKS=0;");

        Permission::truncate();

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Dashboard
        Permission::findOrCreate('dashboard_access');

        // Page
        Permission::findOrCreate('page_view');
        Permission::findOrCreate('page_create');
        Permission::findOrCreate('page_update');
        Permission::findOrCreate('page_delete');
        Permission::findOrCreate('page_manage_others');

        // Form
        Permission::findOrCreate('form_view');
        Permission::findOrCreate('form_create');
        Permission::findOrCreate('form_update');
        Permission::findOrCreate('form_delete');

        // Language
        Permission::findOrCreate('language_manage');
        Permission::findOrCreate('language_translation');

        // Templates
        Permission::findOrCreate('template_view');
        Permission::findOrCreate('template_create');
        Permission::findOrCreate('template_update');
        Permission::findOrCreate('template_delete');

        // News
        Permission::findOrCreate('news_view');
        Permission::findOrCreate('news_create');
        Permission::findOrCreate('news_update');
        Permission::findOrCreate('news_delete');
        Permission::findOrCreate('news_manage_others');

        // Roles
        Permission::findOrCreate('role_view');
        Permission::findOrCreate('role_create');
        Permission::findOrCreate('role_update');
        Permission::findOrCreate('role_delete');

        // Permissions
        Permission::findOrCreate('permission_view');
        Permission::findOrCreate('permission_create');
        Permission::findOrCreate('permission_update');
        Permission::findOrCreate('permission_delete');

        // Settings
        Permission::findOrCreate('setting_view');
        Permission::findOrCreate('setting_update');

        // Menus
        Permission::findOrCreate('menu_view');
        Permission::findOrCreate('menu_create');
        Permission::findOrCreate('menu_update');
        Permission::findOrCreate('menu_delete');

        // User
        Permission::findOrCreate('user_view');
        Permission::findOrCreate('user_create');
        Permission::findOrCreate('user_update');
        Permission::findOrCreate('user_delete');

        // Contact Submissions
        Permission::findOrCreate('contact_manage');

        // Media
        Permission::findOrCreate('media_upload');
        Permission::findOrCreate('media_manage');


        // Other System Permissions
        Permission::findOrCreate('system_log_view');

        // Gallery
        Permission::findOrCreate('gallery_view');
        Permission::findOrCreate('gallery_create');
        Permission::findOrCreate('gallery_update');


        // Plugin
        Permission::findOrCreate('plugin_manage');

        // Redirection
        Permission::findOrCreate('redirection_view');
        Permission::findOrCreate('redirection_create');
        Permission::findOrCreate('redirection_update');
        Permission::findOrCreate('redirection_delete');

        // this can be done as separate statements
        $customer = Role::findOrCreate('customer');

        $role = Role::findOrCreate('administrator');

        $role->givePermissionTo(Permission::all());

        DB::statement("SET FOREIGN_KEY_CHECKS=1;");
    }

}

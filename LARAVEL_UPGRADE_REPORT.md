# Laravel 8 → 12 Upgrade Report

**Date:** 2026-05-07
**Branch:** `upgrade/laravel-12`
**Performed By:** Pankaj (with Claude Code)

---

## 1. Summary

Successfully upgraded the project from **Laravel 8.68.1 → Laravel 12.58.0** through incremental version bumps (8 → 9 → 10 → 11 → 12). All major breaking changes addressed, dependencies updated, and runtime issues fixed.

### Final Versions
| Component | Before | After |
|---|---|---|
| Laravel Framework | 8.68.1 | **12.58.0** |
| PHP | 8.2.12 | 8.2.12 (unchanged) |
| Symfony | v5 | **v7** |
| Carbon | v2 | **v3** |
| Sanctum | v2 | **v4** |
| Spatie Permission | v3 | **v6** |
| Intervention Image | v2 | **v3** |
| Mews Captcha | v3.3 | **v3.4** |
| PHPUnit | v9 | **v10** |
| Security Vulnerabilities | 5 | **0** |

---

## 2. Step-by-Step Upgrade Path

### Step 1: Laravel 8 → 9
- Updated `composer.json` framework constraints
- Removed dead packages: `fzaninotto/faker`, `facade/ignition`
- Added: `spatie/laravel-ignition`
- Symfony v5 → v6
- Flysystem 1 → 3
- Swiftmailer → Symfony Mailer

### Step 2: Laravel 9 → 10
- PHP requirement: ^8.0 → ^8.1
- `spatie/laravel-permission` v3 → v5
- PHPUnit 9 → 10 (later)

### Step 3: Laravel 10 → 11
- PHP requirement: ^8.1 → ^8.2
- Carbon 2 → 3 (no breaking calls in code)
- Symfony v6 → v7
- `spatie/laravel-permission` v5 → v6 (namespace changed: `Middlewares\` → `Middleware\`)
- `laravel/sanctum` v3 → v4

### Step 4: Laravel 11 → 12
- `mews/captcha` v3.3 → v3.4 (required intervention/image v3)
- Intervention Image v2 → v3 (API rewrite)
- Added `intervention/image-laravel` adapter

---

## 3. Files Modified

### 3.1 `composer.json`
**Reason:** Version bumps for Laravel 8 → 12 chain

Key changes:
- `php`: `^7.3|^8.1` → `^8.2`
- `laravel/framework`: `8.68.*` → `^12.30`
- `laravel/sanctum`: `^2.11` → `^4.0`
- `laravel/fortify`: `^1.10` → `^1.25`
- `laravel/ui`: `^3.0` → `^4.6`
- `intervention/image`: `^2.4` → `^3.7`
- **Added** `intervention/image-laravel`: `^1.3`
- `spatie/laravel-permission`: `^3.16` → `^6.10`
- `mews/purifier`: `^3.3` → `^3.4`
- `nunomaduro/collision`: `^5.0` → `^8.6`
- `phpunit/phpunit`: `^9.0` → `^11.5`
- **Removed** `fzaninotto/faker` (dead, replaced by framework's `fakerphp/faker`)
- **Removed** `facade/ignition` → **Added** `spatie/laravel-ignition`: `^2.9`

---

### 3.2 `app/Helpers/AppHelper.php`

**Change 1: PHP 8.2 deprecation fix (line 1299, 1301)**
```php
// BEFORE
$pretty_offset = "UTC${offset_prefix}${offset_formatted}";
$timezone_list[$timezone] = "$timezone (${pretty_offset})";

// AFTER
$pretty_offset = "UTC{$offset_prefix}{$offset_formatted}";
$timezone_list[$timezone] = "$timezone ({$pretty_offset})";
```
**Reason:** PHP 8.2 deprecated `${var}` interpolation syntax.

**Change 2: Intervention Image v3 migration (line 5, 2114-2120)**
```php
// BEFORE
use Intervention\Image\ImageManagerStatic as Image;
$thumbImage = Image::make($filePath);
$thumbImage->resize($w, $h, function ($constraint) {
    $constraint->aspectRatio();
    $constraint->upsize();
})->save($path);

// AFTER
use Intervention\Image\Laravel\Facades\Image;
Image::read($filePath)
    ->scaleDown($w, $h)
    ->save($path);
```
**Reason:** Intervention v3 removed `ImageManagerStatic`; now uses facade and method-based scaling.

---

### 3.3 `app/Http/Kernel.php`

**Spatie Permission v6 namespace fix (lines 81-83)**
```php
// BEFORE
'role' => \Spatie\Permission\Middlewares\RoleMiddleware::class,
'permission' => \Spatie\Permission\Middlewares\PermissionMiddleware::class,
'role_or_permission' => \Spatie\Permission\Middlewares\RoleOrPermissionMiddleware::class,

// AFTER
'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
```
**Reason:** Spatie Permission v6 changed namespace `Middlewares\` (plural) → `Middleware\` (singular).

---

### 3.4 `config/app.php`

**Intervention v3 service provider (line 183)**
```php
// BEFORE
Intervention\Image\ImageServiceProvider::class,

// AFTER
Intervention\Image\Laravel\ServiceProvider::class,
```
**Reason:** Intervention Image v3 ships Laravel adapter as separate package with new SP class.

---

### 3.5 `config/filesystems.php`

**Fix: Misplaced `links` array (was inside `disks`)**
```php
// BEFORE — 'links' inside 'disks' array
'disks' => [
    ...
    'links' => [
        public_path('storage') => storage_path('app/public'),
    ],
],

// AFTER — 'links' at top level
'disks' => [
    ...
],
'links' => [
    public_path('storage') => storage_path('app/public'),
],
```
**Reason:** L11 introduced strict disk validation. The `links` key was misplaced inside `disks` array, causing "Undefined array key 'driver'" error during boot.

---

### 3.6 `database/factories/UserFactory.php`

**Converted from L7-style to class-based factory**
```php
// BEFORE
$factory->define(User::class, function (Faker $faker) {
    return [...];
});

// AFTER
namespace Database\Factories;

class UserFactory extends Factory
{
    protected $model = User::class;
    public function definition(): array { return [...]; }
}
```
**Reason:** L8+ requires class-based factories. Old `$factory->define()` syntax removed in L9.

---

### 3.7 `app/Console/Commands/LocaleExportToFormat.php`

**Flysystem v1 → v3 namespace migration**
```php
// BEFORE
use League\Flysystem\Adapter\Local;
$adapter = new Local($path);
$filesystem->has($filename);

// AFTER
use League\Flysystem\Local\LocalFilesystemAdapter;
$adapter = new LocalFilesystemAdapter($path);
$filesystem->fileExists($filename);
```
**Reason:** Flysystem 3 (used by L9+) reorganized namespaces and renamed `has()` to `fileExists()`.

---

### 3.8 `modules/Media/Helpers/FileHelper.php`

**Intervention Image v3 migration**
```php
// BEFORE
use Intervention\Image\ImageManagerStatic as Image;
$img = Image::make($image_path)->resize($w, null, function ($c) {
    $c->aspectRatio();
})->save($path);

// AFTER
use Intervention\Image\Laravel\Facades\Image;
$img = Image::read($image_path)
    ->scale(width: $w)
    ->save($path);
```

---

### 3.9 `modules/Media/Admin/MediaController.php`

**Removed unused import (line 15)**
```php
// REMOVED
use Intervention\Image\ImageManagerStatic as Image;
```
**Reason:** Import was never used in the file.

---

### 3.10 `modules/Products/Admin/TagController.php`

**Pre-existing namespace bug fix (line 2)**
```php
// BEFORE — wrong namespace at this path
namespace Modules\News\Admin;

// AFTER — matches its file location
namespace Modules\Products\Admin;
```
**Reason:** Pre-existing bug since first commit — file was at `modules/Products/Admin/` but declared `Modules\News\Admin` namespace, causing class name conflict with `modules/News/Admin/TagController.php`. L9's stricter autoload exposed this latent bug.

---

### 3.11 `modules/BookingProduct/Routes/admin.php`

**Renamed 3 routes to match module (lines 8-11)**
```php
// BEFORE — duplicate names with Booking module
Route::post('/modal-detail-ajax','BookingController@modalDetailAjax')->name('booking.admin.modal_detail');
Route::post('/bulkEdit','BookingController@bulkEdit')->name('booking.admin.bulkEdit');
Route::get('getForSelect2','BookingController@getForSelect2')->name('booking.admin.getForSelect2');

// AFTER — unique to this module
Route::post('/modal-detail-ajax','BookingController@modalDetailAjax')->name('booking_products.admin.modal_detail');
Route::post('/bulkEdit','BookingController@bulkEdit')->name('booking_products.admin.bulkEdit');
Route::get('getForSelect2','BookingController@getForSelect2')->name('booking_products.admin.getForSelect2');
```
**Reason:** Pre-existing bug — both `Booking` and `BookingProduct` modules registered routes with same names, causing `route:cache` to fail with `LogicException`. Renamed BookingProduct's routes to use `booking_products.*` prefix matching its other route names.

---

### 3.12 `modules/BookingProduct/Views/admin/index.blade.php`

**Updated route reference (line 12)**
```blade
<!-- BEFORE -->
{{route('booking.admin.bulkEdit')}}

<!-- AFTER -->
{{route('booking_products.admin.bulkEdit')}}
```
**Reason:** Updated to match renamed route in 3.11.

---

### 3.13 `modules/Page/Routes/web.php`

**Made route names unique per language (line 26-30)**
```php
// BEFORE — duplicate name on every iteration
foreach (get_language_codes() as $languageCode) {
    Route::group(['prefix'=> $languageCode], function() {
        Route::get('{slug?}/{branch?}','PageController@detail')->name('page.lang.detail');
    });
}

// AFTER — unique name per language
foreach (get_language_codes() as $languageCode) {
    Route::group(['prefix'=> $languageCode], function() use ($languageCode) {
        Route::get('{slug?}/{branch?}','PageController@detail')->name("page.lang.{$languageCode}.detail");
    });
}
```
**Reason:** Pre-existing bug — `foreach` loop registered same route name `page.lang.detail` for every language, breaking `route:cache`. Now unique per language: `page.lang.de.detail`, `page.lang.en.detail`, etc.

---

### 3.14 `modules/Layout/app.blade.php`

**Change 1: JSON-LD `@verbatim` wrap (line 158)**
```blade
<!-- BEFORE -->
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  ...
}
</script>

<!-- AFTER -->
<script type="application/ld+json">
@verbatim
{
  "@context": "https://schema.org",
  ...
}
@endverbatim
</script>
```
**Reason:** L11 introduced new `@context` Blade directive (Context API). The literal `"@context"` in JSON-LD was being compiled as a Blade directive, breaking the page with `ParseError: syntax error, unexpected token "}"`. Wrapping in `@verbatim` prevents Blade interpretation.

**Change 2: jQuery moved to `<head>` (line 49)**
```blade
<!-- BEFORE — jQuery in footer -->
@include('Layout::parts.footer')
<script src="{{ asset('assests/js/jquery.min.js') }}"></script>

<!-- AFTER — jQuery in <head> -->
<head>
    ...
    <script src="{{ asset('assests/js/jquery.min.js') }}"></script>
</head>
...
@include('Layout::parts.footer')
<!-- jquery.min.js removed from here -->
```
**Reason:** Inline scripts in `<x-popup-contact-form>` (rendered in body) used `jQuery(...)` before jQuery loaded in footer, causing `Uncaught ReferenceError: jQuery is not defined`. Moving jQuery to head ensures availability for all subsequent scripts.

---

### 3.15 `public/assests/js/script.js`

**Change 1: Null guards added (lines 587, 599, 616)**
```js
// BEFORE — crashed when elements not found
let menu = document.querySelector('.mobile-menu');
menu.addEventListener('click', openMenu);

let service = document.querySelector('.service-list');
service.addEventListener('click', openServiceMenu);

var modal = document.getElementById("Gutenmodalpopup");
window.onclick = function(event) { ... };

// AFTER — safe with null checks
let menu = document.querySelector('.mobile-menu');
if (menu) menu.addEventListener('click', openMenu);

let service = document.querySelector('.service-list');
if (service) service.addEventListener('click', openServiceMenu);

var modal = document.getElementById("Gutenmodalpopup");
if (modal) {
    window.onclick = function(event) { ... };
}
```
**Reason:** `.mobile-menu`, `.service-list`, `#Gutenmodalpopup` elements don't exist on home page. Without null checks, script crashed with `TypeError: Cannot read properties of null`.

**Change 2: Captcha button warnings silenced (line 9-14)**
```js
// BEFORE
if (button) {
    button.click();
    console.log(`Clicked button with class .${className}`);
} else {
    console.warn(`Button with class .${className} not found`);
}

// AFTER
if (button) {
    button.click();
}
```
**Reason:** Removed verbose console warnings for non-critical missing captcha buttons.

---

## 4. Issues Encountered & Resolved

| # | Issue | Resolution |
|---|---|---|
| 1 | Composer dependency conflicts | Incremental upgrade (one major version at a time) |
| 2 | `fzaninotto/faker` abandoned | Removed (replaced by framework's `fakerphp/faker`) |
| 3 | `facade/ignition` abandoned | Replaced with `spatie/laravel-ignition` |
| 4 | PHP 8.2 deprecation `${var}` | Changed to `{$var}` |
| 5 | Spatie Permission v6 namespace change | `Middlewares\` → `Middleware\` |
| 6 | Pre-existing duplicate class `Modules\News\Admin\TagController` | Fixed namespace in `Products/Admin/TagController.php` |
| 7 | L11 strict filesystem config validation | Moved `links` out of `disks` array |
| 8 | Initial L12 install at v12.0.0 had `package:discover` bug | Forced `^12.30` for newer patches |
| 9 | `mews/captcha` v3.4 needs `intervention/image` v3 | Migrated all `Image::make()` → `Image::read()` calls |
| 10 | `route:cache` failed (duplicate route names) | Fixed `BookingProduct` routes + `Page` foreach loop |
| 11 | L11 added `@context` Blade directive, broke JSON-LD | Wrapped in `@verbatim` |
| 12 | jQuery loaded after inline jQuery scripts | Moved jQuery to `<head>` |
| 13 | `script.js` crashed on missing DOM elements | Added null guards |

---

## 5. Verification Tests Passed

- ✅ `php artisan --version` → Laravel Framework 12.58.0
- ✅ `php artisan list` → all commands available
- ✅ `php artisan route:list` → 375 routes load successfully
- ✅ `php artisan route:cache` → Routes cached successfully
- ✅ `php artisan config:cache` → all config files compile
- ✅ `php artisan view:cache` → all blade templates compile
- ✅ `php artisan event:cache` → events cached
- ✅ `php artisan optimize` → full optimization succeeds
- ✅ `composer audit` → 0 security vulnerabilities
- ✅ Home page loads HTTP 200 in browser
- ✅ JSON-LD properly rendered (literal `@context` preserved)
- ✅ JS console clean of errors

---

## 6. Pending / Recommended Future Work

### 6.1 Abandoned Packages (Not Critical)
- `rachidlaasri/laravel-installer` — abandoned, no L12-specific replacement; review installer flow
- `shinsenter/defer-laravel` + `shinsenter/defer.php` — abandoned; consider removing or replacing

### 6.2 Code Quality Improvements
- Migrate to L11/L12 modern skeleton (`bootstrap/app.php` central config) — currently using legacy `Kernel.php` files (works fine, just older pattern)
- Refactor inline scripts in `popup_contact_form.blade.php` to use `@push('js')` properly so they render after jQuery
- Clean up `modules/PageOld/`, `modules/TemplateOld/`, `modules/BookingProduct/` orphan files (PSR-4 violations) and `public/module/` duplicates

### 6.3 Manual Browser Testing Required
- Login flow
- Admin dashboard
- Image upload (test new Intervention v3)
- Captcha (test new mews/captcha v3.4)
- Booking/payment flow
- Module pages (Products, News, etc.)

---

## 7. Files Summary

| # | File | Type of Change |
|---|---|---|
| 1 | `composer.json` | Version bumps L8→L12 |
| 2 | `app/Helpers/AppHelper.php` | PHP 8.2 fix + Intervention v3 |
| 3 | `app/Http/Kernel.php` | Spatie v6 namespace |
| 4 | `config/app.php` | Intervention v3 service provider |
| 5 | `config/filesystems.php` | Moved `links` outside `disks` |
| 6 | `database/factories/UserFactory.php` | L7→L8 class-based factory |
| 7 | `app/Console/Commands/LocaleExportToFormat.php` | Flysystem v1→v3 |
| 8 | `modules/Media/Helpers/FileHelper.php` | Intervention v3 |
| 9 | `modules/Media/Admin/MediaController.php` | Removed unused import |
| 10 | `modules/Products/Admin/TagController.php` | Namespace bug fix |
| 11 | `modules/BookingProduct/Routes/admin.php` | Duplicate route names |
| 12 | `modules/BookingProduct/Views/admin/index.blade.php` | Route reference update |
| 13 | `modules/Page/Routes/web.php` | Per-language unique route names |
| 14 | `modules/Layout/app.blade.php` | `@verbatim` for JSON-LD + jQuery to head |
| 15 | `public/assests/js/script.js` | Null guards + warning cleanup |

**Total: 15 project files modified**
**Plus regenerated: `composer.lock` (auto, gitignored), `vendor/` (auto)**

---

## 8. Git Branch Information

- **Working Branch:** `upgrade/laravel-12`
- **Source Branch:** `pankaj`
- **Status:** Ready for commit / review / merge

---

## END OF REPORT

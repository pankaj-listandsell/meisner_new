<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

/**
 * Recompresses heavy above-the-fold images in place (with a one-time .bak backup).
 *
 * uploads/ is gitignored, so image files never travel with a code deploy. Running this
 * on a server recompresses that server's own originals — no manual upload required.
 * Re-encoded files are only kept when they come out smaller, so the command is idempotent.
 *
 *   php artisan images:optimize-hero            # quality 80
 *   php artisan images:optimize-hero --quality=78
 *   php artisan images:optimize-hero --restore  # roll back from .bak
 */
class OptimizeHeroImages extends Command
{
    protected $signature = 'images:optimize-hero {--quality=80} {--restore}';

    protected $description = 'Recompress heavy hero/above-the-fold images in place (GD, WebP), keeping a .bak backup';

    /** Paths relative to public/uploads/ */
    protected array $targets = [
        '0000/1/2024/09/11/berlin-gate.webp',            // mobile/tablet hero background (LCP)
        '0000/1/2024/08/26/brandenburg-berlingate.webp', // desktop hero background (LCP)
        '0000/14/2025/10/28/meissner-nach-img-nw.webp',  // before/after section
        '0000/14/2025/10/28/meissner-vorher-bild-nw.webp',
        '0000/1/2024/09/14/proven-expert.webp',          // review badge
    ];

    public function handle()
    {
        if (!function_exists('imagecreatefromwebp')) {
            $this->error('GD WebP support is not available on this server.');
            return self::FAILURE;
        }

        $restore = (bool) $this->option('restore');
        $quality = max(1, min(100, (int) $this->option('quality')));

        foreach ($this->targets as $rel) {
            $path = public_path('uploads/' . $rel);
            $bak  = $path . '.bak';
            $name = basename($rel);

            if ($restore) {
                if (is_file($bak)) {
                    copy($bak, $path);
                    $this->info(sprintf('%-32s restored from .bak', $name));
                } else {
                    $this->line(sprintf('%-32s no .bak to restore', $name));
                }
                continue;
            }

            if (!is_file($path)) {
                $this->warn(sprintf('%-32s missing, skipped', $name));
                continue;
            }

            $before = filesize($path);
            $img = @imagecreatefromwebp($path);
            if (!$img) {
                $this->warn(sprintf('%-32s could not be read, skipped', $name));
                continue;
            }
            imagepalettetotruecolor($img);
            imagealphablending($img, true);
            imagesavealpha($img, true);

            $tmp = $path . '.tmp';
            imagewebp($img, $tmp, $quality);
            imagedestroy($img);
            $after = is_file($tmp) ? filesize($tmp) : 0;

            if ($after > 0 && $after < $before) {
                if (!is_file($bak)) {
                    copy($path, $bak); // one-time backup of the original
                }
                rename($tmp, $path);
                $this->info(sprintf(
                    '%-32s %6.1f KiB -> %6.1f KiB  (-%d%%)',
                    $name, $before / 1024, $after / 1024, round(100 * ($before - $after) / $before)
                ));
            } else {
                @unlink($tmp);
                $this->line(sprintf('%-32s %6.1f KiB  kept (re-encode not smaller)', $name, $before / 1024));
            }
        }

        $this->newLine();
        $this->info($restore ? 'Restore complete.' : 'Optimization complete. Re-run with --restore to roll back.');
        return self::SUCCESS;
    }
}

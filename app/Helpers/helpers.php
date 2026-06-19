<?php

use App\Services\Core\FileUploadService;
use Carbon\Carbon;

function lawyer_storage_path($path = ''): string
{
    $path = ltrim($path, '\/\\');
    $filePath = config("filesystems.disks.lawyer_local.root");
    return $filePath . ($path ? DIRECTORY_SEPARATOR . $path : '');
}

function lawyer_asset($path = ''): string
{
    $path = ltrim($path, '/');

    return Storage::disk('lawyer_local')->url($path ?: '');
}


if (!function_exists('lawyer_upload_file')) {
    function lawyer_upload_file($file, $path, $fileName = null, $prefix = '', $suffix = '') {
        $service = app(FileUploadService::class);

        $disk = config('lawyer.config.default_disk', 'public');

        return $service->upload($file, $path, $fileName ??  Str::random(), $prefix, $suffix, disk: $disk);
    }
}


if (!function_exists('get_avatar')) {
    function get_avatar($avatar = null)
    {
        if (empty($avatar)) {
            return lawyer_asset('assets/images/default-avatar.png');
        }

        if (filter_var($avatar, FILTER_VALIDATE_URL)) {
            return $avatar;
        }

        return lawyer_asset($avatar);
    }
}

if (!function_exists('lawyer_date_format')) {
    function lawyer_date_format($date, $incTime = false, $format = null) {
        $format ??= $incTime
            ? config('lawyer.config.default_datetime_format', 'd M Y H:i')
            : config('lawyer.config.default_date_format', 'd M Y');

        return !empty($date) ? Carbon::parse($date)->format($format) : '-';
    }
}

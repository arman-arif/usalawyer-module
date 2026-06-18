<?php

namespace App\Modules\Lawyer\Database\Seeders;

use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Modules\Lawyer\Models\Location;

class LocationsTableSeeder extends Seeder
{
    /**
     * @throws FileNotFoundException
     */
    public function run(): void
    {
        $path = __DIR__ . '/data/us-states.json';

        if (!File::exists($path)) {
            return;
        }

        $states = json_decode(File::get($path), true);

        if (!is_array($states)) {
            return;
        }

        $records = [];
        foreach ($states as $state) {
            $name = $state['name'] ?? null;
            $code = $state['code'] ?? null;

            if (!$name) {
                continue;
            }

            $records[] = [
                'slug' => Str::slug($name),
                'name' => $name,
                'short_code' => $code,
            ];
        }

        Location::upsert($records, ['short_code', 'slug']);
    }
}

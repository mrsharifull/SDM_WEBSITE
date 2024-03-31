<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;
use League\Csv\Reader;

class PermissionSeeder extends Seeder
{

    public function run(): void
    {
        $csvFile = public_path('csv/permissions.csv');

        $csv = Reader::createFromPath($csvFile, 'r');
        $csv->setHeaderOffset(0);

        foreach ($csv as $record) {
            Permission::create($record);
        }
    }
}

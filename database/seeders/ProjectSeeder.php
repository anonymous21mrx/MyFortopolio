<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Projects;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'title' => 'Sistem ERP',
                'description' => 'Sistem ERP (Enterprise Resource Planning) Perusahaan Manufaktur',
                'teknologi' => 'PHP, Laravel, MySQL',
                'image' => 'erp.png',
                'status' => 'active', // Sesuai migration
            ],
            [
                'title' => 'Sistem HRIS',
                'description' => 'Sistem HRIS (Human Resource Information System) Perusahaan Manufaktur',
                'teknologi' => 'PHP, Laravel, MySQL',
                'image' => 'hris.png',
                'status' => 'active', // Ubah dari in_progress ke active
            ],
            [
                'title' => 'Sistem SCM',
                'description' => 'Sistem SCM (Supply Chain Management) Perusahaan Manufaktur',
                'teknologi' => 'PHP, Laravel, MySQL',
                'image' => 'scm.png',
                'status' => 'active', // Ubah dari in_progress ke active
            ],
            [
                'title' => 'Sistem WMS',
                'description' => 'Sistem WMS (Warehouse Management System) Perusahaan Manufaktur',
                'teknologi' => 'PHP, Laravel, MySQL',
                'image' => 'wms.png',
                'status' => 'archived', // Ubah dari completed ke archived
            ],
        ];

        foreach ($data as $item) {
            Projects::create($item);
        }
    }
}
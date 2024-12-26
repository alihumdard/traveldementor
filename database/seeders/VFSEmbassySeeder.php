<?php

namespace Database\Seeders;

use App\Models\VfsEmbassy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VFSEmbassySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    protected $vfsembesies;

    public function __construct()
    {
        $this->vfsembesies = config('constants.VFSEMBASSY');
    }
    public function run(): void
    {
        VfsEmbassy::truncate();

        foreach ($this->vfsembesies as $vfsembassy) {
            VfsEmbassy::create([
                'name' => $vfsembassy,
            ]);      
        }
    }
}

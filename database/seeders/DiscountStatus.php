<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ConStatus;
use App\Models\ConDiscount;

class DiscountStatus extends Seeder {
    /**
     * Run the database seeds.
     */
    public function run(): void {
        $status = [
            [
                "status_id" => "STS-01",
                "status_name" => "Activo",
                "status_description" => "Contratos que estan siendo utilizados",
            ],
            [
                "status_id" => "STS-02",
                "status_name" => "Inactivo",
                "status_description" => "Contratos que han sido finalizados",
            ],
        ];

        $discount = [
            [
                "discount_id" => "DIS-01",
                "discount_name" => "Tercera Edad",
                "discount_description" =>
                    "Aplica para personas mayores a 65 años ",
            ],
            [
                "discount_id" => "DIS-02",
                "discount_name" => "Discapacitados",
                "discount_description" =>
                    "Aplica para personas con discapacidad mayor a 20% ",
            ],
        ];

        ConStatus::insert($status);
        ConDiscount::insert($discount);
    }
}

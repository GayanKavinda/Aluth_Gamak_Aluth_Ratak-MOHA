<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Maatwebsite\Excel\Sheet;
use Maatwebsite\Excel\Writer;
use PhpOffice\PhpSpreadsheet\Worksheet\PageSetup;

//Developed by G.R Gayan Kavinda Gamlath 
//gayankavinda98v.lk@gmail.com
//2024 SLIIT Internship 
//Ministry of Home Affairs (MOHA)

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }   

    /**
     * Bootstrap any application services.
     */
    public function boot()
    {
        Sheet::macro('setOrientation', function (Sheet $sheet, string $orientation) {
            $sheet->getPageSetup()->setOrientation($orientation);
        });
    }
}

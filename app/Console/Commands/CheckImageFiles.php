<?php

namespace App\Console\Commands;

use App\Models\Staff\ImageOne;
use App\Models\Staff\ImageMany;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CheckImageFiles extends Command
{
    protected $signature = 'images:check';

    protected $description = 'Verifica la existencia de archivos de imágenes y elimina los registros correspondientes si no existen';

    public function handle()
    {
        // Buscar y eliminar registros en la tabla image_many
        $imageManyRecords = ImageMany::all();

        foreach ($imageManyRecords as $record) {
            $filePath = $record->image;

            if (File::exists($filePath)) {
                $this->info("El archivo existe: $filePath");
            } else {
                $this->info("El archivo no existe: $filePath. Eliminando el registro...");
                $record->delete();
            }
        }

        // Buscar y eliminar registros en la tabla image_ones
        $imageOnesRecords = ImageOne::all();

        foreach ($imageOnesRecords as $record) {
            $filePath = $record->image;

            if (File::exists($filePath)) {
                $this->info("El archivo existe: $filePath");
            } else {
                $this->info("El archivo no existe: $filePath. Eliminando el registro...");
                $record->delete();
            }
        }
    }
}

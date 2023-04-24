<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class CreateDirectoryAndFiles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'folder:make {dirname : Name of the directory} {--files= : Comma separated file names to be created inside the directory}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a directory and optionally create one or more files inside. (--files= : Comma separated file names to be created inside the directory)';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {   
        $dirname = $this->argument('dirname'); // Obtiene la ruta completa del directorio a crear dentro de la carpeta "app"
        $parts = explode('/', $dirname);
        $first = $parts[0];
        $rest = array_slice($parts, 1);

        $dirname = implode('/', [$first, ...array_map('ucfirst', $rest)]);

        $forNameSpace = ucwords($first);

        // Verificar si el directorio ya existe
        if (!file_exists($dirname)) { 
            mkdir($dirname, 0775, true); // Crear el directorio con permisos adecuados
            $this->info('Directory created successfully.'); // Mostrar mensaje de éxito
        } else {
            $this->info('Directory already exists. Files will be created inside it.'); // Mostrar mensaje de que la carpeta ya existe
        }

        if ($this->option('files')) { // Verificar si se especificaron archivos
            $filenames = explode(',', $this->option('files')); // Obtener los nombres de archivo separados por comas
            foreach ($filenames as $filename) { // Iterar sobre cada nombre de archivo
                $filename = Str::studly($filename);
                $filename = str_replace('.php', '', $filename) . '.php'; // Agregar la extensión .php si no está presente
                $filepath = $dirname . '/' . $filename; // Crear la ruta completa del archivo

                if (file_exists($filepath)) {
                    $this->info('File already exists: ' . $filepath);
                    continue;
                }
                //return $this->info($filepath);
                touch($filepath); // Crear el archivo vacío
                $namespace = str_replace('/', '\\', $dirname) . '\\' . str_replace('.php', '', $filename); // Crear el namespace
                //return $this->info($namespace);
                $content = "<?php\n\nnamespace " . ucfirst($namespace) . ";\n\n" . "class " . str_replace('.php', '', $filename) . " \n{\n\n}"; // Crear el contenido del archivo
                file_put_contents($filepath, $content); // Escribir el contenido en el archivo
                $this->info('File created successfully: ' . $filepath); // Mostrar mensaje de éxito
            }
        }

        exec('sudo chown -R $USER:www-data ' . $dirname); // Establecer los permisos adecuados para el usuario y el grupo
        exec('sudo find ' . $dirname . ' -type f -exec chmod 664 {} \;'); // Establecer los permisos adecuados para los archivos
        exec('sudo find ' . $dirname . ' -type d -exec chmod 775 {} \;'); // Establecer los permisos adecuados para los directorios
        $this->info('Directory and files permissions set successfully.'); // Mostrar mensaje de éxito
    }
}

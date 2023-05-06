<?php

namespace App\Http\Livewire\Sesion\Administrador;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Illuminate\Validation\ValidationException;
use League\Flysystem\GoogleCloudStorage\GoogleCloudStorageAdapter;
use League\Flysystem\Filesystem;
use Google\Cloud\Storage\StorageClient;

class AdministradorIngresarLivewire extends Component
{
    public $email;
    public $password;
    public $recordarme;

    protected $rules = [
        'email' => 'required',
        'password' => 'required',
    ];

    protected $validationAttributes = [
        'email' => 'email o usuario',
        'password' => 'contraseña',
    ];

    protected $messages = [
        'email.required' => 'El :attribute es requerido.',
        'password.required' => 'La :attribute es requerido.',
    ];

    public function mount()
    {
        /*$storageClient = new StorageClient([
            'projectId' => config('filesystems.disks.gcs.project_id'),
            'keyFilePath' => config('filesystems.disks.gcs.key_file'),
        ]);
        
        $bucket = $storageClient->bucket( config('filesystems.disks.gcs.bucket'));

        $adapter = new GoogleCloudStorageAdapter($bucket);
        
        $filesystem = new Filesystem($adapter);
        
        $filesystem->write('file.txt', 'Hello, World!');*/

        //Storage::disk('gcs')->write('nombre_archivo.txt', 'Este es el contenido del archivo.');
        //Storage::disk('gcs')->delete('file.txt');
        $url = "https://storage.cloud.google.com";
        dd($url . '/laravelcrd/file.txt');


        https://storage.cloud.google.com/laravelcrd/nombre_archivo.txt
    }

    public function ingresar()
    {
        $this->validate();

        $credentials = [
            'password' => $this->password,
        ];
        if (filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $credentials['email'] = $this->email;
        } else {
            $credentials['username'] = $this->email;
        }
        if (Auth::attempt($credentials, $this->recordarme)) {
            $usuario = Auth::user();

            if ($usuario->rol == "administrador") {
                return redirect()->route('administrador.encargado.index');
            } elseif ($usuario->rol == "encargado") {
                return redirect()->route('encargado.especialidad.sede.index');
            } elseif ($usuario->rol == "odontologo") {
                return redirect()->route('odontologo.paciente.odontologo.index');
            } elseif ($usuario->rol == "paciente") {
                return redirect()->route('encargado.odontologo.index');
            } else {
                return redirect()->route('inicio');
            }
        } else {
            $errors = ['email' => 'Email o usuario incorrecto.'];
            if (User::where('email', $this->email)->count() > 0) {
                $errors = ['password' => 'La contraseña es incorrecta.'];
            }
            throw ValidationException::withMessages($errors);
        }
    }

    public function render()
    {
        return view('livewire.sesion.administrador.administrador-ingresar-livewire')->layout('layouts.sesion.index');
    }
}

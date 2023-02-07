# Progetto Laravel con login

## Organizzare il progetto
1. Definire la struttura del database per bene (tabelle, campi, tipo di ciascun campo e limiti, relazioni tra tabelle)
1. Tutta la parte di codice è bene farla in inglese (nomi tabelle, nomi variabili e se possibile anche commenti)
1. Definire le sezioni del sito (le pagine) e la struttura degli indirizzi
## Inizializzazione
1. Creare la cartella del progetto
1. Entrare dal terminale nella cartella
1. ```composer create-project --prefer-dist laravel/laravel:^7.0 .```
1. Se volete usare la laravel-debugbar:
    ```composer require barryvdh/laravel-debugbar --dev```
1. Installare la libreria di scaffolding:
    ```composer require laravel/ui:^2.4```
1. Scegliere lo scaffolding desiderato (nel nostro caso vue con autenticazione):
    ```php artisan ui vue --auth```
1. (installare eventuali altre librerie per altre cose come: gestione ruoli, generazione slug)

## Backend specifico dell'applicazione
1. Spostare e rinominare il file **app/Http/Controllers/HomeController.php** in **app/Http/Controllers/Admin/AdminController.php**
1. Nel file appena spostato:
	- modificare il namespace in:
		```php
		namespace App\Http\Controllers\Admin;
		```
	- aggiungere la riga di codice (se non c'è già):
		```php
		use App\Http\Controllers\Controller;
		```
1. fare una ricerca nella cartella del progetto di **App\Http\Controllers\HomeController** e sostituirlo con **App\Http\Controllers\Admin\AdminController** (non modificare però i file che si trovano nella cartella vendor)
1. Per l'intero progetto i controllers li costruiremo con:
    ```php artisan make:controller <NomeCartella>/<NomeDelController> --resource --model=<NomeDelModel>```
1. Rigenerare la classmap:
    ```composer dump-autoload```
1. Nel file **app/Providers/RouteServiceProvider.php** modificare:
    - ```public const HOME = '/home';``` in ```public const HOME = '/admin';``` (oppure l'indirizzo che avete dato alla pagina di dashboard dell'amministratore)
1. Se serve modificare il file **app/Http/Middleware/Authenticate.php**:
    - ```return route('login');``` con la route che volete voi

## Routes
1. Nel file **routes/web.php** creare le rotte necessarie raggruppando tutte quelle dedicate al backoffice sotto il termine admin. Esempio:
    ```php
    Route::get('/', function () {
        return view('guests.home');
    })->name('home');

    Auth::routes();

    Route::middleware('auth')
   ->namespace('Admin')
   ->name('admin.')
   ->prefix('admin')
   ->group(function () {
        Route::get('/', 'AdminController@dashboard')->name('dashboard');
        Route::resource('posts', 'PostController');
   });
    ```
## Database
1. Creare il database da phpMyAdmin oppure da linea di comando o come volete
1. Nel file .env aggiornare i dati del database (quelli che iniziano con DB_) e giacchè anche APP_NAME col nome della vostra app
1. Aggiornare i file delle migrations
1. Aggiornare il file DatabaseSeeder.php aggiungendo ```$this->call(ModelSeeder::class);``` per ogni model di cui abbiamo il seeder
1. Aggiornare i file dei seeders
	- aggiungere
		```php
			use Faker\Generator as Faker;
		```
	- modificare
		```php
			public function run()
		```
		in
		```php
			public function run(Faker $faker)
		```
1. (slugs cercate nei file del progetto per dettagli)
1. Nel model impostare la proprietà $fillable con le colonne che possono essere "mass assigned" (solo se volete usare questa tecnica)

## Views
1. Organizzare la cartella resources/views con:
    - una sottocartella admin (con le sottocartelle per ciascun model risorsa)
    - una sottocartella guests
1. spostare **resources/views/home.blade.php** dentro admin e rinominarlo in **dashboard.blade.php** o comunquer rinominare i file con nomi chiari
1. aggiornare i vecchi nomi dei template blade ovunque erano stai usati (controllers, web.php, altri template blade ...)
1. in **resources/views/layouts/app.blade.php** modificare data-toggle in data-bs-toggle (dovrebbero esserci solo due istanze)

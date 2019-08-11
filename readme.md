Weather Api Project

<ol>
  <li>Для установки laravel проекта использовал консольную команду (при установленном composer)<br>
    <code>composer create-project laravel/laravel weather_api --prefer-dist</code>
      <ul>Для развертывание этого проекта на другой машине следует склонировать файлы с этого репозитория: 
        <li>прописать в консоли команду<br><code>composer install</code>;</li>
        <li>переименовать .env.example в .env;</li>
        <li>заменить путь и доступы к вашей базе данных;</li>
    </ul>
  </li>
  <li>Для удаление ненужной в данном проекте frontend части использовал команду<br>
  <code>php artisan preset none</code></li>
  <li>Создал базу данных <b>weather_api</b>, прописал подключение к бд в файле .env<br>
    <pre>
      <code>
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=weather_db
        DB_USERNAME=root
        DB_PASSWORD=
      </code>
    </pre>
  </li>
  <li>Создал модель Weather и миграцию для нее командой<br>
  <code>php artisan make:model Weather -m</code></li>
  <li>Заполнил поля в миграции таким образом:<br>
    <pre>
      <code>
        Schema::create('weathers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('city');
            $table->integer('temperature');
            $table->integer('humidity');
            $table->integer('wind_speed');
            $table->timestamps();
        });
      </code>
    </pre>
    и мигрировал командой<br>
    <code>php artisan migrate</code>
  </li>
  <li>
    Добавил атрибут fillable для модели Weather
    <pre><code>
        class Weather extends Model
        {
            protected $fillable = ['city', 'temperature', 'humidity', 'wind_speed'];
        }
    </code></pre>
  </li>
  <li>
    Добавил два роута в api.php для получения всех данных о погоде
    <pre>
        <code>
        Route::get('weather', function() {
            return Weather::all();
        });
        </code>
    </pre>
    и для получения погоды по конкретному городу
    <pre><code>
        Route::get('weather/{city}', function($city) {
            return Weather::where('city', $city) -> first();
        });
    </code></pre>
  </li>
  <li>
    Создал контроллер командой 
    <pre><code>
        php artisan make:controller WeatherController
    </code></pre>
  </li>
  <li>
    В контроллере прописал два метода index и show для получения всей погоды и по городу соответственно
    <pre><code>
        class WeatherController extends Controller
        {
            public function index()
            {
                return Weather::all();
            }
            public function show($city)
            {
                return Weather::where('city', $city) -> first();
            }
        }
    </code></pre>
  </li>
  <li>
    После этого убрал логику из роута в файле api.php
    <pre><code>
        Route::get('weather', 'WeatherController@index');
        Route::get('weather/{city}', 'WeatherController@show');
    </code></pre>
  </li>
</ol>


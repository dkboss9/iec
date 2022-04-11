<?php return array (
  'akibtanjim/currency-converter' => 
  array (
    'providers' => 
    array (
      0 => 'AkibTanjim\\Currency\\CurrencyServiceProvider',
    ),
    'aliases' => 
    array (
      'Currency' => 'AkibTanjim\\Currency\\Facades\\CurrencyConverter',
    ),
  ),
  'ashallendesign/laravel-exchange-rates' => 
  array (
    'providers' => 
    array (
      0 => 'AshAllenDesign\\LaravelExchangeRates\\Providers\\ExchangeRatesProvider',
    ),
    'aliases' => 
    array (
      'ExchangeRate' => 'AshAllenDesign\\LaravelExchangeRates\\Facades\\ExchangeRate',
    ),
  ),
  'danielme85/laravel-cconverter' => 
  array (
    'providers' => 
    array (
      0 => 'danielme85\\CConverter\\CConverterServiceProvider',
    ),
    'aliases' => 
    array (
      'Currency' => 'danielme85\\CConverter\\CConverter',
    ),
  ),
  'facade/ignition' => 
  array (
    'providers' => 
    array (
      0 => 'Facade\\Ignition\\IgnitionServiceProvider',
    ),
    'aliases' => 
    array (
      'Flare' => 'Facade\\Ignition\\Facades\\Flare',
    ),
  ),
  'fideloper/proxy' => 
  array (
    'providers' => 
    array (
      0 => 'Fideloper\\Proxy\\TrustedProxyServiceProvider',
    ),
  ),
  'fruitcake/laravel-cors' => 
  array (
    'providers' => 
    array (
      0 => 'Fruitcake\\Cors\\CorsServiceProvider',
    ),
  ),
  'intervention/image' => 
  array (
    'providers' => 
    array (
      0 => 'Intervention\\Image\\ImageServiceProvider',
    ),
    'aliases' => 
    array (
      'Image' => 'Intervention\\Image\\Facades\\Image',
    ),
  ),
  'ixudra/curl' => 
  array (
    'providers' => 
    array (
      0 => 'Ixudra\\Curl\\CurlServiceProvider',
    ),
    'aliases' => 
    array (
      'Curl' => 'Ixudra\\Curl\\Facades\\Curl',
    ),
  ),
  'jamesmills/laravel-timezone' => 
  array (
    'providers' => 
    array (
      0 => 'JamesMills\\LaravelTimezone\\LaravelTimezoneServiceProvider',
    ),
  ),
  'laravel/tinker' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Tinker\\TinkerServiceProvider',
    ),
  ),
  'laravel/ui' => 
  array (
    'providers' => 
    array (
      0 => 'Laravel\\Ui\\UiServiceProvider',
    ),
  ),
  'laravelcollective/html' => 
  array (
    'providers' => 
    array (
      0 => 'Collective\\Html\\HtmlServiceProvider',
    ),
    'aliases' => 
    array (
      'Form' => 'Collective\\Html\\FormFacade',
      'Html' => 'Collective\\Html\\HtmlFacade',
    ),
  ),
  'nesbot/carbon' => 
  array (
    'providers' => 
    array (
      0 => 'Carbon\\Laravel\\ServiceProvider',
    ),
  ),
  'nunomaduro/collision' => 
  array (
    'providers' => 
    array (
      0 => 'NunoMaduro\\Collision\\Adapters\\Laravel\\CollisionServiceProvider',
    ),
  ),
  'pbmedia/laravel-ffmpeg' => 
  array (
    'providers' => 
    array (
      0 => 'ProtoneMedia\\LaravelFFMpeg\\Support\\ServiceProvider',
    ),
    'aliases' => 
    array (
      'FFMpeg' => 'ProtoneMedia\\LaravelFFMpeg\\Support\\FFMpeg',
    ),
  ),
  'torann/geoip' => 
  array (
    'providers' => 
    array (
      0 => 'Torann\\GeoIP\\GeoIPServiceProvider',
    ),
    'aliases' => 
    array (
      'GeoIP' => 'Torann\\GeoIP\\Facades\\GeoIP',
    ),
  ),
  'tymon/jwt-auth' => 
  array (
    'aliases' => 
    array (
      'JWTAuth' => 'Tymon\\JWTAuth\\Facades\\JWTAuth',
      'JWTFactory' => 'Tymon\\JWTAuth\\Facades\\JWTFactory',
    ),
    'providers' => 
    array (
      0 => 'Tymon\\JWTAuth\\Providers\\LaravelServiceProvider',
    ),
  ),
);
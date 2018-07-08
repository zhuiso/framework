<?php
// +----------------------------------------------------------------------
// | Dscription:  The file is part of Zs
// +----------------------------------------------------------------------
// | Author: showkw <showkw@163.com>
// +----------------------------------------------------------------------
// | CopyRight: (c) 2018 zhuiso.com
// +----------------------------------------------------------------------
return [
    'name'            => env('APP_NAME', 'My Application'),
    'env'             => env('APP_ENV', 'production'),
    'debug'           => env('APP_DEBUG', false),
    'url'             => env('APP_URL', 'http://localhost'),
    'timezone'        => env('APP_TIMEZONE', 'PRC'),
    'locale'          => env('APP_LOCALE', 'zh-cn'),
    'fallback_locale' => env('APP_LOCALE_FALLBACK', 'zh-cn'),
    'key'             => env('APP_KEY', ''),
    'cipher'          => 'AES-256-CBC',
    'log'             => env('APP_LOG', 'daily'),
    'log_level'       => env('APP_LOG_LEVEL', 'debug'),
    'providers'       => [
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Zs\Foundation\Addon\AddonServiceProvider::class,
        Zs\Foundation\Attachment\AttachmentServiceProvider::class,
        Zs\Foundation\Composer\ComposerServiceProvider::class,
        Zs\Foundation\Console\ConsoleServiceProvider::class,
        Zs\Foundation\Database\MigrationServiceProvider::class,
        Zs\Foundation\Debug\DebugServiceProvider::class,
        Zs\Foundation\Editor\EditorServiceProvider::class,
        Zs\Foundation\Flow\FlowServiceProvider::class,
        Zs\Foundation\GraphQL\GraphQLServiceProvider::class,
        Zs\Foundation\JWTAuth\JWTAuthServiceProvider::class,
        Zs\Foundation\Mail\MailServiceProvider::class,
        Zs\Foundation\Member\MemberServiceProvider::class,
        Zs\Foundation\Navigation\NavigationServiceProvider::class,
        Zs\Foundation\Notification\NotificationServiceProvider::class,
        Zs\Foundation\Permission\PermissionServiceProvider::class,
        Zs\Foundation\SearchEngine\SearchEngineServiceProvider::class,
        Zs\Foundation\Theme\ThemeServiceProvider::class,
        Zs\Foundation\Translation\TranslationServiceProvider::class,
        Zs\Foundation\Http\HttpServiceProvider::class,
        Zs\Foundation\Administration\AdministrationServiceProvider::class,
        Zs\Installer\InstallerServiceProvider::class,
    ],
    'aliases'         => [
        'App'          => Illuminate\Support\Facades\App::class,
        'Artisan'      => Illuminate\Support\Facades\Artisan::class,
        'Auth'         => Illuminate\Support\Facades\Auth::class,
        'Blade'        => Illuminate\Support\Facades\Blade::class,
        'Cache'        => Illuminate\Support\Facades\Cache::class,
        'Config'       => Illuminate\Support\Facades\Config::class,
        'Cookie'       => Illuminate\Support\Facades\Cookie::class,
        'Crypt'        => Illuminate\Support\Facades\Crypt::class,
        'DB'           => Illuminate\Support\Facades\DB::class,
        'Eloquent'     => Illuminate\Database\Eloquent\Model::class,
        'Event'        => Illuminate\Support\Facades\Event::class,
        'File'         => Illuminate\Support\Facades\File::class,
        'Gate'         => Illuminate\Support\Facades\Gate::class,
        'Hash'         => Illuminate\Support\Facades\Hash::class,
        'JWTAuth'      => Zs\Foundation\JWTAuth\Facades\JWTAuth::class,
        'JWTFactory'   => Zs\Foundation\JWTAuth\Facades\JWTFactory::class,
        'Lang'         => Illuminate\Support\Facades\Lang::class,
        'Log'          => Illuminate\Support\Facades\Log::class,
        'Mail'         => Illuminate\Support\Facades\Mail::class,
        'Notification' => Illuminate\Support\Facades\Notification::class,
        'Password'     => Illuminate\Support\Facades\Password::class,
        'Queue'        => Illuminate\Support\Facades\Queue::class,
        'Redirect'     => Illuminate\Support\Facades\Redirect::class,
        'Redis'        => Illuminate\Support\Facades\Redis::class,
        'Request'      => Illuminate\Support\Facades\Request::class,
        'Response'     => Illuminate\Support\Facades\Response::class,
        'Route'        => Illuminate\Support\Facades\Route::class,
        'Schema'       => Illuminate\Support\Facades\Schema::class,
        'Session'      => Illuminate\Support\Facades\Session::class,
        'Storage'      => Illuminate\Support\Facades\Storage::class,
        'URL'          => Illuminate\Support\Facades\URL::class,
        'Validator'    => Illuminate\Support\Facades\Validator::class,
        'View'         => Illuminate\Support\Facades\View::class,
    ],
];
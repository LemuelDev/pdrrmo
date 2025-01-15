<?php

namespace App\Providers;

use App\Models\UserProfile;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;

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
    public function boot(): void
    {
        Paginator::useBootstrap();
        $this->loadGoogleStorage();

        view()->composer('*', function ($view) {
            $pendingCount = 0; // Default to zero if the user is not authenticated
    
            if (auth()->check()) { // Check if the user is authenticated
                $userProfile = auth()->user()->userProfile;
    
                if ($userProfile) {
                    if ($userProfile->municipality === 'pdrrmo' || $userProfile->user_type === 'superadmin' ) {
                        // Calculate pending count for 'pdrrmo' users
                        $pendingCount = UserProfile::where('isPending', 'pending')->count();
                    } else {
                        // Calculate pending count for other municipalities
                        $pendingCount = UserProfile::where('user_type', 'staff')
                            ->where('municipality', $userProfile->municipality)
                            ->where('isPending', 'pending')->count();
                    }
                }
            }
    
            // Share pendingCount with all views
            $view->with('pendingCount', $pendingCount);
        });
    }

    private function loadGoogleStorage() {
        try {
            Storage::extend('google', function($app, $config) {
                $options = [];

                if (!empty($config['teamDriveId'] ?? null)) {
                    $options['teamDriveId'] = $config['teamDriveId'];
                }

                if (!empty($config['sharedFolderId'] ?? null)) {
                    $options['sharedFolderId'] = $config['sharedFolderId'];
                }

                $client = new \Google\Client();
                $client->setClientId($config['clientId']);
                $client->setClientSecret($config['clientSecret']);
                $client->refreshToken($config['refreshToken']);
                
                $service = new \Google\Service\Drive($client);
                $adapter = new \Masbug\Flysystem\GoogleDriveAdapter($service, $config['folder'] ?? '/', $options);
                $driver = new \League\Flysystem\Filesystem($adapter);

                return new \Illuminate\Filesystem\FilesystemAdapter($driver, $adapter);
            });
        } catch(\Exception $e) {
            return $e;
        }
        // ...
    }
    
}

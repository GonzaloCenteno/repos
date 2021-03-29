<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Inertia\Inertia;
use Illuminate\Support\Facades\Auth;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Session;
use Illuminate\Pagination\UrlWindow;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Request;
use App\Http\Models\Admod;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Inertia::share('auth', function (){
            return[
                'user' => Auth::user(),
            ];
        });

        Inertia::share('modulos', function (){
            return Admod::where('admodnimg',1)->with('admprs.admdts')->orderBy('admodmodn','asc')->get();
            // return Admod::whereHas('admprs.admdts', function($q)
            // {
            //     $q->where('admdtmdtn', '=', '1');
            
            // })->where('admodnimg',1)->with('admprs.admdts')->orderBy('admodmodn','asc')->get();
        });
    }

    protected function registerLengthAwarePaginator()
    {
        $this->app->bind(LengthAwarePaginator::class, function ($app, $values) {
            return new class(...array_values($values)) extends LengthAwarePaginator {
                public function only(...$attributes)
                {
                    return $this->transform(function ($item) use ($attributes) {
                        return $item->only($attributes);
                    });
                }

                public function transform($callback)
                {
                    $this->items->transform($callback);

                    return $this;
                }

                public function toArray()
                {
                    return [
                        'data' => $this->items->toArray(),
                        'links' => $this->links(),
                    ];
                }

                public function links($view = null, $data = [])
                {
                    $this->appends(Request::all());

                    $window = UrlWindow::make($this);

                    $elements = array_filter([
                        $window['first'],
                        is_array($window['slider']) ? '...' : null,
                        $window['slider'],
                        is_array($window['last']) ? '...' : null,
                        $window['last'],
                    ]);

                    return Collection::make($elements)->flatMap(function ($item) {
                        if (is_array($item)) {
                            return Collection::make($item)->map(function ($url, $page) {
                                return [
                                    'url' => $url,
                                    'label' => $page,
                                    'active' => $this->currentPage() === $page,
                                ];
                            });
                        } else {
                            return [
                                [
                                    'url' => null,
                                    'label' => '...',
                                    'active' => false,
                                ],
                            ];
                        }
                    })->prepend([
                        'url' => $this->previousPageUrl(),
                        'label' => 'Anterior',
                        'active' => false,
                    ])->push([
                        'url' => $this->nextPageUrl(),
                        'label' => 'Siguiente',
                        'active' => false,
                    ]);
                }
            };
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerLengthAwarePaginator();
    }
}

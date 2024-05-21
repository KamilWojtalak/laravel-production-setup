<?php

namespace App\Providers;

use App\Rules\Recaptcha;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

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
        $this->registerBladeDirectives();
    }

    private function registerBladeDirectives(): void
    {
        Blade::directive('reCaptchaHead', function () {
            return '<script src="https://www.google.com/recaptcha/api.js"></script>';
        });

        Blade::directive('reCaptchaFooter', function (string $formId) {
            $return = $this->getHtmlForRecaptchaFooter($formId);

            return $return;
        });
    }

    private function getHtmlForRecaptchaFooter(string $formId): string
    {
        return <<<HTML
        <script>
        function onSubmitRecaptcha(token) {
            document.getElementById($formId).submit();
        }
        </script>
        HTML;
    }
}

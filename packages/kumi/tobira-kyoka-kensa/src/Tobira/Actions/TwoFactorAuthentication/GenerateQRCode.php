<?php

namespace Kumi\Tobira\Actions\TwoFactorAuthentication;

use BaconQrCode\Writer;
use Laravel\Fortify\Fortify;
use BaconQrCode\Renderer\Color\Rgb;
use BaconQrCode\Renderer\ImageRenderer;
use Lorisleiva\Actions\Concerns\AsAction;
use BaconQrCode\Renderer\RendererStyle\Fill;
use Illuminate\Contracts\Auth\StatefulGuard;
use BaconQrCode\Renderer\Image\SvgImageBackEnd;
use BaconQrCode\Renderer\RendererStyle\RendererStyle;
use Laravel\Fortify\Contracts\TwoFactorAuthenticationProvider;

class GenerateQRCode
{
    use AsAction;

    protected StatefulGuard $guard;
    protected TwoFactorAuthenticationProvider $provider;

    public function __construct(StatefulGuard $guard, TwoFactorAuthenticationProvider $provider)
    {
        $this->guard = $guard;
        $this->provider = $provider;
    }

    public function handle(int $size = 256): string
    {
        $svg = (new Writer(
            new ImageRenderer(
                new RendererStyle($size, 0, null, null, Fill::uniformColor(new Rgb(255, 255, 255), new Rgb(45, 55, 72))),
                new SvgImageBackEnd()
            )
        ))->writeString($this->generateQRCodeURL());

        return trim(substr($svg, strpos($svg, "\n") + 1));
    }

    protected function generateQRCodeURL(): string
    {
        return $this->provider->qrCodeUrl(
            config('app.name'),
            $this->guard->user()->{Fortify::username()},
            GenerateSecret::run(),
        );
    }
}

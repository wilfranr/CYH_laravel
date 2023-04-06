<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class LogoController extends Controller
{
    public function resizeLogo()
    {
        $logo = public_path('images/logo.png');

        $logoSmall = public_path('images/logo-small.png');

        $image = Image::make($logo)->resize(100, null, function ($constraint) {
            $constraint->aspectRatio();
        }); // Cambia el tamaño a 100x100 píxeles
        try {
            $image->save($logoSmall);
        } catch (\Exception $e) {
            dd($e);
        }
    }
}

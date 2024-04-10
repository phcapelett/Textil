<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    //
    public function swap($locale)
    {
        // available language in template array
        $availLocale = ['en' => 'en', 'fr' => 'fr', 'de' => 'de', 'pt' => 'pt'];
        // check for existing language
        if (array_key_exists($locale, $availLocale)) {
            session()->put('locale', $locale);
        }
        return redirect()->back();
    }

    public static function getLanguage()
    {
        $cookie = \Cookie::get('language');
        if (!$cookie) {
            $cookie = "pt-Br";
        }
        $trans = include(base_path() . "/lang/" . $cookie . "/page.php");

        if ($cookie == "pt-Br") {
            $trans['datatable'] = 'pt-Br';
        }
        return $trans;
    }
}

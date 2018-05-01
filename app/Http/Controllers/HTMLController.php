<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CS602\TrueFalse;
use DOMDocument;
use Storage;

class HTMLController extends Controller {
    
    public function generateHTML() {
        
        $storagePath = Storage::disk('cs602')->getDriver()->getAdapter()->getPathPrefix();

        $fileName = 'html-';

        for ($i = 0; $i < 5; $i++) {
            $html = new TrueFalse();
            $htmlFile = $html->generateHTML();
            $htmlFile->save($storagePath . $fileName . $i . '.html'); 
        }

        return response()->json(
            [
                'success' => true,
                'message' => 'html created'
            ]
        );

    }
}
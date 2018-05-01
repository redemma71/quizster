<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Soa\Item;
// use App\Soa\MultipleChoice;
use App\CS602\SingleSelect;
use DOMDocument;
use Storage;

class SingleSelectController extends Controller
{
    public function generateItems() {

        $question_type = $_POST['question_type'];
        $num_items = $_POST['num_items'];
        $directory_name = $_POST['job_directory'];
    
        // $storagePath = Storage::disk('soa')->getDriver()->getAdapter()->getPathPrefix();
        $storagePath = Storage::disk('cs602')->getDriver()->getAdapter()->getPathPrefix();
        $jobPath = Storage::makeDirectory('public/cs602/' . $directory_name . '/', 0775, true);
    
        // if ($question_type == 'multi') {
        //     for ($i = 1; $i <= $num_items; $i++) {
        //         $mcXML = new MultipleChoice();
        //         $mcItem = $mcXML->generateMC($question_type);
        //         $mcItem->save($storagePath . $question_type . '-' . $i . '.html');
        //     }
        // } elseif ($question_type == 'single') {
        //     for ($i = 1; $i <= $num_items; $i++) {
        //         $ssXML = new SingleSelect();
        //         $ssItem = $ssXML->generateSS($question_type);
        //         $ssItem->save($storagePath . $question_type . '-' . $i . '.html');
        //     }
        // } else {
        //     return;
        // }

        for ($i = 1; $i <= $num_items; $i++) {
            $ssXML = new SingleSelect();
            $ssItem = $ssXML->generateSS($num_items);
            $ssItemName = $question_type . '-' . $i . '.html';
            $ssItem->save($storagePath . $ssItemName);
            Storage::move("public/cs602/$ssItemName", "public/cs602/" . $directory_name . '/' . $ssItemName);

        }

        return response()-> json(
            [
               'success' => true,
               'message' => 'items created'
            ]
        );
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Soa\Item;
// use App\Soa\MultipleChoice;
use App\CS602\MultipleChoice;
use DOMDocument;
use Storage;

class MultipleChoiceController extends Controller
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
        //         $ssXML = new MultipleChoice();
        //         $ssItem = $ssXML->generateSS($question_type);
        //         $ssItem->save($storagePath . $question_type . '-' . $i . '.html');
        //     }
        // } else {
        //     return;
        // }

        // CS602
        for ($i = 1; $i <= $num_items; $i++) {
            $mcXML = new MultipleChoice();
            $mcItem = $mcXML->generateMC($num_items);
            $mcItemName = $question_type . '-' . $i . '.html';
            $mcItem->save($storagePath . $mcItemName);
            Storage::move("public/cs602/$mcItemName", "public/cs602/" . $directory_name . '/' . $mcItemName);
        }

        return response()-> json(
            [
               'success' => true,
               'message' => 'items created'
            ]
        );
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Soa\Item;
// use App\Soa\TrueFalse;
use App\CS602\TrueFalse;
use DOMDocument;
use Storage;

class TrueFalseController extends Controller
{
    public function generateItems() {

        $question_type = $_POST['question_type'];
        $num_items = $_POST['num_items'];
        $directory_name = $_POST['job_directory'];
        
        // $storagePath = Storage::disk('soa')->getDriver()->getAdapter()->getPathPrefix();
        $storagePath = Storage::disk('cs602')->getDriver()->getAdapter()->getPathPrefix();
        $jobPath = Storage::makeDirectory('public/cs602/' . $directory_name . '/', 0775, true);
    
        // for ($i = 1; $i <= $num_items; $i++) {
        //     $tfXML = new TrueFalse();
        //     $tfItem = $tfXML->generateTF();
        //     $tfItem->save($storagePath . $question_type . '-' . $i . '.xml');
        // }

        // CS602
        for ($i = 1; $i <= $num_items; $i++) {
            $tfXML = new TrueFalse();
            $tfItem = $tfXML->generateTF($num_items);
            $tfItemName = $question_type . '-' . $i . '.html';
            $tfItem->save($storagePath . $tfItemName);
            Storage::move("public/cs602/$tfItemName", "public/cs602/" . $directory_name . '/' . $tfItemName);
        }

        return response()->json(
            [
               'success' => true,
               'message' => 'items created'
            ]
        );
    }
}
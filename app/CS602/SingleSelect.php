<?php

namespace App\CS602;

use App\CS602\Html;
use App\CS602\SingleSelectForm;
use App\CS602\Prompt;
use App\CS602\Navbar;
use Faker;
use DOMDocument;
use Storage;

class SingleSelect {
    function __construct() {
        $html = new Html();
        $this->question = new DOMDocument();
        // append HTML wrapper to this question
        $this->question->loadHTML($html->generate());
        $this->faker = Faker\Factory::create();
    }

public function generateSS($num_items) {
    $bodies = $this->question->getElementsByTagName('body');
    $body = $bodies->item(0);

    $header = $this->question->createElement('h3',$this->faker->bs());
    $header->setAttribute('class','header quiz-header');
    $body->appendChild($header);

    //////////////////////////////////////
    // bootstrap grid: begin div container
    $div_container = $this->question->createElement('div');
    $div_container->setAttribute('class','container');
        
        //////////////////////
        /// breadcrumb nav bar
        //////////////////////
        $navbar_obj = new Navbar();
        $navbar_str = $navbar_obj->createNavbar('single',$num_items);
        $navbar_dom = new DOMDocument();
        $navbar_dom->loadHTML($navbar_str);
        $navbar_node = $navbar_dom->getElementsByTagName('div')->item(0);
        $navbar_node = $this->question->importNode($navbar_node,true);
        $div_container->appendChild($navbar_node);
        /// end breadcrumbs ///
        ///////////////////////

        ///////////////////////////
        /// single-select question
        ///////////////////////////
        $singleSelect_question = $this->question->createElement('div');
        $singleSelect_question->setAttribute('class','row');
            $singleSelect_question_col = $this->question->createElement('div');
            $singleSelect_question_col->setAttribute('class',"col-8");

                //////////////////////////
                // begin single-select prompt
                $prompt_obj = new Prompt();
                $prompt_str = $prompt_obj->createPrompt('single');
                $prompt_dom = new DOMDocument();
                $prompt_dom->loadHTML($prompt_str);
                $prompt_node = $prompt_dom->getElementsByTagName("p")->item(0);
                $prompt_node = $this->question->importNode($prompt_node,true);
                $singleSelect_question_col->appendChild($prompt_node);
                // end single-select prompt
                //////////////////////////
            
                //////////////////////////
                // begin single-select form
                $number_of_distractors = rand(2,5);
                $form_obj = new SingleSelectForm();
                $form_str = $form_obj->createForm($number_of_distractors);
                $form_dom = new DOMDocument();
                $form_dom->loadHTML($form_str);
                $form_node = $form_dom->getElementsByTagName("form")->item(0);
                $form_node = $this->question->importNode($form_node,true);
                $singleSelect_question_col->appendChild($form_node);
                // end single-select form
                //////////////////////////

            $singleSelect_question->appendChild($singleSelect_question_col);        
        $div_container->appendChild($singleSelect_question);   
        //////////////////////////////
        /// end single-select question
        /////////////////////////////

    $body->appendChild($div_container);
    // end bootstrap div container
    //////////////////////////////////////
    
    $this->question->formatOutput = true;
    return $this->question;
}

}

?>
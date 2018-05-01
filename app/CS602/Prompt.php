<?php

namespace App\CS602;

use Faker;
use DOMDocument;
use Storage;

class Prompt {

    function __construct() {
        $this->dom = new DOMDocument();
        $this->faker = Faker\Factory::create();
    }

    public function createPrompt($question_type) {
        $prompt = $this->dom->createElement('p');

            if ($question_type == 'multi') {
                $prompt_label_text = "Choose All That Apply: ";
            } elseif ($question_type == "single") {
                $prompt_label_text = "Choose the Best Answer: ";
            } else {
                $prompt_label_text = "True or False: ";
            }
            $span = $this->dom->createElement('span',$prompt_label_text);
            $span->setAttribute('class','prompt-label');
            $prompt->appendChild($span);
            $prompt_text = $this->dom->createTextNode($this->faker->realText(50));
            $prompt->appendChild($prompt_text);
        $this->dom->appendChild($prompt);
        return $this->dom->saveHTML($prompt);
    }


}

?>
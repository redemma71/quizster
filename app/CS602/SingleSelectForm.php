<?php

namespace App\CS602;

use Faker;
use DOMDocument;
use Storage;

class SingleSelectForm {
    
    function __construct() {
        $this->dom = new DOMDocument();
        $this->faker = Faker\Factory::create();
    }

    public function createForm($number_of_distractors) {
        $form = $this->dom->createElement('form');
        $form->setAttribute('action','../../../php/ss_form.php');
        $form->setAttribute('method','post');
        $form->setAttribute('target','_blank');
            
            $fieldset = $this->dom->createElement('fieldset');
            $fieldset->setAttribute('class','form-group');

                $correct_answer_index = rand(1,$number_of_distractors);
                $correct_answer = '';
                while ($number_of_distractors >= 0) {
                    $answer_option = $this->faker->unique()->state();
                    $div = $this->dom->createElement('div');
                    $div->setAttribute('class','form-check');
                        $label = $this->dom->createElement('label');
                        $label->setAttribute('class','form-check-label');
                        $label_text_node = $this->dom->createTextNode('   ' . $answer_option);
                            $input_atts = array(
                                array('type' => 'radio'),
                                array('class' => 'form-check-input'),
                                array('name' => 'single'),
                                array('id' => $answer_option),
                                array('value' => $answer_option)
                            );
                            $input = $label->appendChild($this->dom->createElement('input'));
                            foreach ($input_atts as $attribute) {
                                foreach ($attribute as $key => $value) {
                                    $input->setAttribute($key,$value);
                                }
                            }
                        $label->appendChild($label_text_node);
                    $div->appendChild($label);
                $fieldset->appendChild($div);
                if ($correct_answer_index == $number_of_distractors) {
                    $correct_answer = $answer_option;
                }
                $number_of_distractors--;
                }
        $form->appendChild($fieldset);
            
        $hidden_input = $this->dom->createElement('input');
        $hidden_input->setAttribute('type','hidden');
        $hidden_input->setAttribute('name','correct');
        $hidden_input->setAttribute('value',$correct_answer);
        $form->appendChild($hidden_input);
        $_SESSION["correct"] = 


        $submit_button = $this->dom->createElement('button','Answer');
        $submit_button->setAttribute('type','submit');
        $submit_button->setAttribute('class','btn btn-primary');
        $form->appendChild($submit_button);
        
        $this->dom->appendChild($form);
        return $this->dom->saveHTML($form);
    }
    
}

?>
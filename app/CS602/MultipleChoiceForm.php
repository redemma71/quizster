<?php
namespace App\CS602;

use Faker;
use DOMDocument;
use Storage;

class MultipleChoiceForm {
    
    function __construct() {
        $this->dom = new DOMDocument();
        $this->faker = Faker\Factory::create();
    }

    public function createForm($number_of_answer_options) {
        $form = $this->dom->createElement('form');
        $form->setAttribute('action','../../../php/mc_form.php');
        $form->setAttribute('method','post');
        $form->setAttribute('target','_blank');
            
            $fieldset = $this->dom->createElement('fieldset');
            $fieldset->setAttribute('class','form-group');
            // determine corrects
            $number_of_corrects = rand(1,$number_of_answer_options - 1);
            $correct_array_index = array(); // get an index of corret answers
            $correct_answer_array = array(); // populate correct answer array in the while loop
            for ($i = 0; $i < $number_of_corrects; $i++) {
                array_push($correct_array_index,rand(1,$number_of_answer_options));
            }

                while ($number_of_answer_options > 0) {
                    $answer_option = $this->faker->unique()->colorName();                    
                    foreach ($correct_array_index as $index) {
                        if ($index == $number_of_answer_options) {
                            array_push($correct_answer_array,$answer_option);
                        }
                    }
                    $div = $this->dom->createElement('div');
                    $div->setAttribute('class','form-check');
                        $label = $this->dom->createElement('label');
                        $label->setAttribute('class','form-check-label');
                        $label_text_node = $this->dom->createTextNode(' ' . $answer_option);
                            $input_atts = array(
                                array('type' => 'checkbox'),
                                array('class' => 'form-check-input'),
                                array('name' => 'multi[]'),
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
                // decrement while loop
                $number_of_answer_options--;
                }
        $form->appendChild($fieldset);
        
        $correct_count = 0;
        foreach ($correct_answer_array as $correct_answer) {
            $hidden_input = $this->dom->createElement('input');
            $hidden_input->setAttribute('type','hidden');
            $hidden_input->setAttribute('name','correct' . $correct_count);
            $hidden_input->setAttribute('value',$correct_answer);
            $form->appendChild($hidden_input);
            $correct_count++;
        }

    

        $submit_button = $this->dom->createElement('button','Answer');
        $submit_button->setAttribute('type','submit');
        $submit_button->setAttribute('class','btn btn-primary');
        $form->appendChild($submit_button);
        
        $this->dom->appendChild($form);
        return $this->dom->saveHTML($form);
    }
    
}


?>
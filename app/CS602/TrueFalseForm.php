<?php
namespace App\CS602;

use Faker;
use DOMDocument;
use Storage;

class TrueFalseForm {
    
    function __construct() {
        $this->dom = new DOMDocument();
        $this->faker = Faker\Factory::create();
    }

    public function createForm($correct_answer) {
        $form = $this->dom->createElement('form');
        $form->setAttribute('action','../../../php/tf_form.php');
        $form->setAttribute('method','post');
        $form->setAttribute('target','_blank');
            
            $fieldset = $this->dom->createElement('fieldset');
            $fieldset->setAttribute('class','form-group');
    
                $input_types = array('true','false');
                foreach ($input_types as $input_type) {
                    $div = $this->dom->createElement('div');
                    $div->setAttribute('class','form-check');
                        $label_text = ($input_type == 'true') ? 'True' : 'False';
                        $label = $this->dom->createElement('label');
                        $label->setAttribute('class','form-check-label');
                        $label_text_node = $this->dom->createTextNode(' ' . $label_text);
                            $input_atts = array(
                                array('type' => 'radio'),
                                array('class' => 'form-check-input'),
                                array('name' => 'tf'),
                                array('id' => $input_type),
                                array('value' => $input_type)
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
                }
            $form->appendChild($fieldset);


            $hidden_input = $this->dom->createElement('input');
            $hidden_input->setAttribute('type','hidden');
            $hidden_input->setAttribute('name','correct');
            $hidden_input->setAttribute('value',$correct_answer);
            $form->appendChild($hidden_input);
        

            $submit_button = $this->dom->createElement('button','Answer');
            $submit_button->setAttribute('type','submit');
            $submit_button->setAttribute('class','btn btn-primary');
            $form->appendChild($submit_button);
        
        $this->dom->appendChild($form);
        return $this->dom->saveHTML($form);
    }
    
}


?>
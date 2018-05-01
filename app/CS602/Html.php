<?php

namespace App\CS602;

use Faker;
use DOMDocument;

class Html {

    public function generate() {
        $faker = Faker\Factory::create();
        $html = new DOMDocument();
        $html_root = $html->createElement('html');
        $html_root->setAttribute('lang','{{ app()->getLocale() }}');

        // html head
        $head = $html->createElement('head');

        // meta tags
        $meta = array(
            array('charset' => 'UTF-8'),
            array('name' => 'viewport', 'content' => 'width=device-width, intial-scale=1.0'),
            array('http-equiv' => 'X-UA-Compatible', 'content' => 'ie-edge')
        );
        foreach ($meta as $attributes) {
            $meta_node = $head->appendChild($html->createElement('meta'));
            foreach ($attributes as $key => $value) {
                $meta_node->setAttribute($key,$value);
            }
        }

        // link tags
        $link = array(
            array('rel' => 'stylesheet'),
            array('href' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css'),
            array('integrity' => 'sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u'),
            array('crossorigin' => 'anonymous')
        );
        $link_node = $head->appendChild($html->createElement('link'));
        foreach ($link as $attributes) {
            foreach ($attributes as $key => $value) {
                $link_node->setAttribute($key,$value);
            }
        }

        $link2 = array(
            array('rel' => 'stylesheet'),
            array('href' => '../../../css/scrivener.css' ),
            array('type' => 'text/css')
        );
        $link2_node = $head->appendChild($html->createElement('link'));
        foreach ($link2 as $attributes) {
            foreach ($attributes as $key => $value) {
                $link2_node->setAttribute($key,$value);
            }
        }

        // script tags
        $script = array(
            array('src' => 'https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js'),
            array('src' => 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js')
        );
        foreach ($script as $attributes) {
            $script_node = $head->appendChild($html->createElement('script',' '));
            foreach ($attributes as $key => $value) {
                $script_node->setAttribute($key,$value);
            }
        }

        // title
        $head->appendChild($html->createElement('title',$faker->realText(30)));
        
        // add head
        $html_root->appendChild($head);
        
        // html body
        $html_root->appendChild($html->createElement('body'));
        
        // html root
        $html->appendChild($html_root);
        $html->formatOutput = true;
        return $html->saveHTML();
    }
}

?>
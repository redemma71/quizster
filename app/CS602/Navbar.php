<?php

namespace App\CS602;

use Faker;
use DOMDocument;
use Storage;

class Navbar {

    function __construct() {
        $this->dom = new DOMDocument();
        $this->faker = Faker\Factory::create();
    }

    public function createNavbar($question_type,$num_items) {
        $row = $this->dom->createElement('div');
        $row->setAttribute('class','row');
            $col = $this->dom->createElement('div');
            $col->setAttribute('class','col-4');
                $ul = $this->dom->createElement('ul');
                $ul->setAttribute('class','breadcrumb');
                    for ($i = 1; $i <= $num_items; $i++) {
                        $li = $this->dom->createElement('li');
                            $a_href_text = "Question $i";
                            $a_href = $this->dom->createElement('a',$a_href_text);
                            $a_href_url = "$question_type-$i.html";
                            $a_href->setAttribute('href',$a_href_url);
                        $li->appendChild($a_href);
                $ul->appendChild($li);
                }
            $col->appendChild($ul);
        $row->appendChild($col);
        $this->dom->appendChild($row);
        return $this->dom->saveHTML($row);
    }
}

?>
<?php
class Well_Form_Element_County extends Zend_Form_Element_Select {

    public function init() {
        $this->addPrefixPath('Application_Form', APPLICATION_PATH . '/forms', 'decorator');

        $this->setLabel('County')
        ->setDecorators(array(
                'Decorator'
        ))
        ->setAttrib('class', 'form-control')
        ->setAttrib('data-size', 'col-xs-3');

        $this->addmultioption("bake", "Baker");
        $this->addmultioption("bent", "Benton");
        $this->addmultioption("clac", "Clackamas");
        $this->addmultioption("clat", "Clatsop");
        $this->addmultioption("colu", "Columbia");
        $this->addmultioption("coos", "Coos");
        $this->addmultioption("croo", "Crook");
        $this->addmultioption("curr", "Curry");
        $this->addmultioption("desc", "Deschutes");
        $this->addmultioption("doug", "Douglas");
        $this->addmultioption("gill", "Gilliam");
        $this->addmultioption("gran", "Grant");
        $this->addmultioption("harn", "Harney");
        $this->addmultioption("hood", "Hood river");
        $this->addmultioption("jack", "Jackson");
        $this->addmultioption("jeff", "Jefferson");
        $this->addmultioption("jose", "Josephine");
        $this->addmultioption("klam", "Klamath");
        $this->addmultioption("lake", "Lake");
        $this->addmultioption("lane", "Lane");
        $this->addmultioption("linc", "Lincoln");
        $this->addmultioption("linn", "Linn");
        $this->addmultioption("malh", "Malheur");
        $this->addmultioption("mari", "Marion");
        $this->addmultioption("morr", "Morrow");
        $this->addmultioption("mult", "Multnomah");
        $this->addmultioption("polk", "Polk");
        $this->addmultioption("sher", "Sherman");
        $this->addmultioption("till", "Tillamook");
        $this->addmultioption("umat", "Umatilla");
        $this->addmultioption("unio", "Union");
        $this->addmultioption("wall", "Wallowa");
        $this->addmultioption("wasc", "Wasco");
        $this->addmultioption("wash", "Washington");
        $this->addmultioption("whee", "Wheeler");
        $this->addmultioption("yamh", "Yamhill");
        
    }

}

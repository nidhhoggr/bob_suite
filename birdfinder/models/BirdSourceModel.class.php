<?php
//EXTEND THE BASE MODEL
class BirdSourceModel extends BaseModel {

    //SET THE TABLE OF THE MODEL AND THE IDENTIFIER
    protected function configure() {
        $this->setTable("bird_source");
    }
}

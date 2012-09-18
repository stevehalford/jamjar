<?php

class Client extends Eloquent 
{

    public function projects() {

        return $this->has_many('Project');

    }
}
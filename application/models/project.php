<?php

class Project extends Eloquent 
{
    public function client() {

        return $this->belongs_to('Client');

    }

    public function jobs() {

        return $this->has_many('Job');

    }
}
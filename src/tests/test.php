<?php

class TestService
{

}

class Test
{
    protected TestService $service;

    public function method()
    {

    }
}


inject(Test::class)->method();

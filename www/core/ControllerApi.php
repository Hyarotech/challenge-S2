<?php

namespace Core;

interface ControllerApi
{
    public function readOne(Request $request);

    public function readAll();
    public function create(Request $request);
    public function update(Request $request);

    public function delete(Request $request);

}
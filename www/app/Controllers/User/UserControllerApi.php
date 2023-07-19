<?php

namespace App\Controllers;

class UserControllerApi implements ControllerApi
{

    public function read(GetUserRequest $request)
    {
        $this->request = $request;
    }
    
    public function readAll(){
        
    }

    public function create(CreateUserRequest $request)
    {
        $this->request = $request;
        $user = new User($request->getData());
        $user->save();
    }

    public function update(UpdateUserRequest $request)
    {
        $this->request = $request;
    }

    public function delete(DeleteUserRequest $request)
    {
        $this->request = $request;
    }

}
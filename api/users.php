<?php
    class User{
        private $first_name;
        private $last_name;
        private $id_document;
        private $role;
    }

    public function __contructor($first_name, $last_name, $id_document, $role){
        $this->firt_name = $first_name;
        $this->last_name = $last_name;
        $this->id_document = $id_document;
        $this->role = $role;
    }

    public function createUser()
    {
        
    }

    public function listUser()
    {
        
    }

    public function updateUser()
    {
        
    }

    public function deleteUser()
    {
        
    }
?>
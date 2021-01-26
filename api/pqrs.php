<?php
    class PQR{
        private $type;
        private $case;
        private $user;
        private $state;
        private $create_date;
        private $limit_date;
    }

    public function __contructor($type, $case, $user, $state, $create_date, $limit_date){
        $this->type = $type;
        $this->case = $case;
        $this->user = $user;
        $this->state = $state;
        $this->create_date = $create_date;
        $this->limit_date = $limit_date;
    }

    public function createPQR()
    {
        
    }

    public function listPQR()
    {
        
    }

    public function updatePQR()
    {
        
    }

    public function deletePQR()
    {
        
    }
?>
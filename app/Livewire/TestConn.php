<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TestConn extends Component
{
    public $count = 0;
   public  function increment(){
        $this->count++;
    }
    public function test(){

        $this->dispatch('testConn','testEvent', ['message' => 'شغال بدون مشاكل']);
    }
    public function render()
    {
        return view('livewire.test-conn');
    }
}

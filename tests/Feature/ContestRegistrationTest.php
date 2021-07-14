<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Support\Facades\Event;
use App\Events\NewEntryReceivedEvent;
class ContestRegistrationTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    protected function setUp():void{
      parent::setUp();
      Event::fake([
        NewEntryReceivedEvent::class
      ]);
    }
    public function an_email_can_be_entered_into_the_contest()
    {
        $this->withoutExceptionHandling();
        $this->post('/contest',[
            'email'=>'abc@gmail.com'
        ]);

        $this->assertDatabaseCount('contest_entries',1);
    }

     /** @test */
    public function email_is_required()
    {
      
        $this->post('/contest',[
            'email'=>''
        ]);

        $this->assertDatabaseCount('contest_entries',0);
    }

     /** @test */
     public function email_needs_to_be_an_email()
     {
       
         $this->post('/contest',[
             'email'=>'test'
         ]);
 
         $this->assertDatabaseCount('contest_entries',0);
     }

   /** @test */ 
    public function an_event_is_fired_when_user_registers(){
     $this->post('/contest',[
         'email'=>'test@gmail.com'
     ]);
     Event::assertDispatched(NewEntryReceivedEvent::class);
    }
    /** @test */ 
    public function a_welcome_event_is_sent(){
        Event::fake([
            NewEntryReceivedEvent::class
            ]);
       $this->post('/contest',[
           'email'=>'abdelrahmangad95@gmail.com'
       ]); 
    }
}

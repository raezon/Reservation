<?php 
use yii\codeception\TestCase;
use app\tests\fixtures\GeneralInformationFormFixture;
use app\components\step1; 

class step1Test extends \Codeception\Test\Unit
{
    /**
     * @var \UnitTester
     */
    protected $tester;
    
    protected function _before()
    {
       
    }

    protected function _after()
    {
        
    }

    // tests

  
    
    // tests
    public function testSomeFeature()
    {  
        session_abort();
        $modelStep1 = new \app\models\forms\GeneralInformationForm();
        //assigning
        $modelStep1->id=370;
        $modelStep1->firstName='amar';
        $modelStep1->lastName='dje';
        $modelStep1->mobile='032432234';
        $modelStep1->email='amardje@gmail.com';
        $modelStep1->companyName='Hmida';
        $modelStep1->cat_id=1;
        $modelStep1->idi=1;
        $step1Mock= $this->createMock(step1::class)
      //  ->setMethods(array('send', 'sent'))
   //     ->getMock();
   ;
        // Configurer le bouchon.
        $step1Mock->method('save_partner_step1')
             ->willReturn('okey');
        //asigning data to 
        $category_id = 1;
        $user_id =370;
        $step1=new step1();
        $this->markTestSkipped('There is nobody to watch the baby');
     //   $this->assertEquals($step1Mock->save_partner_step1($modelStep1, $user_id, $category_id,true),'okey');
      //  $step1Mock->expectsOutputString('okey');
    //    ->method('save_partner_step1')
   //     ->with($this->equalTo('okey'));

      
       
    }
}
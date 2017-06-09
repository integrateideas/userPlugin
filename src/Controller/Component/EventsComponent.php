<?php
namespace Integrateideas\User\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Event\Event;
use Cake\Event\EventManager;

/**
 * Events component
 */
class EventsComponent extends Component
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    public function fireEvent($name, $data){
        $name = 'userPlugin.'.$name;
        $event = new Event($name, $this, [$data]);
		$eventManager = new EventManager();
		$eventManager->dispatch($event);
        if($event->getResult()){
            return $event->getResult();
        }else{
            return false;
        }
    }
}

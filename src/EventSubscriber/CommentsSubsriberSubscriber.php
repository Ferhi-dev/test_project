<?php

namespace App\EventSubscriber;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ResponseEvent;

class CommentsSubsriberSubscriber implements EventSubscriberInterface
{
  
    
    public static function getSubscribedEvents()
    {
        return [
            'kernel.response' => [['onCommentAdd']]
        ];
    }
  
  
    public function onCommentAdd(ResponseEvent $event)
    {
        // ...
    }

}

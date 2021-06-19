<?php


namespace App\Subscribers;
use App\Entity\Notes;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;

class NotesSubscriber implements  EventSubscriberInterface
{
    private Security $security;

    public function __construct(Security $security)
    {
        $this->security =$security;
    }

    public static function getSubscribedEvents()
    {
        // TODO: Implement getSubscribedEvents() method.
        return[
          BeforeEntityPersistedEvent::class => ['setUser']
        ];
    }

    public function setUser(BeforeEntityPersistedEvent  $event){
        $entity = $event->getEntityInstance();
        if($entity instanceof Notes){
            $entity->setAuteur($this->security->getUser());
        }
    }

}
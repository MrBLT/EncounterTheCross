<?php
/**
 *
 * @Author: bthrower
 * @CreateAt: 1/7/2019 12:34 PM
 * Project: EncounterTheCross
 * File Name: RegistrationController.php
 */

namespace App\Controller;


use App\Entity\Event;
use App\Entity\EventAttendee;
use App\Form\RegisterAttendeeFormType;
use App\Form\RegisterServerFormType;
use App\Repository\EventRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class RegistrationController
 * @package App\Controller
 */
class RegistrationController extends BaseController
{
    /**
     * Form to choose between server and attendee
     *
     * @Route("/register/{eventId}", name="register_type")
     * @param $eventId
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction($eventId)
    {
        // Show a form to choose between attendee or server
        return $this->render('event/attendee_server_form.html.twig',[
            'event_id' => $eventId
        ]);
    }

    /**
     * Register an attendee or server for an Event
     *
     * @Route("/register/{attendeeOrServer}/{eventId}", name="register")
     * @param $attendeeOrServer
     * @param $eventId
     * @param EntityManagerInterface $em
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registerAction($attendeeOrServer,$eventId, EntityManagerInterface $em, Request $request, EventRepository $eventRepository)
    {
        /** @var Event|null $event */
        $event = $eventRepository->findOneByID($eventId);

        if($event === null){
            throw $this->createNotFoundException('Event Not Found');
        }

        switch ($attendeeOrServer) {
            case 'attendee':
                //TODO: attendee registration form
                $attendeeForm = $this->createForm(RegisterAttendeeFormType::class);

                $attendeeForm->handleRequest($request);

                if($attendeeForm->isSubmitted() && $attendeeForm->isValid()){
                    /** @var EventAttendee $attendee */
                    $attendee = $attendeeForm->getData();
                    $attendee->setEvent($event);
                    $em->persist($attendee);
                    $em->flush();

                    $this->addFlash('success', 'Registration Successful!');

                    return $this->redirectToRoute('payment', [
                        'attendeeId' => $attendee->getId()
                        ]
                    );
                }

                return $this->render('event/register_attendee.html.twig',[
                    'event_id' => $eventId,
                    'form' => $attendeeForm->createView()
                ]);
                break;
            case 'server':
                $serverForm = $this->createForm(RegisterServerFormType::class);

                $serverForm->handleRequest($request);
                //TODO: server registration form
                return $this->render('event/register_server.html.twig',[
                    'event_id' => $eventId,
                    'form' => $serverForm->createView()
                ]);
                break;
            default:
                throw $this->createNotFoundException();
        }
    }
}

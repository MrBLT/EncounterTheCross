<?php

namespace App\Controller;

use App\Entity\Event;
use App\Entity\EventAttendee;
use App\Model\StripeClient;
use App\Repository\EventAttendeeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class PaymentController
 * @package App\Controller
 * @Route("/payment", schemes={"%secure_channel%"})
 */
class PaymentController extends AbstractController
{
    /**
     * @var StripeClient
     */
    private $stripeClient;
    /**
     * @var EventAttendeeRepository
     */
    private $attendeeRepository;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * PaymentController constructor.
     * @param StripeClient $stripeClient
     */
    public function __construct(StripeClient $stripeClient, EventAttendeeRepository $attendeeRepository, EntityManagerInterface $em)
    {
        $this->stripeClient = $stripeClient;
        $this->attendeeRepository = $attendeeRepository;
        $this->em = $em;
    }


    /**
     * @Route("/{attendeeId}", name="payment")
     */
    public function index($attendeeId)
    {
        /** @var EventAttendee $attendee */
        $attendee = $this->attendeeRepository->findOneByID($attendeeId);
        if($attendee === null){
            throw $this->createNotFoundException();
        }

        /** @var Event $event */
        $event = $attendee->getEvent();
        if($event === null){
            throw $this->createNotFoundException();
        }

        if($attendee->isPaid()){
            $this->addFlash('notice', 'You have already paid!');
            $this->redirectToRoute('app_homepage');
        }

        return $this->render('payment/index.html.twig', [
            'controller_name' => 'PaymentController',
            'attendee' => $attendee,
            'event' => $event
        ]);
    }

    /**
     * @Route("/submit/{attendeeId}", name="payment_submit", methods={"POST"})
     */
    public function submitPayment($attendeeId, Request $request)
    {
        $paymentToken = $request->get('stripeToken');
        if($paymentToken === null){
            throw $this->createNotFoundException();
        }

        /** @var EventAttendee $attendee */
        $attendee = $this->attendeeRepository->findOneByID($attendeeId);
        if($attendee === null){
            throw $this->createNotFoundException();
        }

        $attendee->setPaymentMethod('Pay With Card');

        $chargeAmount = 12893;


        $transactionResult = $this->stripeClient->createChargeUsd($chargeAmount,$paymentToken);

        return $this->render('payment/success.html.twig', [
            'controller_name' => 'PaymentController',
            'transaction_result' => $transactionResult
        ]);
    }

    /**
     * @Route("/submit/later/{attendeeId}", name="payment_later", methods={"POST"})
     */
    public function submitPaymentLater($attendeeId, Request $request)
    {
        /** @var EventAttendee $attendee */
        $attendee = $this->attendeeRepository->findOneByID($attendeeId);
        if($attendee === null){
            throw $this->createNotFoundException();
        }

        $attendee->setPaymentMethod('Pay Later');

        $this->em->persist($attendee);
        $this->em->flush();

        return $this->render('payment/thank_you.html.twig', [
            'controller_name' => 'PaymentController'
        ]);
    }

}

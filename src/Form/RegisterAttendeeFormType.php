<?php
/**
 *
 * @Author: bthrower
 * @CreateAt: 1/7/2019 1:12 PM
 * Project: EncounterTheCross
 * File Name: RegisterAttendeeFormType.php
 */

namespace App\Form;


use App\Entity\Event;
use App\Entity\EventAttendee;
use App\Entity\LaunchPoint;
use App\Repository\LaunchPointRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterAttendeeFormType extends PersonFormType
{

    /**
     * @var LaunchPointRepository
     */
    private $launchPointRepository;

    public function __construct(LaunchPointRepository $launchPointRepository)
    {
        $this->launchPointRepository = $launchPointRepository;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $thisBuilder = &$builder;

        parent::buildForm($thisBuilder, $options);

        $builder
            ->add('contactPerson', null, [
                'help' => 'We would like to speak to your spouse, a member of your family, or a friend 2 weeks prior to the encounter to ask them to pray for and encourage you. Please provide one contact.'
            ])
            ->add('contactPersonRelationship', ChoiceType::class, [
                'choices' => [
                    'Spouse' => 'Spouse',
                    'Mother' => 'Mother',
                    'Father' => 'Father',
                    'Other Family Member' => 'OtherFamilyMember',
                    'Friend' => 'Friend',
                    ],
                'placeholder'=>'Choose One'
            ])
            ->add('contactPersonPhone')
            ->add('church', null, [
                'help' => 'What church do you attend, if any?'
            ])
            ->add('invitedBy')
            ->add('questionsOrComments')
            ->add('concerns')
            ->add('launchPoint', EntityType::class, [
                'class' => LaunchPoint::class,
                'placeholder' => 'Choose a Launch Point',
                'choices' => $this->launchPointRepository->findAllOrderedByASC(['state','city','name'])

            ])
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EventAttendee::class
        ]);
    }
}

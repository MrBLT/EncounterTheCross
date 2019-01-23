<?php
/**
 *
 * @Author: bthrower
 * @CreateAt: 1/7/2019 1:15 PM
 * Project: EncounterTheCross
 * File Name: PersonFormType.php
 */

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class PersonFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName')
            ->add('lastName')
            ->add('email')
            ->add('phone')
            ->add('address')
            ->add('address2')
            ->add('city')
            ->add('state')
            ->add('zipcode')
            ;
    }

}

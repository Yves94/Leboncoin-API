<?php

namespace App\Form;

use App\Entity\Announcement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormInterface;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AnnouncementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('category', ChoiceType::class, [
                'placeholder' => 'Choose an option',
                'choices' => [
                    'job' => 0,
                    'vehicle' => 1,
                    'realEstate' => 2
                ],
                'mapped' => false
            ])
        ;

        $formModifier = function (FormInterface $form, $announcementType = null) {

            if ($announcementType === 0) {
                $form->add('job', JobType::class);
            } else if ($announcementType === 1) {
                $form->add('vehicle', VehicleType::class);
            } else if ($announcementType === 2) {
                $form->add('realEstate', RealEstateType::class);
            }

        };

        $builder->addEventListener(
            FormEvents::PRE_SET_DATA,
            function (FormEvent $event) use ($formModifier) {

                $data = $event->getData();

                $formModifier($event->getForm());
            }
        );

        $builder->get('category')->addEventListener(
            FormEvents::POST_SUBMIT,
            function (FormEvent $event) use ($formModifier) {
                
                $announcementType = $event->getForm()->getData();
                $formModifier($event->getForm()->getParent(), $announcementType);
            }
        );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Announcement::class,
        ]);
    }

}

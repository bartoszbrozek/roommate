<?php

namespace AppBundle\Form;

use AppBundle\Entity\Priority;
use AppBundle\Entity\Status;
use AppBundle\Entity\User;
use AppBundle\Entity\Task;
use DateTime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TaskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class)
            ->add('description', TextareaType::class)
            ->add('dueDate', DateTimeType::class, [
                    'widget' => 'single_text',
                    'required' => true,
                    'data' => new DateTime()
                ]
            )
            ->add('priority', EntityType::class, [
                'class' => Priority::class,
                'choice_label' => 'value'
            ])
            ->add('status', EntityType::class, [
                'class' => Status::class,
                'choice_label' => 'value'
            ])
            ->add('users', EntityType::class, [
                'class' => User::class,
                'multiple' => true,
                'expanded' => true,
                'required' => true
            ])
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
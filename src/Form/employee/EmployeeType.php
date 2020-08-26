<?php


namespace App\Form\employee;


use App\Entity\Employee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EmployeeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add(
                'nameSurname',
                TextType::class,
                [
                    'label' => 'Name Surname',
                    'label_attr' => [
                        'class' =>'col-sm-2 control-label'
                    ],
                    'attr' => [
                        'class' =>'col-lg-6 col-md-6 col-sm-6'
                    ],
                ]
            )
            ->add(
                'workPerHour',
                IntegerType::class,
                [
                    'label' => 'Work Per Hour',
                    'label_attr' => [
                        'class' =>'col-sm-2 control-label'
                    ],
                    'attr' => [
                        'class' =>'col-lg-6 col-md-6 col-sm-6'
                    ],
                ]
            )
            ->add(
                'save',
                SubmitType::class,
                [
                    'attr' => [
                        'class' =>'btn btn-primary'
                    ],
                ]
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Employee::class
        ]);
    }
}
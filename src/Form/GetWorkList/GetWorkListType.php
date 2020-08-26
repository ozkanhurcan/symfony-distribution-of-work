<?php


namespace App\Form\GetWorkList;


use App\Entity\Works;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GetWorkListType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'title',
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
                'level',
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
                'estimatedDuration',
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
            'data_class' => Works::class
        ]);
    }
}
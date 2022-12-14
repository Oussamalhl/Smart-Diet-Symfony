<?php

namespace App\Form;

use App\Entity\Reclamation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ReclamationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description',TextareaType::class,[
                'label'=>'description',
                'attr'=>['placeholder'=>'description'
                ]
            ])
            ->add('typereclamation',ChoiceType::class,[
                'label'=>'type reclamation',
                'choices'  => [
                    'Produit' => null,
                    'Livraison' => true,
                    'Nutritionniste' => false,
                ],
            ])
            ->add('idpersonne')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reclamation::class,
        ]);
    }
}

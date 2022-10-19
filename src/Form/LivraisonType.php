<?php

namespace App\Form;

use App\Entity\Livraison;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LivraisonType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('etatlivraison',TextType::class,[
                'label'=>'etat livraison',
                'attr'=>['placeholder'=>'Donner etat','class'=>'etatlivraison'
                ]
            ])

            ->add('datelivraison',TextType::class,[
        'label'=>'date livraison',
        'attr'=>['placeholder'=>'Donner id de payment','class'=>'datelivraison'
        ]
    ])
            ->add('idlivreur')
            ->add('idpayment')
            ->add('idcommande')
           /* ->add('idlivreur',TextType::class,[
        'label'=>'id livreur',
        'attr'=>['placeholder'=>'Donner id de payment','class'=>'idlivreur'
        ]
    ])*/
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Livraison::class,
        ]);
    }
}

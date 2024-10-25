<?php

namespace App\Form;

use App\Entity\Cgv;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CgvType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titel', TextType::class,[
                'label' => ' Titre de  l\'article'
            ])
            ->add('content',CKEditorType::class,[

                'attr' =>['placeholder' => "Contenu de l'article"],
                'label' => ' l\'article',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}

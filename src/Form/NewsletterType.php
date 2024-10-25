<?php

namespace App\Form;

use App\Entity\Newsletter;


use App\Entity\NesletterCategorie;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class NewsletterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class)
            ->add('content',CKEditorType::class,[

                'attr' =>['placeholder' => "Contenu de l'article"],
                'label' => ' l\'article',
            ])
           // ->add('createdAt')
           // ->add('is_sent')
         ->add('catNews',EntityType::class, [
            'class' => NesletterCategorie::class,
             'choice_label' => 'name',
             'required' =>false,
             'attr' => [
                 'class' => 'select2'
             ]
          
         
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Newsletter::class,
        ]);
    }
}

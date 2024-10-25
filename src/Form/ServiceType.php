<?php

namespace App\Form;

use App\Entity\Service;
use Symfony\Component\Form\AbstractType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class ServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('titel', TextType::class,[
            'label' => ' Titre de  l\'article'
        ])
      
           ->add('contenu',CKEditorType::class,[

            'attr' =>['placeholder' => "Contenu de l'article"],
            'label' => ' l\'article',
        ])
        ->add('image', FileType::class, [
            'label' => ' Image d\'en-tête  de votre article',
       // 'multiple' => true,
        'required' => false,
        'mapped' => false,
             'constraints' => [
        new File([
                     'maxSize' => '1048576K',
                 'mimeTypes' => [
                         'image/jpeg',
                          'image/png',
                       
                      ],
                      'mimeTypesMessage' => 'Please upload a valid image ',
                  ])
              ],
         ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Service::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Category;
use App\Form\Type\PriceType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom du produit',
                'attr' => [
                    'placeholder' => 'tapez le nom du produit'
                ],
            ])
            ->add('shortDescription', TextareaType::class, [
                'label' => 'Description courte',
                'attr' => [
                    'placeholder' => 'Tapez une description assez courte mais parlante pour le visiteur'
                ]
            ])
            ->add('price', PriceType::class, [
                'label' => 'Prix du produit',
                'attr' => [
                    'placeholder' => 'Tapez le prix du produit en €'
                ],
                // 'divisor' => 100
            ])
            ->add('mainPicture', UrlType::class, [
                'label' => 'Image du produit',
                'attr' => ['placeholder' => 'Tapez une URL d\'une image']
            ])
            ->add('category', EntityType::class, [
                    'label' => 'Catégorie',
                    'placeholder' => '-- Choisir une catégorie --',
                    'class' => Category::class,
                    // Nom de la propriété de la category + option maj de l'affichage
                    'choice_label' => function(Category $category) {
                        return strtoupper($category->getName());
                    }
                ]);

        // Dans ce cas, nous voulons que notre formulaire affiche le prix entier
        // Mais qu'il le retourne avec les cts dans la bdd
        // La class callbacktransformer prends en paramètres deux fonctions
        // 1) Une fonction qui transforme la donnée
        // 2) Reverse transforme = Ce qu'elle doit retournée
        // $builder->get('price')->addModelTransformer(new CentimesTransformer);
        
        // $builder->addEventListener(FormEvents::POST_SUBMIT, function(FormEvent $event) {
        //     $product = $event->getData();

        //     if($product->getPrice() !== null) {
        //         $product->setPrice($product->getPrice() *100);
        //     }
        // });

        // $builder->addEventListener(FormEvents::PRE_SET_DATA, function(FormEvent $event) {
        //     $form = $event->getForm();

        //     /** @Var Product */
        //     $product = $event->getData();

        //     // Permet d'afficher le prix entier
        //     if($product->getPrice() !== null)
        //     {
        //     $product->setPrice($product->getPrice() /100);
        //     }


        //     if($product->getId() === null) {
        //         $form->add('category', EntityType::class, [
        //             'label' => 'Catégorie',
        //             'placeholder' => '-- Choisir une catégorie --',
        //             'class' => Category::class,
        //             // Nom de la propriété de la category + option maj de l'affichage
        //             'choice_label' => function(Category $category) {
        //                 return strtoupper($category->getName());
        //             }
        //         ]);
        //     }
    //     });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}

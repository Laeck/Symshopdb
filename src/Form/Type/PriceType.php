<?php

namespace App\Form\Type;

use App\Form\DataTransformer\CentimesTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;

class PriceType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if($options['divide'] === false) {
            return;
        }

        $builder->addModelTransformer(new CentimesTransformer);
    }

    // On informe à symfo que notre champs "s'inspire" du champ NumberType.
    // Et hériter des options de bases
    public function getParent()
    {
        return NumberType::class;
    }

    // Permet de définir les nouvelles options de mon champs price
    public function configureOptions(OptionsResolver $resolver)
    {
        // Par défaut, on dit qu'il faudra diviser
        $resolver->setDefaults([
            'divide' => true
        ]);
    }
}
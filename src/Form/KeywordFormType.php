<?php 

namespace App\Form;

use Doctrine\DBAL\Types\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Test\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class KeywordFormType extends AbstractType
{
    public function builForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('keyword', TextType::class )
            ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
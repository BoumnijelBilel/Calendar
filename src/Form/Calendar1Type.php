<?php

namespace App\Form;

use App\Entity\Calendar;
use phpDocumentor\Reflection\Type;
use Symfony\Component\Form\{AbstractType,
    ChoiceList\ChoiceList,
    Extension\Core\Type\ChoiceType,
    Extension\Core\Type\TextType,
    FormBuilderInterface};
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;



class Calendar1Type extends AbstractType
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('title')
            ->add('start')
            ->add('end')
            ->add('description')
            ->add('all_day')
            ->add('background_color')
            ->add('border_color')
            ->add('text_color')
            ->add('calendar_user', EntityType::class,[
            'class' => User::class,
            'choice_label' => 'username',
            'choices' => [$this->security->getUser()]
    ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Calendar::class,
        ]);
    }
}

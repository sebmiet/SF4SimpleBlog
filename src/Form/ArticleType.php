<?php
/**
 * Created by PhpStorm.
 * User: sebmiet
 * Date: 30.04.18
 * Time: 04:40
 */

namespace App\Form;


use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, array("label" => "Tytuł"))
            ->add('subtitle', TextType::class, array("label" => "Podtytuł"))
            ->add('postdate', DateType::class, array("label" => "Data utworzenia wpisu"))
            ->add('author', TextType::class, array("label" => "Autor artykułu"))
            ->add('content', TextareaType::class, array("label" => "Artykuł / Post"))
            ->add('submit', SubmitType::class, array("label" => "Zapisz",
                                                                "attr" => ['class' => 'btn btn-default pull-right']))
            ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}
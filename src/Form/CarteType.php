<?php

namespace App\Form;

use App\Entity\Pate;
use App\Entity\Pizza;
use App\Entity\Ingredient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class CarteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('ingredient')
		  ->add('pate', EntityType::class, [
			"class"=>Pate::class,
			'choice_label' => 'consistance',
			])
		->add('ingredients', EntityType::class, [
			"class"=>Ingredient::class,
			'choice_label' => 'nom',
			'multiple'=>true,
			'expanded'=>true,
			])
		->add('imageFile', FileType::class, [
			"required" =>false,
			"mapped"=>true,
			"constraints"=>[
				new File([
					'maxSize'=>"2M",
					"mimeTypes"=>[
						"image/jpeg",
						"image/png",
						"image/gif",
					],
					"mimeTypesMessage"=>"Veuillez télécharger une image valide (.jpeg, .png ou .gif)",
				])
			],
		]);
	}
    

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pizza::class,
        ]);
    }
}


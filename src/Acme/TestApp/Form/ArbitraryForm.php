<?php

namespace Acme\TestApp\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ArbitraryForm extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('name', 'text', array('required' => false,
				'label' => "Имя"))
			->add('famname', 'text', array('required' => false,
				'label' => "Фамилия"))
			->add('send', 'submit');
	}

	public function getName()
	{
		return 'AForm';
	}
}

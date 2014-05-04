<?php

namespace Acme\TestApp\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Acme\TestApp\Form\ArbitraryForm;

class MainController extends Controller
{
	public $form;

	public function indexAction()
    {
        return $this->render('AcmeTestApp:Main:index.html.twig');
    }

    public function showformAction()
    {

		// 	Рабочий вариант с созданием формы прямо в контроллере
		
		/*	$form = $this->createFormBuilder()
			->setAction($this->generateUrl('_email_process'))
			->setMethod('POST')			
			->add('name', 'text', array('required' => false,
				'label' => "Имя"))
			->add('famname', 'text', array('required' => false,
					'label' => "Фамилия"))
			->add('send', 'submit')
			->getForm();
		*/			
	
		$form = $this->createForm(new ArbitraryForm(), null, array(
				'action' => $this->generateUrl('_email_process'),
				'method' => 'POST')
				);
		
		return $this->render('AcmeTestApp:Main:table.html.twig', array(
						'form' => $form->createView()
						)
				);
    }
	
	public function processAction()
	{
		$params = (array)$this->getRequest()->get('AForm');

		$message = \Swift_Message::newInstance()
			->setSubject('Тестовое сообщение')
			->setFrom('massa-alex@mail.ru')
			->setTo('surplus@list.ru')
			->setContentType('text/html')
			->setBody($this->renderView(
				'AcmeTestApp:Main:email.html.twig',
					array('bodytext' => "Если вам в руки попало это письмо, сожгите его...\n",
						'params' => $params)
			));
		
		if (!$this->get('mailer')->send($message)) 
			{
				$sendResult = 'Письмо отправить не удалось!';
			}
		else
			{
				$sendResult = 'Письмо успешно отправлено!';
			}		
		return $this->render('AcmeTestApp:Main:final.html.twig', array(
					'sendResult' => $sendResult));
	}
}
					


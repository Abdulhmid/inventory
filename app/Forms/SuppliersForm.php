<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class SuppliersForm extends Form
{
    public function buildForm()
    {
      $this
    		->add('name_company','text')
        ->add('handphone','text')
    		->add('telp','text')
    		->add('email','text')
        ->add('website','text')
    		->add('active','choice',[
			'choices' 		=> [1 => 'Active', 0 => 'Not Active'],
			'label'			=> "Status",
			'expanded' 		=> true,
            'multiple'      => false,
      		'choice_options' => [
        		'wrapper' => [
        			'class' => 'choice-wrapper'
        		]
		 	     ]
	        ])
  		->add('photo','file',[
              'attr' => [
                  'id' => 'file',
                  'onchange' => 'readUrl(this)'
              ]
          ])
      ->add('upload','button',[
          'label' => '<i class="fa fa-upload"></i> Browse',
          'attr' => [
              'class' => 'form-control btn bg-gray',
              'onclick' => 'chooseFile()'
          ]
      ])
      ->add('address','textarea');

    }
}

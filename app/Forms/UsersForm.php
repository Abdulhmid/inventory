<?php namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class UsersForm extends Form
{
    public function buildForm()
    {
    	$this
    		->add('username','text')
            ->add('name','text')
    		->add('email','text')
    		->add('password','password')
    		->add('password_confirmation','password')
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
	        ->add('group_id', 'select', [
	            'attr' => ['class' => 'frm-e form-control'],
	            'choices' => \App\Models\Groups::lists("group_name", "group_id")->toArray(),
	            'empty_value' => '- Select Groups-',
	            'label' => 'Groups'
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
            ]);
    }
}
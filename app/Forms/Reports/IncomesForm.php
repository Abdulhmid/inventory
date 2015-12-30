<?php namespace App\Forms\Reports;

use Kris\LaravelFormBuilder\Form;

class IncomesForm extends Form
{
    public function buildForm()
    {
    	$this
        ->add('bank_id', 'select', [
            'attr' => ['class' => 'frm-e form-control'/*,'required' => 'true'*/],
            'choices' => \App\Models\Banks::lists("name", "id")->toArray(),
            'empty_value' => '- Select Banks -',
            'label' => 'Bank'
        ])
        ->add('area_id', 'select', [
            'attr' => ['class' => 'frm-e form-control'/*,'required' => 'true'*/],
            'choices' => \App\Models\Areas::lists("name_area", "id")->toArray(),
            'empty_value' => '- Select Area-',
            'label' => 'Area'
        ])
        ->add('location_id', 'select', [
            'attr' => ['class' => 'frm-e form-control'/*,'required' => 'true'*/],
            'choices' => \App\Models\Locations::lists("name", "id")->toArray(),
            'empty_value' => '- Select Lokasi-',
            'label' => 'Lokasi'
        ])
        ->add('machine_id', 'select', [
            'attr' => ['class' => 'frm-e form-control'/*,'required' => 'true'*/],
            'choices' => \App\Models\Machines::lists("name_machine", "id")->toArray(),
            'empty_value' => '- Pilih Mesin -',
            'label' => 'Mesin'
        ])
        ->add('from', 'text',
            [
                'attr' => ['class' => 'form-control datepicker1','required' => 'true']
            ]
        )
        ->add('to', 'text',
            [
                'attr' => ['class' => 'form-control datepicker2','required' => 'true']
            ]
        )
		->add('format','choice',[
			'choices' 		=> ['pdf' => 'PDF', 'csv' => 'CSV', 'xls' => 'XLS'],
            'attr'          => ['required' => 'true'],
			'label'			=> "Format",
	  		'choice_options' => [ 
	    		'wrapper' => [
	    			'class' => 'choice-wrapper'
	    		] 
		 	     ]
        ]);
    }
}
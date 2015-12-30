<?php namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class GroupsForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('group_name', 'text',
                [
                    'attr' => ['class' => 'form-control']
                ]
            )
            ->add('order', 'number',
                [
                    'attr' => ['class' => 'form-control','min' => 0,'style' => 'display : none', 'hidden'],
                    'label' => false
                ]
            )
            ->add('description', 'textarea',
                [
                    'attr' => ['class' => 'wysihtml52 form-control']
                ]
            );
    }
}
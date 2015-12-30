<?php namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ItemsCategoryForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name_category', 'text',
                [
                    'attr' => ['class' => 'form-control']
                ]
            )
            ->add('description', 'textarea',
                [
                    'attr' => ['class' => 'wysihtml52 form-control']
                ]
            );
    }
}

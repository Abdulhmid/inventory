<?php

namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class ItemsForm extends Form
{
    public function buildForm()
    {
    	$this
			->add('supplier_id', 'select', [
				'empty_value' => '- Pilih Supplier -',
				'choices' => \App\Models\Suppliers::lists('name_company','supplier_id')->toArray(),
				'label' => 'Supplier',
				'attr' => ['id' => 'supplier_id']
			])
			->add('category_id', 'select', [
				'empty_value' => '- Pilih Kategori -',
				'choices' => \App\Models\ItemsCategory::lists('name_category','item_category_id')->toArray(),
				'label' => 'Kategori Barang',
				'attr' => ['id' => 'category_id']
			])
			->add('name_items','text')
			->add('price_buy', 'number',[
				'default_value' => 0,
				'attr' => ['min' => 0],
				'label' => 'Harga Beli'
			])
			->add('price_selling', 'number',[
				'default_value' => 0,
				'attr' => ['min' => 0],
				'label' => 'Harga Jual'
			])
			->add('stok', 'number',[
				'default_value' => 0,
				'attr' => ['min' => 0,'readonly' => 'true'],
				'label' => 'Stok'
			])
			->add('note', 'textarea');
    }
}

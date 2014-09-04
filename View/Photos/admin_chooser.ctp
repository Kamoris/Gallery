<?php

$this->extend('/Common/admin_index');

$this->set('showActions', false);

$this->append('table-heading');
	$tableHeaders = $this->Html->tableHeaders(array(
		$this->Paginator->sort('id'),
		$this->Paginator->sort('small', __d('gallery', 'Preview')),
		$this->Paginator->sort('description', __d('gallery', 'Description')),
		$this->Paginator->sort('url', __d('gallery', 'url')),
		__d('gallery', 'Actions'),
	));
	echo $tableHeaders;
$this->end();

$this->append('table-body');
	$rows = array();
	foreach ($photos as $attachment):
		$actions = array();
		$actions[] = $this->Croogo->adminRowAction(__d('gallery', 'Choose'), '#', array(
			'class' => 'item-choose',
			'data-chooser_type' => 'Photo',
			'data-chooser_id' => $attachment['Photo']['id'],
			'data-chooser_small' => $attachment['Photo']['small'],
			'data-chooser_large' => $attachment['Photo']['large'],
			'data-chooser_original' => $attachment['Photo']['original'],
		));
		$actions[] = $this->Croogo->adminRowActions($attachment['Photo']['id']);

		$thumbnail = $this->Html->thumbnail(
			'/' . $attachment['Photo']['small']
		);

		$rows[] = array(
			$attachment['Photo']['id'],
			$thumbnail,
			$this->Text->truncate(strip_tags($attachment['Photo']['description']), 30),
			$attachment['Photo']['url'],
			implode(' ', $actions),
		);
	endforeach;

	echo $this->Html->tableCells($rows);
$this->end('table-body');

$this->append('table-footer', $tableHeaders);

<?php

$this->extend('/Common/admin_edit');

$this->Html
	->addCrumb('', '/admin', array('icon' => 'home'))
	->addCrumb('Gallery')
	->addCrumb(__d('gallery', 'Albums'), array('admin' => true, 'plugin' => 'gallery', 'controller' => 'albums', 'action' => 'index'));

if (empty($this->data['Album']['title'])) {
	$this->Html->addCrumb(__d('gallery', 'Add'), $this->here);
} else {
	$this->Html->addCrumb($this->data['Album']['title'], $this->here);
}
?>

<?php $this->start('actions'); ?>
	<?php
	if (!empty($this->data['Album']['title'])):
		echo $this->Html->link(__d('gallery','Photos'),
			array('action'=>'upload', $this->data['Album']['id']),
			array('button' => 'default', 'tooltip' => array(
				'title' => __d('gallery', 'Manage/upload photos for this album'),
				'data-placement' => 'right',
			))
		);
	endif;
	?>
<?php $this->end(); ?>

<?php echo $this->Form->create('Album');?>

<div class="row-fluid">
	<div class="span8">

		<ul class="nav nav-tabs">
			<li><a href="#album-main" data-toggle="tab"><?php echo __d('gallery', 'Album'); ?></a></li>
			<li><a href="#album-settings" data-toggle="tab"><?php echo __d('gallery', 'Settings'); ?></a></li>
			<?php echo $this->Croogo->adminTabs(); ?>
		</ul>

		<div class="tab-content">
			<div id='album-main' class="tab-pane">
			<?php
				$this->Form->inputDefaults(array(
					'class' => 'span10',
				));
				echo $this->Form->input('id');
				echo $this->Form->input('title', array(
					'placeholder' => __d('gallery', 'Title')
				));
				echo $this->Form->input('slug', array(
					'placeholder' => __d('gallery', 'Slug'),
				));
				echo $this->Form->input('description', array(
					'placeholder' => __d('gallery', 'Description'),
				));
				echo $this->Form->input('type', array(
					'placeholder' => __d('gallery', 'Type'),
					'empty' => true,
					'default' => key($types),
				));
			?>
			</div>

			<div id='album-settings' class="tab-pane">
			<?php
				echo $this->Form->input('quality', array(
					'placeholder' => __d('gallery', 'Quality'),
				));
				echo $this->Form->input('max_width', array(
					'placeholder' => __d('gallery', 'Max. width'),
				));
				echo $this->Form->input('max_height', array(
					'placeholder' => __d('gallery', 'Max. height'),
				));
				echo $this->Form->input('max_width_thumbnail', array(
					'placeholder' => __d('gallery', 'Max. thumbnail width'),
				));
				echo $this->Form->input('max_height_thumbnail', array(
					'placeholder' => __d('gallery', 'Max. thumbnail height'),
				));
				echo $this->Form->input('params', array(
					'placeholder' => __d('gallery', 'Parameters'),
				));
			?>
			</div>

		</div>
	</div>

	<div class="span4">
	<?php
		echo $this->Html->beginBox(__d('gallery', 'Publishing')) .
			$this->Form->button(__d('gallery', 'Apply'), array('name' => 'apply', 'button' => 'default')) .
			$this->Form->button(__d('gallery', 'Save'), array('button' => 'success')) .
			$this->Html->link(__d('gallery', 'Cancel'), array('action' => 'index'), array('class' => 'cancel btn btn-danger')) .

			$this->Form->input('status', array(
				'legend' => false,
				'type' => 'radio',
				'class' => false,
				'default' => CroogoStatus::UNPUBLISHED,
				'options' => $this->Croogo->statuses(),
			)) .

			$this->Form->input('created', array(
				'type' => 'text',
				'class' => 'span10 input-datetime',
			)) .

			$this->Html->div('input-daterange',
				$this->Form->input('publish_start', array(
					'label' => __d('croogo', 'Publish Start'),
					'type' => 'text',
				)) .
				$this->Form->input('publish_end', array(
					'label' => __d('croogo', 'Publish End'),
					'type' => 'text',
				))
			);

		echo $this->Html->endBox();

		echo $this->Croogo->adminBoxes();
	?>
	</div>
</div>
<?php echo $this->Form->end(); ?>
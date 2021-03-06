<?php

App::uses('AppHelper', 'View/Helper');

class JqueryKenburnHelper extends AppHelper {

	public $helpers = array(
		'Html',
		'Js',
		'Gallery.Gallery',
		);

	public function assets($options = array()) {
	}

	public function album($album, $photos) {
		$galleryId = 'gallery' . Inflector::camelize($album['Album']['slug']);
		$result = $this->Html->div($galleryId . ' ' . 'peNojd', $photos, array(
			'id' => $galleryId,
			'data-autopause' => 'none',
			'data-controls' => 'hideOnFirst',
			'data-mode' => 'kb',
			'data-shadow' => 'enabled',
			'data-logo' => 'disable',
			)
		);
		return $result;
	}

	public function photo($album, $photo) {
		$options = array(
			'data-delay' => 5,
			'data-duration' => 3,
			'data-zoom' => 'in',
			'data-align' => 'center, center',
			'data-pan' => 'center, center',
		);

		$imgTag = $this->Html->image('/' . $this->base . $photo['original'], array(
			'alt' => 'img',
			'style' => 'width:950px; background:transparent;'
		));

		$results = $this->Html->div('peKb_active', $imgTag, $options);
		return $results;
	}

	public function initialize($album) {
		$config = $this->Gallery->getAlbumJsParams($album);
		$galleryId = 'gallery' . Inflector::camelize($album['Album']['slug']);
		$js = sprintf('$(\'#%s\').peKenburnsSlider();', $galleryId);

		$js = str_replace('"' . $galleryId . '"', $galleryId, $js);
		$this->Js->buffer($js);
	}

}

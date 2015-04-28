<?php namespace PaperClip\Support\Validation;

$validators = array(
	'language' => array(
		'update' => array(
			array(
				'id' 			=> $id,
				'language' 		=> Input::get('language'),
				'abbreviation' 	=> Input::get('abbreviation'),
				),
			array(
				'id' 			=> Government::regulation('language.id'),
				'language' 		=> Government::regulation('language.update.language', array($id)),
				'abbreviation' 	=> Government::regulation('language.update.abbreviation', array($id)),
				)
			),
		'store' => array(
			array(
				'language' 		=> Input::get('language'),
				'abbreviation' 	=> Input::get('abbreviation'),
				),
			array(
				'language' 		=> Government::regulation('language.language'),
				'abbreviation' 	=> Government::regulation('language.abbreviation'),
				)
			)
		)
	);

return array_dot(array_dot($validators));
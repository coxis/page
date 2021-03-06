<?php
namespace App\Page\Entities;

class Page extends \Asgard\Core\Entity {
	public static $properties = array(
		'title',
		'content'	=>	array(
			'type'	=>	'longtext',
		),
		'name',
		'url'	=> array(
			'required'	=>	false,
		),
	);

	public static $relations = array(	
		// 'menuitem' => array(
		// 	'as'	=>	'menuitemable',
		// 	'type'	=>	'hasMany',
		// 	'entity'	=>	'App\Menu\Entities\Menuitem',
		// ),
	);
	
	public static $behaviors = array(	
		'Asgard\Behaviors\MetasBehavior',
		'Asgard\Behaviors\PublishBehavior',
		'Asgard\Orm\ORMBehavior',
	);
		
	public static $meta = array(
	);
	
	public function __toString() {
		return (string)$this->title;
	}

	public function url() {
		return \Asgard\Core\App::get('url')->url_for(array('page', 'show'), array('url'=>$this->url));
	}

	public function replaceTags($tags) {
		foreach($tags as $name=>$replace) {
			$this->content = str_replace('{{'.$name.'}}', $replace, $this->content);
		}
	}
}
<?php namespace Rugosa;

class Collection {

	protected array $items = [];

	public function add($item) {
		$firstItem = reset($this->items);
		if (!$item->name) {
			trigger_error("Collection->add: Item name cannot be empty.");
		} elseif (isset($this->items[$item->name])) {
			trigger_error("Collection->add: Item '{$item->name}' is already present in Collection.");
			return false;
		} elseif (!$firstItem || get_class($item) === get_class($firstItem)) {
			$this->items[$item->name] = $item;
			return true;
		} else {
			trigger_error("Collection->add: Items added to this Collection must be instance of " . get_class($firstItem) . ". This is determined by the first item added to the Collection.");
			return false;
		}
	}
	
	public function remove($name) {
		if (array_key_exists($name, $this->items)) {
			unset($this->items[$name]);
			return true;
		} else {
			trigger_error("Item '{$index}' does not exist in Collection.");
			return false;
		}
	}

	public function __get($name) {
		return $this->$name ?? null;
	}
}

?>
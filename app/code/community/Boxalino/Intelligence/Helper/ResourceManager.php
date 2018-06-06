<?php

/**
 * Class Boxalino_Intelligence_Helper_ResourceManager
 */
class Boxalino_Intelligence_Helper_ResourceManager{

    /**
     * @var array
     */
    protected $resource = array();

    /**
     * @var array
     */
    protected $types = array('collection', 'product');

    public function __construct()
    {
        $this->initResource();
    }

    protected function initResource() {
        foreach ($this->types as $type) {
            $this->resource[$type] = array();
        }
    }

    public function getResource($id, $type) {

        $resource = null;

        if(isset($this->resource[$type]) && isset($this->resource[$type][$id])) {
            $resource = $this->resource[$type][$id];
        }
        return $resource;
    }

    public function setResource($resource, $id, $type) {
        if(!isset($this->resource[$type])) {
            $this->resource[$type] = array();
        }
        $this->resource[$type][$id] = $resource;
    }
}

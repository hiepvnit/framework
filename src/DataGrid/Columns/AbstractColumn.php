<?php
namespace Mage2\Framework\DataGrid\Columns;


use Mage2\Framework\DataGrid\Contracts\Column as ColumnContract;

abstract class AbstractColumn  implements  ColumnContract {

    protected $identifier = NULL;

    protected $label = NULL;

    protected $sortable = NULL;


    /**
     *
     *
     * @param string $identifier
     * @param array $options
     */
    public function __construct($identifier, $options) {

        $this->identifier = $identifier;
        $this->label = (isset($options['label'])) ? $options['label'] : title_case($identifier);
        $this->sortable = (isset($options['sortable'])) ? $options['sortable'] : false;
    }




    /**
     * Get the Column Type
     * @return string $type
     */
    public function sortable() {
        return $this->sortable;
    }


    /**
     * Get the Column Type
     * @return string $type
     */
    public function type() {
        return $this->type;
    }


    /**
     * Get the Column Label
     * @return string $label
     */
    public function label() {
        return $this->label;
    }

    /**
     * Get the column identifier.
     * @return string $identifier
     */
    public function identifier() {
        return $this->identifier;
    }
}
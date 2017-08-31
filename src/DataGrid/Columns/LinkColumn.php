<?php
namespace Mage2\Framework\DataGrid\Columns;

use Mage2\Framework\DataGrid\Columns\AbstractColumn;

class LinkColumn  extends AbstractColumn{

    /**
     * identifier of the Columns
     *
     * @string
     */
    public $type = "link";


    /**
     * Callable function for the link
     *
     * @string
     */
    public $callback;

    public function __construct($identifier, $options = [], $callback = NULL) {
        parent::__construct($identifier, $options);
        $this->callback = $callback;
    }

    public function executeCallback($row) {
        $return = $this->callback;

        if($row && is_callable($return)) {
            return $return($row);
        }

        return false;
    }
}
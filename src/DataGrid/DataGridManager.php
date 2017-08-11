<?php
namespace Mage2\Framework\DataGrid;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;
use Mage2\Framework\DataGrid\Columns\TextColumn;
use Mage2\Framework\DataGrid\Columns\LinkColumn;

class DataGridManager
{

    /**
     * Database table model
     *
     * @var \Illuminate\Http\Request
     */

    public $request;

    /**
     * Database table model
     *
     * @var \Illuminate\Support\Collection
     */
    public $data;
    /**
     * Database table model
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    public $model;
    /**
     * Database table model
     *
     * @var \Illuminate\Support\Collection
     */
    public $columns = NULL;
    /**
     * Database table model
     *
     * @var \Illuminate\Database\Eloquent\Model
     */
    protected $paginate = 10;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    public function dataTableData($model) {

        $this->model = $model;
        return $this;
        /**
        $count = $model->get()->count();

        $columns = $this->request->get('columns');
        $orders = $this->request->get('order');

        $order = $orders[0];

        $records = $model->orderBy($columns[$order['column']]['name'], $order['dir']);

        $noOfRecord = $this->request->get('length');
        $noOfSkipRecord = $this->request->get('start');

        $records->skip($noOfSkipRecord)->take($noOfRecord);

        $data = [
                "data" => $records->get(),
                "draw" =>  $this->request->get('draw'),
                "recordsTotal"=> $count,
                "recordsFiltered" => $count
                ];

         */


        //return JsonResponse::create($data);
    }


    /**
     *
     *
     * @return static
     *
     */
    public function get()
    {

        $count = $this->model->get()->count();

        $columns = $this->request->get('columns');
        $orders = $this->request->get('order');


        $order = $orders[0];

        $records = $this->model->orderBy($columns[$order['column']]['name'], $order['dir']);

        $noOfRecord = $this->request->get('length');
        $noOfSkipRecord = $this->request->get('start');

        $records->skip($noOfSkipRecord)->take($noOfRecord);

        $allRecords = $records->get();

        if(isset($this->columns) && $this->columns->count() > 0) {

            $jsonRecords = Collection::make([]);

            foreach ($allRecords as $i => $singleRecord) {
                foreach ($this->columns as $key => $columnData) {

                    if (is_callable($columnData)) {
                        $columnValue = $columnData($singleRecord);
                    } else {
                        $columnValue = $columnData;
                    }

                    $singleRecord->setAttribute($key, $columnValue);
                }

                $jsonRecords->put($i, $singleRecord);
            }
        }




        $data = [
            "data" => (isset($jsonRecords)) ? $jsonRecords : $allRecords,
            "draw" =>  $this->request->get('draw'),
            "recordsTotal"=> $count,
            "recordsFiltered" => $count
        ];

        return JsonResponse::create($data);

    }

    public function addColumn($columnKey , $data) {

        if(NULL === $this->columns) {
            $this->columns = Collection::make([]);
        }
        $this->columns->put($columnKey , $data);
        return $this;
    }


    public static  function linkColumn($identifier, $label, $callback) {
        return new LinkColumn($identifier,$label,$callback);
    }
}
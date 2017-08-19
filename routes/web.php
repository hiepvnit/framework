<?php
/**
 * Mage2
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * https://www.gnu.org/licenses/gpl-3.0.en.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to ind.purvesh@gmail.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://mage2.website for more information.
 *
 * @author    Purvesh <ind.purvesh@gmail.com>
 * @copyright 2016-2017 Mage2
 * @license   https://www.gnu.org/licenses/gpl-3.0.en.html GNU General Public License v3.0
 */


/*
  |--------------------------------------------------------------------------
  | Mage2 Framework Module Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an mage2 framework modules.
  | It's a breeze. Simply tell mage2 framework module the URI it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */






Route::group(['middleware' => ['web', 'adminauth', 'permission', 'install'], 'namespace' => "Mage2\Framework", 'prefix' => 'admin'], function () {

    //*****    DASHBOARD MODULE ROUTES    ****//


    Route::get('product-tmp/create', ['as' => 'admin.dashboard', 'uses' => 'Product\Controllers\Admin\ProductController@index']);




    //*****    ATTRIBUTE MODULE ROUTES    ****//
    Route::get('attribute-2/get-datatable-data',
                    ['as' => 'admin.attribute2.data-grid-table.get-data',
                    'uses' => 'Attribute\Controllers\Admin\AttributeController@getDataGrid'
                    ]
            );
    Route::resource('attribute-2', 'Attribute\Controllers\Admin\AttributeController', ['as' => 'admin2']);

});

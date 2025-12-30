<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [store] process for the categories
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Categories;
use Illuminate\Contracts\Support\Responsable;

class StoreResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }


    /**
     * render the view for categories
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        //[Custom] Handle external source (e.g. from client form)
        if (request('source') == 'ext') {
            $category = $categories->first();
            
            //set attributes for JS to read
            $jsondata['dom_attributes'][] = [
                'selector' => '#client_categoryid',
                'attr' => 'data-new-category-id',
                'value' => $category->category_id
            ];
            $jsondata['dom_attributes'][] = [
                'selector' => '#client_categoryid',
                'attr' => 'data-new-category-name',
                'value' => $category->category_name
            ];

            $jsondata['postrun_functions'][] = [
                'value' => 'NXUpdateClientCategory',
            ];
            
            //close modal
            $modal = (request('target_modal') == 'actionsModal') ? '#actionsModal' : '#commonModal';
            $jsondata['dom_visibility'][] = array('selector' => $modal, 'action' => 'close-modal');

        } else {
            //prepend content on top of list
            $html = view('pages/categories/components/table/ajax', compact('categories'))->render();
            $jsondata['dom_html'][] = array(
                'selector' => '#categories-td-container',
                'action' => 'prepend',
                'value' => $html);

            //close modal
            $jsondata['dom_visibility'][] = array('selector' => '#commonModal', 'action' => 'close-modal');
        }

        //notice
        $jsondata['notification'] = array('type' => 'success', 'value' => __('lang.request_has_been_completed'));

        //response
        return response()->json($jsondata);

    }

}

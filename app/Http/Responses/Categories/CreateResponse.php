<?php

/** --------------------------------------------------------------------------------
 * This classes renders the response for the [create] process for the categories
 * controller
 * @package    Grow CRM
 * @author     NextLoop
 *----------------------------------------------------------------------------------*/

namespace App\Http\Responses\Categories;
use Illuminate\Contracts\Support\Responsable;

class CreateResponse implements Responsable {

    private $payload;

    public function __construct($payload = array()) {
        $this->payload = $payload;
    }

    /**
     * render the view
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function toResponse($request) {

        //set all data to arrays
        foreach ($this->payload as $key => $value) {
            $$key = $value;
        }

        //render the form
        $html = view('pages/categories/components/modals/add-edit-inc', compact('page'))->render();
        
        //[Custom] Handle dynamic targeting
        if (request('target_modal') == 'actionsModal') {
             $jsondata['dom_html'][] = array(
                'selector' => '#actionsModalBody',
                'action' => 'replace',
                'value' => $html);
            $jsondata['dom_visibility'][] = array('selector' => '#actionsModalFooter', 'action' => 'show');
            $jsondata['postrun_functions'][] = [
                'value' => 'NXCategoriesCreateActions',
            ];
        } else {
            $jsondata['dom_html'][] = array(
                'selector' => '#commonModalBody',
                'action' => 'replace',
                'value' => $html);
            $jsondata['dom_visibility'][] = array('selector' => '#commonModalFooter', 'action' => 'show');
            $jsondata['postrun_functions'][] = [
                'value' => 'NXCategoriesCreate',
            ];
        }

        //ajax response
        return response()->json($jsondata);

    }

}

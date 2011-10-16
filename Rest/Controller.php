<?php

/**
 * CodeBlender
 *
 * @category  CodeBlender
 * @package   Rest
 * @copyright Copyright (c) 2000-2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 */

/**
 * Abstract class for the Rest Controllers
 *
 * @category  CodeBlender
 * @package   Rest
 * @copyright Copyright (c) 2000-2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 */
abstract class CodeBlender_Rest_Controller extends Zend_Rest_Controller
{

    /**
     * Core Table
     *
     * @param  object $table Zend DB Object
     * @param  bool   $fetchRow Whether to fetch the row after inserting
     * @return void
     */
    protected function _setupTable($table, $fetchRow = true)
    {
        $this->table = $table;
        $this->fetchRow = $fetchRow;
    }

    /**
     * Decode JSON
     */
    public function decodeJSON()
    {
        try {
            $paramaters = Zend_Json::decode($this->getRequest()->getRawBody());
            return $paramaters;
        } catch (Zend_Exception $e) {
            $this->errorDecode($e->getMessage());
        }
    }

    /**
     * Error
     * Access Token invalid - Response Code - 401
     */
    public function errorAccessToken($message = false)
    {
        if ($message) {
            $message = $message;
        } else {
            $message = 'access_token not found in database';
        }

        // Add the processed JSON to the body
        $dataArray = array(
            'success' => false,
            'message' => $message
        );

        // Send JSON
        $this->sendJSON($dataArray, 401);
    }

    /**
     * Error
     * Insert Failed Due to Validation - Response Code 500
     */
    public function errorInsert($message = false)
    {
        if ($message) {
            $message = $message;
        } else {
            $message = 'Validation Failed';
        }

        // Add the processed JSON to the body
        $dataArray = array(
            'success' => false,
            'message' => $message
        );

        // Send JSON
        $this->sendJSON($dataArray, 500);
    }

    /**
     * Error
     * Invalid attributes - Response Code 400
     */
    public function errorInvalidAttributes($message = false)
    {
        if ($message) {
            $message = $message;
        } else {
            $message = 'Invalid Attributes';
        }

        // Add the processed JSON to the body
        $dataArray = array(
            'success' => false,
            'message' => $message
        );

        $this->sendJSON($dataArray, 400);
    }

    /**
     * Action
     * Failed Dependancy - Response Code 424
     */
    public function errorFailedDependancy($message = false)
    {
        if ($message) {
            $message = $message;
        } else {
            $message = 'Reverse Geocode service failed to return a valid response';
        }

        // Add the processed JSON to the body
        $dataArray = array(
            'success' => false,
            'message' => $message
        );

        $this->sendJSON($dataArray, 424);
    }

    /**
     * Error
     * JSON Decode issue - Response Code 400
     */
    public function errorDecode($message = false)
    {
        if ($message) {
            $message = $message;
        } else {
            $message = 'JSON Decode failed';
        }

        // Add the processed JSON to the body
        $dataArray = array(
            'success' => false,
            'message' => $message
        );

        $this->sendJSON($dataArray, 400);
    }

    /**
     * Error
     * Method not found - Response Code 405
     */
    public function errorNoMethod()
    {
        // Add the processed JSON to the body
        $dataArray = array(
            'success' => false,
            'message' => 'Method not valid - ' . $this->_getParam('action')
        );

        $this->sendJSON($dataArray, 405);
    }

    /**
     * Send JSON
     */
    protected function sendJSON($dataArray, $responseCode)
    {
        $dataArray['serverTime'] = time();

        $this->_response->setHttpResponseCode($responseCode);
        $this->_helper->json($dataArray);
        return;
    }

    /**
     * The index action handles index/list requests; it should respond with a
     * list of the requested resources.
     *
     * @param  array  $dataArray
     * @return object JSON Object
     */
    public function indexAction($dataArray = false)
    {
        // Check to see if a dataArray has been passed into this method
        if (empty($dataArray)) {

            // Decode the returned JSON
            $dataArray = Zend_Json::decode($this->getRequest()->getRawBody());
        }

        // Count Query
        $totalCount = $this->table->getCount();

        // Check that a result was returned
        if ($totalCount >= 1) {

            // Get Results
            $rowSet = $this->table->getAll();

            if (!is_array($rowSet)) {
                $rowSet = $rowSet->toArray();
            }

            // Array creation
            $dataArray = array(
                'success' => true,
                'totalCount' => $totalCount,
                'data' => $rowSet
            );

            // Show no Data message if the count returns zero rows
        } else {

            // Add the processed JSON to the body
            $dataArray = array(
                'success' => true,
                'data' => array()
            );
        }

        // Set the response code
        $this->_response->setHttpResponseCode(200);

        // Check whether the Callback feature for ScriptTagProxy is set
        if (!$this->_getParam('callback')) {
            $this->_helper->json($dataArray);
        } else {
            $this->_helper->layout()->disableLayout();
            $this->_helper->viewRenderer->setNoRender(true);
            echo $this->_getParam('callback') . '(' . Zend_Json::encode($dataArray) . ');';
        }
    }

    /**
     * The get action handles GET requests and receives an 'id' parameter; it
     * should respond with the server resource state of the resource identified
     * by the 'id' value.
     *
     * @return object JSON Object
     */
    public function getAction()
    {
        $this->_response->setHttpResponseCode(200);
        $this->_helper->json('Get Action');
    }

    /**
     * The post action handles POST requests; it should accept and digest a
     * POSTed resource representation and persist the resource state.
     *
     * @param  string $variableName
     * @param  array  $dataArray
     * @return object JSON Object
     */
    public function postAction($variableName = false, $dataArray = false)
    {
        // Check to see if a dataArray has been passed into this method
        if (empty($dataArray)) {

            // Decode the returned JSON
            $dataArray = Zend_Json::decode($this->getRequest()->getRawBody());
        }

        if (!empty($dataArray['data'][$variableName])) {

            // Instantiate the Account Model
            $result = $this->table->insert($dataArray['data']);

            // Check that the update was successful
            if (is_numeric($result)) {

                // Whether to get the new row
                if ($this->fetchRow) {

                    // Query to find the new data that has been created and send back to the Grid
                    $rowSet = $this->table->getAll($result);
                } else {
                    $rowSet = '';
                }

                // Produce the data array to send back
                $dataArray = array('success' => true, 'message' => 'Record added!', 'data' => $rowSet);
            } else {

                // Produce the data array to send back
                $dataArray = array('success' => false, 'message' => $result, 'data' => array('id' => ''));
            }
        } else {

            // Produce the data array to send back
            $dataArray = array('success' => false, 'message' => 'Initial Variable Empty');
        }

        // Set the response code
        $this->_response->setHttpResponseCode(200);

        // Add the processed JSON to the body
        $this->_helper->json($dataArray);
    }

    /**
     * The put action handles PUT requests and receives an 'id' parameter; it
     * should update the server resource state of the resource identified by
     * the 'id' value.
     *
     * @param  array  $dataArray
     * @return object JSON Object
     */
    public function putAction($dataArray = false)
    {
        // Check to see if a dataArray has been passed into this method
        if (empty($dataArray)) {

            // Decode the returned JSON
            $dataArray = Zend_Json::decode($this->getRequest()->getRawBody());
        }

        $where = $this->table->getAdapter()->quoteInto('id = ?', $this->_getParam('id'));
        $result = $this->table->update($dataArray['data'], $where);

        // Check that the update was successful
        if (is_numeric($result)) {

            // Whether to get the new row
            if ($this->fetchRow) {

                // Query to find the new data that has been created and send back to the Grid
                $rowSet = $this->table->getAll($this->_getParam('id'));
                ;
            } else {
                $rowSet = '';
            }

            // Produce the data array to send back
            $dataArray = array('success' => true, 'message' => 'Record Updated', 'data' => $rowSet);
        } else {

            // Produce the data array to send back
            $dataArray = array('success' => false, 'message' => $result);
        }

        // Set the response code
        $this->_response->setHttpResponseCode(200);

        // Add the JSON
        $this->_helper->json($dataArray);
    }

    /**
     * The delete action handles DELETE requests and receives an 'id'
     * parameter; it should update the server resource state of the resource
     * identified by the 'id' value.
     *
     * @param  array  $dataArray
     * @return object JSON Object
     */
    public function deleteAction($dataArray = false)
    {
        // Check to see if a dataArray has been passed into this method
        if (empty($dataArray)) {

            // Decode the returned JSON
            $dataArray = Zend_Json::decode($this->getRequest()->getRawBody());
        }

        // Query to update the Abuse reports to state that it has been actioned
        $where = $this->table->getAdapter()->quoteInto('id = ?', $this->_getParam('id'));
        $result = $this->table->delete($where);

        // Check that the update was successful
        if (is_numeric($result)) {

            // Produce the data array to send back
            $dataArray = array('status' => 'success');
        } else {

            // Produce the data array to send back
            $dataArray = array('status' => 'failed', 'message' => 'No DB Result');
        }

        // Set the response code
        $this->_response->setHttpResponseCode(200);

        // Add the JSON
        $this->_helper->json($dataArray);
    }

}

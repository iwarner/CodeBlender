<?php

/**
 * CodeBlender
 *
 * @category  CodeBlender
 * @package   Rest
 * @copyright Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 */

/**
 * Rest
 *
 * @category  CodeBlender
 * @package   Rest
 * @copyright Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
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

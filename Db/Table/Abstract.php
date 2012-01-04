<?php

/**
 * CodeBlender
 *
 * @category  CodeBlender
 * @package   DB
 * @copyright Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 */

/**
 * CodeBlender
 *
 * @category  CodeBlender
 * @package   DB
 * @copyright Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 */
abstract class CodeBlender_Db_Table_Abstract extends Zend_Db_Table_Abstract
{
    /**
     * Format suitable for passing to date() to generate an ISO/MySQL datetimestring (YYYY-MM-DD HH:MM:SS)
     *
     * @var string
     */
    const FORMAT_DATETIME = 'Y-m-d H:i:s';

    /**
     * Matches ISO/MySQL datetime format: YYYY-MM-DD HH:MM:SS
     *
     * @var string
     */
    const REGEX_DATETIME = '/^\d\d\d\d-\d\d-\d\d \d\d:\d\d:\d\d$/';

    /**
     * Matches ISO/MySQL datetime format: YYYY-MM-DD HH:MM:SS, allows blank/null
     *
     * @var string
     */
    const REGEX_DATETIME_OR_EMPTY = '/^(\d\d\d\d-\d\d-\d\d \d\d:\d\d:\d\d)?$/';

    /**
     * Request params
     */
    protected $params = null;

    /**
     * Validation Output
     */
    public $escapedOutput = false;

    /**
     * Construct the parent optios
     *
     * @param $config
     */
    public function __construct($config = array())
    {
        parent::__construct($config);
    }

    /**
     * Overide the Zend Abstract to create the Table name
     *
     * Table name matches the last part of the classname (after the _), lowercase.
     * So we strtolower, then strip off everything up to and including the last underscore.
     *
     * @return void
     */
    protected function _setupTableName()
    {
        $this->_name = preg_replace('/.*_/', '', strtolower(get_class($this)));
        parent::_setupTableName();
    }

    /**
     * Overide the Zend Abstract to create the Primary Key
     *
     * @return void
     */
    protected function _setupPrimaryKey()
    {
        $this->_primary = 'id';
        parent::_setupPrimaryKey();
    }

    /**
     * Get Count
     *
     * @param  int    $limit
     * @param  int    $start
     * @return object
     */
    public function getCount($limit = false, $start = false)
    {
        // Params
        $params = Zend_Controller_Front::getInstance()->getRequest()->getParams();

        $select = $this->select()
                ->from($this, array('total' => 'COUNT(*)'))
                ->where('status = ?', 'Active');

        // Filter
        if (!empty($params['filterKey']) && !filter_var($params['filter'], FILTER_VALIDATE_BOOLEAN)) {
            $select->where($params['filterKey'] . ' ?', $params['filter']);
        }

        // Filter Array
        if (!empty($params['filterArray'])) {

            $i = 1;

            foreach ($params['filterArray'] as $k => $v) {

                if ($i == 1) {
                    $select->where($k . ' ?', $v);
                } else {
                    $select->orwhere($k . ' ?', $v);
                }

                $i++;
            }
        }

        // Limit
        if (is_numeric($limit) && is_numeric($start)) {
            $select->limit($limit, $start);
        } elseif ((!empty($params['limit']) && is_numeric($params['limit'])) && (!empty($params['start']) && is_numeric($params['start']))) {
            $select->limit($params['limit'], $params['start']);
        }

        // Fetch Row
        $row = $this->fetchRow($select);

        return $row->total;
    }

    /**
     * Get All
     *
     * @param  string $columns
     * @param  int    $limit
     * @param  int    $start
     * @return object
     */
    public function getAll($columns = '*', $limit = false, $start = false)
    {
        // Params
        $params = Zend_Controller_Front::getInstance()->getRequest()->getParams();

        $select = $this->select()
                ->from($this, $columns)
                ->where('status = ?', 'Active');

        // Filter
        if (!empty($params['filter']) && !empty($params['filterKey'])) {
            $select->where($params['filterKey'] . ' ?', $params['filter']);
        }

        // Filter Array
        if (!empty($params['filterArray'])) {

            $i = 1;

            foreach ($params['filterArray'] as $k => $v) {

                if ($i == 1) {
                    $select->where($k . ' ?', $v);
                } else {
                    $select->orwhere($k . ' ?', $v);
                }

                $i++;
            }
        }

        // Sort
        if (!empty($params['sort']) && preg_match('/^\w+$/', $params['sort']) && !empty($params['dir']) && ($params['dir'] == 'ASC' || $params['dir'] == 'DESC')) {
            $select->order($params['sort'] . ' ' . $params['dir']);
        }

        // Limit
        if (is_numeric($limit) && is_numeric($start)) {
            $select->limit($limit, $start);
        } elseif ((!empty($params['limit']) && is_numeric($params['limit'])) && (!empty($params['start']) && is_numeric($params['start']))) {
            $select->limit($params['limit'], $params['start']);
        }

        // Fetch All
        $rowSet = $this->fetchAll($select);

        return $rowSet;
    }

    /**
     * Insert
     *
     * @param  array $data
     * @return mixed
     */
    public function insert($data)
    {
        // Creation Date Timestamp
        if (empty($data['creation_date'])) {
            $data['creation_date'] = time();
        }

        // Validate the data
        $valid = $this->validate($data);

        if ($valid === true) {
            $result = parent::insert($data, 'insert');
            return $result;
        } else {
            throw new Zend_Exception('Cannot insert into table ' . $this->_name . ' because validation failed: ' . $valid);
        }
    }

    /**
     * Update
     *
     * @param  array  $data
     * @param  string $where
     * @return mixed
     */
    public function update($data, $where = null)
    {
        // Default is to update by ID, which is almost always what you want.
        if (empty($where)) {
            $where = 'id = ' . intval($data['id']);
        }

        // Revision Date Timestamp
        if (empty($data['revision_date'])) {
            $data['revision_date'] = time();
        }

        // Validate the data
        $valid = $this->validate($data, 'update');

        if ($valid === true) {
            $result = parent::update($data, $where);
            return $result;
        } else {
            throw new Zend_Exception('Cannot update ' . $this->_name . ' because validation failed: ' . $valid);
        }
    }

    /**
     * Method to validate the data entered into the model.
     * Should return true (boolean) if valid, or a message (string) if not.
     *
     * @return void
     */
    public abstract function validate($data);

    /**
     * Validation Process
     */
    public function validateProcess($filters, $validators, $data)
    {
        // Process the Data through the Filter and Validators
        $input = new Zend_Filter_Input($filters, $validators, $data);

        // Data Valid
        if ($input->isValid()) {

            // Get filtered output
            $this->escapedOutput = $input->getEscaped();
            return true;

            // Not Valid send messages
        } else {

            $message = '';

            foreach ($input->getMessages() as $k => $v) {
                $message .= $v[key($v)] . ' | ';
            }

            return rtrim($message, ' | ');
        }
    }

}

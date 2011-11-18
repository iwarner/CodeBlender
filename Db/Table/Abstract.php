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
 * DB Class
 *
 * @category  CodeBlender
 * @package   DB
 * @copyright Copyright (c) 2011 Triangle Solutions Ltd. (http://www.triangle-solutions.com/)
 * @license   http://codeblender.net/license
 *
 * @todo Insert and Update use field names - should be configurable
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
     * @return void
     */
    protected function _setupTableName()
    {
        // Table name matches the last part of the classname (after the _), lowercase.
        // So we strtolower, then strip off everything up to and including the last underscore.
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
     * Method to count the rows in this table
     */
    public function getCount()
    {
        $select = $this->select()
            ->from($this, array('total' => 'COUNT(*)'))
            ->where('status = ?', 'Active');

        $row = $this->fetchRow($select);
        return $row->total;
    }

    /**
     * Gets all the table results.
     * Uses some request parameters to control sorting and limit.
     *
     * @param  int    $limit
     * @param  int    $start
     * @return object
     */
    public function getAll($limit = false, $start = false)
    {
        $params = Zend_Controller_Front::getInstance()->getRequest()->getParams();

        // Query to get all the table results
        $select = $this->select()
            ->where('status = ?', 'Active');

        // Create the sorting options
        if (!empty($params['sort']) && preg_match('/^\w+$/', $params['sort']) && !empty($params['dir']) && ($params['dir'] == 'ASC' || $params['dir'] == 'DESC')) {
            $select->order($params['sort'] . ' ' . $params['dir']);
        }

        // Create the limit options from the method attributes
        if (is_numeric($limit) && is_numeric($start)) {
            $select->limit($limit, $start);

            // Use the reqyest params
        } elseif ((!empty($params['limit']) && is_numeric($params['limit'])) && (!empty($params['start']) && is_numeric($params['start']))) {
            $select->limit($params['limit'], $params['start']);
        }

        // Fetch All
        $rowSet = $this->fetchAll($select);

        return $rowSet;
    }

    /**
     * Override method to insert the row
     *
     * @param  array $data
     */
    public function insert($data)
    {
        // Add a time stamp
        if (empty($data['creation_date'])) {
            $data['creation_date'] = time();
        }

        $valid = $this->validate($data);

        // Validate the data
        if ($valid === true) {
            $result = parent::insert($data);
            return $result;
        } else {
            throw new Exception('Cannot insert ' . $this->_name . ' because validation failed: ' . $valid);
        }
    }

    /**
     * Override method to update the row
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

        // Add a time stamp
        if (empty($data['revision_date'])) {
            $data['revision_date'] = time();
        }

        $valid = $this->validate($data);

        // Validate the data
        if ($valid === true) {
            $result = parent::update($data, $where);
            return $result;
        } else {
            throw new Exception('Cannot update ' . $this->_name . ' because validation failed: ' . $valid);
        }
    }

    /**
     * Method to validate the data entered into the model.
     * Should return true (boolean) if valid, or a message (string) if not.
     *
     * @return void
     */
    public abstract function validate($data);
}

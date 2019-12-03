<?php
// http://www.tutorial-portal.com/tutorial/37/php-database-class
class Database {
	protected $server;
	protected $database;
	protected $user;
	protected $password;

	protected $connection;

	public function __construct($server, $database, $user, $password)
	{
		$this->_server   = $server;
		$this->_database = $database;
		$this->_user     = $user;
		$this->_password = $password;

	}

	protected function _sendQuery($query, $getId = false)
	{
		// connect to mysql
		$this->_connection = mysqli_connect($this->_server, $this->_user, $this->_password);
		if (!$this->_connection) {
			echo "Whoops, something went wrong, check your database connection credentials...";
			exit();
		}

		// does database name exist?
		$databaseExists = mysqli_select_db($this->_connection, $this->_database);

		// if database doesn't exist
		if (!$databaseExists) {
			printf("Could not connect to database named :: <strong>%s</strong>\n", $this->_database);
			exit();
		}

		mysqli_query($this->_connection, 'SET NAMES \'utf8\'');
		mysqli_query($this->_connection, 'SET CHARACTER SET \'utf8\'');

		$result = mysqli_query($this->_connection, $query);
		$tmpId  = mysqli_insert_id($this->_connection);

		mysqli_close($this->_connection);

		if ($getId):
			return $tmpId;
		endif;

		return $result;
	}

	/**
	 * Performs a SELECT-Query
	 *
	 * @param	string		Table name
	 * @param	string		Fields to select
	 * @param	string		WHERE Clause
	 * @param	string		ORDER
	 * @param	string		LIMIT
	 * @param	bool		false = ASC, true = DESC
	 * @param	int		Limitbegin
	 * @param	string		GroupBy
	 * @param	bool		Activate Monitoring
	 * @return	resource	Result
	 */
	public function select($table, $fields = '*', $where = '1=1', $returntype = 'array', $leftjoin = '', $on = '',  $order = 'id', $limit = '', $desc = false, $limitBegin = 0, $groupby = null, $monitoring = false)
	{

		$types = array('array'=>'mysqli_fetch_assoc', 'object'=>'mysqli_fetch_object');
		$type = $types[$returntype];

		$query = 'SELECT ' . $fields;

		$query .= ' FROM ' . $table;

		if (!empty($leftjoin) && !empty($on)):
			$query .= ' LEFT JOIN ' . $leftjoin;
			$query .= ' ON ' . $on;
		endif;

		$query .= ' WHERE ' . $where;

		if (!empty($groupby)):
			$query .= ' GROUP BY ' . $groupby;
		endif;

		if (!empty($order)):
			$query .= ' ORDER BY ' . $order;
			if ($desc):
				$query .= ' DESC';
			endif;
		endif;

		if (!empty($limit)):
			$query .= ' LIMIT ' . $limitBegin . ', ' . $limit;
		endif;

		$result = $this->_sendQuery($query);
		$resultArray = array();

		while ($row = $type($result)){
			$resultArray[] = $row;
		}

		/**
		 * If monitoring is activated, echo the query
		 */
		if ($monitoring):
			echo $query;
		endif;

		return $resultArray;
	}

	/**
	 * Performs an INSERT-Query
	 *
	 * @param	string	Table
	 * @param	array	Data
	 * @return	int     Id of inserted data
	 */
	public function insert($table, $objects)
	{
		$query = 'INSERT INTO ' . $table . ' ( ' . implode(',', array_keys($objects)) . ' )';
		$query .= ' VALUES(\'' . implode('\',\'', $objects) . '\')';

		$result = $this->_sendQuery($query, true);

		return $result;
	}

	/**
	 * Performs an UPDATE-Query
	 *
	 * @param	string	Table
	 * @param	array	Data
	 * @param	string	WHERE-Clause
	 * @return	void
	 */
	public function update($table, $data, $where)
	{
		if (is_array($data)):
			$update = array();

			foreach ($data as $key => $val):
				$update[] .= $key . '=\'' . $val . '\'';
			endforeach;

			$query = 'UPDATE ' . $table . ' SET ' . implode(',', $update) . ' WHERE ' . $where;

			$this->_sendQuery($query);
		endif;
	}

	/**
	 * Performs a DELETE-Query
	 *
	 * @param	string	Table
	 * @param	int     Id of row to delete
	 * @return	void
	 */
	public function delete($table, $id, $where = null)
	{
		if ($where === null):
			$query = 'DELETE FROM ' . $table . ' WHERE id=\'' . $id . '\'';
		else:
			$query = 'DELETE FROM ' . $table . ' WHERE ' . $where;
		endif;

		$this->_sendQuery($query);
	}

	/**
	 * Performs a TRUNCATE
	 *
	 * @param	string	Table
	 * @return	void
	 */
	public function truncate($table)
	{
		$query = 'TRUNCATE TABLE `' . $table . '`';
		$this->_sendQuery($query);
	}

	/**
	 *
	 *	added	v.1.0.0
	 */
	public static function preventInjection($string)
	{
		$string = strtolower($string);
		$string = str_replace(' ', '', $string);
		$string = str_replace('-', '', $string);
		$string = str_replace('_', '', $string);
		$string = str_replace('@', '', $string);
		$string = str_replace('&', '', $string);
		$string = str_replace('!', '', $string);
		$string = str_replace('.', '', $string);
		$string = str_replace(',', '', $string);
		$string = str_replace('[', '', $string);
		$string = str_replace(']', '', $string);
		$string = str_replace(';', '', $string);
		$string = str_replace(':', '', $string);
		$string = str_replace('#', '', $string);
		$string = str_replace('$', '', $string);
		$string = str_replace('^', '', $string);
		$string = str_replace('%', '', $string);
		$string = str_replace('(', '', $string);
		$string = str_replace(')', '', $string);
		$string = str_replace('{', '', $string);
		$string = str_replace('}', '', $string);
		$string = str_replace('+', '', $string);
		$string = str_replace('=', '', $string);
		$string = str_replace('?', '', $string);
		$string = str_replace('/', '', $string);
		$string = str_replace('"', '', $string);
		$string = str_replace('*', '', $string);
		$string = str_replace('<', '', $string);
		$string = str_replace('>', '', $string);
		$string = str_replace('|', '', $string);
		$string = str_replace('~', '', $string);
		$string = str_replace('`', '', $string);
		$string = str_replace('\'', '', $string);

		$string = str_replace('select', '', $string);
		$string = str_replace('and', '', $string);
		$string = str_replace('or', '', $string);
		$string = str_replace('join', '', $string);
		$string = str_replace('in', '', $string);
		$string = str_replace('on', '', $string);
		$string = str_replace('from', '', $string);
		$string = str_replace('create', '', $string);
		$string = str_replace('delete', '', $string);
		$string = str_replace('update', '', $string);
		$string = str_replace('insert', '', $string);
		$string = str_replace('order', '', $string);
		$string = str_replace('by', '', $string);

		return $string;
	}
}

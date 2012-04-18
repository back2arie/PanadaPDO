<?php
/**
 * Panada PDO Database Driver.
 *
 * @package	Driver
 * @subpackage	Database
 * @author	Azhari Harahap <azhari@harahap.us>
 * @since	Version 1.0
 */
namespace Drivers\Database;
use Resources\Interfaces as Interfaces,
Resources\RunException as RunException,
PDO, PDOException;

class PanadaPDO implements Interfaces\Database {

	protected $port = null;
	protected $column = '*';
	protected $distinct = false;
	protected $tables = array();
	protected $joins = null;
	protected $joinsType = null;
	protected $joinsOn = array();
	protected $criteria = array();
	protected $groupBy = null;
	protected $isHaving = array();
	protected $limit = null;
	protected $offset = null;
	protected $orderBy = null;
	protected $order = null;
	protected $isQuotes = true;
	private $link;
	private $connection;
	private $config;
	private $lastQuery;
	private $lastError;
	private $dsn;
	public $insertId;
	public $clientFlags = 0;
	public $newLink = true;
	public $persistentConnection = false;
	public $instantiateClass = 'stdClass';
	
	/**
	 * Check if PDO enabled
	 * Define all properties needed.
	 * 
	 * @return void
	 */
	function __construct( $config, $connectionName ){
	
		// Check for PDO
		if (!extension_loaded('PDO')){
			throw new RunException('PDO extension not installed.');
		}
		
		$this->config = $config;
		$this->connection = $connectionName;
	}

	/**
	 * Establish a new connection
	 *
	 * @return string | boolean
	 */
	private function establishConnection(){
	
		// Persistent connection?
		$options[PDO::ATTR_PERSISTENT] = $this->config['persistent'];
		
		// Postgresql?
		if ($this->config['driver'] == 'postgresql')
			$this->config['driver'] = 'pgsql';
			
		// Build DSN
		$this->dsn = $this->config['driver'].":host=".$this->config['host'].
					";port=".$this->config['port'].";dbname=".$this->config['database'];
		
		try{
			return new PDO($this->dsn, $this->config['user'], $this->config['password'], $options);
		}
		catch(PDOException $e){
			throw new RunException( $e->getMessage() );
		}
	}
    
	/**
	 * Initial for all process
	 *
	 * @return void
	 */
	private function init(){

		if( is_null($this->link) )
			$this->link = $this->establishConnection();
			
		try{
			if ( ! $this->link )
			throw new RunException('Unable connect to database in <strong>'.$this->connection.'</strong> connection.');
		}
		catch(RunException $e){
			RunException::outputError( $e->getMessage() );
		}
	}

	/**
	 * API for "SELECT ... " statement.
	 *
	 * @param string $column1, $column2 etc ...
	 * @return object
	 */
	public function select(){
		
		$column = func_get_args();
		
		if( ! empty($column) ){
			$this->column = $column;
			
			if( is_array($column[0]) )
				$this->column = $column[0];
		}
		return $this;
	}
	
	public function distinct(){
		
	}
	
	public function from(){
		
		$tables = func_get_args();
	
		if( is_array($tables[0]) )
			$tables = $tables[0];
		
		$this->tables = $tables;
		return $this;
	}
	
	public function join( $table, $type = null ){

	}
	
	public function on( $column, $operator, $value, $separator = false ){
		
	}
	
	public function where( $column, $operator, $value, $separator = false ){
		
	}
	
	public function groupBy(){
		
	}
	
	public function having( $column, $operator, $value, $separator = false ){
		
	}
	public function orderBy( $column, $order = null ){
		
	}
	public function limit( $limit, $offset = null ){
		
	}
	
	public function command(){
		
	}
	
	public function begin(){
		
	}
	
	public function commit(){
		
	}
	
	public function rollback(){
		
	}
	
	public function escape( $string ){
		
	}
	
	public function query( $sql ){
		
		if( is_null($this->link) )
			$this->init();
		
		$query = $this->link->query( $sql );
		$this->lastQuery = $sql;
		
		return $query;
	}
	
	public function getAll( $table = false, $where = array(), $fields = array() ){
		
	}
	
	public function getOne( $table = false, $where = array(), $fields = array() ){
		
	}
	
	public function getVar( $query = null ){
		
		// TODO
		/*if( is_null($query) )
			$query = $this->command();*/

		$result = $this->row($query);
		$key = array_keys(get_object_vars($result));
		
		return $result->$key[0];
	}
	
	public function results( $query, $type = 'object' ){
		
		// TODO
		/*if( is_null($query) )
			$query = $this->command();*/
			
		$result = $this->query($query);
		
		while ($row = $result->fetch(PDO::FETCH_OBJ)) {
			
			if($type == 'array')
				$return[] = (array) $row;
			else
				$return[] = $row;
		}
		
		if( ! isset($return) )
			return false;
	
        return $return;
	}
	
	public function row( $query, $type = 'object' ){
		
		// TODO
		/*if( is_null($query) )
			$query = $this->command();*/

		if( is_null($this->link) )
			$this->init();
		
		$result = $this->query($query);
		$return = $result->fetch(PDO::FETCH_OBJ);
		
		if($type == 'array')
			return (array) $return;
		else
			return $return;
	}
	
	public function insert( $table, $data = array() ){
		
	}
	
	public function insertId(){
		
	}
	
	public function update( $table, $dat, $where = null ){
		
	}
	
	public function delete( $table, $where = null ){
		
	}
	
	public function version(){
		
	}
	
	public function close(){
		
	}
}

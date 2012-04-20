Panada PDO
=================
[PDO](http://php.net/manual/en/book.pdo.php) implementation for [Panada PHP Framework](https://github.com/panada/Panada)

## Usage Example:
### Configure database option:

```php
<?php
'default_pdo' => array(
	'driver' => 'postgresql',
	'host' => 'localhost',
	'port' => 5432,
	'user' => 'postgres',
	'password' => '',
	'database' => 'panada',
	'tablePrefix' => '',
	'charset' => 'utf8',
	'collate' => 'utf8_general_ci',
	'persistent' => false,
	'pdo' => true
),
```

The only difference you see is `pdo` option.

### Load Database as usual:
```php
<?php
$this->db = new Resources\Database('default_pdo');
```

### Fetch single record using raw query:
```php
<?php
	$data = $this->db->row("SELECT * FROM users"); 
	var_dump($data);
```

### Fetch multiple record using raw query:
```php
<?php
	$data = $this->db->results("SELECT * FROM users"); 
	var_dump($data);
```

### Fetch single variable using raw query:
```php
<?php
	$data = $this->db->getVar("SELECT COUNT(*) FROM users"); 
	var_dump($data);
```

### Using Query Builder
```php
<?php
	$data = $this->db->select('user_name')->from('users')->getAll();
	var_dump($data);

	$data = $this->db->select('users.user_name', 'posts.post_content')->from('users')->join('posts')->on('users.user_id', '=', 'posts.post_author')->getAll(); 
	var_dump($data);
	
	$data = $this->db->insert('users', array('user_name' => 'Azhari', 'user_id' => '123')); 
	var_dump($data);
	
	$data = $this->db->update('users', array('user_name' => 'jhon gmail'), array('user_id' => 2122)); 
	var_dump($data);
	
	echo $this->db->insertId();
	echo $this->db->getLastQuery();
	echo $this->db->version();
```

Panada PDO
=================
[PDO](http://php.net/manual/en/book.pdo.php) implementation for [Panada PHP Framework](https://github.com/panada/Panada)

## WARNING: NOT READY FOR USED YET

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


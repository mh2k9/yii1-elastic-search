Yii 1.x extension for ElasticSearch
--
It is an yii-1.x  extension for performing `ElasticSearch` queries. This extension is based on [**Official low-level client for ElasticSearch**](https://github.com/elastic/elasticsearch-php)

Prerequisite
----

- PHP 7.0 or higher

Installation
---------

1. download the project or clone from https://github.com/mh2k9/yii1-elastic-search.git
2. Copy the ``protected/extensions/elasticSearch`` to your project extension direcory
3. Add components to `main.php` 
```
<?php
'es' => [
    'class' => 'application.extensions.elasticSearch.ElasticSearch',
    'host' => '127.0.0.1:9200',
    // Array of index types. Array keys indicate the name of indexes
    'es_index_type' => [
        'my_index' => 'my_type',
        'my_index2' => 'my_type2',
        'my_index3' => 'my_type2',
        // list all indexes and types [key value pare]
    ]
]
?>
```

Quick Start
---

Get data by ID
--
**Query by ID**
```
<?php
$response = Yii::app()->es->getById('my_index', 'my_id');
?>
```

**Output look like**
```
<?php
Array
(
    [_index] => my_index
    [_type] => my_type
    [_id] => my_id
    [_version] => 1
    [found] => 1
    [_source] => Array
    (
        [id] => my_id
        .....
    )
)   
?>
```

Get by query
--
**Query**
```
<?php
$queryBody = [];
$queryBody['_source'] = 'field1, field2, field3'; // An example of selected fields
$queryBody['body'] = [
    'query' => [
        'bool' => [
            'must' => [
                'bool' => [
                    'should' => [
                        [ 'match' => [ 'condition_field_name' => "condition_value" ] ]
                    ]
                ]
            ]
        ]
    ]
];

$response = Yii::app()->es->getByQuery('my_index', $queryBody);
?>
```

Query as per official [documentation](https://github.com/elastic/elasticsearch-php)
---
```
<?php
$params = [
    'index' => 'my_index',
    'type' => 'my_type',
    'id' => 'my_id'
];

$response = Yii::app()->es->getClientInstance()->get($params);
?>
```

Conclusion
--
This extension is totally based on [**elasticsearch-php**](https://github.com/elastic/elasticsearch-php).
For more and clear documentation read from [**here**](https://github.com/elastic/elasticsearch-php).


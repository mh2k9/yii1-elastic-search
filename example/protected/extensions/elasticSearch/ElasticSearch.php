<?php

use Elasticsearch\ClientBuilder;

require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'vendor/autoload.php';
require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'ElasticSearchInterface.php';

class ElasticSearch extends ClientBuilder implements ElasticSearchInterface {
	public $params = [];
	public $body = [];
	public $host = null;
	public $es_index_type = [];

	private $client = null;

	/**
	 * Init method to assigns class states
	 * The assignment is performed when the instance of class is created
	 */
	public function init() { }

	/**
	 * Create Client instance using singleton
	 * @return \Elasticsearch\Client|null
	 */
	public function getClientInstance() {
		if (null === $this->client) {
			$this->client = ClientBuilder::create();
			if ($this->host) {
				$this->client = $this->client->setHosts(['host' => $this->host]);
			}
			$this->client = $this->client->build();
		}
		return $this->client;
	}

	/**
	 * Get end point of ES to perform query
	 * @param $index
	 * @return array
	 * @throws CHttpException
	 */
	private function getPath($index) {
		$this->params = [];
		if (isset($this->es_index_type[$index])) {
			return [
				'index' => $index,
				'type' => $this->es_index_type[$index]
			];
		} else {
			throw new CHttpException(400, "Bad Request!");
		}
	}

	/**
	 * Get data from ES by unique ID only
	 * @param $index {String}
	 * @param $id {String | Integer}
	 * @return mixed
	 * @throws CHttpException
	 * @Example: Yii::app()->es->getById('rental_properties', 'BC-1000010')
	 */
	public function getById($index, $id) {
		$this->params = $this->getPath($index);
		$this->params['id'] = $id;
		return $this->getClientInstance()->get($this->params);
	}

	/**
	 * Get data by query
	 * @param $index {String}
	 * @param $body {Array}
	 * @return array|mixed
	 * @throws CHttpException
	 */
	public function getByQuery($index, $body) {
		$this->params = $this->getPath($index);
		$this->params = $this->params + $body;
		return $this->getClientInstance()->search($this->params);
	}

	/**
	 * Delete a record from ElasticSearch index
	 * @param $index {String}
	 * @param $id {String | Integer}
	 * @return array|mixed
	 * @throws CHttpException
	 */
	public function deleteById($index, $id)
	{
		$this->params = $this->getPath($index);
		$this->params['id'] = $id;
		return $this->getClientInstance()->delete($this->params);
	}

	/**
	 * Get data by query
	 * @param $index {String}
	 * @param $body {Array}
	 * @return array|mixed
	 * @throws CHttpException
	 */
	public function deleteByQuery($index, $body)
	{
		$this->params = $this->getPath($index);
		$this->params = $this->params + $body;
		return $this->getClientInstance()->deleteByQuery($this->params);
	}

	/**
	 * Get data by query
	 * @param $index {String}
	 * @param $body {Array}
	 * @return array|mixed
	 * @throws CHttpException
	 */
	public function getCount($index, $body) {
		$this->params = $this->getPath($index);
		$this->params = $this->params + $body;
		return $this->getClientInstance()->count($this->params);
	}

	/**
	 * Delete a record from ElasticSearch index
	 * @param $index {String}
	 * @param $id {String | Integer}
	 * @return array|mixed
	 * @throws CHttpException
	 */
	public function isExist($index, $id)
	{
		$this->params = $this->getPath($index);
		$this->params['id'] = $id;
		return $this->getClientInstance()->exists($this->params);
	} 

	/**
	 * Delete a record from ElasticSearch index
	 * @param $index {String}
	 * @param $id {String | Integer}
	 * @param $body {Array}
	 * @return array|mixed
	 * @throws CHttpException
	 */
	public function updateById($index, $id, $body)
	{
		$this->params = $this->getPath($index);
		$this->params['id'] = $id;
		$this->params = $this->params + $body;
		return $this->getClientInstance()->count($this->params);
	}

	/**
	 * @param $index {String}
	 * @param $body {Array}
	 * @param $type {Array}
	 * @return array|mixed
	 * @throws CHttpException
	 */
	public function updateByQuery($index, $body, $type)
	{
		$this->params = $this->getPath($index);
		$this->params = $this->params + $body;
		$this->params = $this->params + $type;
		return $this->getClientInstance()->count($this->params);
	}
}

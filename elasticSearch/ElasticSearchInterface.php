<?php

interface ElasticSearchInterface {
	/**
	 * @param $index {String} The name of index in ES cluster
	 * @param $id {String | Integer} Unique id in records
	 * @return mixed
	 */
	public function getById($index, $id);

	/**
	 * @param $index {String} The name of index in ES cluster
	 * @param $body {Array} Query conditions as array
	 * @return mixed
	 */
	public function getByQuery($index, $body);

	/**
	 * @param $index {String} The name of index in ES cluster
	 * @param $id {String | Integer} Unique id in records
	 * @return mixed
	 */
	public function deleteById($index, $id);

	/**
	 * @param $index {String} The name of index in ES cluster
	 * @param $body {Array} Query conditions as array
	 * @return mixed
	 */
	public function deleteByQuery($index, $body);

	/**
	 * @param $index {String} The name of index in ES cluster
	 * @param $id {String | Integer} Unique id in records
	 * @return mixed
	 */
	public function isExist($index, $id);

	/**
	 * @param $index {String} The name of index in ES cluster
	 * @param $id {String | Integer} Unique id in records
	 * @param $body {Array} Query conditions as array
	 * @return mixed
	 */
	public function updateById($index, $id, $body);

	/**
	 * @param $index {String} The name of index in ES cluster
	 * @param $body {Array} Query conditions as array
	 * @param $type {Array}
	 * @return mixed
	 */
	public function updateByQuery($index, $body, $type);
}

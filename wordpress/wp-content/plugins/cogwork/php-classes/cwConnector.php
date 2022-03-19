<?php

class cwConnector {

	protected static $jsonDataUrl = 'api/json/';

	protected $errors = array();

	protected $params = array(
			'org' => null,
			'contentType' => ''
	);

	protected $orgCode = 'dktest';
	protected $protocol = 'https';
	protected $host = 'minaaktiviteter';
	protected $apiKey = '';

	protected $contentType = '';
	protected $contentDataArr = null;

	private $contentLoaded = false;

	public function __construct() {
		$this->loadSettings();
	}

	/**
	 * @return array
	 */
	public function toArray() {
		$arr = array();
		$arr['contentType'] = $this->contentType;
		$arr['orgCode'] = $this->orgCode;
		$arr['getJsonDataUrl()'] = $this->getJsonDataUrl();
		$arr['params'] = $this->params;
		return $arr;
	}

	/**
	 * Loads local plugin settings to object properties
	 */
	private function loadSettings() {

		$options = get_option('cogwork_option');

		if (!empty($options['orgCode'])) {
			$this->orgCode = $options['orgCode'];
		}

		if (!empty($options['websiteCode'])) {
			$this->host = $options['websiteCode'];
		}

		if (!empty($options['protocol'])) {
			$this->protocol = $options['protocol'];
		}

		if (!empty($options['apiKey'])) {
			$this->apiKey= $options['apiKey'];
		}
	}

	/**
	 * @return array
	 */
	public function getContentDataArray() {

		$this->loadContentDataArray();

		return $this->contentDataArr;
	}

	/**
	 * @param string $contentType
	 */
	public function setContentType($contentType) {

		if (!is_scalar($contentType)) {
			return;
		}

		$this->contentType = trim((string) $contentType);
	}

	public function getHtmlContent() {

		$this->loadContentDataArray();
		$dataArr = &$this->contentDataArr;

		$html = "\n";
		$html.= "\n<!-- ";
		$html.= "\n    Content retrieved by CogWork API";
		$html.= "\n    Host = ".$this->host;
		$html.= "\n    Content type = " .$this->contentType;
		$html.= "\n    JSON Data URL = ".$this->getJsonDataUrl(false);
		foreach ($this->errors as $error) {
			$html.= "\n    Error: " .$error;
		}
		$html.= "\n-->";

		// When we reached add_shortcode it is to late to use wp_enqueue_style and wp_enqueue_script
		if (isset($dataArr['cssFiles']) && is_array($dataArr['cssFiles'])) {
			foreach ($dataArr['cssFiles'] as $fileData) {
				if (empty($fileData['url'])) { continue; }
				$html.= "\n".'<link rel="stylesheet" href="'.htmlspecialchars($fileData['url']).'" type="text/css" media="all" />';
			}
		}

	
		if (isset($dataArr['javascriptFilesBefore']) && is_array($dataArr['javascriptFilesBefore'])) {
			foreach ($dataArr['javascriptFilesBefore'] as $fileData) {
				if (empty($fileData['url'])) { continue; }
				$html.= "\n".'<script type="text/javascript" src="'.htmlspecialchars($fileData['url']).'"></script>';
			}
		}
	

		if (!empty($dataArr['htmlBlock'])) {
			$html.= "\n".$dataArr['htmlBlock'];
		}


		if (isset($dataArr['javascriptFilesAfter']) && is_array($dataArr['javascriptFilesAfter'])) {
			foreach ($dataArr['javascriptFilesAfter'] as $fileData) {
				if (empty($fileData['url'])) { continue; }
				$html.= "\n".'<script type="text/javascript" src="'.htmlspecialchars($fileData['url']).'"></script>';
			}
		}	 
		
		return $html;
	}

	private function adjustParams() {

		if (isset($this->orgCode)) {
			$this->params['org'] = $this->orgCode;
		}
		if (!empty($this->contentType)) {
			$this->params['contentType'] = $this->contentType;
		}
	}

	public function addParam($paramName, $paramValue) {
		$this->params[$paramName] = $paramValue;
	}

	private function getJsonDataUrl($includeApiKey=false) {

		$this->adjustParams();

		$hostUrl = $this->protocol.'://';
		switch ($this->host) {
			case 'test'  : $hostUrl.= 'test.minaaktiviteter.se/'; break;
			case 'local' : $hostUrl.= 'localhost/cw/public_html/'; break;
			case 'dans'  : $hostUrl.= 'dans.se/'; break;
			case 'idrott'  : $hostUrl.= 'idrott.se/'; break;
			default      : $hostUrl.= 'minaaktiviteter.se/'; break;
		}

		$urlVarArr = array();

		if (isset($this->params) && count($this->params) > 0) {
			foreach ( $this->params as $key => $val ) {
				if (empty($key)) {
					continue;
				}

				if (is_numeric($key)) {
					$urlVar = urlencode($val);
					$val = null;
				} else {
					$urlVar = urlencode($key);
				}

				if (isset($val)) {
					$urlVar.= '='.urlencode($val);
				}

				$urlVarArr[] = $urlVar;
			}
		}
		if ($includeApiKey && !empty($this->apiKey)) {
			$urlVarArr[] = 'pw='.urlencode($this->apiKey);
		}
		$urlVarStr = implode('&', $urlVarArr);

		$url = $hostUrl.self::$jsonDataUrl.'?'.$urlVarStr;

		return $url;
	}

	/**
	 * @return string
	 *
	 * Sends a request to the CogWork server and returns the json formatted server response
	 */
	private function loadContent() {

		$url = $this->getJsonDataUrl(true);

		if (function_exists('curl_init')) {

			// Initialize the CURL library
			$cURL = curl_init();

			// Set the URL to execute
			curl_setopt($cURL, CURLOPT_URL, $url);

			// Set options. More info at http://my.php.net/curl-setopt
			curl_setopt($cURL, CURLOPT_HEADER, 0);
			curl_setopt($cURL, CURLOPT_RETURNTRANSFER, 1);

			// Execute, saving results in a variable
			$strPage = curl_exec($cURL);

			if ($strPage === true) {
				$strPage = '';
			}

			// Close CURL resource
			curl_close($cURL);

			return $strPage;
		}

		$strPage = @file_get_contents($url);
		if ($strPage !== false) {
			return $strPage;
		}

		$errMsg = 'Server settings do not allow content to be loaded from external sources. ';
		$errMsg.= 'Curl or file_get_contents must be allowed.';

		$this->errors[] = $errMsg;

		return '';
	}

	private function loadContentDataArray() {

		// Skip if already loaded
		if ($this->contentLoaded) {
			return;
		}

		$str = $this->loadContent();
		$this->contentDataArr = json_decode($str, true);

		$this->contentLoaded = true;
	}
}

?>
<?php
class Translator {
	private $language	= 'EN';
	private $lang 		= array();

	public function __construct($language){
		$this->language		= $language;
		// $this->lang			= $lang;
		$this->lang			= [];
		$this->langfolder	= 'languages';
	}

	private function findString($str){
		if (array_key_exists($str, $this->lang[$this->language])){
			echo $this->lang[$this->language][$str];
			return null;
		} else {
			// if no translation is found, default to english
			$english = $this->english();
			if (array_key_exists($str, $english)){
				echo $english[$str];
			} else {
				echo $str;
			}
		}
	}

	private function splitStrings($str){
		return explode('=',trim($str));
	}

	public function __($str){
		$langfolder = 'languages';
		$this->lang = array();
		if (!array_key_exists($this->language, $this->lang)){
			$langpath = $langfolder . DS . 'brcc-' . $this->language . '.txt';
			if (file_exists($langpath)){
				$strings = array_map(array($this, 'splitStrings'), file($langpath));
				foreach ($strings as $k => $v){
					// if not empty (account for empty lines in .txt file)
					if (!empty($v[0])) {
						$this->lang[$this->language][$v[0]] = $v[1];
					}
				}

				return $this->findString($str);
			} else {
				echo $str;
			}
		} else {
			return $this->findString($str);
		}
	}

	public function english(){
		$langfolder = 'languages';
		$langpath = $langfolder.DS.'brcc-EN.txt';
		if (file_exists($langpath)){
			$strings = array_map(array($this,'splitStrings'),file($langpath));
			foreach ($strings as $k => $v){
				// if not empty (account for empty lines in .txt file)
				if (!empty($v[0])) {
					$langEN[$v[0]] = $v[1];
				}
			}
			return $langEN;
		}
	}
}

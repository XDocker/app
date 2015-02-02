<?php

function usernoise_url($path){
	global $config;
	return $config['home'] . "$path";
}

if (!class_exists('HTML_Helpers_0_4')){
	class HTML_Helpers_0_4{
		/* HTML Generator functions */
		function _tag($tag, $attributes = array(), $content = null, $close = null){
			if (!is_array($attributes)){
				$close = $content;
				$content = $attributes;
				$attributes = array();
			}
			if (is_bool($content)){
				$close = $content;
				$content = null;
			}
			if ($content === null && $close === null)
				$close = true;
			else if ($close === null)
				$close = $content != null;
			else
				$close = $close === null ? true : $close;
			$parts = explode(' ', $tag, 2);
			$tag = $parts[0];
			$additional_attrs = count($parts) > 1 ? $parts[1] : null;
			return $this->_tag_start($tag . ($additional_attrs ? " " . $additional_attrs : ''), $attributes) . 
				$content . 
				($close ? $this->_tag_end($tag) : '');
		}

		function tag($tag, $attributes = array(), $content = null, $close = null){
			echo $this->_tag($tag, $attributes, $content, $close);
		}

		function _tag_start($tag, $attributes = array()){
			$attr_string = '';
			foreach( $attributes as $key => $val)
				$attr_string .= " $key=\"" . htmlspecialchars(is_array($val) ? join(' ', $val) : $val) . "\"";
			return "<$tag $attr_string>";
		}

		function tag_start($tag, $attributes = array()){
			echo $this->_tag_start($tag, $attributes);
		}

		function _tag_end($tag){
			return "</{$tag}>";
		}
	
		function tag_end($tag){
			echo $this->_tag_end($tag);
		}

		function _img($src, $alt = null, $attributes = array()){
			if ('' !== $alt && !$alt){
				$alt = ucwords(pathinfo($src, PATHINFO_FILENAME));
			}
			if ($alt) $attributes['alt'] = $alt;
			if (!pathinfo($src, PATHINFO_EXTENSION))
				$src .= ".png";
			$attributes['src'] = $src;
			return $this->_tag('img', $attributes, null, false);
		}

		function img($src, $alt = null, $attributes = array()){
			echo $this->_img($src, $alt, $attributes);
		}

		function _link_to($text, $url = '', $attributes = array()){
			$attributes['href'] = $url;
			return $this->_tag('a', $attributes, $text, true);
		}

		function link_to($text, $url = '', $attributes = array()){
			echo $this->_link_to($text, $url, $attributes);
		}

		function _select($name, $values = array(), $selected = null, $attributes = array(), 
		$options = array()){
			$multi = isset($attributes['multiple']) && $attributes['multiple'];
			if ($multi)
				$attributes['multiple'] = "multiple";
			$res = '';
			if (isset($options['empty']) && $options['empty']){
				$res .= $this->_tag('option', array('value' => null), $options['empty']);
			}
			foreach ($values as $arr){
				$text = $arr[0];
				if (isset($arr[1]))
					$value = $arr[1];
				else unset($value);
				$attrs = array();
				if ((!$multi && ((isset($value) && $value == $selected) || (!isset($value) && $selected == null) || $text === $selected)) ||
					($multi && ($value && in_array($value, $selected) || in_array($text, $selected)))) 
					$attrs['selected'] = 'selected';
				if (isset($value))
					$attrs['value'] = $value;
				$res .= $this->_tag("option", $attrs, $text);      
			}
			$attributes['name'] = $name;
			if (empty($attributes['id']))
				$attributes['id'] = sanitize_title_with_dashes($attributes['name']);
			return $this->_tag('select', $attributes, false) . $res . $this->_tag_end('select');
		}

		function select($name, $values = array(), $selected = null, $attributes = array(),
			$options = array()){
			echo $this->_select($name, $values, $selected, $attributes, $options);
		}

		function _text_field($name, $value = null, $attributes = array()){
			$attributes['value'] = $value;
			$attributes['name'] = $name;
			$attributes['type'] = 'text';
			if (empty($attributes['id']))
				$attributes['id'] = sanitize_title_with_dashes($attributes['name']);
			return $this->_tag('input', $attributes, null, false);
		}

		function text_field($name, $value = null, $attributes = array()){
			echo $this->_text_field($name, $value, $attributes);
		}

		function _password_field($name, $value = null, $attributes = array()){
			$attributes['value'] = $value;
			$attributes['name'] = $name;
			$attributes['type'] = 'password';
			if (empty($attributes['id']))
				$attributes['id'] = sanitize_title_with_dashes($attributes['name']);
			return $this->_tag('input', $attributes, null, false);
		}

		function password_field($name, $value = null, $attributes = array()){
			echo $this->_password_field($name, $value, $attributes);
		}

		function _hidden_field($name, $value = null, $attributes = array()){
			$attributes['value'] = $value;
			$attributes['name'] = $name;
			$attributes['type'] = 'hidden';
			return $this->_tag('input', $attributes, null, false);
		}

		function hidden_field($name, $value = null, $attributes = array()){
			echo $this->_hidden_field($name, $value, $attributes);
		}

		function _checkbox($name, $value = null, $checked = false, $attributes = array()){
			if ($checked)
				$attributes['checked'] = 'checked';
			$attributes['type'] = 'checkbox';
			$attributes = array_merge($attributes, array('name' => $name, 'value' => $value));
			if (empty($attributes['id']))
				$attributes['id'] = sanitize_title_with_dashes($attributes['name']);
			return $this->_tag('input', $attributes, null, false);
		}

		function checkbox($name, $value = null, $checked = false, $attributes = array()){
			echo $this->_checkbox($name, $value, $checked, $attributes);
		}
	

		function _radiobutton($name, $value = null, $checked = false, $attributes = array()){
			if ($checked)
				$attributes['checked'] = 'checked';
			$attributes['type'] = 'radio';
			$attributes = array_merge($attributes, array('name' => $name, 'value' => $value));
			if (empty($attributes['id']))
				$attributes['id'] = sanitize_title_with_dashes($attributes['name']);
			return $this->_tag('input', $attributes);
		}

		function radiobutton($name, $value = null, $checked = false, $attributes = array()){
			echo $this->_radiobutton($name, $value, $checked, $attributes);
		}

		function _textarea($name, $value, $attributes = array(), $escape = true){
			$attributes['name'] = $name;
			if (empty($attributes['id']))
				$attributes['id'] = sanitize_title_with_dashes($attributes['name']);
			return $this->_tag('textarea', $attributes, $escape ? @htmlspecialchars($value) : $value, true);
		}
	
		function textarea($name, $value = '', $attributes = array(), $escape = true){
			echo $this->_textarea($name, $value, $attributes, $escape);
		}

		function _label($content, $attrs = array()){
			return $this->_tag('label', $attrs, $content);
		}

		function label($content, $attrs = array()){
			echo $this->_label($content, $attrs);
		}

		function _cycle($array, $context = null){
			global $cycles;
			if (!$context)
				$context = 'default';
			if (!isset($cycles[$context]))
				$cycles[$context] = 0;
			return $array[$cycles[$context]++ % count($array)];
		}
	
		function cycle($array, $context = null){
			echo $this->_cycle($array, $context);
		}

		function reset_cycle($context = 'default'){
			global $cycles;
			if (!$cycles) return;
			$cycles[$context] = 0;
		}

		/* Helper functions */

		function collection2hastag($collection, $key_field, $value_field){
			$result = array();
			foreach($collection as $obj){
				$result[$obj->$key_field] = $obj->$value_field;
			}
			return $result;
		}

		function collection2options($collection, $key_field, $value_field, $empty = null){
			$result = array();
			if ($empty){
				$result []= array($empty, '');
			}
			foreach($collection as $obj){
				$result []= array($obj->$value_field, $obj->$key_field);
			}
			return $result;
		}

		function hash2options($hash, $empty = null){
			$options = array();
			if ($empty){
				$options []= array($empty, '');
			}
			foreach($hash as $key => $value){
				$options []= array($value, $key);
			}
			return $options;
		}

		function array2options($array, $empty = null){
			$options = array();
			if ($empty){
				$options []= array($empty, '');
			}
			foreach($array as $item){
				$options []= array($item, null);
			}
			return $options;
		}
	}
}

function is_email( $email, $deprecated = false ) {
	if ( strlen( $email ) < 3 ) {
		return false;
	}
	if ( strpos( $email, '@', 1 ) === false ) {
		return false;
	}
	list( $local, $domain ) = explode( '@', $email, 2 );
	if ( !preg_match( '/^[a-zA-Z0-9!#$%&\'*+\/=?^_`{|}~\.-]+$/', $local ) ) {
		return false;
	}
	if ( preg_match( '/\.{2,}/', $domain ) ) {
		return false;
	}
	if ( trim( $domain, " \t\n\r\0\x0B." ) !== $domain ) {
		return false;
	}
	$subs = explode( '.', $domain );
	if ( 2 > count( $subs ) ) {
		return false;
	}
	foreach ( $subs as $sub ) {
		if ( trim( $sub, " \t\n\r\0\x0B-" ) !== $sub ) {
			return false;
		}
		if ( !preg_match('/^[a-z0-9-]+$/i', $sub ) ) {
			return false;
		}
	}
	return true;
}
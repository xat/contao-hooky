<?php
/**
 * Contao Open Source CMS
 *
 * Copyright (C) 2005-2012 Leo Feyer
 *
 * @package   Hooky
 * @author    Simon Kusterer
 * @license   LGPL
 * @copyright Simon Kusterer 2013
 */

class Hooky
{

	/**
	 * Cache objects in here
	 *
	 * @var array
	 */
	protected static $arrObjects = array();

	/**
	 * Create, Cache and return an Object
	 *
	 * @param string
	 * @return object
	 */
	protected static function getObject($strClass)
	{
		if (!isset(self::$arrObjects[$strClass]))
		{
			self::$arrObjects[$strClass] = (in_array('getInstance', get_class_methods($strClass))) ? call_user_func(array($strClass, 'getInstance')) : new $strClass();
		}

		return self::$arrObjects[$strClass];
	}

	/**
	 * Trigger a Hook
	 *
	 * @param $strHook
	 * @param $a
	 * @param $b
	 * @param $c
	 * @param $d
	 * @param $e
	 * @param $f
	 * @param $g
	 * @param $h
	 * @param $i
	 * @param $j
	 * @param $k
	 * @param $l
	 * @param $m
	 * @param $n
	 * @param $o
	 * @return boolean
	 */
	public static function trigger($strHook, &$a=null, &$b=null, &$c=null, &$d=null, &$e=null, &$f=null, &$g=null, &$h=null, &$i=null, &$j=null, &$k=null, &$l=null, &$m=null, &$n=null, &$o=null)
	{
		// Please do not blame me for this method :)
		// I know what you are thinking: WTH are you not using func_get_args()?
		// Well, the reason is, that call-by-reference would not be possible
		// anymore if I would use that (see https://gist.github.com/4426999)
		// So here we are, have arguments from a to o

		if (isset($GLOBALS['TL_HOOKS'][$strHook]) && is_array($GLOBALS['TL_HOOKS'][$strHook]))
		{
			foreach ($GLOBALS['TL_HOOKS'][$strHook] as $callback)
			{
				$objHook = self::getObject($callback[0]);
				$objHook->$callback[1]($a, $b, $c, $d, $e, $f, $g, $h, $i, $j, $k, $l, $m, $n, $o);
			}

			return true;
		}

		return false;
	}
}

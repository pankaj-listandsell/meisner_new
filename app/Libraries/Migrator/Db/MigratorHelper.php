<?php


namespace App\Libraries\Migrator\Db;


trait MigratorHelper
{


	/**
	 * Object Collection Into Array
	 *
	 * @param $objects
	 * @return array
	 */
	public static function toArray($objects)
	{
		$array = [];

		foreach ($objects as $object) {
			$array[] = (array)$object;
		}

		return $array;
	}


	/**
	 * Change Key
	 *
	 * @param $array
	 * @param $old_key
	 * @param $new_key
	 * @return array|false
	 */
	public static function changeKey( $array, $old_key, $new_key ) {

		if( ! array_key_exists( $old_key, $array ) )
			return $array;

		$keys = array_keys( $array );
		$keys[ array_search( $old_key, $keys ) ] = $new_key;

		return array_combine( $keys, $array );
	}

	public static function changeKeys($array, $keys)
	{
		$modifiedArray = $array;

		foreach ($keys as $prevKey => $newKey) {

			if (key_exists($prevKey, $array)) {
				$modifiedArray = self::changeKey($array, $prevKey, $newKey);
			}

			if (count($keys) > 0) {
				array_shift($keys);
			}

			if (count($keys) == 0) {
				return $modifiedArray;
			}

			return self::changeKeys($modifiedArray, $keys);
		}
	}


	public static function removeKey($array, $key)
	{
		if (key_exists($key, $array)) {
			unset($array[$key]);
		}

		return $array;
	}


	public static function removeKeys($array, $keys)
	{
		$modifiedArray = $array;

		foreach ($keys as $key) {

			if (key_exists($key, $modifiedArray)) {
				$modifiedArray = self::removeKey($array, $key);
			}

			if (count($keys) > 0) {
				array_shift($keys);
			}

			if (count($keys) == 0) {
				return $modifiedArray;
			}

			return self::removeKeys($modifiedArray, $keys);
		}
	}


    public static function addKeys($array, $values)
    {
        foreach ($values as $key => $value) {
            $array = self::addKey($array, $key, $value);
        }
        return $array;
    }


    public static function addKey($array, $key, $value)
    {
        $array[$key] = $value;

        return $array;
    }

}

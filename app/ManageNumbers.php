<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ManageNumbers extends Model
{
	public static function getMoneyByWords($number) {
		$intNumber = floor($number);
		$decNumber = $number - $intNumber;

		$numerator = round($decNumber * 100);

		$pesos = $intNumber == 1 ? ' PESO ' : ' PESOS ';
		return '('.self::getNumberInWords($number).$pesos.$numerator.'/100 M. N.)';
	}


    public static function getNumberInWords($number) {
    	if ($number == 0)
    		return 'CERO';

		if ($number >= 1000000000000)
			return 'Número demasiado grande - sin descripción';

		$intNumber = floor($number);
		return self::getNumberInWordsAux($intNumber);
	}

	private static function getNumberInWordsAux($number) {
		if ($number < 10)
		{
			switch ($number)
			{
				case 0: return '';
				case 1: return 'UN';
				case 2: return 'DOS';
				case 3: return 'TRES';
    			case 4: return 'CUATRO';
    			case 5: return 'CINCO';
    			case 6: return 'SEIS';
    			case 7: return 'SIETE';
    			case 8: return 'OCHO';
    			case 9: return 'NUEVE';
			}
		}

		if ($number < 100)
		{
			$D = floor($number / 10);
			$U = floor($number % 10);

			switch ($D)
			{
				case 1:
				switch ($number)
				{
					case 10: return 'DIEZ';
	    			case 11: return 'ONCE';
	    			case 12: return 'DOCE';
	    			case 13: return 'TRECE';
	    			case 14: return 'CATORCE';
	    			case 15: return 'QUINCE';
	    			default: return 'DIECI' . self::getNumberInWordsAux($U);
				}
				case 2:
				switch ($number)
				{
					case 20: return 'VEINTE';
					default: return 'VEINTI' . self::getNumberInWordsAux($U);
				}
				case 3:
				switch ($number)
				{
					case 30: return 'TREINTA';
					default: return 'TREINTA Y ' . self::getNumberInWordsAux($U);
				}
				case 4:
				switch ($number)
				{
					case 40: return 'CUARENTA';
					default: return 'CUARENTA Y ' . self::getNumberInWordsAux($U);
				}
				case 5:
				switch ($number)
				{
					case 50: return 'CINCUENTA';
					default: return 'CINCUENTA Y ' . self::getNumberInWordsAux($U);
				}
				case 6:
				switch ($number)
				{
					case 60: return 'SESENTA';
					default: return 'SESENTA Y ' . self::getNumberInWordsAux($U);
				}
				case 7:
				switch ($number)
				{
					case 70: return 'SETENTA';
					default: return 'SETENTA Y ' . self::getNumberInWordsAux($U);
				}
				case 8:
				switch ($number)
				{
					case 80: return 'OCHENTA';
					default: return 'OCHENTA Y ' . self::getNumberInWordsAux($U);
				}
				case 9:
				switch ($number)
				{
					case 90: return 'NOVENTA';
					default: return 'NOVENTA Y ' . self::getNumberInWordsAux($U);
				}
			}
		}

		if ($number < 1000)
		{
			$C = floor($number / 100);
			$remainder = floor($number % 100);

			switch ($C)
			{
				case 1:
				switch ($number)
				{
					case 100: return 'CIEN';
					default: return 'CIENTO ' . self::getNumberInWordsAux($remainder);
				}
				case 2:
				switch ($number)
				{
					case 200: return 'DOCIENTOS';
					default: return 'DOCIENTOS ' . self::getNumberInWordsAux($remainder);
				}
				case 3:
				switch ($number)
				{
					case 300: return 'TRECIENTOS';
					default: return 'TRECIENTOS ' . self::getNumberInWordsAux($remainder);
				}
				case 4:
				switch ($number)
				{
					case 400: return 'CUATROCIENTOS';
					default: return 'CUATROCIENTOS ' . self::getNumberInWordsAux($remainder);
				}
				case 5:
				switch ($number)
				{
					case 500: return 'QUINIENTOS';
					default: return 'QUINIENTOS ' . self::getNumberInWordsAux($remainder);
				}
				case 6:
				switch ($number)
				{
					case 600: return 'SEISCIENTOS';
					default: return 'SEISCIENTOS ' . self::getNumberInWordsAux($remainder);
				}
				case 7:
				switch ($number)
				{
					case 700: return 'SETECIENTOS';
					default: return 'SETECIENTOS ' . self::getNumberInWordsAux($remainder);
				}
				case 8:
				switch ($number)
				{
					case 800: return 'OCHOCIENTOS';
					default: return 'OCHOCIENTOS ' . self::getNumberInWordsAux($remainder);
				}
				case 9:
				switch ($number)
				{
					case 900: return 'NOVECIENTOS';
					default: return 'NOVECIENTOS ' . self::getNumberInWordsAux($remainder);
				}
			}
		}
		// more than a thousand
		if ($number < 1000000)
		{
			$fHalf = floor($number / 1000);
			$remainder = floor($number % 1000);

			if ($fHalf == 1)
			{
				return 'MIL ' . self::getNumberInWordsAux($remainder);
			}
			else
			{
				return self::getNumberInWordsAux($fHalf, true) . 
				'MIL ' . self::getNumberInWordsAux($remainder);
			}
		}

		// more than a million
		$fHalf = floor($number / 1000000);
		$remainder = floor($number % 1000000);
		$million = $fHalf == 1 ? ' MILLON ' : ' MILLONES ';
		return self::getNumberInWordsAux($fHalf, true) .
		$million . self::getNumberInWordsAux($remainder);
	}
}

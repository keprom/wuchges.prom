<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------

/*
Instructions:

Load the plugin using:

 	$this->load->plugin('captcha');

Once loaded you can generate a captcha like this:
	
	$vals = array(
					'word'		 => 'Random word',
					'img_path'	 => './captcha/',
					'img_url'	 => 'http://example.com/captcha/',
					'font_path'	 => './system/fonts/texb.ttf',
					'img_width'	 => '150',
					'img_height' => 30,
					'expiration' => 7200
				);
	
	$cap = create_captcha($vals);
	echo $cap['image'];
	

NOTES:
	
	The captcha function requires the GD image library.
	
	Only the img_path and img_url are required.
	
	If a "word" is not supplied, the function will generate a random
	ASCII string.  You might put together your own word library that
	you can draw randomly from.
	
	If you do not specify a path to a TRUE TYPE font, the native ugly GD
	font will be used.
	
	The "captcha" folder must be writable (666, or 777)
	
	The "expiration" (in seconds) signifies how long an image will
	remain in the captcha folder before it will be deleted.  The default
	is two hours.

RETURNED DATA

The create_captcha() function returns an associative array with this data:

  [array]
  (
	'image' => IMAGE TAG
	'time'	=> TIMESTAMP (in microtime)
	'word'	=> CAPTCHA WORD
  )

The "image" is the actual image tag:
<img src="http://example.com/captcha/12345.jpg" width="140" height="50" />

The "time" is the micro timestamp used as the image name without the file
extension.  It will be a number like this:  1139612155.3422

The "word" is the word that appears in the captcha image, which if not
supplied to the function, will be a random string.


ADDING A DATABASE

In order for the captcha function to prevent someone from posting, you will need
to add the information returned from create_captcha() function to your database.
Then, when the data from the form is submitted by the user you will need to verify
that the data exists in the database and has not expired.

Here is a table prototype:

	CREATE TABLE captcha (
	 captcha_id bigint(13) unsigned NOT NULL auto_increment,
	 captcha_time int(10) unsigned NOT NULL,
	 ip_address varchar(16) default '0' NOT NULL,
	 word varchar(20) NOT NULL,
	 PRIMARY KEY `captcha_id` (`captcha_id`),
	 KEY `word` (`word`)
	)


Here is an example of usage with a DB.

On the page where the captcha will be shown you'll have something like this:

	$this->load->plugin('captcha');
	$vals = array(
					'img_path'	 => './captcha/',
					'img_url'	 => 'http://example.com/captcha/'
				);
	
	$cap = create_captcha($vals);

	$data = array(
					'captcha_id'	=> '',
					'captcha_time'	=> $cap['time'],
					'ip_address'	=> $this->input->ip_address(),
					'word'			=> $cap['word']
				);

	$query = $this->db->insert_string('captcha', $data);
	$this->db->query($query);
		
	echo 'Submit the word you see below:';
	echo $cap['image'];
	echo '<input type="text" name="captcha" value="" />';


Then, on the page that accepts the submission you'll have something like this:

	// First, delete old captchas
	$expiration = time()-7200; // Two hour limit
	$DB->query("DELETE FROM captcha WHERE captcha_time < ".$expiration);		

	// Then see if a captcha exists:
	$sql = "SELECT COUNT(*) AS count FROM captcha WHERE word = ? AND ip_address = ? AND date > ?";
	$binds = array($_POST['captcha'], $this->input->ip_address(), $expiration);
	$query = $this->db->query($sql, $binds);
	$row = $query->row();

	if ($row->count == 0)
	{
		echo "You must submit the word that appears in the image";
	}

*/


	
/**
|==========================================================
| Create Captcha
|==========================================================
|
*/

function num2str($inn, $stripkop=false) {
	$nol = 'ноль';
	$str[100]= array('','сто','двести','триста','четыреста','пятьсот','шестьсот', 'семьсот', 'восемьсот','девятьсот');
	$str[11] = array('','десять','одиннадцать','двенадцать','тринадцать', 'четырнадцать','пятнадцать','шестнадцать','семнадцать', 'восемнадцать','девятнадцать','двадцать');
	$str[10] = array('','десять','двадцать','тридцать','сорок','пятьдесят', 'шестьдесят','семьдесят','восемьдесят','девяносто');
	$sex = array(
		array('','один','два','три','четыре','пять','шесть','семь', 'восемь','девять'),// m
		array('','одна','две','три','четыре','пять','шесть','семь', 'восемь','девять') // f
	);
	$forms = array(
		array('тиын',  'тиын',   'тиын',     1), // 10^-2
		array('тенге',    'тенге',     'тенге',     0), // 10^ 0
		array('тысяча',   'тысячи',    'тысяч',      1), // 10^ 3
		array('миллион',  'миллиона',  'миллионов',  0), // 10^ 6
		array('миллиард', 'миллиарда', 'миллиардов', 0), // 10^ 9
		array('триллион', 'триллиона', 'триллионов', 0), // 10^12
	);
	$out = $tmp = array();
	// Поехали!
	$tmp = explode('.', str_replace(',','.', $inn));
	$rub = number_format($tmp[0],0,'','-');
	if ($rub==0) $out[] = $nol;
	// нормализация копеек
	$kop = isset($tmp[1]) ? substr(str_pad($tmp[1], 2, '0', STR_PAD_RIGHT),0,2) : '00';
	$segments = explode('-', $rub);
	$offset = sizeof($segments);
	if ((int)$rub==0) { // если 0 рублей
		$o[] = $nol;
		$o[] = morph(0, $forms[1][0],$forms[1][1],$forms[1][2]);
	}
	else {
		foreach ($segments as $k=>$lev) {
			$sexi= (int) $forms[$offset][3]; // определяем род
			$ri  = (int) $lev; // текущий сегмент
			if ($ri==0 && $offset>1) {// если сегмент==0 & не последний уровень(там Units)
				$offset--;
				continue;
			}
			// нормализация
			$ri = str_pad($ri, 3, '0', STR_PAD_LEFT);
			// получаем циферки для анализа
			$r1 = (int)substr($ri,0,1); //первая цифра
			$r2 = (int)substr($ri,1,1); //вторая
			$r3 = (int)substr($ri,2,1); //третья
			$r22= (int)$r2.$r3; //вторая и третья
			// разгребаем порядки
			if ($ri>99) $o[] = $str[100][$r1]; // Сотни
			if ($r22>20) {// >20
				$o[] = $str[10][$r2];
				$o[] = $sex[ $sexi ][$r3];
			}
			else { // <=20
				if ($r22>9) $o[] = $str[11][$r22-9]; // 10-20
				elseif($r22>0)  $o[] = $sex[ $sexi ][$r3]; // 1-9
			}
			// Рубли
			$o[] = morph($ri, $forms[$offset][0],$forms[$offset][1],$forms[$offset][2]);
			$offset--;
		}
	}
	// Копейки
	if (!$stripkop) {
		$o[] = $kop;
		$o[] = morph($kop,$forms[0][0],$forms[0][1],$forms[0][2]);
	}
	return preg_replace("/\s{2,}/",' ',implode(' ',$o));
}

function kvt2str($inn, $stripkop=true) {
	$nol = 'ноль';
	$str[100]= array('','сто','двести','триста','четыреста','пятьсот','шестьсот', 'семьсот', 'восемьсот','девятьсот');
	$str[11] = array('','десять','одиннадцать','двенадцать','тринадцать', 'четырнадцать','пятнадцать','шестнадцать','семнадцать', 'восемнадцать','девятнадцать','двадцать');
	$str[10] = array('','десять','двадцать','тридцать','сорок','пятьдесят', 'шестьдесят','семьдесят','восемьдесят','девяносто');
	$sex = array(
		array('','один','два','три','четыре','пять','шесть','семь', 'восемь','девять'),// m
		array('','одна','две','три','четыре','пять','шесть','семь', 'восемь','девять') // f
	);
	$forms = array(
		array('',  '',   '',     1), // 10^-2
		array('кВт',    'кВт',     'кВт',     0), // 10^ 0
		array('тысяча',   'тысячи',    'тысяч',      1), // 10^ 3
		array('миллион',  'миллиона',  'миллионов',  0), // 10^ 6
		array('миллиард', 'миллиарда', 'миллиардов', 0), // 10^ 9
		array('триллион', 'триллиона', 'триллионов', 0), // 10^12
	);
	$out = $tmp = array();
	// Поехали!
	$tmp = explode('.', str_replace(',','.', $inn));
	$rub = number_format($tmp[0],0,'','-');
	if ($rub==0) $out[] = $nol;
	// нормализация копеек
	$kop = isset($tmp[1]) ? substr(str_pad($tmp[1], 2, '0', STR_PAD_RIGHT),0,2) : '00';
	$segments = explode('-', $rub);
	$offset = sizeof($segments);
	if ((int)$rub==0) { // если 0 рублей
		$o[] = $nol;
		$o[] = morph(0, $forms[1][0],$forms[1][1],$forms[1][2]);
	}
	else {
		foreach ($segments as $k=>$lev) {
			$sexi= (int) $forms[$offset][3]; // определяем род
			$ri  = (int) $lev; // текущий сегмент
			if ($ri==0 && $offset>1) {// если сегмент==0 & не последний уровень(там Units)
				$offset--;
				continue;
			}
			// нормализация
			$ri = str_pad($ri, 3, '0', STR_PAD_LEFT);
			// получаем циферки для анализа
			$r1 = (int)substr($ri,0,1); //первая цифра
			$r2 = (int)substr($ri,1,1); //вторая
			$r3 = (int)substr($ri,2,1); //третья
			$r22= (int)$r2.$r3; //вторая и третья
			// разгребаем порядки
			if ($ri>99) $o[] = $str[100][$r1]; // Сотни
			if ($r22>20) {// >20
				$o[] = $str[10][$r2];
				$o[] = $sex[ $sexi ][$r3];
			}
			else { // <=20
				if ($r22>9) $o[] = $str[11][$r22-9]; // 10-20
				elseif($r22>0)  $o[] = $sex[ $sexi ][$r3]; // 1-9
			}
			// Рубли
			$o[] = morph($ri, $forms[$offset][0],$forms[$offset][1],$forms[$offset][2]);
			$offset--;
		}
	}
	// Копейки
	if (!$stripkop) {
		$o[] = $kop;
		$o[] = morph($kop,$forms[0][0],$forms[0][1],$forms[0][2]);
	}
	return preg_replace("/\s{2,}/",' ',implode(' ',$o));
}

/**
 * Склоняем словоформу
 */
function morph($n, $f1, $f2, $f5) {
	$n = abs($n) % 100;
	$n1= $n % 10;
	if ($n>10 && $n<20)	return $f5;
	if ($n1>1 && $n1<5)	return $f2;
	if ($n1==1)		return $f1;
	return $f5;
}


/* End of file captcha_pi.php */
/* Location: ./system/plugins/captcha_pi.php */